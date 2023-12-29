<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image', 'title', 'slug', 'category_id', 'user_id', 'description', 'weight', 'price', 'stock', 'discount'
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

    public function getImageAttribute($value)
    {
        return asset('/storage/products/' . $value);
    }
}
