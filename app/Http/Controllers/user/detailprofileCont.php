<?php

namespace App\Http\Controllers\user;

use App\Account;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class detailprofileCont extends Controller
{
    public function index(User $acc){
 
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('user')){
                return redirect()->back()->with('alert', 'You are admin not user');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
        
                return view('user.user-homePage', compact('acc'));
            }
        }

    }

    public function detailpage(User $acc){

        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('user')){
                return redirect()->back()->with('alert', 'You are admin not user');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('user.user-detailPage', compact('acc'));
            }
        }    
    }

    public function editpage(User $acc){

        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('user')){
                return redirect()->back()->with('alert', 'You are admin not user');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('user.user-editPage', compact('acc'));
            }
        }
    }

    public function changepass(User $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('user')){
                return redirect()->back()->with('alert', 'You are admin not user');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('user.user-changepassPage', compact('acc'));
            }
        }
        
    }

    public function updatepass(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();


        Account::where('id', $id)
                ->update([
                    'pass' => md5($req->new_password)
                ]);
        return redirect()->back()->with('showModal', 'a')->with('alert-success','Pasword Changed');
        // return view('user.user-changepassword.user-changepassPage', compact('acc'))->with('alert-success', 'Password Changed');

    }

    public function editImage(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();
        // $req->image->store('images');
        if ($req->hasfile('image')){
            $file = $req->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('userimg/',$filename);
            Account::where('id', $id)
                ->update([
                    'image' => $req->image = $filename
                ]);
                return redirect()->back()->with('showModal', 'a')->with('alert-success','Image Updated');
        }
        else{
            return redirect()->back()->with('showModal', 'a')->with('alert','No Image Selected');
            
        }
        // $name = $req->image->getClientOriginalName();

        

        
    }
}
