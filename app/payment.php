<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payment';

    protected $fillable = ['cost','order_id','payment_status'];

    public $timestamps = false;
}
