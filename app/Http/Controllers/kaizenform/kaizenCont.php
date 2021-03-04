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
use App\Kaizen_Temp;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
// use Spatie\CalendarLinks\Link;
Use DateTime;

use Illuminate\Support\Facades\Mail;

use App\View_KaizenRoles;
use App\View_UpdateList;
use App\View_Member;
use App\View_ListDate;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Ical\Ical;
use Ical\IcalendarException;


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

        $kaizen_list = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
        $memberlist = View_Member::all();

        $scopelist = Kaizen_Scope::all();
        $baselist = Kaizen_Baseline::all();
        $backlist = Kaizen_Background::all();
        $goalslist = Kaizen_Goals::all();
        $delivlist = Kaizen_Deliverable::all();
        $datelist = Kaizen_Date::all();
        // dd($datelist);

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
        $KZ_Main->Kaizen_room = "";
        $KZ_Main->Kaizen_status = "Waiting";
        $KZ_Main->Kaizen_madeby = $req->kpk[0];
        $KZ_Main->save();

        $KZ_Date->Kaizen_ID = $req->kzid;
        $KZ_Date->Kaizen_DateFrom = $req->dateFrom;
        $KZ_Date->Kaizen_DateTo = $req->dateTo;
        $KZ_Date->save();
        
        $totMember = $req->totRow;
        $dataMembers = [];

        $names = $req->name;
            $kpk = $req->kpk;
            $role = $req->role;
            foreach($names as $key => $n){
                    $dataMembers = [
                    ['Kaizen_ID' => $req->kzid,  'member_roles' => $role[$key], 'kpkNum' => $kpk[$key]]
                ];
                $KZ_Member->insert($dataMembers);
            }

            $KZ_Date->Kaizen_ID = $req->kzid;
            $KZ_Date->Kaizen_DateFrom = $req->dateFrom;
            $KZ_Date->Kaizen_DateTo = $req->dateTo;
            $KZ_Date->save();

            $scope = $req->scope;
            $back = $req->back;
            $base = $req->base;
            $goals = $req->goals;
            $deliv = $req->deliv;

            foreach($scope as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'scope' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'scope' => $n,
                    ]];
                }
                
                $KZ_Scope->insert($dataMembers);
            }

            foreach($back as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'background' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'background' => $n,
                    ]];
                }
                
                $KZ_Back->insert($dataMembers);
            }

            foreach($base as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'baseline' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'baseline' => $n,
                    ]];
                }
                $KZ_Baseline->insert($dataMembers);
            }

            foreach($goals as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'goals' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'goals' => $n,
                    ]];
                }
                $KZ_Goals->insert($dataMembers);
            }
            foreach($deliv as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'deliverable' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'deliverable' => $n,
                    ]];
                }
                
                $KZ_Deliv->insert($dataMembers);
            }

        return redirect()->back()->with('showModal', 'a')->with('alert-success', 'Pre-Kaizen Created, Waiting for Approval');
        

    }

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

            $kaizen_list = View_UpdateList::orderBy('Kaizen_DateFrom', 'DESC')->where('kpkNum', $acc->kpkNum)->get();
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

        // dd($req->name);

        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            $KZ_Member = new Kaizen_Member;
            $KZ_Main = new Kaizen_Main;
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
            $KZ_Main->save();
            
            $totMember = $req->totRow;
            $dataMembers = [];

            $names = $req->name;
            $kpk = $req->kpk;
            $role = $req->role;
            foreach($names as $key => $n){
                    $dataMembers = [
                    ['Kaizen_ID' => $req->kzid,  'member_roles' => $role[$key], 'kpkNum' => $kpk[$key]]
                ];
                $KZ_Member->insert($dataMembers);
            }

            $KZ_Date->Kaizen_ID = $req->kzid;
            $KZ_Date->Kaizen_DateFrom = $req->dateFrom;
            $KZ_Date->Kaizen_DateTo = $req->dateTo;
            $KZ_Date->save();

            $scope = $req->scope;
            $back = $req->back;
            $base = $req->base;
            $goals = $req->goals;
            $deliv = $req->deliv;

            foreach($scope as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'scope' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'scope' => $n,
                    ]];
                }
                
                $KZ_Scope->insert($dataMembers);
            }

            foreach($back as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'background' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'background' => $n,
                    ]];
                }
                
                $KZ_Back->insert($dataMembers);
            }

            foreach($base as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'baseline' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'baseline' => $n,
                    ]];
                }
                $KZ_Baseline->insert($dataMembers);
            }

            foreach($goals as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'goals' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'goals' => $n,
                    ]];
                }
                $KZ_Goals->insert($dataMembers);
            }
            foreach($deliv as $key => $n){
                if($n != NULL){
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'deliverable' => $n,
                    ]];
                }else{
                    $n = " ";
                    $dataMembers = [[
                        'Kaizen_ID' => $req->kzid,
                        'deliverable' => $n,
                    ]];
                }
                
                $KZ_Deliv->insert($dataMembers);
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
            $cancel_kaizen = Kaizen_Main::latest('Kaizen_ID')->where('Kaizen_status', 'Canceled')->get();
            $memberlist = View_Member::all();

            $scopelist = Kaizen_Scope::all();
            $baselist = Kaizen_Baseline::all();
            $backlist = Kaizen_Background::all();
            $goalslist = Kaizen_Goals::all();
            $delivlist = Kaizen_Deliverable::all();
            $datelist = Kaizen_Date::all();

            // $totWait = View_UpdateList::latest('Kaizen_ID')->where('Kaizen_status', 'Waiting')->get();
            $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
            
            return view('kaizenform-admin.listapprove-page', compact('cancel_kaizen' ,'approve_kaizen' ,'datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
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
        $user = User::all();
        // dd($user);
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $employee = Employee::all();
            // dd($employee);
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-admin.approval-page', compact('user', 'rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
    }

    public function approvemail(Request $req){
        
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $kzid = $req->kzid;
            $mail = $req->email;
            $kpks = $req->kpk;
            $room = $req->kzroom;
            $fixStart = $req->startTime;
            

            Kaizen_Main::where('Kaizen_ID', $kzid)
            ->update([
                'Kaizen_status' => 'Approved',
                'Kaizen_room' => $room,
            ]);

            Kaizen_Temp::truncate();
            $temp = new Kaizen_Temp;
            $temp->Kaizen_ID = $kzid;
            $temp->kpkNum = $req->userKpk;
            $temp->save();

            //exec('START file://///apckrm06a/Namlos/34.%20Kaizen_mails/Kaizen_Mail/Testing/bin/Debug/Testing.exe');

            return redirect('/kaizen-form/approval-kaizen')->with('showModal', 'a')->with('send', 'a')->with('alert-success', 'Kaizen Approved');
            
            
        }
    }

    public function testApps(){
        exec('START file://///apckrm06a/Namlos/24.%20Sendipedia/Sendipedia/Sendipedia/bin/Debug/Sendipedia.exe');
    }

    public function approvemailTest(Request $req){

        function clean($string) {
            $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
            
            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
         }
         function cleanS($string) {
            $string = str_replace(':', '', $string); // Replaces all spaces with hyphens.
            
            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
         }
        
        
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $kzid = $req->kzid;
            $mail = $req->email;
            $kpks = $req->kpk;
            $room = $req->kzroom;
            $fixStart = $req->startTime;
            $fixEnd = $req->endTime;
            $fixDate = $req->dateFrom;
            clean($fixDate);
            cleanS($fixStart);
            cleanS($fixEnd);

            $text = "BEGIN:VCALENDAR\r\n
            VERSION:2.0\r\n
            PRODID:-//Deathstar-mailer//theforce/NONSGML v1.0//EN\r\n
            METHOD:REQUEST\r\n
            BEGIN:VEVENT\r\n
            UID:" . md5(uniqid(mt_rand(), true)) . "example.com\r\n
            DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z\r\n
            DTSTART:".$fixDate."T".$fixStart."00Z\r\n
            DTEND:".$fixDate."T".$fixEnd."00Z\r\n
            SUMMARY:test\r\n
            LOCATION:".$room."\r\n
            DESCRIPTION:trial\r\n
            ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;X-NUM-GUESTS=0:MAILTO:gabriella.keysiarahamis@mattel.com\r\n
            END:VEVENT\r\n
            END:VCALENDAR\r\n";

            
		
		// ICS
		
           
            $email = [];
            foreach($kpks as $key => $n){
                if($mail[$key] != NULL){
                    array_push($email, $mail[$key]);
                    Account::where('kpkNum', $n)
                    ->update([
                        'email' => $mail[$key]
                    ]);
                }else{
                    
                }

            }

            
            
            // dd($text);

            Kaizen_Main::where('Kaizen_ID', $kzid)
            ->update([
                'Kaizen_status' => 'Waiting',
                'Kaizen_room' => $room,
            ]);

            $main = Kaizen_Main::where('Kaizen_ID', $kzid)->first();
            $member = View_KaizenRoles::where('Kaizen_ID', $kzid)->get();
            $date = Kaizen_Date::where('Kaizen_ID', $kzid)->first();
            $Scope = Kaizen_Scope::where('Kaizen_ID', $kzid)->get();
            $Back = Kaizen_Background::where('Kaizen_ID', $kzid)->get();
            $Deliv = Kaizen_Deliverable::where('Kaizen_ID', $kzid)->get();
            $Base = Kaizen_Baseline::where('Kaizen_ID', $kzid)->get();
            $Goals = Kaizen_Goals::where('Kaizen_ID', $kzid)->get();
            Mail::send('mail/forgotmailpage', ['Scope' => $Scope, 'Back' => $Back, 'Deliv' => $Deliv, 'Base' => $Base, 'Goals' => $Goals, 'date' => $date, 'email' => $email, 'main' => $main, 'member' => $member],function ($m) use ($email,$main,$room,$fixDate,$fixStart,$fixEnd) {    
                $filename = "invite.ics";
                $meeting_duration = (3600 * 2); // 2 hours
                // $meetingstamp = strtotime( $data['start_date'] . " UTC");
                // $dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
                // $dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
                $todaystamp = gmdate('Ymd\THis\Z');
                $uid = date('Ymd').'T'.date('His').'-'.rand().'@yourdomain.com';
                // $description = strip_tags($data['texto']);
                $location = "Telefone ou vídeo conferência";
                $titulo_invite = "Your meeting title";
                $organizer = "CN=Organizer name:email@YourOrganizer.com";

                $mail[0]  = "BEGIN:VCALENDAR";
                $mail[1] = "PRODID:-//Microsoft Corporation//Outlook 11.0 MIMEDIR//EN";
                $mail[2] = "VERSION:2.0";
                $mail[3] = "CALSCALE:GREGORIAN";
                $mail[4] = "METHOD:REQUEST";
                $mail[5] = "BEGIN:VEVENT";
                $mail[6] = "DTSTART:".$fixDate."T".$fixStart."00Z";
                $mail[7] = "DTEND:".$fixDate."T".$fixEnd."00Z";
                $mail[8] = "DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z";
                $mail[9] = "UID:" . md5(uniqid(mt_rand(), true)) . "example.com";
                $mail[10] = "ORGANIZER;" . $organizer;
                $mail[11] = "CREATED:" . $todaystamp;
                $mail[12] = "DESCRIPTION:Test";
                $mail[13] = "LAST-MODIFIED:" . $todaystamp;
                $mail[14] = "LOCATION:" . $room;
                $mail[15] = "SEQUENCE:0";
                $mail[16] = "STATUS:CONFIRMED";
                $mail[17] = "ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CNfadel;X-NUM-GUESTS=0:MAILTO:gabriella.keysiarahamis@mattel.com;";
                $mail[18] = "SUMMARY:Your meeting title";
                $mail[19] = "TRANSP:OPAQUE";
                $mail[20] = "END:VEVENT";
                $mail[21] = "END:VCALENDAR";
                
                $mail = implode("\r\n", $mail);
                header("text/calendar");
                file_put_contents($filename, $mail);
                
                $m->to($email, 'name')
                ->subject(
                    'Kaizen Invitation ' . $main['Kaizen_type'] . ' - ' . $main['Kaizen_title']. '('.$main['Kaizen_ID'].')'
                )->attach($filename, array('base64' => 'text/calendar'));
                
            });

            return redirect('/kaizen-form/approval-kaizen')->with('showModal', 'a')->with('alert-success', 'Kaizen Approved');
            
            
        }
    }

    public function comingsoon(){
        if(!Session::get('login')){
            return view('comingsoon.comingsoon_kaizen');    
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();

            return view('comingsoon.comingsoon_kaizen', compact('totWait', 'acc'));
        }
    }

    public function attendancepage(){
        Session::put('kaizen', TRUE);
        Session::forget('home');

        $kaizen_list = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
        $memberlist = View_Member::all();

        $scopelist = Kaizen_Scope::all();
        $baselist = Kaizen_Baseline::all();
        $backlist = Kaizen_Background::all();
        $goalslist = Kaizen_Goals::all();
        $delivlist = Kaizen_Deliverable::all();
        $datelist = Kaizen_Date::all();
        // dd($datelist);

        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();

        if(!Session::get('login')){
            return view('kaizenform-user.listallkaizen-page', compact('datelist', 'totWait', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $myKaizen_list = View_UpdateList::latest('Kaizen_ID')->where('kpkNum', $acc->kpkNum)->get();
            return view('kaizenform-admin.attendance-page', compact('myKaizen_list', 'datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }
    }

    public function attendancedetail($kzid){
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
        $user = User::all();
        // dd($user);
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $employee = Employee::all();
            // dd($employee);
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-admin.attendance-detail-page', compact('user', 'rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
    }

    public function attendancesubmit(Request $req){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            $KZ_Member = new Kaizen_Member;
            $kzid = $req->kzid;

            Kaizen_Member::where('Kaizen_ID', $kzid)->delete();

            $dataMembers = [];

            $names = $req->name;
            $kpk = $req->kpk;
            $role = $req->role;
            foreach($names as $key => $n){
                    $dataMembers = [
                    ['Kaizen_ID' => $req->kzid,  'member_roles' => $role[$key], 'kpkNum' => $kpk[$key]]
                ];
                $KZ_Member->insert($dataMembers);
            }

            Kaizen_Main::where('Kaizen_ID', $kzid)
            ->update([
                'Kaizen_status' => 'Recorded',
            ]);

            return redirect('/kaizen-form/attendance-kaizen')->with('showModal', 'a')->with('alert-success', 'Kaizen Attendance Recorded');
        }
    }

    public function searchData(Request $req){
        Session::put('kaizen', TRUE);
        Session::forget('home');


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

            return view('kaizenform-admin.attendance-page', compact('myKaizen_list', 'datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }
    }

    public function cancelkaizen($kzid){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            Kaizen_Main::where('Kaizen_ID', $kzid)
            ->update([
                'Kaizen_status' => 'Canceled',
            ]);
            return redirect('/kaizen-form/approval-kaizen')->with('showModal', 'a')->with('alert', 'Kaizen Canceled');
        }
    }
}
