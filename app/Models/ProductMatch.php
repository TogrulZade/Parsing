<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductMatch extends Model
{
    use HasFactory;

    protected $table = 'product_match';

    public function product() {
    return $this->hasOne(Product::class, 'id', 'product_id');
}

public function matchedProduct() {
    return $this->hasOne(Product::class, 'id', 'product_match_id');
}
}
