<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'category_id', 'size', 'product_code', 'sub_category',
        'buying_price', 'selling_price', 'color', 'image', 'thumbnail', 'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function deleteImage()
    {
        Storage::delete('product_images/' . $this->image);
        Storage::delete('product_thumbnails/' . $this->image);
    }
}
