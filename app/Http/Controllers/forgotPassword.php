<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;

class forgotPassword extends Controller
{
    public function forgotpage(){
        return view('forgotpassword.forgotpasspage');
    }

    public function getotp(Request $req){
        $user = $req->user;
        $email = $req->mail;
        $fourRandomDigit = mt_rand(1000,9999);
        
        $checkuser = User::where('kpkNum', $user)->where('email', $email)->first();
        
        // dd($checkuser, $fourRandomDigit);

        if($checkuser){
            Session::put('kpk', $user);
            Session::put('otp', $fourRandomDigit);
            Mail::send('mail/forgotmail', ['checkuser' => $checkuser, 'code' => $fourRandomDigit], function ($m) use ($checkuser) {    
                $m->to($checkuser->email, $checkuser->Fullname)->subject('<No Reply>Forgot Password OTP CODE');
            });
            
            return redirect('/forgot-password')->with('getotp','OTP Already sent to your email')->with('showOtp', 'a');
        }else{
            return redirect()->back()->with('alert','No User Match')->with('showModal', 'a');

        }
        
    }

    public function checkotp(Request $req, Account $acc){
        $otp = Session::get('otp');
        if($otp == $req->otp){
            $kpk = Session::get('kpk');
            $acc = Account::where('kpkNum', '=', $kpk)->first();
            return view('forgotpassword.changepage', compact('acc'));

        }else{
            return redirect('/forgot-password')->with('msg','Wrong OTP Code, Try Again!')->with('error', 'a')->with('getotp','OTP Already sent to your email')->with('showOtp', 'a');
        }
    }

    public function updatepass(Request $req, Account $acc){
        $kpk = Session::get('kpk');
        $acc = Account::where('kpkNum', '=', $kpk)->first();


        Account::where('kpkNum', $kpk)
                ->update([
                    'pass' => md5($req->new_password)
                ]);
        return redirect('/forgot-password')->with('showModal', 'a')->with('alert-success','Pasword Updated, Please Login');
        // return view('user.user-changepassword.user-changepassPage', compact('acc'))->with('alert-success', 'Password Changed');
            
    }

    
}
