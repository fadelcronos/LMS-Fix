<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kaizen_Member extends Model
{
    protected $table = 'KF_Member';
    protected $fillable = ['Kaizen_ID'];
    public $timestamps = false;
}
