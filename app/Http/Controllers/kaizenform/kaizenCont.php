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
use App\View_RplusName;
use App\View_ListDate;
use App\Kaizen_Finding;
use App\Kaizen_Rplus;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Ical\Ical;
use Ical\IcalendarException;


class kaizenCont extends Controller
{   
    //Controller function to return Add Kaizen page view with employee and account data.
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
    
    //Controller function to return List Kaizen Page view with account and employee data.
    public function listkaipage(){
        Session::put('kaizen', TRUE);
        Session::forget('home');

        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();

        if(!Session::get('login')){
            return view('kaizenform-user.listallkaizen-page', compact('totWait'));
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            return view('kaizenform-user.listallkaizen-page', compact('acc', 'id', 'totWait'));
        }
    }

    //Search function in list kaizen page by Using Ajax
    public function searchkaizen(Request $req){
        
        if($req->ajax()){
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $memberlist = View_Member::all();
            $scopelist = Kaizen_Scope::all();
            $baselist = Kaizen_Baseline::all();
            $backlist = Kaizen_Background::all();
            $goalslist = Kaizen_Goals::all();
            $delivlist = Kaizen_Deliverable::all();
            $datelist = Kaizen_Date::all();
            $output = '';
            $myoutput = '';
            $query = $req->get('query');
            $type = $req->get('type');
            $status = $req->get('status');
            $dept = $req->get('dept');
            if($query != ' ' || $type != ' ' || $status != ' ' || $dept != ' '){
                $data = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')
                ->where('Kaizen_title', 'like', '%'. $query . '%')
                ->where('Kaizen_type', 'like', '%'. $type .'%')
                ->where('Kaizen_status', 'like', '%'. $status .'%')
                ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                ->get();
    
                if($req->session()->has("login")){
                    $myData = View_UpdateList::orderBy('Kaizen_DateFrom', 'DESC')
                    ->where('Kaizen_title', 'like', '%'. $query . '%')
                    ->where('Kaizen_type', 'like', '%'. $type .'%')
                    ->where('Kaizen_status', 'like', '%'. $status .'%')
                    ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                    ->where('kpkNum', $acc->kpkNum)
                    ->get();
                }
                
    
            }else{
                $data = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
                if($req->session()->has("login")){
                    $myData = View_UpdateList::orderBy('Kaizen_DateFrom', 'DESC')->where('kpkNum', $acc->kpkNum)->get();
                }
            }
            $total_row = $data->count();
            if($req->session()->has("login")){
                $total_my = $myData->count();
            }
            if($total_row > 0){
                foreach($data as $list){
    
                    $output .= 
                            '<a class="list-group-item">
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <div class="row align-self-start"><h5 class="text-danger font2 font-weight-bold">'. $list->Kaizen_title .'</h5></div>
                                        <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <div class="row">
                                            <div class="col-12 align-self-center">
                                                <div class="row">
                                                    <div class="col-2 align-self-center">
                                                        <i class="fas fa-map-pin"></i>
                                                    </div>
                                                    <div class="col-10">
                                                        '.$list->Kaizen_dept.'
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div class="col">';
                                                    
                                                            foreach($memberlist as $members){
                                                                if($list->Kaizen_ID == $members->Kaizen_ID){
                                                                    if($members->member_roles == "Leader")
                                                                        $output .= $members->Fullname;
                                                                }
                                                            }
                                                            $output.=
                                                            
                                                            '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 align-self-center">
                                        <div class="row">
                                            <div class="col-2 align-self-center">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                            <div class="col-10">
                                                ';
                                                foreach($datelist as $date){
                                                    if($list->Kaizen_ID == $date->Kaizen_ID){
                                                        
                                                            $fdate = $date->Kaizen_DateFrom;
                                                            $tdate = $date->Kaizen_DateTo;
    
                                                            $datetime1 = new DateTime($fdate);
                                                            $datetime2 = new DateTime($tdate);
                                                            $interval = $datetime1->diff($datetime2);
                                                            $days = $interval->format('%a');
                                                        
                                                        $output .= $days+1;
                                                    }
                                                }
                                                $output.=
                                                '
                                                Day(s)
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fas fa-info-circle"></i>                 
                                            </div>
                                            <div class="col-auto">
                                            ';
                                                if($list->Kaizen_status == "Waiting")
                                                $output .= '<div>'. $list->Kaizen_status .' <i class="fas fa-exclamation-circle text-warning"></i></div>';
                                                else if($list->Kaizen_status == "Completed")
                                                $output .='<div>'. $list->Kaizen_status .' <i class="fas fa-check-circle text-success"></i></div>';
                                                else if($list->Kaizen_status == "Recorded")
                                                $output .='<div>'. $list->Kaizen_status .' <i class="fas fa-clipboard-list text-primary"></i></div>';
                                                else if($list->Kaizen_status == "Approved")
                                                $output .='<div>'. $list->Kaizen_status .' <i class="far fa-thumbs-up text-primary"></i></div>';
                                                else
                                                $output .='<div>'. $list->Kaizen_status .' <i class="fas fa-times-circle text-danger"></i></div>';
                                                
                                                $output .=   
                                            '
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="col-1 align-self-center">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="allkz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Type
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_type .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Status
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_status .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Date
                                            </div>    
                                            <div class="col">
                                            ';
                                                foreach($datelist as $dates){
                                                    if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                        $output .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                    }
                                                
                                                $output .=
                                                '
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Department
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_dept .'
                                            </div>
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Member
                                            </div>
                                            <div class="col">';
                                            foreach($memberlist as $mem)
                                                if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                    $output .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                    $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Scope
                                            </div>
                                            <div class="col">';
                                            foreach($scopelist as $scope){
                                                    if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                        $output .= '<li>'. $scope->scope .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Background
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($backlist as $back){
                                                    if($list->Kaizen_ID == $back->Kaizen_ID)
                                                        $output .= '<li>'. $back->background .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Baseline
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($baselist as $base){
                                                    if($list->Kaizen_ID == $base->Kaizen_ID)
                                                        $output .= '<li>'. $base->baseline .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Goals
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($goalslist as $goal){
                                                    if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                        $output .= '<li>'. $goal->goals .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Deliverable
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($delivlist as $deliv){
                                                    if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                        $output .= '<li>'. $deliv->deliverable .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        ';
                                            if($req->session()->has("login")){
    
                                                if($acc->kpkNum == "393560"){
                                                    $output .= '<a href="/kaizen-form/update-kaizen/'.$list->Kaizen_ID.'" class="btn btn-success">Edit <i class="fas fa-edit"></i></a>';
                                                }
                                            }
                                                $output.=
                                            '
                                    </div>
                                    </div>
                                </div>
                            </div>
                            ';
                }
            }else{
                $output = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
            }
            
            if($req->session()->has("login")){
                if($total_my > 0){
                    if($req->session()->has("login")){
                        foreach($myData as $list){
    
                            $myoutput .= 
                            '<a class="list-group-item">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <div class="row align-self-start"><h5 class="text-danger font2 font-weight-bold">'. $list->Kaizen_title .'</h5></div>
                                    <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                </div>
                                <div class="col-4 align-self-center">
                                    <div class="row">
                                        <div class="col-12 align-self-center">
                                            <div class="row">
                                                <div class="col-2 align-self-center">
                                                    <i class="fas fa-map-pin"></i>
                                                </div>
                                                <div class="col-10">
                                                    '.$list->Kaizen_dept.'
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="col">';
                                                
                                                        foreach($memberlist as $members){
                                                            if($list->Kaizen_ID == $members->Kaizen_ID){
                                                                if($members->member_roles == "Leader")
                                                                    $myoutput .= $members->Fullname;
                                                            }
                                                        }
                                                        $myoutput.=
                                                        
                                                        '
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 align-self-center">
                                    <div class="row">
                                        <div class="col-2 align-self-center">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-10">
                                            ';
                                            foreach($datelist as $date){
                                                if($list->Kaizen_ID == $date->Kaizen_ID){
                                                    
                                                        $fdate = $date->Kaizen_DateFrom;
                                                        $tdate = $date->Kaizen_DateTo;

                                                        $datetime1 = new DateTime($fdate);
                                                        $datetime2 = new DateTime($tdate);
                                                        $interval = $datetime1->diff($datetime2);
                                                        $days = $interval->format('%a');
                                                    
                                                    $myoutput .= $days+1;
                                                }
                                            }
                                            $myoutput.=
                                            '
                                            Day(s)
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="fas fa-info-circle"></i>                 
                                        </div>
                                        <div class="col-auto">
                                        ';
                                            if($list->Kaizen_status == "Waiting")
                                            $myoutput .= '<div>'. $list->Kaizen_status .' <i class="fas fa-exclamation-circle text-warning"></i></div>';
                                            else if($list->Kaizen_status == "Completed")
                                            $myoutput .='<div>'. $list->Kaizen_status .' <i class="fas fa-check-circle text-success"></i></div>';
                                            else if($list->Kaizen_status == "Recorded")
                                            $myoutput .='<div>'. $list->Kaizen_status .' <i class="fas fa-clipboard-list text-primary"></i></div>';
                                            else if($list->Kaizen_status == "Approved")
                                            $myoutput .='<div>'. $list->Kaizen_status .' <i class="far fa-thumbs-up text-primary"></i></div>';
                                            else
                                            $myoutput .='<div>'. $list->Kaizen_status .' <i class="fas fa-times-circle text-danger"></i></div>';
                                            
                                            $myoutput .=   
                                        '
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="col-1 align-self-center">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mykz'.$list->Kaizen_ID.'"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="modal fade" id="mykz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row p-2">
                                                    <div class="col-3">
                                                        Type
                                                    </div>    
                                                    <div class="col">
                                                        '. $list->Kaizen_type .'
                                                    </div>
                                                </div>
                                                <div class="row  p-2 rounded">
                                                    <div class="col-3">
                                                        Status
                                                    </div>    
                                                    <div class="col">
                                                        '. $list->Kaizen_status .'
                                                    </div>
                                                </div>
                                                <div class="row  p-2 rounded">
                                                    <div class="col-3">
                                                        Date
                                                    </div>    
                                                    <div class="col">
                                                    ';
                                                        foreach($datelist as $dates){
                                                            if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                                $myoutput .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                            }
                                                        
                                                        $myoutput .=
                                                        '
                                                    </div>
                                                </div>
                                                <div class="row p-2">
                                                    <div class="col-3">
                                                        Department
                                                    </div>    
                                                    <div class="col">
                                                        '. $list->Kaizen_dept .'
                                                    </div>
                                                </div>
                                                <div class="row p-2  rounded">
                                                    <div class="col-3">
                                                        Member
                                                    </div>
                                                    <div class="col">';
                                                    foreach($memberlist as $mem)
                                                        if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                            $myoutput .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                            $myoutput .=
                                                        '
                                                    </div> 
                                                </div>
                                                <div class="row p-2">
                                                    <div class="col-3">
                                                        Scope
                                                    </div>
                                                    <div class="col">';
                                                    foreach($scopelist as $scope){
                                                            if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                                $myoutput .= '<li>'. $scope->scope .'</li>';
                                                        }
                                                        $myoutput .=
                                                        '
                                                    </div> 
                                                </div>
                                                <div class="row p-2  rounded">
                                                    <div class="col-3">
                                                        Background
                                                    </div>
                                                    <div class="col">
                                                    ';
                                                    foreach($backlist as $back){
                                                            if($list->Kaizen_ID == $back->Kaizen_ID)
                                                                $myoutput .= '<li>'. $back->background .'</li>';
                                                        }
                                                        $myoutput .=
                                                        '
                                                    </div> 
                                                </div>
                                                <div class="row p-2">
                                                    <div class="col-3">
                                                        Baseline
                                                    </div>
                                                    <div class="col">
                                                    ';
                                                    foreach($baselist as $base){
                                                            if($list->Kaizen_ID == $base->Kaizen_ID)
                                                                $myoutput .= '<li>'. $base->baseline .'</li>';
                                                        }
                                                        $myoutput .=
                                                        '
                                                    </div> 
                                                </div>
                                                <div class="row p-2  rounded">
                                                    <div class="col-3">
                                                        Goals
                                                    </div>
                                                    <div class="col">
                                                    ';
                                                    foreach($goalslist as $goal){
                                                            if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                                $myoutput .= '<li>'. $goal->goals .'</li>';
                                                        }
                                                        $myoutput .=
                                                        '
                                                    </div> 
                                                </div>
                                                <div class="row p-2">
                                                    <div class="col-3">
                                                        Deliverable
                                                    </div>
                                                    <div class="col">
                                                    ';
                                                    foreach($delivlist as $deliv){
                                                            if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                                $myoutput .= '<li>'. $deliv->deliverable .'</li>';
                                                        }
                                                        $myoutput .=
                                                        '
                                                    </div> 
                                                </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                ';
                                                    if($req->session()->has("login")){
    
                                                        if($acc->kpkNum == "393560"){}
                                                            $myoutput .= '<a href="/kaizen-form/update-kaizen/'.$list->Kaizen_ID.'" class="btn btn-success">Edit <i class="fas fa-edit"></i></a>';
                                                    }
                                                        $myoutput.=
                                                    '
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                        }
                    }
                }else{
                    $myoutput = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
                }
            }
            
    
    
            
            
            $data = array(
                'table_data'  => $myoutput,
                'total_data'  => $output,
                );
    
            return response()->json($data);
           
            
          }
    }

    //Function to create new kaizen or Add new Kaizen.
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
    
    //Function to show detail of a kaizen
    public function show($kzid)
    {
        $main = Kaizen_Main::where('Kaizen_ID', $kzid)->first();
        $dates = Kaizen_Date::where('Kaizen_ID', $kzid)->first();
        $member = View_Member::oldest('MemberID')->where('Kaizen_ID', $kzid)->get();
        $scopes = Kaizen_Scope::where('Kaizen_ID', $kzid)->get();
        $backs = Kaizen_Background::where('Kaizen_ID', $kzid)->get();
        $bases = Kaizen_Baseline::where('Kaizen_ID', $kzid)->get();
        $goals = Kaizen_Goals::where('Kaizen_ID', $kzid)->get();
        $delivs = Kaizen_Deliverable::where('Kaizen_ID', $kzid)->get();
        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
        $findings = Kaizen_Finding::where('Kaizen_ID', $kzid)->get();
        $Rplus = View_RplusName::all();

        
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{

            $employee = Employee::all();
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-user.updatekaizenlistdetail-page', compact('Rplus' ,'findings' ,'rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
    }

    //Function to show Update List Kaizen Page, but this isn't use anymore.
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
            $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
           
            return view('kaizenform-user.updatekaizenlist-page', compact('datelist', 'totWait', 'acc', 'kaizen_list', 'memberlist', 'scopelist', 'baselist', 'backlist', 'goalslist', 'delivlist'));
        }
    }

    //Update kaizen details data 
    public function updatedetaildata(Request $req){
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
                return redirect('/kaizen-form/list-kaizen')->with('showModal', 'a')->with('alert-success', 'Data Updated');
            }else{
                return redirect('/kaizen-form/list-kaizen')->with('showModal', 'a')->with('alert-success', 'Data Updated');
            }
        }
    }

    //Return Approval Kaizen Page 
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

            if(!Session::get('login')){
                return view('kaizenform-admin.listapprove-page', compact('totWait'));
            }else{
                $id = Session::get('id');
                $acc = User::where('id', '=', $id)->first();
                return view('kaizenform-admin.listapprove-page', compact('acc', 'id', 'totWait'));
            }
            
        }
    }

