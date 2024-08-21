<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThicknessType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'thick',
        'product_variant_id',
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
