<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'address', 'phone', 'source'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
