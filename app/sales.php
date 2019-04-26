<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $fillable = ['name', 'bar_code', 'qty', 'rec', 'price'];
}
