<?php

namespace App\Http\Controllers\kaizenform;

use App\Http\Controllers\Controller;
use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class kaizenCont extends Controller
{   

    public function userkaipage(){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('user')){
                return redirect()->back()->with('alert', 'You are admin not user');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
        
                return view('kaizenform-user.addkaizen-page', compact('acc'));
            }
            
        }
    }
    public function listkaipage(){

        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            if(!Session::get('user')){
                return redirect()->back()->with('alert', 'You are admin not user');
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
        
                return view('kaizenform-user.listallkaizen-page', compact('acc'));

            }
            
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check(Request $req){
        $tot=$req->totRow;
        echo $req->kzid;
        for ($i=1; $i<=$tot; $i++){
            $role = $req->{'role'.$i};
            $kpk = $req->{'kpk'.$i};
            $name = $req->{'name'.$i};
            echo $role." ".$kpk." ".$name."<br>";
        }
    }
}
