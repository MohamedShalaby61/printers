<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['user_id','question1','question2','question3','question4'];
    public $timestamps = false;
}
