<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrinterDetails extends Model
{
    protected $table = 'printer_details';
    protected $fillable = ['name','logo','address','user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
