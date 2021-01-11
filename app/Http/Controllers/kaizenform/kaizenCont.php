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
Use DateTime;

use Illuminate\Support\Facades\Mail;

use App\View_KaizenRoles;
use App\View_UpdateList;
use App\View_Member;

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
                // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
                $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();

                return view('kaizenform-user.addkaizen-page', compact('acc', 'employee', 'totWait'));
            
            
        }
    }
    public function listkaipage(){
        Session::put('kaizen', TRUE);
        Session::forget('home');

        $kaizen_list = Kaizen_Main::latest('Kaizen_ID')->get();
        $memberlist = View_Member::all();

        $scopelist = Kaizen_Scope::all();
        $baselist = Kaizen_Baseline::all();
        $backlist = Kaizen_Background::all();
        $goalslist = Kaizen_Goals::all();
        $delivlist = Kaizen_Deliverable::all();
        $datelist = Kaizen_Date::all();

        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();

        if(!Session::get('login')){
            return view('kaizenform-user.listallkaizen-page', compact('datelist', 'totWait', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $myKaizen_list = View_UpdateList::latest('Kaizen_ID')->where('kpkNum', $acc->kpkNum)->get();
            return view('kaizenform-user.listallkaizen-page', compact('myKaizen_list', 'datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }
    }

    public function searchkaizen(Request $req){
        $search = $req->search;
        $type = $req->kztype;
        $status = $req->status;
        $dept = $req->department;
        $kaizen_list = Kaizen_Main::latest('Kaizen_ID')->where('Kaizen_title', 'LIKE', '%'. $search. '%')->where('Kaizen_type', 'LIKE', '%'. $type. '%')->where('Kaizen_status', 'LIKE', '%'. $status. '%')->where('Kaizen_dept', 'LIKE', '%'. $dept. '%')->get();
        $memberlist = View_Member::all();

        $scopelist = Kaizen_Scope::all();
        $baselist = Kaizen_Baseline::all();
        $backlist = Kaizen_Background::all();
        $goalslist = Kaizen_Goals::all();
        $delivlist = Kaizen_Deliverable::all();
        $datelist = Kaizen_Date::all();

        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
        if(!Session::get('login')){
            return view('kaizenform-user.listallkaizen-page', compact('datelist', 'totWait', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
            // return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $myKaizen_list = View_UpdateList::latest('Kaizen_ID')->where('kpkNum', $acc->kpkNum)->where('Kaizen_title', 'LIKE', '%'. $search. '%')->where('Kaizen_type', 'LIKE', '%'. $type. '%')->where('Kaizen_status', 'LIKE', '%'. $status. '%')->where('Kaizen_dept', 'LIKE', '%'. $dept. '%')->get();

            return view('kaizenform-user.listallkaizen-page', compact('myKaizen_list', 'datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }
    }

    public function index()
    {
        //
    }
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

        // $fdate = $req->dateFrom;
        // $tdate = $req->dateTo;
        // $datetime1 = new DateTime($fdate);
        // $datetime2 = new DateTime($tdate);
        // $interval = $datetime1->diff($datetime2);
        // $days = $interval->format('%a');//now do whatever you like with $days
        // dd($days+1);

        $KZ_Main->Kaizen_ID = $req->kzid;
        $KZ_Main->Kaizen_title = $req->kztitle;
        $KZ_Main->Kaizen_type = $req->kztypes;
        $KZ_Main->Kaizen_dept = $req->kzdept;
        $KZ_Main->Kaizen_room = "";
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
            $totBase = $req->totRowBase;
            for ($i=1; $i<=$totBase; $i++){
                $dataMembers = [[
                    'Kaizen_ID' => $req->kzid,
                    'baseline' => $req->{'base'.$i}
                ]];
 
                $KZ_Baseline->insert($dataMembers);

            }

            $totGoals = $req->totRowGoals;
            for ($i=1; $i<=$totGoals; $i++){
                $dataMembers = [[
                    'Kaizen_ID' => $req->kzid,
                    'goals' => $req->{'goals'.$i}
                ]];

                $KZ_Goals->insert($dataMembers);

            }

            return redirect()->back()->with('showModal', 'a')->with('alert-success', 'Pre-Kaizen Created, Waiting for Approval');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kzid)
    {
        // dd($kzid);
        $main = Kaizen_Main::where('Kaizen_ID', $kzid)->first();
        $dates = Kaizen_Date::where('Kaizen_ID', $kzid)->first();
        $member = View_Member::oldest('MemberID')->where('Kaizen_ID', $kzid)->get();

        $scopes = Kaizen_Scope::where('Kaizen_ID', $kzid)->get();
        $backs = Kaizen_Background::where('Kaizen_ID', $kzid)->get();
        $bases = Kaizen_Baseline::where('Kaizen_ID', $kzid)->get();
        $goals = Kaizen_Goals::where('Kaizen_ID', $kzid)->get();
        $delivs = Kaizen_Deliverable::where('Kaizen_ID', $kzid)->get();
        // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
        

        // dd($scopes);
        // dd($member);
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $employee = Employee::all();
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-user.updatekaizenlistdetail-page', compact('rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
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

            $kaizen_list = View_UpdateList::latest('Kaizen_ID')->where('kpkNum', $acc->kpkNum)->get();
            $memberlist = View_Member::all();

            $scopelist = Kaizen_Scope::all();
            $baselist = Kaizen_Baseline::all();
            $backlist = Kaizen_Background::all();
            $goalslist = Kaizen_Goals::all();
            $delivlist = Kaizen_Deliverable::all();
            $datelist = Kaizen_Date::all();

            // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
            $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
           
            return view('kaizenform-user.updatekaizenlist-page', compact('datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
           

        }
    }

    public function detaillist(Request $req){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $kzid = $req->kzid;
            dd($kzid);
            return view('kaizenform-user.updatekaizenlistdetail-page', compact('acc'));
        }
    }

    public function updatedetaildata(Request $req){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();


            $KZ_Main = new Kaizen_Main;
            $KZ_Member = new Kaizen_Member;
            $KZ_Date = new Kaizen_Date;
            $KZ_Back = new Kaizen_Background;
            $KZ_Scope = new Kaizen_Scope;
            $KZ_Deliv = new Kaizen_Deliverable;
            $KZ_Baseline = new Kaizen_Baseline;
            $KZ_Goals = new Kaizen_Goals;

            $kzid = $req->kzid;

            

            
            Kaizen_Deliverable::where('Kaizen_ID', $kzid)->delete();
            Kaizen_Goals::where('Kaizen_ID', $kzid)->delete();
            Kaizen_Baseline::where('Kaizen_ID', $kzid)->delete();
            Kaizen_Background::where('Kaizen_ID', $kzid)->delete();
            Kaizen_Scope::where('Kaizen_ID', $kzid)->delete();
            Kaizen_Date::where('Kaizen_ID', $kzid)->delete();
            Kaizen_Member::where('Kaizen_ID', $kzid)->delete();
            
            Kaizen_Main::where('Kaizen_ID', $kzid)->delete();
                
            $KZ_Main->Kaizen_ID = $kzid;
            $KZ_Main->Kaizen_title = $req->kztitle;
            $KZ_Main->Kaizen_type = $req->kztypes;
            $KZ_Main->Kaizen_dept = $req->kzdept;
            $KZ_Main->Kaizen_madeby = $req->kzmade;
            $KZ_Main->Kaizen_status = $req->kzstatus;
            $KZ_Main->Kaizen_room = $req->kzroom;

            // if($acc->kpkNum == "393560"){
            //     $KZ_Main->Kaizen_status = "Approved";
            //     $KZ_Main->Kaizen_room = $req->kzroom;
            // }else{
            //     $KZ_Main->Kaizen_status = $req->kzstatus;
            //     $KZ_Main->Kaizen_room = $req->kzroom;
            // }

            
            
            
            $KZ_Main->save();
            $totMember = $req->totRow;
            $dataMembers = [];
                for ($i=1; $i<=$totMember; $i++){
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
                $totBase = $req->totRowBase;
                for ($i=1; $i<=$totBase; $i++){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'baseline' => $req->{'base'.$i}
                    ]];

                    $KZ_Baseline->insert($dataMembers);

                }

                $totGoals = $req->totRowGoals;
                for ($i=1; $i<=$totGoals; $i++){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'goals' => $req->{'goals'.$i}
                    ]];

                    $KZ_Goals->insert($dataMembers);

                }
                if($acc->kpkNum == "393560"){
                    return redirect('/kaizen-form/approval-kaizen')->with('showModal', 'a')->with('alert-success', 'Data Updated');
                }else{
                    return redirect('/kaizen-form/update-kaizen')->with('showModal', 'a')->with('alert-success', 'Data Updated');
                }
        

            // return view('kaizenform-user.updatekaizenlistdetail-page', compact('acc'));
        }
    }

    public function listapprove(){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            $kaizen_list = Kaizen_Main::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
            $approve_kaizen = Kaizen_Main::latest('Kaizen_ID')->where('Kaizen_status', 'Approved')->get();
            $memberlist = View_Member::all();

            $scopelist = Kaizen_Scope::all();
            $baselist = Kaizen_Baseline::all();
            $backlist = Kaizen_Background::all();
            $goalslist = Kaizen_Goals::all();
            $delivlist = Kaizen_Deliverable::all();
            $datelist = Kaizen_Date::all();

            // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
            $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
            
            return view('kaizenform-admin.listapprove-page', compact('approve_kaizen' ,'datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }
    }

    public function testmail(){
        
    }

    public function approvalpage($kzid){
        // dd($kzid);
        $main = Kaizen_Main::where('Kaizen_ID', $kzid)->first();
        $dates = Kaizen_Date::where('Kaizen_ID', $kzid)->first();
        $member = View_Member::oldest('MemberID')->where('Kaizen_ID', $kzid)->get();

        $scopes = Kaizen_Scope::where('Kaizen_ID', $kzid)->get();
        $backs = Kaizen_Background::where('Kaizen_ID', $kzid)->get();
        $bases = Kaizen_Baseline::where('Kaizen_ID', $kzid)->get();
        $goals = Kaizen_Goals::where('Kaizen_ID', $kzid)->get();
        $delivs = Kaizen_Deliverable::where('Kaizen_ID', $kzid)->get();
        // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
        

        // dd($scopes);
        // dd($member);
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $employee = Employee::all();
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-admin.approval-page', compact('rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
    }
    public function approvemail($kzid){
        // dd($kzid);
        $main = Kaizen_Main::where('Kaizen_ID', $kzid)->first();
        $dates = Kaizen_Date::where('Kaizen_ID', $kzid)->first();
        $member = View_Member::oldest('MemberID')->where('Kaizen_ID', $kzid)->get();

        $scopes = Kaizen_Scope::where('Kaizen_ID', $kzid)->get();
        $backs = Kaizen_Background::where('Kaizen_ID', $kzid)->get();
        $bases = Kaizen_Baseline::where('Kaizen_ID', $kzid)->get();
        $goals = Kaizen_Goals::where('Kaizen_ID', $kzid)->get();
        $delivs = Kaizen_Deliverable::where('Kaizen_ID', $kzid)->get();
        // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
        

        // dd($scopes);
        // dd($member);
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $employee = Employee::all();
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-admin.approval-page', compact('rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
    }
}
