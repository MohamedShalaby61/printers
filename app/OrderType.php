<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    protected $table = 'order_type';
    protected $guarded = ['id'];
    public $timestamps = false;
}
