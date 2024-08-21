<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'name', 'price', 'descriptions', 'po_status', 'product_id', 'image'
    ];

    protected $casts = [
        'po_status' => 'boolean',
    ];
}
