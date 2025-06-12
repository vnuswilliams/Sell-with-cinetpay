<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'url'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
