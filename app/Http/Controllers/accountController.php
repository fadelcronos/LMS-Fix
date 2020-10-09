<?php

namespace App\Http\Controllers;

use App\Account;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $pass = md5($req->pass);
        
        $checkusername = User::where('kpkNum', $user)->first();

        if($checkusername){
            $data = User::where('kpkNum', $user)->where('pass', $pass)->first();
            if($data){
                Session::flush();
                Session::put('name',$data->Fullname);
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

            // $request->validate([
            //     'emailAdd' => 'unique:lms_accounts,email',            
            //  ]);
         $validator = Validator::make($request->all(), [
            'emailAdd' => 'unique:lms_accounts,email',            
        ]);
        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->with('none', 'a')->with('data', 'a');
        }
         
        $acc->email = $request->emailAdd;
        $acc->kpkNum = Session::get('kpkno');
        $acc->pass = md5($request->pass);
        $acc->level = "user";

        if($acc->save()){   
            Session::forget('Fullname');
            Session::forget('kpkno');
            Session::forget('dept');
            return redirect()->back()->with('showModal', 'a')->with('alert-success', 'Account Created');
        }else{
            return redirect()->back()->with('showModal', 'a')->with('alert', 'Failed To Create Account')->withInput($request->except('pass'));
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

    public function checkKPK(Request $req)
    {
        $kpk = $req->kpkNum;
        $userAcc = Account::where('kpkNum', $kpk)->first();
        $employeeAcc = Employee::where('KPK', $kpk)->first();

        // dd($employeeAcc);

        if($userAcc){
            // return "back to register send account sudah teregister";
            return redirect()->back()->with('showModal', 'a')->with('alert', 'User Already Registered, Please Login!')->withInput($req->except('pass'));
        }else{
            if($employeeAcc){
                Session::put('Fullname',$employeeAcc->Fullname);
                Session::put('kpkno',$employeeAcc->KPK);
                Session::put('dept',$employeeAcc->Dept);
                return redirect('/register')->with('showModal', 'a')->with('alert-success', 'Employee Data Found! Please Fill The Data.')->with('none', 'a')->with('data', 'a');
            }else{
                return redirect()->back()->with('showModal', 'a')->with('alert', 'No Employee Data Found! Can not Register.')->withInput($req->except('pass'));
            }
        }
    }
}
