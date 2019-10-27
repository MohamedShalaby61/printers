<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_type';
    protected $guarded = ['id'];
    public $timestamps = false;
}
