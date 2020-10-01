<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

class accountController extends Controller
{
    public function test(){
        return view('mail.forgotmail');
        
    }
    public function login(){
        return view('login.loginPages');
        
    }

    public function register(){
        return view('registration.registerPages');
    }

    public function signinAcc(Request $req){
        $user = $req->user;
        $pass = $req->pass;
        
        $checkusername = Account::where('kpkNum', $user)->first();

        if($checkusername){
            $data = Account::where('kpkNum', $user)->where('pass', $pass)->first();
            if($data){
                Session::flush();
                Session::put('name',$data->fName);
                Session::put('kpknum',$data->kpkNum);
                Session::put('id', $data->id);
                Session::put('login',TRUE);
                if($data->level == "admin"){
                    Session::put('admin',TRUE);
                    return redirect('/admin-homepage')->with('alert-success','Login Successfull');
                }else{
                    Session::put('user',TRUE);
                    return redirect('/homepage')->with('alert-success','Login Successfull');
                }
            }else{
                
                return redirect('/login')->with('alert','Incorrect Password')->with('showModal', 'a')->withInput($req->except('pass'));
            }
        }else{
            return redirect('/login')->with('alert','Incorrect Username')->with('showModal', 'a')->withInput($req->except('pass'));
        }
    }

    public function logOut(){
        Session::flush();
        return redirect('/login')->with('showModal', 'a')->with('alert-success', 'Logout Succesfull');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acc = new Account;

        $request->validate([
            'kpknum' => 'unique:accounts,kpkNum',
            'emailAdd' => 'unique:accounts,email',            
         ]);
         

        $acc->fName = $request->fName;
        $acc->lName = $request->lName;
        $acc->email= $request->emailAdd;
        $acc->kpkNum = $request->kpknum;
        $acc->department = $request->department;
        $acc->pass = md5($request->pass);
        $acc->roles = "user"; 

        if($acc->save()){   
            return redirect()->back()->with('showModal', 'a')->with('alert-success', 'Account Created')->withInput($request->except('pass'));
        }else{
            return redirect()->back()->with('showModal', 'a')->with('alert', 'Failed To Create Account');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
