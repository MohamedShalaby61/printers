<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChooseFile extends Model
{
     protected $table = 'choose_file'; 
     protected $guarded = ['id']; 
     public $timestamps = false;

}