    //Approved spesific kaizen and set room for the kaizen
    public function approvalpage($kzid){
        $main = Kaizen_Main::where('Kaizen_ID', $kzid)->first();
        $dates = Kaizen_Date::where('Kaizen_ID', $kzid)->first();
        $member = View_Member::oldest('MemberID')->where('Kaizen_ID', $kzid)->get();
        $scopes = Kaizen_Scope::where('Kaizen_ID', $kzid)->get();
        $backs = Kaizen_Background::where('Kaizen_ID', $kzid)->get();
        $bases = Kaizen_Baseline::where('Kaizen_ID', $kzid)->get();
        $goals = Kaizen_Goals::where('Kaizen_ID', $kzid)->get();
        $delivs = Kaizen_Deliverable::where('Kaizen_ID', $kzid)->get();
        $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();
        $user = User::all();
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $employee = Employee::all();
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $rolesKaizen = View_KaizenRoles::where('Kaizen_ID', $kzid)->where('kpkNum', $acc->kpkNum)->first();
            return view('kaizenform-admin.approval-page', compact('user', 'rolesKaizen', 'totWait' ,'acc', 'employee', 'main', 'member', 'dates', 'scopes', 'backs', 'bases', 'goals', 'delivs'));
        }
    }

    //Search kaizen features and return all kaizen data without reload the page using AJAX in Approval Page
    public function searchApprove(Request $req){
        if($req->ajax()){
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $memberlist = View_Member::all();
            $scopelist = Kaizen_Scope::all();
            $baselist = Kaizen_Baseline::all();
            $backlist = Kaizen_Background::all();
            $goalslist = Kaizen_Goals::all();
            $delivlist = Kaizen_Deliverable::all();
            $datelist = Kaizen_Date::all();
            $output = '';
            $myoutput = '';
            $yououtput = '';
            $query = $req->get('query');
            $type = $req->get('type');
            $dept = $req->get('dept');
            if($query != ' ' || $type != ' ' || $dept != ' '){
                $data = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')
                ->where('Kaizen_title', 'like', '%'. $query . '%')
                ->where('Kaizen_type', 'like', '%'. $type .'%')
                ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                ->where('Kaizen_status', 'Waiting')
                ->get();
    
                $myData = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')
                ->where('Kaizen_title', 'like', '%'. $query . '%')
                ->where('Kaizen_type', 'like', '%'. $type .'%')
                ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                ->where('Kaizen_status', 'Approved')
                ->get();

                $youData = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')
                ->where('Kaizen_title', 'like', '%'. $query . '%')
                ->where('Kaizen_type', 'like', '%'. $type .'%')
                ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                ->where('Kaizen_status', 'Canceled')
                ->get();
                
    
            }else{
                $data = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
                $myData = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
            }
            $total_row = $data->count();
            $total_my = $myData->count();
            $total_you = $youData->count();
            if($total_row > 0){
                foreach($data as $list){
    
                    $output .= 
                            '<a class="list-group-item">
                                <div class="row">
                                    <div class="col-5 align-self-center">
                                        <div class="row align-self-start"><h5 class="text-danger font-weight-bold font2">'. $list->Kaizen_title .'</h5></div>
                                        <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                        <div class="row align-self-end">Kaizen ID : '. $list->Kaizen_ID .'</div>
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date From';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $output .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateFrom)).'</div>';
                                        }
                                        $output .=
                                        '
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date To';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $output .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateTo)).'</div>';
                                        }
                                        $output .=
                                        '
                                    </div>
                                                    
                                    <div class="col-3 align-self-center text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'">View</button>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="allkz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Type
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_type .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Status
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_status .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Date
                                            </div>    
                                            <div class="col">
                                            ';
                                                foreach($datelist as $dates){
                                                    if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                        $output .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                    }
                                                
                                                $output .=
                                                '
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Department
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_dept .'
                                            </div>
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Member
                                            </div>
                                            <div class="col">';
                                            foreach($memberlist as $mem)
                                                if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                    $output .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                    $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Scope
                                            </div>
                                            <div class="col">';
                                            foreach($scopelist as $scope){
                                                    if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                        $output .= '<li>'. $scope->scope .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Background
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($backlist as $back){
                                                    if($list->Kaizen_ID == $back->Kaizen_ID)
                                                        $output .= '<li>'. $back->background .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Baseline
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($baselist as $base){
                                                    if($list->Kaizen_ID == $base->Kaizen_ID)
                                                        $output .= '<li>'. $base->baseline .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Goals
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($goalslist as $goal){
                                                    if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                        $output .= '<li>'. $goal->goals .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Deliverable
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($delivlist as $deliv){
                                                    if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                        $output .= '<li>'. $deliv->deliverable .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCancel'. $list->Kaizen_ID .'" data-dismiss="modal">Cancel <i class="far fa-times-circle"></i></button>
                                        <a href="/kaizen-form/update-kaizen/'. $list->Kaizen_ID .'" class="btn btn-primary">Update <i class="fas fa-edit"></i></a>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalApprove'. $list->Kaizen_ID .'" data-dismiss="modal">Approve <i class="far fa-thumbs-up"></i></button>
                                    </div>
                                    
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalCancel'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="modalCancelTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-light" id="exampleModalLongTitle">Cancel Kaizen ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to cancel kaizen titled "'. $list->Kaizen_title .'" ?
                                        </div>
                                        <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <a href="/kaizen-form/cancel-kaizen/'. $list->Kaizen_ID .'" class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalApprove'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="modalCancelTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-light" id="exampleModalLongTitle">Approve Kaizen ?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to approve kaizen titled "'. $list->Kaizen_title .'" ?
                                        </div>
                                        <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <a href="/kaizen-form/apr-kaizen/'. $list->Kaizen_ID .'" class="btn btn-primary">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                }
            }else{
                $output = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
            }
            
            if($total_my > 0){
                
                foreach($myData as $list){
    
                    $myoutput .= 
                            '<a class="list-group-item">
                                <div class="row">
                                    <div class="col-5 align-self-center">
                                        <div class="row align-self-start"><h5 class="font-weight-bold font2 text-danger">'. $list->Kaizen_title .'</h5></div>
                                        <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                        <div class="row align-self-end">Kaizen ID : '. $list->Kaizen_ID .'</div>
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date From';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $myoutput .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateFrom)).'</div>';
                                        }
                                        $myoutput .=
                                        '
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date To';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $myoutput .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateTo)).'</div>';
                                        }
                                        $myoutput .=
                                        '
                                    </div>
                                                    
                                    <div class="col-3 align-self-center text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'">View</button>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="allkz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Type
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_type .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Status
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_status .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Date
                                            </div>    
                                            <div class="col">
                                            ';
                                                foreach($datelist as $dates){
                                                    if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                        $myoutput .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                    }
                                                
                                                $myoutput .=
                                                '
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Department
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_dept .'
                                            </div>
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Member
                                            </div>
                                            <div class="col">';
                                            foreach($memberlist as $mem)
                                                if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                    $myoutput .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                    $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Scope
                                            </div>
                                            <div class="col">';
                                            foreach($scopelist as $scope){
                                                    if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                        $myoutput .= '<li>'. $scope->scope .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Background
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($backlist as $back){
                                                    if($list->Kaizen_ID == $back->Kaizen_ID)
                                                        $myoutput .= '<li>'. $back->background .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Baseline
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($baselist as $base){
                                                    if($list->Kaizen_ID == $base->Kaizen_ID)
                                                        $myoutput .= '<li>'. $base->baseline .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Goals
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($goalslist as $goal){
                                                    if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                        $myoutput .= '<li>'. $goal->goals .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Deliverable
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($delivlist as $deliv){
                                                    if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                        $myoutput .= '<li>'. $deliv->deliverable .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalCan'. $list->Kaizen_ID .'" data-dismiss="modal">Cancel <i class="far fa-times-circle"></i></button>
                                        <a href="/kaizen-form/update-kaizen/'. $list->Kaizen_ID .'" class="btn btn-primary">Update <i class="fas fa-edit"></i></a>
                                        <a href="/kaizen-form/approval-kaizen/'. $list->Kaizen_ID .'" class="btn btn-success">Set Room & Mail <i class="far fa-thumbs-up"></i></a>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalCan'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="modalCanTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-light" id="exampleModalLongTitle">Cancel Kaizen ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to cancel kaizen titled "'. $list->Kaizen_title .'" ?
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <a href="/kaizen-form/cancel-kaizen/'. $list->Kaizen_ID .'" class="btn btn-primary">Yes</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            ';
                }
                
            }else{
                $myoutput = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
            }
            
            if($total_you > 0){
                
                foreach($youData as $list){
    
                    $yououtput .= 
                            '<a class="list-group-item">
                                <div class="row">
                                    <div class="col-5 align-self-center">
                                        <div class="row align-self-start"><h5 class="font-weight-bold font2 text-danger">'. $list->Kaizen_title .'</h5></div>
                                        <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                        <div class="row align-self-end">Kaizen ID : '. $list->Kaizen_ID .'</div>
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date From';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $yououtput .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateFrom)).'</div>';
                                        }
                                        $yououtput .=
                                        '
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date To';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $yououtput .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateTo)).'</div>';
                                        }
                                        $yououtput .=
                                        '
                                    </div>
                                                    
                                    <div class="col-3 align-self-center text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'">View</button>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="allkz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Type
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_type .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Status
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_status .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Date
                                            </div>    
                                            <div class="col">
                                            ';
                                                foreach($datelist as $dates){
                                                    if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                        $yououtput .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                    }
                                                
                                                $yououtput .=
                                                '
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Department
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_dept .'
                                            </div>
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Member
                                            </div>
                                            <div class="col">';
                                            foreach($memberlist as $mem)
                                                if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                    $yououtput .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                    $yououtput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Scope
                                            </div>
                                            <div class="col">';
                                            foreach($scopelist as $scope){
                                                    if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                        $yououtput .= '<li>'. $scope->scope .'</li>';
                                                }
                                                $yououtput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Background
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($backlist as $back){
                                                    if($list->Kaizen_ID == $back->Kaizen_ID)
                                                        $yououtput .= '<li>'. $back->background .'</li>';
                                                }
                                                $yououtput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Baseline
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($baselist as $base){
                                                    if($list->Kaizen_ID == $base->Kaizen_ID)
                                                        $yououtput .= '<li>'. $base->baseline .'</li>';
                                                }
                                                $yououtput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Goals
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($goalslist as $goal){
                                                    if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                        $yououtput .= '<li>'. $goal->goals .'</li>';
                                                }
                                                $yououtput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Deliverable
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($delivlist as $deliv){
                                                    if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                        $yououtput .= '<li>'. $deliv->deliverable .'</li>';
                                                }
                                                $yououtput .=
                                                '
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                            ';
                }
                
            }else{
                $yououtput = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
            }
    
            
            $data = array(
                'table_data'  => $myoutput,
                'total_data'  => $output,
                'total_cancel'  => $yououtput,
                );
    
            return response()->json($data);
           
            
          }
    }

    //Approve kaizen to set room and send email
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

            return redirect('/kaizen-form/approval-kaizen')->with('showModal', 'a')->with('send', 'a')->with('alert-success', 'Kaizen Approved');
            
            
        }
    }

    //Return Dashboard Page
    public function comingsoon(){
        if(!Session::get('login')){
            return view('comingsoon.comingsoon_kaizen');    
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $totWait = Kaizen_Main::where('Kaizen_status', 'Waiting')->get();

            return view('kaizenform-user.dashboard', compact('totWait', 'acc'));
        }
    }

    //Return to Kaizen Attendance Page and show all kaizen data that has not been attended yet
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

    //detail of attendance page
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

    //Submit who attend that kaizen.
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

    //Search function in attendance page and return all kaizen data without reload the page, using AJAX
    public function searchData(Request $req){
        if($req->ajax()){
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();
            $memberlist = View_Member::all();
            $scopelist = Kaizen_Scope::all();
            $baselist = Kaizen_Baseline::all();
            $backlist = Kaizen_Background::all();
            $goalslist = Kaizen_Goals::all();
            $delivlist = Kaizen_Deliverable::all();
            $datelist = Kaizen_Date::all();
            $output = '';
            $myoutput = '';
            $query = $req->get('query');
            $type = $req->get('type');
            $dept = $req->get('dept');
            if($query != ' ' || $type != ' ' || $dept != ' '){
                $data = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')
                ->where('Kaizen_title', 'like', '%'. $query . '%')
                ->where('Kaizen_type', 'like', '%'. $type .'%')
                ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                ->where('Kaizen_status', 'Approved')
                ->get();
    
                $myData = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')
                ->where('Kaizen_title', 'like', '%'. $query . '%')
                ->where('Kaizen_type', 'like', '%'. $type .'%')
                ->where('Kaizen_dept', 'like', '%'. $dept .'%')
                ->where('Kaizen_status', 'Recorded')
                ->get();
                
    
            }else{
                $data = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
                $myData = View_ListDate::orderBy('Kaizen_DateFrom', 'DESC')->get();
            }
            $total_row = $data->count();
            $total_my = $myData->count();
            if($total_row > 0){
                foreach($data as $list){
    
                    $output .= 
                            '<a class="list-group-item">
                                <div class="row">
                                    <div class="col-5 align-self-center">
                                        <div class="row align-self-start"><h5 class="text-danger font-weight-bold font2">'. $list->Kaizen_title .'</h5></div>
                                        <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                        <div class="row align-self-end">Kaizen ID : '. $list->Kaizen_ID .'</div>
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date From';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $output .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateFrom)).'</div>';
                                        }
                                        $output .=
                                        '
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date To';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $output .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateTo)).'</div>';
                                        }
                                        $output .=
                                        '
                                    </div>
                                                    
                                    <div class="col-3 align-self-center text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'">View</button>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="allkz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Type
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_type .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Status
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_status .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Date
                                            </div>    
                                            <div class="col">
                                            ';
                                                foreach($datelist as $dates){
                                                    if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                        $output .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                    }
                                                
                                                $output .=
                                                '
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Department
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_dept .'
                                            </div>
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Member
                                            </div>
                                            <div class="col">';
                                            foreach($memberlist as $mem)
                                                if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                    $output .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                    $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Scope
                                            </div>
                                            <div class="col">';
                                            foreach($scopelist as $scope){
                                                    if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                        $output .= '<li>'. $scope->scope .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Background
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($backlist as $back){
                                                    if($list->Kaizen_ID == $back->Kaizen_ID)
                                                        $output .= '<li>'. $back->background .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Baseline
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($baselist as $base){
                                                    if($list->Kaizen_ID == $base->Kaizen_ID)
                                                        $output .= '<li>'. $base->baseline .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Goals
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($goalslist as $goal){
                                                    if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                        $output .= '<li>'. $goal->goals .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Deliverable
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($delivlist as $deliv){
                                                    if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                        $output .= '<li>'. $deliv->deliverable .'</li>';
                                                }
                                                $output .=
                                                '
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                                        if(Session::has("login")){
                                            if($acc->kpkNum == "393560"){
                                                $output .= '<a href="/kaizen-form/attendance-kaizen/'.$list->Kaizen_ID.'" class="btn btn-primary">Attend <i class="fas fa-user-check"></i></a>';
                                            }
                                        }
                                        $output.=
                                        '
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                            ';
                }
            }else{
                $output = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
            }
            
            if($total_my > 0){
                
                foreach($myData as $list){
    
                    $myoutput .= 
                            '<a class="list-group-item">
                                <div class="row">
                                    <div class="col-5 align-self-center">
                                        <div class="row align-self-start"><h5 class="text-danger font-weight-bold font2">'. $list->Kaizen_title .'</h5></div>
                                        <div class="row align-self-end">Kaizen '. $list->Kaizen_type .'</div>
                                        <div class="row align-self-end">Kaizen ID : '. $list->Kaizen_ID .'</div>
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date From';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $myoutput .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateFrom)).'</div>';
                                        }
                                        $myoutput .=
                                        '
                                    </div>
                                    <div class="col-2 align-self-center">
                                        Date To';
                                        foreach($datelist as $date){
                                            if($list->Kaizen_ID == $date->Kaizen_ID)
                                            $myoutput .= '<div class="text">'. date("d M Y", strtotime($date->Kaizen_DateTo)).'</div>';
                                        }
                                        $myoutput .=
                                        '
                                    </div>
                                                    
                                    <div class="col-3 align-self-center text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#allkz'.$list->Kaizen_ID.'">View</button>
                                    </div>
                                </div>
                            </a>
                            <div class="modal fade" id="allkz'. $list->Kaizen_ID .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">'. $list->Kaizen_title .'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Type
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_type .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Status
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_status .'
                                            </div>
                                        </div>
                                        <div class="row  p-2 rounded">
                                            <div class="col-3">
                                                Date
                                            </div>    
                                            <div class="col">
                                            ';
                                                foreach($datelist as $dates){
                                                    if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                        $myoutput .= date("d M Y", strtotime($dates->Kaizen_DateFrom))  .'-'.   date("d M Y", strtotime($dates->Kaizen_DateTo));
                                                    }
                                                
                                                $myoutput .=
                                                '
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Department
                                            </div>    
                                            <div class="col">
                                                '. $list->Kaizen_dept .'
                                            </div>
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Member
                                            </div>
                                            <div class="col">';
                                            foreach($memberlist as $mem)
                                                if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                    $myoutput .= '<li>'.$mem->Fullname .'('.$mem->member_roles.')</li>';
                                                    $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Scope
                                            </div>
                                            <div class="col">';
                                            foreach($scopelist as $scope){
                                                    if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                        $myoutput .= '<li>'. $scope->scope .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Background
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($backlist as $back){
                                                    if($list->Kaizen_ID == $back->Kaizen_ID)
                                                        $myoutput .= '<li>'. $back->background .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Baseline
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($baselist as $base){
                                                    if($list->Kaizen_ID == $base->Kaizen_ID)
                                                        $myoutput .= '<li>'. $base->baseline .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2  rounded">
                                            <div class="col-3">
                                                Goals
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($goalslist as $goal){
                                                    if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                        $myoutput .= '<li>'. $goal->goals .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                Deliverable
                                            </div>
                                            <div class="col">
                                            ';
                                            foreach($delivlist as $deliv){
                                                    if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                        $myoutput .= '<li>'. $deliv->deliverable .'</li>';
                                                }
                                                $myoutput .=
                                                '
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                                        if(Session::has("login")){
                                            if($acc->kpkNum == "393560"){
                                                $myoutput .= '<a href="/kaizen-form/attendance-kaizen/'.$list->Kaizen_ID.'" class="btn btn-primary">Update Attendance <i class="fas fa-user-edit"></i></a>';
                                            }
                                        }
                                        $myoutput.=
                                        '
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                            ';
                }
                
            }else{
                $myoutput = '<h4 class="text-center mt-3 font2">No Data Found</h4>';
            }
            
    
    
            
            
            $data = array(
                'table_data'  => $myoutput,
                'total_data'  => $output,
                );
    
            return response()->json($data);
           
            
          }
    }

    //Function to set kaizen status to canceled
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

    //Function to set kaizen status to approve
    public function approvekaizen($kzid){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            Kaizen_Main::where('Kaizen_ID', $kzid)
            ->update([
                'Kaizen_status' => 'Approved',
            ]);
            return redirect('/kaizen-form/approval-kaizen')->with('showModal', 'a')->with('alert-success', 'Kaizen Approved');
        }
    }

    //Function to add new finding in detail kaizen page
    public function addFinding(Request $req){
        $KZ_finding = new Kaizen_Finding;
        $KZ_Rplus = new Kaizen_Rplus;

        $KZ_finding->Finding_ID = $req->findingID;
        $KZ_finding->Kaizen_ID = $req->kzidRplus;
        $KZ_finding->KPI = $req->selectKPI;
        $KZ_finding->Issue_desc = $req->issueDesc;
        $KZ_finding->Actions_desc = $req->actionDesc;
        $KZ_finding->Before_act = $req->beforeAct;
        $KZ_finding->After_act = $req->afterAct;
        $KZ_finding->Unit_measure = $req->selectUM;
        $KZ_finding->Goals_act = $req->goalsAct;
        $KZ_finding->Due_date = $req->dueDate;
        $KZ_finding->Remarks = $req->selectRemarks;

        $KZ_finding->save();

        $dataMembers = [];
        $names = $req->rplusKpk;
        // $kpk = $req->kpkRplus;
        
        foreach($names as $key => $n){
                $dataMembers = [
                ['Finding_ID' => $req->findingID, 'kpkNum' => $names[$key]]
            ];
            $KZ_Rplus->insert($dataMembers);
        }
        
    }

    //Function to delete a finding in detail kaizen page
    public function deleteFinding($fid){
        if(!Session::get('login')){
            return redirect('/login')->with('showModal', 'a')->with('alert', 'You must be login first');
        }else{
            $id = Session::get('id');
            $acc = User::where('id', '=', $id)->first();

            Kaizen_Rplus::where('Finding_ID', $fid)->delete();
            Kaizen_Finding::where('Finding_ID', $fid)->delete();

            return redirect()->back()->with('showModal', 'a')->with('alert', '1 Finding Deleted');
        }
    }

    //Function to edit a finding in detail kaizen page
    public function editFinding(Request $req){
        $findingID = $req->editFID;
        
        // dd($findingID);
        
        Kaizen_Rplus::where('Finding_ID', '=', $findingID)->delete();
        Kaizen_Finding::where('Finding_ID', '=', $findingID)->delete();
        
        
        
        $KZ_finding = new Kaizen_Finding;
        $KZ_Rplus = new Kaizen_Rplus;
        
        $KZ_finding->Finding_ID = $findingID;

        $KZ_finding->Kaizen_ID = $req->kzid;
        $KZ_finding->KPI = $req->selectKPIUpdate;
        $KZ_finding->Issue_desc = $req->issueDescUpdate;
        $KZ_finding->Actions_desc = $req->actionDescUpdate;
        $KZ_finding->Before_act = $req->beforeActUpdate;
        $KZ_finding->After_act = $req->afterActUpdate;
        $KZ_finding->Unit_measure = $req->selectUMUpdate;
        $KZ_finding->Goals_act = $req->goalsActUpdate;
        $KZ_finding->Due_date = $req->dueDateUpdate;
        $KZ_finding->Remarks = $req->selectRemarksUpdate;

        $KZ_finding->save();

        $dataMembers = [];
        $names = $req->updateRplus;
        
        foreach($names as $key => $n){
                $dataMembers = [
                ['Finding_ID' => $findingID, 'kpkNum' => $names[$key]]
            ];
            $KZ_Rplus->insert($dataMembers);
        }
        
        return redirect()->back()->with('showModal', 'a')->with('alert-success', 'Finding edited');
    }

}
