<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détails d'achat - EduMarket</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <h1 class="text-2xl font-bold text-indigo-600">EduMarket</h1>
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('home') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">Accueil</a>
                    @auth
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">Mon
                            compte</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-indigo-600">Se
                            connecter</a>
                        <a href="{{ route('signup') }}"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-indigo-600 hover:text-indigo-700">S'inscrire</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Purchase Details Section -->
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Détails de votre achat</h2>

                    @if (session('success'))
                        <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="flex bg-gray-50 p-4 border-b border-gray-200">
                            <div class="w-1/3 font-medium text-gray-500">Produit</div>
                            <div class="w-2/3 font-medium">{{ $purchase->product->name }}</div>
                        </div>

                        <div class="flex p-4 border-b border-gray-200">
                            <div class="w-1/3 font-medium text-gray-500">Description</div>
                            <div class="w-2/3">{{ $purchase->product->description }}</div>
                        </div>

                        <div class="flex bg-gray-50 p-4 border-b border-gray-200">
                            <div class="w-1/3 font-medium text-gray-500">Prix</div>
                            <div class="w-2/3">{{ number_format($purchase->price, 2) }} CDF</div>
                        </div>

                        <div class="flex p-4 border-b border-gray-200">
                            <div class="w-1/3 font-medium text-gray-500">Référence</div>
                            <div class="w-2/3">{{ $purchase->transaction_id }}</div>
                        </div>

                        <div class="flex bg-gray-50 p-4 border-b border-gray-200">
                            <div class="w-1/3 font-medium text-gray-500">Statut</div>
                            <div class="w-2/3">
                                @if ($purchase->status === 'completed')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Payé
                                    </span>
                                @elseif($purchase->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> En attente
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Échoué
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($purchase->purchased_at)
                            <div class="flex p-4">
                                <div class="w-1/3 font-medium text-gray-500">Date d'achat</div>
                                <div class="w-2/3">
                                    {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d/m/Y à H:i') }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 flex justify-center">
                        @if ($purchase->status === 'completed')
                            <a href="#"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-download mr-2"></i> Télécharger le cours
                            </a>
                        @elseif($purchase->status === 'pending')
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-4">Votre paiement est en cours de traitement.
                                    Veuillez patienter...</p>
                                <a href="{{ route('purchase.verify', ['transaction_id' => $purchase->transaction_id]) }}"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-sync-alt mr-2"></i> Vérifier le statut
                                </a>
                            </div>
                        @else
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-4">Une erreur s'est produite lors du traitement de
                                    votre paiement.</p>
                                <a href="{{ route('purchase', $purchase->product_id) }}"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <i class="fas fa-shopping-cart mr-2"></i> Réessayer l'achat
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            <i class="fas fa-arrow-left mr-1"></i> Retour à la page d'accueil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Support Information -->
            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Besoin d'aide ?</h3>
                <p class="text-sm text-gray-600 mb-4">Si vous rencontrez des problèmes avec votre achat ou avez des
                    questions, n'hésitez pas à contacter notre équipe de support.</p>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-indigo-500 mr-2"></i>
                    <a href="mailto:support@edumarket.com"
                        class="text-sm text-indigo-600 hover:text-indigo-500">support@edumarket.com</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="border-t border-gray-200 pt-8">
                <p class="text-center text-sm text-gray-500">&copy; 2025 EduMarket. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>

</html>
