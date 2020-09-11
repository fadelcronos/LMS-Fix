<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class detailprofileCont extends Controller
{
    public function detailpage(){
        return view('user-detail.user-detailPage');
    }
}
