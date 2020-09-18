<?php

namespace App\Http\Controllers\user;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class detailprofileCont extends Controller
{
    public function detailpage(Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();
     
        // return $acc;
        
        return view('user.user-detail.user-detailPage', compact('acc'));
    }

    public function editpage(Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();

        return view('user.user-edit.user-editPage', compact('acc'));
    }

    public function changepass(Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();

        return view('user.user-changepassword.user-changepassPage', compact('acc'));
    }

    public function updatepass(Request $req, Account $acc){
        $id = Session::get('id');
        $acc = Account::where('id', '=', $id)->first();


        Account::where('id', $id)
                ->update([
                    'pass' => $req->new_password
                ]);
        return redirect()->back()->with('alert-success','Pasword Changed');
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
                return redirect()->back()->with('alert-success','Image Updated');
        }
        else{
            return redirect()->back()->with('alert','No Image');
            
        }
        // $name = $req->image->getClientOriginalName();

        

        
    }
}
