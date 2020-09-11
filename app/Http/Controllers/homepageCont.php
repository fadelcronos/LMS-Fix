<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homepageCont extends Controller
{
    public function index(){
        return view('homepage.homePage');
    }
}
