<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompletedFile extends Model
{
    protected $table = 'completed_files';
    protected $fillable = ['file','url'];

    public $timestamps = false;
}
