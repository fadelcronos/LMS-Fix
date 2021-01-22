<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class adminPageController extends Controller
{
    public function index(User $acc){
        Session::put('home', TRUE);
        Session::forget('kaizen');
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('admin.admin-homepage', compact('acc'));
            }
        } 
        
    }

    public function profilepage(User $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('admin.admin-profile', compact('acc'));
            }
        }

        
    }
    public function editpage(User $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('admin.admin-edit', compact('acc'));
            }
        }
        
    }
    public function editImageAdmin(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();
        // $req->image->store('images');

        try {
            Account::where('id', $id)
            ->update([
                'email' => $req->email
            ]);
            if ($req->hasfile('image')){
                $file = $req->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('adminimg/',$filename);
                Account::where('id', $id)
                    ->update([
                        'image' => $req->image = $filename
                    ]);
                }
            return redirect()->back()->with('showModal', 'a')->with('alert-success','Data Updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('showModal', 'a')->with('alert-danger','No Data Updated');
        }

        
        // else{
        //     // return redirect()->back()->with('showModal', 'a')->with('alert','No Image Selected');
        // }
         
    }

    public function changepwpage(Account $acc){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('admin')){
                return redirect()->back()->with('alert', 'Only admin can access the page');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('admin.admin-changepass', compact('acc'));
            }
        }
        
    }

    public function updatepw(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();


        Account::where('id', $id)
                ->update([
                    'pass' => md5($req->new_password)
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
