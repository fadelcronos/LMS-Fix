@extends('layout/main-kaizenForm-detail')


@section('title', 'Update Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', 'active')
@section('updateKaizen', '')
@section('dashboard', '')

@section('container')

<div class="container" >

          <form class="user" method="post" action="{{ url('/kaizen-form/update-kaizen') }}">
            @csrf
            
              <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                  <p class="text text-light bg-red rounded" id="">KZ ID: {{ $main->Kaizen_ID }}</p>
                  <input type="text" name="kzid" id="kzidi" hidden value="{{ $main->Kaizen_ID }}">
                  <input type="text" name="kzstatus" id="kzidi" hidden value="{{ $main->Kaizen_status }}">
                  <input type="text" name="kzmade" id="kzidi" hidden value="{{ $main->Kaizen_madeby }}">
                </div>
              </div>

              <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active text-dark" id="nav-main-tab" data-toggle="tab" href="#nav-main" role="tab" aria-controls="nav-main" aria-selected="true">Main</a>
                      <a class="nav-item nav-link text-dark" id="nav-member-tab" data-toggle="tab" href="#nav-member" role="tab" aria-controls="nav-member" aria-selected="false">Members</a>
                      <a class="nav-item nav-link text-dark" id="nav-detail-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Details</a>
                      <a class="nav-item nav-link text-dark" id="nav-action-tab" data-toggle="tab" href="#nav-action" role="tab" aria-controls="nav-action" aria-selected="false">Finding</a>
                  </div>
              </nav>

              <div class="border-0 shadow-lg rounded pl-3 pt-3 pb-3 pr-3">
                <div class="tab-content pt-3" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
                    <div class="list-group vertical-scrollable">
                      <div class="form-group row justify-content-center">
                        <div class="col-md-8 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Title</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kztitle" value="{{ $main->Kaizen_title }}">
                        </div>
                        <div class="col-md-3 border-0 rounded pt-2 pb-2">
                          <label for="exampleSelect1" class="bmd-label-floating blk  font-weight-bold">Kaizen Type</label>
                          <select class="form-control" id="exampleSelect1" name="kztypes" required>
                          <option value="{{ $main->Kaizen_type }}" selected hidden>{{$main->Kaizen_type}}</option>
                              <option value="BPK">BPK</option>
                              <option value="SFK">SFK</option>
                              <option value="DK">DK</option>
                              <option value="555">555</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row justify-content-center ">
                        <div class="col-md-6 border-0 rounded pt-2 pb-2">
                          <label for="exampleSelect1" class="bmd-label-floating blk  font-weight-bold">Department</label>
                          <select class="form-control" name="kzdept" id="kzdept" required>
                              <option value="{{ $main->Kaizen_dept }}" selected hidden>{{ $main->Kaizen_dept }}</option>
                              <option value="EHS">EHS</option>
                              <option value="Engineering">Engineering</option>
                              <option value="Finance & IT">Finance & IT</option>
                              <option value="Human Resources">Human Resources</option>
                              <option value="Manufacturing East">Manufacturing East</option>
                              <option value="Manufacturing West">Manufacturing West</option>
                              <option value="Quality">Quality</option>
                              <option value="Product Development">Product Development</option>
                              <option value="Materials">Materials</option>
                          </select>
                        </div>
                        <div class="col-md-5 border-0 rounded pt-2 pb-2">
                          <div id="date" class="row justify-content-center">
                            <div class="col-md-" id="dates">
                              <label for="dat" class="bmd-label-floating blk  font-weight-bold"> Date From</label>
                              <input class="form-control" type="date" name="dateFrom" value="{{ $dates->Kaizen_DateFrom }}" required>
                            </div>
                            <div class="col-md-6 pt-md-0 pt-2">
                              <label for="dat" class="bmd-label-floating blk  font-weight-bold">Date To</label>
                              <input class="form-control" type="date" name="dateTo" value="{{ $dates->Kaizen_DateTo }}" required>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row justify-content-center mt-5">
                        <button type="button" id="nextMems" class="btn btn-danger justify-content-center">Next <i class="fas fa-chevron-circle-right"></i></button>
                      </div>
                      
                    </div>
                  </div>
                  <div class="tab-pane fade show" id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
                    <div class="list-group vertical-scrollable">
                      <div class="form-group row justify-content-center d-flex">
                        <div class="col-md-10 border-0 rounded pt-2 pb-2">
                          <label for="myTab" class="bmd-label-floating blk  font-weight-bold">Members</label>
                          <div class="row justify-content-center">
                            <div class="col-10 text-center">
                              <select class="" style="width: 100%;" id="nameEmp" name="">
                                  <option value="" selected disabled hidden></option>
                                  @foreach($employee as $emp)
                                    <option id="test2">{{ $emp->Fullname }}- {{ $emp->KPK }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="col-2 text-center">
                              <button onclick="addRow()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                            </div>
                          </div>

                          <div class="row">
                            <table class="table text-center" id="myTab">
                              <thead class="text-center blk">
                                  <th>KPK</th>
                                  <th>Name</th>
                                  <th>Role</th>
                              </thead>
                              <tbody id="myRows" class="text-white">
                                @foreach($member as $mems)
                                  <tr>
                                      <td><input readonly name="kpk[]" scope="col" type="text" class="form-control" value="{{ $mems->kpkNum }}"></td>
                                      <td><input readonly name="name[]" scope="col" type="text" class="form-control"  value="{{ $mems->Fullname }}"></td>
                                      <td>
                                        <select class="form-control" name="role[]" id="role1" style="width:auto" required>
                                          <option value="{{$mems->member_roles}}" selected hidden>{{$mems->member_roles}}</option>
                                          <option value="Sponsor">Sponsor</option>
                                          <option value="Facilitator">Facilitator</option>
                                          <option value="Leader">Leader</option>
                                          <option value="Leader">Co-Leader</option>
                                          <option value="Leader">Participant</option>
                                        </select>
                                      </td>
                                      <td><button type='button' onclick='delRow(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                                  </tr>
                                  
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <div class="form-group row justify-content-center mt-5">
                            <button type="button" id="befMain" class="btn btn-danger justify-content-center mr-2"><i class="fas fa-chevron-circle-left"></i> Back</button>
                            <button type="button" id="nextDet" class="btn btn-danger justify-content-center">Next <i class="fas fa-chevron-circle-right"></i></button>
                          </div>
                            <input type="text" id="totRow" name="totRow" hidden value="1">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade show" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                    <div class="list-group vertical-scrollable">
                    <div class="form-group row justify-content-center">
                      <div class="col-md-10 border-0  rounded pt-2 pb-2">
                        <div class="row justify-content-center">
                          <div class="col border-0 rounded pt-2 pb-2">
                            <label for="exampleTextarea" class="bmd-label-floating blk  font-weight-bold">Scope</label>
                            <table class="table" id="scopeTab">
                              <tbody id="scopeRow">
                                @foreach($scopes as $scp)
                                  <tr class="text-dark">
                                    <td class="text-center">
                                    <ul><li></li></ul>
                                    </td>
                                    <td>
                                      <textarea class="form-control" id="scope1" name="scope[]" rows="1">{{ $scp->scope }}</textarea>
                                    </td>
                                    <td><button type='button' onclick='delScope(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col text-center">
                                  <input type="text" id="totRowScope" name="totRowScope" hidden value="1">
                                <button onclick="addScope()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>              
                        <div class="row justify-content-center">
                          <div class="col border-0 rounded pt-2 pb-2">
                            <label for="exampleTextarea" class="bmd-label-floating blk  font-weight-bold">Background</label>
                            <table class="table" id="backTab">
                              <tbody id="backRow">
                                @foreach($backs as $back)
                                  <tr class="text-dark">
                                    <td class="text-center">
                                    <ul><li></li></ul>
                                    </td>
                                    <td>
                                      <textarea class="form-control" id="back1" name="back[]" rows="1">{{ $back->background }}</textarea>
                                    </td>
                                    <td><button type='button' onclick='delBack(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                              
                            </table>
                            <div class="row">
                              <div class="col text-center">
                                  <input type="text" id="totRowBack" name="totRowBack" hidden value="1">
                                <button onclick="addBack()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>              
                        <div class="row justify-content-center">
                          <div class="col border-0 rounded pt-2 pb-2">
                            <label for="exampleTextarea" class="bmd-label-floating blk  font-weight-bold">Baseline</label>
                            <table class="table" id="baseTab">
                              <tbody id="baseRow">
                                @foreach($bases as $base)
                                  <tr class="text-dark">
                                    <td class="text-center">
                                    <ul><li></li></ul>
                                    </td>
                                    <td>
                                      <textarea class="form-control" id="base1" name="base[]" rows="1">{{$base->baseline}}</textarea>
                                    </td>
                                    <td><button type='button' onclick='delBase(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <div class="row">
                              <div class="col text-center">
                                  <input type="text" id="totRowBase" name="totRowBase" hidden value="1">
                                <button onclick="addBase()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>              
                        <div class="row justify-content-center">
                          <div class="col border-0 rounded pt-2 pb-2">
                            <label for="exampleTextarea" class="bmd-label-floating blk  font-weight-bold">Goals</label>
                            <table class="table" id="goalsTab">
                              <tbody id="goalsRow">
                                @foreach($goals as $goal)
                                  <tr class="text-dark">
                                    <td class="text-center">
                                    <ul><li></li></ul>
                                    </td>
                                    <td>
                                      <textarea class="form-control" id="goals1" name="goals[]" rows="1">{{ $goal->goals }}</textarea>
                                    </td>
                                    <td><button type='button' onclick='delGoals(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                              
                            </table>
                            <div class="row">
                              <div class="col text-center">
                                  <input type="text" id="totRowGoals" name="totRowGoals" hidden value="1">
                                <button onclick="addGoals()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>              
                        <div class="row justify-content-center">
                          <div class="col border-0 rounded pt-2 pb-2">
                            <label for="exampleTextarea" class="bmd-label-floating blk  font-weight-bold">Deliverables</label>
                            <table class="table" id="delivTab">
                              <tbody id="delivRow">
                                @foreach($delivs as $deliv)
                                  <tr class="text-dark">
                                    <td class="text-center">
                                    <ul><li></li></ul>
                                    </td>
                                    <td>
                                      <textarea class="form-control" id="deliv1" name="deliv[]" rows="1">{{$deliv->deliverable}}</textarea>
                                    </td>
                                    <td><button type='button' onclick='delDeliv(this)'  class='btn btn-danger'><i class='fas fa-trash'></i></button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                              
                            </table>
                            <div class="row">
                              <div class="col text-center">
                                  <input type="text" id="totRowDeliv" name="totRowDeliv" hidden value="1">
                                <button onclick="addDeliv()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>              
                      </div>
                    </div>
                    <div class="form-group row justify-content-center mt-5">
                        <button type="button" id="befMem" class="btn btn-danger justify-content-center mr-2"><i class="fas fa-chevron-circle-left"></i> Back</button>
                      </div>                          
                    </div>
                  </div>
                  <div class="tab-pane fade show" id="nav-action" role="tabpanel" aria-labelledby="nav-action-tab">
                    <div class="list-group vertical-scrollable">
                      <!-- <div class="row">
                        <div class="col-md-2 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Issue</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kzissue" value="">
                        </div>
                        <div class="col-md-2 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Issue</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kzissue" value="">
                        </div>
                        <div class="col-md-2 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Issue</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kzissue" value="">
                        </div>
                        <div class="col-md-2 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Issue</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kzissue" value="">
                        </div>
                        <div class="col-md-2 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Issue</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kzissue" value="">
                        </div>
                        <div class="col-md-2 border-0 rounded pt-2 pb-2">
                          <label for="exampleInputEmail" class="bmd-label-floating blk  font-weight-bold">Issue</label>
                          <input required type="text" class="form-control form-control" id="exampleInputEmail" name="kzissue" value="">
                        </div>
                      </div> -->
                      <div class="form-group row justify-content-end mr-3">
                          <button onclick="getFindingID()" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" id="addIssueBtn" class="btn btn-danger justify-content-center">Add Issue</button>
                      </div>
                      <table class="table table-hover table-striped text-center">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Issue</th>
                            <th scope="col">Action</th>
                            <th scope="col">status</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($findings as $finding)
                          <tr>
                            <td scope="col">{{ $loop->iteration }}</td>
                            <td scope="col" hidden>{{ $finding->KPI }}</td>
                            <td scope="col">{{ $finding->Issue_desc }}</td>
                            <td scope="col">{{ $finding->Actions_desc }}</td>
                            <td scope="col" hidden>{{ $finding->Before_act }}</td>
                            <td scope="col" hidden>{{ $finding->After_act }}</td>
                            <td scope="col" hidden>{{ $finding->Unit_measure }}</td>
                            <td scope="col" hidden>{{ $finding->Goals_act }}</td>
                            <td scope="col" hidden>{{ $finding->Due_date }}</td>
                            <td scope="col">{{ $finding->Remarks }}</td>
                            <td scope="col" hidden>

                             <select class="hides" style="width: 100%;" id="rplusHidden" name="rplusHidden" multiple>
                                  @foreach($Rplus as $rp)
                                    @if($finding->Finding_ID == $rp->Finding_ID)
                                      <option selected value="{{ $rp->kpkNum }}" class="font2">{{ $rp->Fullname }}- {{ $rp->kpkNum }}</option>
                                    @endif
                                  @endforeach
                            </select>
                            </td>
                            <td scope="col">
                              <button title="Detail" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-detail-modal-lg{{$finding->Finding_ID}}"><i class="fas fa-eye"></i></button>
                              <button title="Edit" type="button" class="btn btn-success editBtn"><i class="fas fa-edit"></i></button>
                              <button title="Delete" type="button" class="btn btn-danger" data-toggle="modal" data-toggle="modal" data-target="#deleteFindingModal{{$finding->Finding_ID}}"><i class="fas fa-trash-alt"></i></button>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col d-flex justify-content-start">
                    <a href="{{ url('/kaizen-form/list-kaizen') }}" type="button" class="btn btn-secondary font2 text-light">
                      <i class="fas fa-angle-left"></i> Go Back
                    </a>
                  </div>
                  <div class="col d-flex justify-content-end">
                    @if($acc->kpkNum == '393560')
                      <button id="submitUpdate" type="submit" class="btn btn-primary font2 text-light">
                          Update <i class="fas fa-edit"></i>
                      </button>
                    @else
                      @if($rolesKaizen->member_roles == 'Leader' || $rolesKaizen->member_roles == 'Facilitator' || $rolesKaizen->member_roles == 'Sponsor')
                        <button id="submitUpdate" type="submit" class="btn btn-primary font2 text-light">
                          Update <i class="fas fa-edit"></i>
                        </button>
                      @else
                        <button class="btn btn-primary font2 text-light" disabled>
                          Update <i class="fas fa-edit"></i>
                        </button>
                      @endif
                      
                    @endif
                  </div>

                </div>
              </div>
             
              <input type="text" name="kzroom" id="kzidi" hidden value="{{ $main->Kaizen_room }}">
          </form>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title font2 font-weight-bold text-light" id="exampleModalCenterTitle">Finding Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="findingForm">
                    @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="issueDesc" class="font2 text-dark font-weight-bold">Issue</label>
                                        <textarea required class="form-control font2" id="issueDesc" rows="3" placeholder="Type issue here..." name="issueDesc"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="actionDesc" class="font2 text-dark font-weight-bold">Action</label>
                                        <textarea required class="form-control font2" id="actionDesc" rows="3" placeholder="Type action here..." name="actionDesc"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">KPI</label>
                                        <select class="form-control font2" name="selectKPI" id="selectKPI" required>
                                            <option value="" hidden>Select KPI</option>
                                            <option value="Quality">Quality</option>
                                            <option value="Cost">Cost</option>
                                            <option value="Safety">Safety</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Moral">Moral</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Before</label>
                                            <input required class="form-control font2" type="text" id="beforeAct" name="beforeAct" placeholder="Before value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">After</label>
                                            <input required class="form-control font2" type="text" id="afterAct" name="afterAct" placeholder="After value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Unit Measurement</label>
                                        <select class="form-control font2" id="selectUM" name="selectUM" required>
                                            <option value="" hidden>Select Unit Measurement</option>
                                            <option value="PPM">PPM</option>
                                            <option value="Cm">CM</option>
                                            <option value="Cm">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Goals</label>
                                            <input required class="form-control font2" id="goalsAct" name="goalsAct" type="text" placeholder="Goals value">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Due Date</label>
                                            <input required class="form-control font2" id="dueDate" name="dueDate" type="date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Remarks/Status</label>
                                        <select class="form-control font2" id="selectRemarks" name="selectRemarks" required>
                                            <option value="" hidden>Select Remarks</option>
                                            <option value="Not Started">Not Started</option>
                                            <option value="On-Going">On-Going</option>
                                            <option value="Done">Done</option>
                                            <option value="Canceled">Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">R+</label>
                                        <select class="js-example-placeholder-multiple js-states form-control" style="width: 100%;" id="nameRplus" name="rplusKpk[]" multiple required>
                                            <!-- <option value="" hidden>Select KPK</option> -->
                                            @foreach($employee as $emp)
                                              <option value="{{ $emp->KPK }}" class="font2">{{ $emp->Fullname }}- {{ $emp->KPK }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-1 mt-4">
                                      <button onclick="addRplus()" type="button" class="btn btn-danger font2"><i class="fas fa-plus"></i></button>
                                    </div> -->
                                    
                                </div>
                                <!-- <div class="row">
                                  <div class="col-md-7">
                                      <table class="table table-striped" id="rplusTab">
                                        <thead>
                                          <tr>
                                            <th scope="col">KPK</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Remove</th>
                                          </tr>
                                        </thead>
                                        <tbody id="rplusRow">
                                          
                                        </tbody>
                                      </table>
                                    </div>
                                </div> -->
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="cancelModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Add Finding</button>
                            <input id="findingID" name="findingID" hidden></input>
                            <input type="text" name="kzidRplus" hidden value="{{ $main->Kaizen_ID }}">

                        </div>
                    </form>
                </div>
              </div>
            </div>

            <!-- Detail Modal -->
            @foreach($findings as $finding)
              <div class="modal fade bd-detail-modal-lg{{$finding->Finding_ID}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h5 class="modal-title font2 font-weight-bold text-light" id="exampleModalCenterTitle">Finding Form</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="container-fluid">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                      <label for="issueDesc" class="font2 text-dark font-weight-bold">Issue</label>
                                      <textarea required class="form-control font2" id="issueDesc" rows="3" disabled name="issueDesc">{{$finding->Issue_desc}}</textarea>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                      <label for="actionDesc" class="font2 text-dark font-weight-bold">Action</label>
                                      <textarea required class="form-control font2" id="actionDesc" rows="3" disabled name="actionDesc">{{$finding->Actions_desc}}</textarea>
                                      </div>
                                  </div>
                                  
                              </div>
                              <div class="row">
                                  <div class="col-md-3">
                                      <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">KPI</label>
                                      <select class="form-control font2" name="selectKPI" id="selectKPI" required disabled>
                                          <option value="{{$finding->KPI}}" selected hidden>{{$finding->KPI}}</option>
                                          <option value="Quality">Quality</option>
                                          <option value="Cost">Cost</option>
                                          <option value="Safety">Safety</option>
                                          <option value="Delivery">Delivery</option>
                                          <option value="Moral">Moral</option>
                                      </select>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Before</label>
                                          <input disabled required class="form-control font2" type="text" id="beforeAct" name="beforeAct" value="{{$finding->Before_act}}" placeholder="Before value">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">After</label>
                                          <input required class="form-control font2" type="text" id="afterAct" name="afterAct" placeholder="After value" value="{{$finding->After_act}}" disabled>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Unit Measurement</label>
                                      <select class="form-control font2" id="selectUM" name="selectUM" required disabled>
                                          <option value="{{$finding->Unit_measure}}" hidden>{{$finding->Unit_measure}}</option>
                                          <option value="PPM">PPM</option>
                                          <option value="Cm">Cm</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Goals</label>
                                          <input required class="form-control font2" id="goalsAct" name="goalsAct" type="text" placeholder="Goals value" disabled value="{{$finding->Goals_act}}">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Due Date</label>
                                          <input required class="form-control font2" id="dueDate" name="dueDate" type="date" disabled value="{{$finding->Due_date}}">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Remarks/Status</label>
                                      <select class="form-control font2" id="selectRemarks" name="selectRemarks" required disabled>
                                          <option value="{{$finding->Remarks}}" hidden>{{$finding->Remarks}}</option>
                                          <option value="On-Going">On-Going</option>
                                          <option value="Done">Done</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">R+</label>
                                      @foreach($Rplus as $rp)
                                        @if($finding->Finding_ID == $rp->Finding_ID)
                                      <div class="font2 text-dark">{{$rp->Fullname}} - {{$rp->kpkNum}}</div>
                                        @endif
                                      @endforeach
                                  </div>
                                  
                                  
                              </div>
                            
                              
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button id="cancelModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                  </div>
                </div>
              </div>
            @endforeach

            <!-- Edit Modal -->
            <form method="get">
              @csrf
              @foreach($findings as $finding)
                <div class="modal fade bd-edit-modal-lg{{$finding->Finding_ID}}" id="editFindings" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title font2 font-weight-bold text-light" id="exampleModalCenterTitle">Update Finding</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="issueDesc" class="font2 text-dark font-weight-bold">Issue</label>
                                        <textarea required class="form-control font2" id="issueDesc" rows="3"  name="issueDesc">{{$finding->Issue_desc}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="actionDesc" class="font2 text-dark font-weight-bold">Action</label>
                                        <textarea required class="form-control font2" id="actionDesc" rows="3"  name="actionDesc">{{$finding->Actions_desc}}</textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">KPI</label>
                                        <select class="form-control font2" name="selectKPI" id="selectKPI" required >
                                            <option value="" selected hidden></option>
                                            <option value="Quality">Quality</option>
                                            <option value="Cost">Cost</option>
                                            <option value="Safety">Safety</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Moral">Moral</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Before</label>
                                            <input  required class="form-control font2" type="text" id="beforeAct" name="beforeAct" value="" placeholder="Before value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">After</label>
                                            <input required class="form-control font2" type="text" id="afterAct" name="afterAct" placeholder="After value" value="" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Unit Measurement</label>
                                        <select class="form-control font2" id="selectUM" name="selectUM" required >
                                            <option value="" hidden></option>
                                            <option value="PPM">PPM</option>
                                            <option value="Cm">Cm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Goals</label>
                                            <input required class="form-control font2" id="goalsAct" name="goalsAct" type="text" placeholder="Goals value"  value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Due Date</label>
                                            <input required class="form-control font2" id="dueDate" name="dueDate" type="date"  value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Remarks/Status</label>
                                        <select class="form-control font2" id="selectRemarks" name="selectRemarks" required >
                                            <option value="" hidden></option>
                                            <option value="On-Going">On-Going</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-6">
                                          <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">R+</label>
                                          <select class="js-example-placeholder-multiple" style="width: 100%;" id="nameRplus" name="updateRplus[]" multiple>
                                                @foreach($Rplus as $rp)
                                                  @if($finding->Finding_ID == $rp->Finding_ID)
                                                    <option selected value="{{ $rp->KPK }}" class="font2">{{ $rp->Fullname }}- {{ $rp->kpkNum }}</option>
                                                  @endif
                                                @endforeach
  
                                              @foreach($employee as $emp)
                                                <option value="{{ $emp->KPK }}" class="font2">{{ $emp->Fullname }}- {{ $emp->KPK }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <a href="/kaizen-form/edit-finding/{{ $finding->Finding_ID }}" class="btn btn-primary">Update</a>
                          <button id="cancelModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </form> 

            <!-- Delete Modal -->
            @foreach($findings as $finding)
              <div class="modal fade" id="deleteFindingModal{{$finding->Finding_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title font2 text-light" id="exampleModalCenterTitle">Delete Finding ?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="font2">Are you sure want to delete this finding ?</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <a href="/kaizen-form/delete-finding/{{$finding->Finding_ID}}" class="btn btn-danger">Yes</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

            <div class="modal fade bd-edit-modal-lg" id="editFindingss" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title font2 font-weight-bold text-light" id="exampleModalCenterTitle">Update Finding</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="issueDesc" class="font2 text-dark font-weight-bold">Issue</label>
                                        <textarea required class="form-control font2" id="issueDescUpdate" rows="3"  name="issueDesc" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="actionDesc" class="font2 text-dark font-weight-bold">Action</label>
                                        <textarea required class="form-control font2" id="actionDescUpdate" rows="3"  name="actionDesc"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">KPI</label>
                                        <select class="form-control font2" name="selectKPI" id="selectKPIUpdate" required >
                                            <option value="" selected hidden></option>
                                            <option value="Quality">Quality</option>
                                            <option value="Cost">Cost</option>
                                            <option value="Safety">Safety</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Moral">Moral</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Before</label>
                                            <input  required class="form-control font2" type="text" id="beforeActUpdate" name="beforeAct" value="" placeholder="Before value">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">After</label>
                                            <input required class="form-control font2" type="text" id="afterActUpdate" name="afterAct" placeholder="After value" value="" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Unit Measurement</label>
                                        <select class="form-control font2" id="selectUMUpdate" name="selectUM" required >
                                            <option value="" hidden></option>
                                            <option value="PPM">PPM</option>
                                            <option value="Cm">Cm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Goals</label>
                                            <input required class="form-control font2" id="goalsActUpdate" name="goalsAct" type="text" placeholder="Goals value"  value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Due Date</label>
                                            <input required class="form-control font2" id="dueDateUpdate" name="dueDate" type="date"  value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">Remarks/Status</label>
                                        <select class="form-control font2" id="selectRemarksUpdate" name="selectRemarks" required >
                                            <option value="" hidden></option>
                                            <option value="On-Going">On-Going</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                      <div class="col-md-6">
                                          <label for="exampleFormControlTextarea1" class="font2 text-dark font-weight-bold">R+</label>
                                          <select class="js-example-placeholder-multiple empRplus" style="width: 100%;" id="nameRplusUpdate" name="updateRplus[]" multiple>
                                              @foreach($employee as $emp)
                                                <option value="{{ $emp->KPK }}" class="font2">{{ $emp->Fullname }}- {{ $emp->KPK }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <a href="/kaizen-form/edit-finding/" class="btn btn-primary">Update</a>
                          <button id="cancelModal" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                  </div>
                </div>
            

          </div>

          

          <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
       
        <script>
              function getFindingID() {
              var date = new Date();
              var str = date.getFullYear() + "" + (date.getMonth() + 1) + "" + date.getDate() + "" +  date.getHours() + "" + date.getMinutes() + "" + date.getSeconds();
              var findId = "FID"+str;
              var a = document.getElementById("findingID").value = findId;
              console.log(findId);
            }
            

            $(document).ready(function(){
              $('#findingForm').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                  url:"{{ route('addFinding') }}",
                  method: "POST",
                  data: $('#findingForm').serialize(),
                  success:function(res){
                    console.log(res);
                    alert("Finding Saved");
                    // $('#submitUpdate').click;
                    location.reload();
                  },
                  error: function(err){
                    console.log(err);
                    alert("Data Not Saved");
                  }

                })
              })
            })


        </script>
         
        <script type="text/javascript">
          $(document).ready(function() {
            $('.editBtn').on('click', function(){
              $('#editFindingss').modal('show');
              var selectedEmp = [];
             
              $tr = $(this).closest('tr');
              $td = $(this).closest('td');
              var data = $tr.children('td').map(function() {
                return $(this).text();
              }).get();

              // $.each($(".hides option:selected"), function(){            
              //     selectedEmp.push($(this).text());
              // });

              // var emp = $td.children('.hides option:selected').map(function() {
              //   return $(this).text();
              // }).get();

              // console.log(emp);
              selectedEmp.push(data[10]);
              $('#issueDescUpdate').val(data[2]);
              $('#actionDescUpdate').val(data[3]);
              $('#selectKPIUpdate').val(data[1]);
              $('#beforeActUpdate').val(data[4]);
              $('#afterActUpdate').val(data[5]);
              $('#selectUMUpdate').val(data[6]);
              $('#goalsActUpdate').val(data[7]);
              $('#dueDateUpdate').val(data[8]);
              $('#selectRemarksUpdate').val(data[9]);
              $('#nameRplusUpdate option:selected').val("a");
              console.log(selectedEmp);
              
            })
          })
        </script>
        

@endsection