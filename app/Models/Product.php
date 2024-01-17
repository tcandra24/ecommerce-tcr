<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sku',
        'slug',
        'category_id',
        'brand_id',
        'user_id',
        'description',
        'is_active',
        'weight',
        'price',
        'stock',
    ];

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * reviews
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * wishlist
     *
     * @return void
     */
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * products images
     *
     * @return void
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }
}
