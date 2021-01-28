@extends('layout/main-kaizenForm')


@section('title', 'List Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', 'active')
@section('updateKaizen', '')
@section('dashboard', '')

 
@section('container')
<!-- Main Content -->


        <div class="container-fluid">
            <!-- Begin ALL Kaizen Page Content -->
            <form action="{{ url('/kaizen-form/list-kaizen')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2 ml-4">
                        <div class="form-group row">  
                            <div class="border-0 shadow-lg rounded ml-2 mr-2">
                                
                                <div class="pt-2 pl-2 pr-2 pb-3">
                                    <h5 class="text-dark">Filter</h5>
                                    <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold text-danger">Kaizen Type</label>
                                    <select class="form-control form-control-sm" id="exampleSelect1" name="kztype">
                                        <option value="" selected>All Kaizen Type</option>
                                        <option value="BPK">BPK</option>
                                        <option value="SFK">SFK</option>
                                        <option value="DK">DK</option>
                                        <option value="555">555</option>
                                    </select>
                                </div>

                                <div class="pl-2 pr-2 pb-3">
                                    <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold text-danger">STATUS</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat0" value="" checked>
                                        <label class="form-check-label" for="stat0">All</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat1" value="Waiting">
                                        <label class="form-check-label" for="stat1">Waiting Approval</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat2" value="Approved">
                                        <label class="form-check-label" for="stat2">Approved</label>
                                    </div>
                                </div>

                                <div class="pl-2 pr-2 pb-3">
                                    <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold text-danger">Department</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept0" value="" checked>
                                        <label class="form-check-label" for="dept0">All Department</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept1" value="EHS">
                                        <label class="form-check-label" for="dept1">EHS & Compliance</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept2" value="Engineering">
                                        <label class="form-check-label" for="dept2">Engineering</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept3" value="Finance & IT">
                                        <label class="form-check-label" for="dept3">Finance & IT</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept4" value="Human Resources">
                                        <label class="form-check-label" for="dept4">Human Resources</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept5" value="Manufacturing East">
                                        <label class="form-check-label" for="dept5">Manufacturing East Plant</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept6" value="Manufacturing West">
                                        <label class="form-check-label" for="dept6">Manufacturing West Plant</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept7" value="Materials">
                                        <label class="form-check-label" for="dept7">Materials</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept8" value="Product Development">
                                        <label class="form-check-label" for="dept8">Product Development</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept9" value="Quality">
                                        <label class="form-check-label" for="dept9">Quality</label>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 ml-4">
                        
                        <div class="search-form pt-2 pb-3">
                            @csrf
                            <div class="row">
                                <div class="col-10">
                                    <input class="form-control" name="search" type="search" placeholder="Search Kaizen..." aria-label="Search" aria-describedby="button-addon2"  value="{{ old('search') }}">
                                </div>
                                <div class="col">
                                    <button class="btn btn-customyel" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                    <a class="btn btn-customyel" href="{{url('/kaizen-form/list-kaizen')}}">
                                        <i class="fas fa-redo-alt fa-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--nav tab-->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active text-danger" id="nav-allkz-tab" data-toggle="tab" href="#nav-allkz" role="tab" aria-controls="nav-allkz" aria-selected="true">All Kaizen</a>
                                @if(Session::has('login'))
                                    <a class="nav-item nav-link text-danger" id="nav-mykz-tab" data-toggle="tab" href="#nav-mykz" role="tab" aria-controls="nav-mykz" aria-selected="false">My Kaizen</a>
                                @endif
                            </div>
                        </nav>

                        <!--search result-->                         
                        <div class="border-0 shadow-lg rounded pl-3 pt-3 pb-3 pr-3">
                            <div class="tab-content" id="nav-tabContent">
                                <!-- tab all kaizen -->
                                <div class="tab-pane fade show active" id="nav-allkz" role="tabpanel" aria-labelledby="nav-allkz-tab">
                                    <div class="pt-2 pb-2">Search result(s) for all Kaizen</div>
                                    <div class="list-group vertical-scrollable">
                                        @foreach($kaizen_list as $list)
                                            <a class="list-group-item">
                                                <div class="row">
                                                    <div class="col-5 align-self-center">
                                                        <div class="row align-self-start"><h5 class="text-uppercase text-danger">{{ $list->Kaizen_title }}</h5></div>
                                                        <div class="row align-self-end">Kaizen Type : {{ $list->Kaizen_type }}</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-10 align-self-center">
                                                                
                                                                <div class="row mb-2">
                                                                    <div class="col-2">
                                                                        <i class="fas fa-map-pin"></i>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $list->Kaizen_dept }}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                    <div class="col">
                                                                        @foreach($memberlist as $members)
                                                                            @if($list->Kaizen_ID == $members->Kaizen_ID)
                                                                                @if($members->member_roles == 'Leader')
                                                                                    {{$members->Fullname}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 align-self-center">
                                                        <div class="row mb-2">
                                                            <div class="col-2">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </div>
                                                            <div class="col-8">
                                                                @foreach($datelist as $date)
                                                                    @if($list->Kaizen_ID == $date->Kaizen_ID)
                                                                        @php
                                                                            $fdate = $date->Kaizen_DateFrom;
                                                                            $tdate = $date->Kaizen_DateTo;

                                                                            $datetime1 = new DateTime($fdate);
                                                                            $datetime2 = new DateTime($tdate);
                                                                            $interval = $datetime1->diff($datetime2);
                                                                            $days = $interval->format('%a');
                                                                        @endphp
                                                                        {{$days+1}}
                                                                    @endif
                                                                @endforeach
                                                                Day(s)
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row">
                                                            Status
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <i class="fas fa-info-circle"></i>                 
                                                            </div>
                                                            <div class="col-10">
                                                                @if($list->Kaizen_status == 'Waiting')
                                                                    <p>{{ $list->Kaizen_status }} <i class="fas fa-exclamation-circle text-warning"></i></p>
                                                                @else
                                                                    <p>{{ $list->Kaizen_status }} <i class="fas fa-check-circle text-success"></i></p>
                                                                @endif
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-2 align-self-center">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#allkz{{$list->Kaizen_ID}}">Details</button>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="modal fade" id="allkz{{ $list->Kaizen_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">{{ $list->Kaizen_title }}</h5>
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
                                                                {{ $list->Kaizen_type }}
                                                            </div>
                                                        </div>
                                                        <div class="row  p-2 rounded">
                                                            <div class="col-3">
                                                                Status
                                                            </div>    
                                                            <div class="col">
                                                                {{ $list->Kaizen_status }}
                                                            </div>
                                                        </div>
                                                        <div class="row  p-2 rounded">
                                                            <div class="col-3">
                                                                Date
                                                            </div>    
                                                            <div class="col">
                                                                @foreach($datelist as $dates)
                                                                    @if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                                        {{ date("d M Y", strtotime($dates->Kaizen_DateFrom)) }}  -  {{ date("d M Y", strtotime($dates->Kaizen_DateTo)) }}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Department
                                                            </div>    
                                                            <div class="col">
                                                                {{ $list->Kaizen_dept }}
                                                            </div>
                                                        </div>
                                                        <div class="row p-2  rounded">
                                                            <div class="col-3">
                                                                Member
                                                            </div>
                                                            <div class="col">
                                                            @foreach($memberlist as $mem)
                                                                @if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                                    <li>{{ $mem->Fullname }} ({{ $mem->member_roles }})</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Scope
                                                            </div>
                                                            <div class="col">
                                                            @foreach($scopelist as $scope)
                                                                    @if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                                    
                                                                        <li>{{ $scope->scope }}</li>
                                                                    
                                                                    @endif
                                                                @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2  rounded">
                                                            <div class="col-3">
                                                                Background
                                                            </div>
                                                            <div class="col">
                                                            @foreach($backlist as $back)
                                                                @if($list->Kaizen_ID == $back->Kaizen_ID)
                                                                    <li>{{ $back->background }}</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Baseline
                                                            </div>
                                                            <div class="col">
                                                            @foreach($baselist as $base)
                                                                @if($list->Kaizen_ID == $base->Kaizen_ID)
                                                                    <li>{{ $base->baseline }}</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2  rounded">
                                                            <div class="col-3">
                                                                Goals
                                                            </div>
                                                            <div class="col">
                                                            @foreach($goalslist as $goal)
                                                                @if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                                    <li>{{ $goal->goals }}</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Deliverable
                                                            </div>
                                                            <div class="col">
                                                                @if(count($delivlist) > 0)      
                                                                    @foreach($delivlist as $deliv)
                                                                        @if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                                            <li>{{ $deliv->deliverable }}</li>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <p>-</p>
                                                                @endif
                                                            </div> 
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        @if(Session::has('login'))
                                                            @if($acc->kpkNum == '393560')
                                                                <a href="/kaizen-form/update-kaizen/{{ $list->Kaizen_ID }}" class="btn btn-danger">UPDATE</a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <!-- Modal All Kaizen-->
                                    

                                </div>
                                
                                <!-- tab my kaizen -->
                                @if(Session::has('login'))
                                <div class="tab-pane fade" id="nav-mykz" role="tabpanel" aria-labelledby="nav-mykz-tab">
                                    <div class="pt-2 pb-2">Search result(s) for my Kaizen</div>

                                    <div class="list-group vertical-scrollable">
                                        @foreach($myKaizen_list as $list)
                                            <a class="list-group-item">
                                                <div class="row">
                                                    <div class="col-5 align-self-center">
                                                        <div class="row align-self-start"><h5 class="text-uppercase text-danger">{{ $list->Kaizen_title }}</h5></div>
                                                        <div class="row align-self-end">Kaizen Type : {{ $list->Kaizen_type }}</div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-10 align-self-center">
                                                                
                                                                <div class="row mb-2">
                                                                    <div class="col-2">
                                                                        <i class="fas fa-map-pin"></i>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $list->Kaizen_dept }}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                    <div class="col">
                                                                        @foreach($memberlist as $members)
                                                                            @if($list->Kaizen_ID == $members->Kaizen_ID)
                                                                                @if($members->member_roles == 'Leader')
                                                                                    {{$members->Fullname}}
                                                                                @endif
                                                                            @endif
                                                                        @endforeach 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2 align-self-center">
                                                        <div class="row mb-2">
                                                            <div class="col-2">
                                                                <i class="far fa-calendar-alt"></i>
                                                            </div>
                                                            <div class="col-8">
                                                                @foreach($datelist as $date)
                                                                    @if($list->Kaizen_ID == $date->Kaizen_ID)
                                                                        @php
                                                                            $fdate = $date->Kaizen_DateFrom;
                                                                            $tdate = $date->Kaizen_DateTo;

                                                                            $datetime1 = new DateTime($fdate);
                                                                            $datetime2 = new DateTime($tdate);
                                                                            $interval = $datetime1->diff($datetime2);
                                                                            $days = $interval->format('%a');
                                                                        @endphp
                                                                        {{$days+1}}
                                                                    @endif
                                                                @endforeach
                                                                Day(s)
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-2">
                                                                <i class="fas fa-info-circle"></i>
                                                            </div>
                                                            <div class="col-10">
                                                                @if($list->Kaizen_status == 'Waiting')
                                                                    <p>{{ $list->Kaizen_status }} <i class="fas fa-exclamation-circle text-warning"></i></p>
                                                                @else
                                                                    <p>{{ $list->Kaizen_status }} <i class="fas fa-check-circle text-success"></i></p>
                                                                @endif
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-2 align-self-center">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#mykz{{ $list->Kaizen_ID }}">Details</button>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="modal fade" id="mykz{{ $list->Kaizen_ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="text font-weight-bold text-light text-uppercase" id="exampleModalLongTitle">{{ $list->Kaizen_title }}</h5>
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
                                                                {{ $list->Kaizen_type }}
                                                            </div>
                                                        </div>
                                                        <div class="row p-2 rounded">
                                                            <div class="col-3">
                                                                Status
                                                            </div>    
                                                            <div class="col">
                                                                {{ $list->Kaizen_status }}
                                                            </div>
                                                        </div>
                                                        <div class="row  p-2 rounded">
                                                            <div class="col-3">
                                                                Date
                                                            </div>    
                                                            <div class="col">
                                                                @foreach($datelist as $dates)
                                                                    @if($list->Kaizen_ID == $dates->Kaizen_ID)
                                                                        {{ date("d M Y", strtotime($dates->Kaizen_DateFrom)) }}  -  {{ date("d M Y", strtotime($dates->Kaizen_DateTo)) }}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Department
                                                            </div>    
                                                            <div class="col">
                                                                {{ $list->Kaizen_dept }}
                                                            </div>
                                                        </div>
                                                        <div class="row p-2 rounded">
                                                            <div class="col-3">
                                                                Member
                                                            </div>
                                                            <div class="col">
                                                            @foreach($memberlist as $mem)
                                                                @if($list->Kaizen_ID == $mem->Kaizen_ID)
                                                                    <li>{{ $mem->Fullname }} ({{ $mem->member_roles }})</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Scope
                                                            </div>
                                                            <div class="col">
                                                            @foreach($scopelist as $scope)
                                                                    @if($list->Kaizen_ID == $scope->Kaizen_ID)
                                                                    
                                                                        <li>{{ $scope->scope }}</li>
                                                                    
                                                                    @endif
                                                                @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2 rounded">
                                                            <div class="col-3">
                                                                Background
                                                            </div>
                                                            <div class="col">
                                                            @foreach($backlist as $back)
                                                                @if($list->Kaizen_ID == $back->Kaizen_ID)
                                                                    <li>{{ $back->background }}</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Baseline
                                                            </div>
                                                            <div class="col">
                                                            @foreach($baselist as $base)
                                                                @if($list->Kaizen_ID == $base->Kaizen_ID)
                                                                    <li>{{ $base->baseline }}</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2 rounded">
                                                            <div class="col-3">
                                                                Goals
                                                            </div>
                                                            <div class="col">
                                                            @foreach($goalslist as $goal)
                                                                @if($list->Kaizen_ID == $goal->Kaizen_ID)
                                                                    <li>{{ $goal->goals }}</li>
                                                                @endif
                                                            @endforeach
                                                            </div> 
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col-3">
                                                                Deliverable
                                                            </div>
                                                            <div class="col">
                                                                @if(count($delivlist) > 0)      
                                                                    @foreach($delivlist as $deliv)
                                                                        @if($list->Kaizen_ID == $deliv->Kaizen_ID)
                                                                            <li>{{ $deliv->deliverable }}</li>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <p>-</p>
                                                                @endif
                                                            </div> 
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <a href="/kaizen-form/update-kaizen/{{ $list->Kaizen_ID }}" class="btn btn-danger">UPDATE</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @endforeach
                                    </div>

                                    <!-- Modal My Kaizen-->
                                    <div class="modal fade" id="mykzModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Kaizen Title</h3>
                                                    <h5>Kaizen Type</h5>
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, a, doloribus quidem sunt distinctio ad magni quia nostrum facere temporibus suscipit accusantium expedita, tenetur sed aliquid at eos eius quae.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--end of search result -->

                    </div>
                </div>
            </form>  
        </div>
        <!-- /.container-fluid -->
    
@endsection