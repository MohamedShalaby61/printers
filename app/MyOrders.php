<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\payment;

class MyOrders extends Model
{
    use SoftDeletes;
    protected $table = 'my_orders';
    
    protected $fillable = [
        'user_id',
        'order_status_id',
        'order_type_id',
        'service_type_id',
        'font_type_id',
        'completed_file_id',
        'font_size',
        'order_date',
        'pages_number',
        'more_details',
        'rate',
        'printer_id',
        'update_notes',
        'deliveryDate',
        'update_count'
    ];

    // public function order()
    // {
    //     return $this->hasOne('App\OrderStatus' ,'id');
    // }

    public function getInicioAttribute($val) 
    {
        return Carbon::parse($val);
    }

    public function getFinAttribute($val) 
    {
        return Carbon::parse($val);
    }


    public function font_type()
    {
        return $this->belongsTo('App\FontTypes' , 'font_type_id');
    }

    public function service_type()
    {
        return $this->belongsTo('App\ServiceType' , 'service_type_id');
    }

    public function order_type(){
        return $this->belongsTo('App\OrderType' , 'order_type_id');
    }

    public function printer_details(){
      return $this->belongsTo('App\PrinterDetails','printer_id');
    }

    public function order_status(){
      return $this->belongsTo('App\OrderStatus','order_status_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order_cost()
    {
        return $this->hasMany('App\payment','order_id');
    }

    public function choose_file()
    {
        return $this->hasMany('App\ChooseFile','my_order_id','id');
    }

    public function upload_modify()
    {
        return $this->hasMany('App\UploadModifiedFiles','my_order_id','id');
    }

    public function complete_file()
    {
        return $this->hasOne('App\CompletedFile','id','completed_file_id');
    }

    // public function payment_status(){
    //     return $this->hasOne('App\payment' , 'id','order_id');
    // } 

}
