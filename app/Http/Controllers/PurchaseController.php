<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        if (!$purchase) {
            return redirect()->route('home')->with('error', 'Purchase not found.');
        }

        return view('purchase.show', compact('purchase'));
    }


    public function purchase(Request $request, $productId)
    {

        $product = \App\Models\Product::findOrFail($productId);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        $purchase = new \App\Models\Purchase();
        $purchase->user_id = Auth::id();
        $purchase->product_id = $productId;
        $purchase->price = $product->price;
        $purchase->status = 'pending';
        $purchase->transaction_id = 'txn_' . uniqid();

        if ($purchase->save()) {
            // init cinetpay transaction
            return $this->initializeCinetPayTransaction($purchase);
        } else {
            return redirect()->route('home')->with('error', 'Purchase failed. Please try again.');
        }
    }

    public function initializeCinetPayTransaction($purchase)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            env('CINETPAY_API_URL'),
            [
                'apikey' => env('CINETPAY_API_KEY'),
                'site_id' => env('CINETPAY_SITE_ID'),
                'transaction_id' => $purchase->transaction_id,
                'amount' => intval($purchase->price),
                'currency' => 'CDF',
                'description' => 'Achat du produit ID : ' . $purchase->product_id,
                'return_url' => route('purchase.verify', ['transaction_id' => $purchase->transaction_id]),
                'notify_url' => route('purchase.notify', ['transaction_id' => $purchase->transaction_id]),
                'channels' => ['ALL'],
            ]
        );

        if ($response->successful()) {
            $data = $response->json();

            if ($data['code'] == '201' && $data['message'] === 'CREATED') {
                return redirect($data['data']['payment_url']);
            }
        }

        Log::error('CinetPay transaction initialization failed', [
            'response' => $response->json(),
            'purchase_id' => $purchase->id,
            'request' => $response,
        ]);

        return redirect()->route('home')->with('error', 'Une erreur s\'est produite');
    }

    public function notification(Request $request, $transaction_id)
    {
        Log::info($request->all());

        try {
            $purchase = Purchase::where('transaction_id', $transaction_id)->first();

            if (!$purchase) {
                Log::error('Purchase not found for transaction ID: ' . $transaction_id);
                return response();
            }

            $this->checkStatus($purchase);

            return response();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response();
        }
    }

    public function verification(Request $request, $transaction_id)
    {
        $purchase = Purchase::where('transaction_id', $transaction_id)->first();

        if (!$purchase) {
            return redirect()->route('home')->with('error', 'Transaction not found.');
        }

        if ($purchase->status === 'completed') {
            return redirect()->route('purchase.response', $purchase->id)->with('success', 'Transaction successful. Thank you for your purchase!');
        } else {

            $this->checkStatus($purchase);

            $purchase->refresh();

            if ($purchase->status === 'completed') {
                return redirect()->route('purchase.response', $purchase->id)->with('success', 'Transaction successful. Thank you for your purchase!');
            }

            return redirect()->route('purchase.response', $purchase->id)->with('error', 'Transaction failed or pending. Please try again later.');
        }
    }

    protected function checkStatus($purchase)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            env('CINETPAY_API_URL') . '/check',
            [
                'apikey' => env('CINETPAY_API_KEY'),
                'site_id' => env('CINETPAY_SITE_ID'),
                'transaction_id' => $purchase->transaction_id,
            ]
        );

        if ($response->successful()) {
            $data = $response->json();

            if ($data['code'] == '00' && $data['message'] === 'SUCCES') {
                $purchase->status = 'completed';
                $purchase->purchased_at = now();
            } else {
                $purchase->status = 'failed';
            }
            $purchase->save();
        }

        return true;
    }
}
