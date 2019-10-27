<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['user_id' , 'order_id' , 'title_ar' , 'data_ar','title_en' , 'data_en'];
    public $timestamps = false;


    public function order(){

    	return $this->belongsTo('App\MyOrders');
    }





}
