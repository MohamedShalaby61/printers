<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadModifiedFiles extends Model
{
    protected $table = 'upload_modified';
    protected $fillable = ['my_order_id' , 'file'];
    public $timestamps = false;

}
