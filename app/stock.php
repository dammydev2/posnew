<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $fillable = ['name', 'category', 'weight', 'quantity', 'c_price', 's_price', 'bar_code', 'supplier', 'kit_id'];
}
