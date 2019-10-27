<?php

namespace Modules\Offer\Entities;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
	protected $table = 'offers';
    protected $fillable = ['title','content','photo','code','started_at','ended_at','count'];
    
    public $timestamps = false;
}
