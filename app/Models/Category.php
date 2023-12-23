<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image'
    ];

    /**
     * products
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * image
     *
     * @return Attribute
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = asset('/storage/categories/' . $value);
    }
}
