<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'product_id'
    ];

    /**
     * products
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getNameAttribute($value)
    {
        return asset('/storage/images/products/' . $value);
    }
}
