<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kaizen_Main extends Model
{
    protected $table = 'KF_Main';
    protected $primaryKey = 'Kaizen_ID';
    public $timestamps = false;
    public $incrementing = false;
}
