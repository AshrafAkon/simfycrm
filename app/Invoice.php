<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'invoice_id', 'customer_id', 'invoicestatus_id', 'amount', 'courier_id', 'subtotal', 'date', 'payment', 'discount', 'notes'
    ];
    protected $with = ['records'];



    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany('App\Products', 'invoice_products');
    }

    public function records()
    {
        return $this->hasMany('App\InvoiceRecord');
    }

    public function rows()
    {
        return $this->hasMany(InvoiceRecord::class);
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
    public function invoicestatus()
    {
        return $this->belongsTo(InvoiceStatus::class);
    }
}
