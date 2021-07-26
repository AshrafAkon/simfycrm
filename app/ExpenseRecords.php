<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseRecords extends Model
{
    protected $fillable = ['name', 'amount', 'description', "date"];
}
