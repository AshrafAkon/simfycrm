<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceRecord extends Model
{
    protected $fillable = ['invoice_id', 'products_id', 'quantity', 'price', 'name', 'selling_price'];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function products()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
