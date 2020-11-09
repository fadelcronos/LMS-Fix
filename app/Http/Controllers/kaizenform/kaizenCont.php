<?php

namespace App\Http\Controllers\kaizenform;

use App\Http\Controllers\Controller;
use App\Account;
use App\Employee;
use App\User;
use App\Kaizen_Background;
use App\Kaizen_Date;
use App\Kaizen_Deliverable;
use App\Kaizen_Main;
use App\Kaizen_Member;
use App\Kaizen_Scope;
use App\Kaizen_Baseline;
use App\Kaizen_Goals;
use App\Kaizen_Update_List;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class kaizenCont extends Controller
{   

    public function userkaipage(){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
                $employee = Employee::all();
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
        
                return view('kaizenform-user.addkaizen-page', compact('acc', 'employee'));
            
            
        }
    }
    public function listkaipage(){

        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
        
                return view('kaizenform-user.listallkaizen-page', compact('acc'));

            
            
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
    public function store(Request $req)
    {
        $KZ_Main = new Kaizen_Main;
        $KZ_Member = new Kaizen_Member;
        $KZ_Date = new Kaizen_Date;
        $KZ_Back = new Kaizen_Background;
        $KZ_Scope = new Kaizen_Scope;
        $KZ_Deliv = new Kaizen_Deliverable;
        $KZ_Baseline = new Kaizen_Baseline;
        $KZ_Goals = new Kaizen_Goals;

        $KZ_Main->Kaizen_ID = $req->kzid;
        $KZ_Main->Kaizen_title = $req->kztitle;
        $KZ_Main->Kaizen_type = $req->kztypes;
        $KZ_Main->Kaizen_dept = $req->kzdept;
        $KZ_Main->Kaizen_room = "Jogja";
        $KZ_Main->Kaizen_status = "Waiting";
        $KZ_Main->Kaizen_madeby = $req->kpk1;
        $KZ_Main->save();
        
        $totMember = $req->totRow;
        $dataMembers = [];
            for ($i=1; $i<=$totMember; $i++){

                // $dataMembers = new Kaizen_Member([
                //     'Kaizen_ID' => $req->kzid,
                //     'member_roles' => $req->{'role'.$i},
                //     'kpkNum' => $req->{'kpk'.$i}
                // ]);

                // DB::table('KF_Member')->insert(array(
                //     array($KZ_Member->Kaizen_ID = $req->kzid,
                //     $KZ_Member->member_roles = $req->{'role'.$i},
                //     $KZ_Member->kpkNum = $req->{'kpk'.$i},
                //     )
                // ));
                // echo $KZ_Member->kpkNum;
                // DB::table(KF_Member)->insert($KZ_Member);
                $dataMembers = [
                    ['Kaizen_ID' => $req->kzid,  'member_roles' => $req->{'role'.$i}, 'kpkNum' => $req->{'kpk'.$i}]
                ];
                $KZ_Member->insert($dataMembers);
            }

            $KZ_Date->Kaizen_ID = $req->kzid;
            $KZ_Date->Kaizen_DateFrom = $req->dateFrom;
            $KZ_Date->Kaizen_DateTo = $req->dateTo;
            $KZ_Date->save();

            $totScope = $req->totRowScope;
            for ($i=1; $i<=$totScope; $i++){
                $dataMembers = [[
                    'Kaizen_ID' => $req->kzid,
                    'scope' => $req->{'scope'.$i},
                ]];

                $KZ_Scope->insert($dataMembers);
            }

            $totBack = $req->totRowBack;
            for ($i=1; $i<=$totBack; $i++){
                $dataMembers = [[
                    'Kaizen_ID' => $req->kzid,
                    'background' => $req->{'back'.$i}
                ]];
                $KZ_Back->insert($dataMembers);
            }

            $totDeliv = $req->totRowDeliv;
            for ($i=1; $i<=$totDeliv; $i++){
                $dataMembers = [[
                    'Kaizen_ID' => $req->kzid,
                    'deliverable' => $req->{'deliv'.$i}
                ]];

                $KZ_Deliv->insert($dataMembers);

            }

            return redirect()->back()->with('showModal', 'a')->with('alert-success', 'Prekaizen Created, Waiting for Approval');
        

        

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

    public function updatelist(){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            $kaizen_list = Kaizen_Update_List::where('kpkNum', $acc->kpkNum)->get();

           
            return view('kaizenform-user.updatekaizenlist-page', compact('acc', 'kaizen_list'));
           

        }
    }
}
