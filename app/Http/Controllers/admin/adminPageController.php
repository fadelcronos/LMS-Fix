<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class adminPageController extends Controller
{
    public function index(Account $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = Account::where('id', '=', $id)->first();
                return view('admin.admin-homepage', compact('acc'));
            }
        }
        
    }

    public function profilepage(Account $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = Account::where('id', '=', $id)->first();
                return view('admin.admin-profile', compact('acc'));
            }
        }

        
    }
    public function editpage(Account $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = Account::where('id', '=', $id)->first();
                return view('admin.admin-edit', compact('acc'));
            }
        }
        
    }
    public function editImageAdmin(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();
        // $req->image->store('images');
        if ($req->hasfile('image')){
            $file = $req->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('adminimg/',$filename);
            Account::where('id', $id)
                ->update([
                    'image' => $req->image = $filename
                ]);
                return redirect()->back()->with('showModal', 'a')->with('alert-success','Image Updated');
        }
        else{
            return redirect()->back()->with('showModal', 'a')->with('alert','No Image Selected');
            
        }
         
    }

    public function changepwpage(Account $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = Account::where('id', '=', $id)->first();
                return view('admin.admin-changepass', compact('acc'));
            }
        }
        
    }

    public function updatepw(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();


        Account::where('id', $id)
                ->update([
                    'pass' => $req->new_password
                ]);
        return redirect()->back()->with('showModal', 'a')->with('alert-success','Admin Pasword Changed');

    }

    public function listuserpage(Account $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = Account::where('id', '=', $id)->first();
                $users = Account::where('roles', '=', 'user')->get();
                return view('admin.admin-listuser')->with(compact('acc', 'users'));
                // dd($users);
            }
        }
        
    }



}
