<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class homepageCont extends Controller
{
    public function index(User $acc){
        $id = Session::get('id');
        $acc = User::where('id', '=', $id)->first();

        return view('user.user-homePage', compact('acc'));
    }
}
