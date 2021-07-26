<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;
    protected $fillable = ['products_id', 'buying_price', 'quantity'];
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
