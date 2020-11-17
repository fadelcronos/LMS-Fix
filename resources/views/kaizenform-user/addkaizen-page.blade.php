@extends('layout/main-kaizenForm')



@section('title', 'Add Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', 'active')
@section('listKaizen', '')
@section('updateKaizen', '')
@section('dashboard', '')

@section('container')

@if(Session::has('showModal'))
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(Session('alert'))
          <div class="alert alert-danger">
            <div>{{Session('alert')}}</div>
          </div>
        @endif
        @if(Session('alert-success'))
          <div class="alert alert-success">
            <div>{{Session('alert-success')}}</div>
          </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-customyel" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endif

<!-- Main Content -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <form class="user" method="post" action="{{ url('/kaizen-form/add-kaizen') }}">
            @csrf
              <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                  <p class="text text-light bg-red rounded" id="kzid">KZ ID: </p>
                  <input type="text" name="kzid" id="kzidi" hidden value="">
                </div>
              </div>
              
              <div class="form-group row justify-content-center ">
                <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-3">
                  <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold">Kaizen Type</label>
                  <select class="form-control" id="exampleSelect1" name="kztypes" required>
                      <option value="" selected disabled hidden>Kaizen Type</option>
                      <option value="BPK">BPK</option>
                      <option value="SFK">SFK</option>
                      <option value="DK">DK</option>
                      <option value="555">555</option>
                  </select>
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-3">
                  <label for="exampleInputEmail" class="bmd-label-floating blk text-uppercase font-weight-bold">Title</label>
                  <input required type="text" class="form-control form-control-user" id="exampleInputEmail" name="kztitle" placeholder="Title here...">
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-3">
                  <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold">Department</label>
                  <select class="form-control" name="kzdept" id="kzdept" required>
                      <option value="" selected disabled hidden>Select Department</option>
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
              </div>

              <div class="form-group row justify-content-center d-flex">
                <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-2">
                <label for="myTab" class="bmd-label-floating blk text-uppercase font-weight-bold">Members</label>
                  <div class="row justify-content-center mb-3 mt-1">
                    <div class="col-9 text-center">
                      <select class="form-control" id="nameEmp" name="kztype">
                          <option value="" selected disabled hidden></option>
                          @foreach($employee as $emp)
                            <option id="test1">{{ $emp->Fullname }}- {{ $emp->KPK }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="col-3 text-center">
                      <button onclick="addRow()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>

                  <div class="row">
                    <table class="table text-center" id="myTab">
                      <thead class="text-center blk">
                          <th>Role</th>
                          <th>KPK</th>
                          <th>Name</th>
                      </thead>
                      <tbody id="myRows" class="text-white">
                        <tr>
                            <td>
                              <select class="form-control" name="role1" id="role1" style="width:auto">
                                <option value="Sponsor">Sponsor</option>
                                <option value="Facilitator">Facilitator</option>
                                <option value="Leader">Leader</option>
                              </select>
                            </td>
                            <td><input readonly name="kpk1" scope="col" type="text" class="form-control" value="{{ $acc->kpkNum }}"></td>
                            <td><input readonly name="name1" scope="col" type="text" class="form-control"  value="{{ $acc->Fullname }}"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                      
                  
                      <input type="text" id="totRow" name="totRow" hidden value="1">
                </div>
              </div>
              

              <div class="form-group row justify-content-center">
                <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-2">
                  <label for="date" class="bmd-label-floating blk text-uppercase font-weight-bold">Dates</label>
                  <div id="date" class="row justify-content-center">
                    <div class="col-md-4" id="dates">
                      <label for="dat" class="bmd-label-floating blk">From</label>
                      <input class="form-control" type="date" name="dateFrom" required>
                    </div>
                    <div class="col-md-4">
                      <label for="dat" class="bmd-label-floating blk">To</label>
                      <input class="form-control" type="date" name="dateTo" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-group row justify-content-center">
                <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-2">
                  <label for="exampleTextarea" class="bmd-label-floating blk text-uppercase font-weight-bold">Details</label>
                  <div class="row justify-content-center">
                    <div class="col border-0 shadow-lg rounded pt-2 pb-2">
                      <label for="exampleTextarea" class="bmd-label-floating blk">Scope</label>
                      <table class="table" id="scopeTab">
                        <tbody id="scopeRow">
                          <tr class="text-dark">
                            <td class="text-center">
                              <p>Scope 1</p>
                            </td>
                            <td>
                              <textarea class="form-control" id="scope1" name="scope1" rows="1"></textarea>
                            </td>
                          </tr>
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
                    <div class="col border-0 shadow-lg rounded pt-2 pb-2">
                      <label for="exampleTextarea" class="bmd-label-floating blk">Background</label>
                      <table class="table" id="backTab">
                        <tbody id="backRow">
                          <tr class="text-dark">
                            <td class="text-center">
                              <p>Background 1</p>
                            </td>
                            <td>
                              <textarea class="form-control" id="back1" name="back1" rows="1"></textarea>
                            </td>
                          </tr>
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
                    <div class="col border-0 shadow-lg rounded pt-2 pb-2">
                      <label for="exampleTextarea" class="bmd-label-floating blk">Baseline</label>
                      <table class="table" id="baseTab">
                        <!-- <thead class="text-center blk">
                            <th>NO</th>
                            <th>KPI</th>
                            <th>Sub KPI</th>
                            <th>Value</th>
                            <th>UM</th>
                        </thead> -->
                        <tbody id="baseRow">
                          <tr class="text-dark">
                            <td class="text-center">
                             <p class="text">Baseline 1</p>
                            </td>
                            <td>
                              <textarea class="form-control" id="base1" name="base1" rows="1"></textarea>
                            </td>
                            <!-- <td>
                              <select name="kpi1" id="kpi1" onchange="changeInput()" class="form-control" style="width:120px">
                                <option value="Quality">Quality</option>
                                <option value="Cost">Cost</option>
                                <option value="Environment Health Safety">Environment Health Safety</option>
                                <option value="Delivery">Delivery</option>
                                <option value="Moral">Moral</option>
                                <option value="Product">Product</option>
                                <option value="Others">Others</option>
                              </select>
                            </td>
                            <td id="sub1">
                              <input type="text" class="form-control" name="sub1" >
                            </td>
                            <td>
                              <input type="text" class="form-control" name="valueB1">
                            </td>
                            <td>
                              <input type="text" class="form-control" name="um1">
                            </td> -->
                          </tr>
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
                    <div class="col border-0 shadow-lg rounded pt-2 pb-2">
                      <label for="exampleTextarea" class="bmd-label-floating blk">Goals</label>
                      <table class="table" id="goalsTab">
                        <tbody id="goalsRow">
                          <tr class="text-dark">
                            <td class="text-center">
                              <p>Goals 1</p>
                            </td>
                            <td>
                              <textarea class="form-control" id="goals1" name="goals1" rows="1"></textarea>
                            </td>
                          </tr>
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
                    <div class="col border-0 shadow-lg rounded pt-2 pb-2">
                      <label for="exampleTextarea" class="bmd-label-floating blk">Deliverables</label>
                      <table class="table" id="delivTab">
                        <tbody id="delivRow">
                          <tr class="text-dark">
                            <td class="text-center">
                              <p>Deliverables 1</p>
                            </td>
                            <td>
                              <textarea class="form-control" id="deliv1" name="deliv1" rows="1"></textarea>
                            </td>
                          </tr>
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

              <div class="row justify-content-center">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-customyel btn-user btn-block text-uppercase">
                      Submit
                  </button>
                </div>
              </div>
          </form>
                    

                
        </div>
        <!-- /.container-fluid -->

  
    
@endsection