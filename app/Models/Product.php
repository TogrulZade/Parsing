<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMatch;
use App\Models\Source;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function match() {
        return $this->hasMany(ProductMatch::class, 'product_id', 'id');
    }

    public function source() {
        return $this->hasOne(Source::class, 'id', 'source_id');
    }

    public function matchedWith() {
        return $this->hasOne(ProductMatch::class, 'product_match_id', 'id');
    }


}
