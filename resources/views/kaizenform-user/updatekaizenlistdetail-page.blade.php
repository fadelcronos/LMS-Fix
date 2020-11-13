@extends('layout/main-kaizenForm-detail')


@section('title', 'Update Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', '')
@section('updateKaizen', 'active')
@section('dashboard', '')

@section('container')

<div class="container">

          <form class="user" method="post" action="{{ url('/kaizen-form/add-kaizen') }}">
            @csrf
            
              <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                  <p class="text text-light bg-red rounded" id="">KZ ID: {{ $main->Kaizen_ID }}</p>
                  <input type="text" name="kzid" id="kzidi" hidden value="">
                </div>
              </div>

              <nav>
                <div class="nav nav-tabs nav-justified mb-3" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kaizen</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Action Plan</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="form-group row justify-content-center ">
                    <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-3">
                      <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold">Kaizen Type</label>
                      <select class="form-control" id="exampleSelect1" name="kztypes" required>
                          <option value="{{ $main->Kaizen_type }}" selected disabled hidden>{{$main->Kaizen_type}}</option>
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
                      <input required type="text" class="form-control form-control-user" id="exampleInputEmail" name="kztitle" value="{{ $main->Kaizen_title }}">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-3">
                      <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold">Department</label>
                      <select class="form-control" name="kzdept" id="kzdept" required>
                          <option value="{{ $main->Kaizen_dept }}" selected disabled hidden>{{ $main->Kaizen_dept }}</option>
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
                          @foreach($member as $mems)
                            <tr>
                                <td>
                                  <select class="form-control" name="role1" id="role1" style="width:auto">
                                    <option value="{{$mems->roles}}" selected disabled hidden>{{$mems->member_roles}}</option>
                                    <option value="Sponsor">Sponsor</option>
                                    <option value="Facilitator">Facilitator</option>
                                    <option value="Leader">Leader</option>
                                  </select>
                                </td>
                                <td><input readonly name="kpk1" scope="col" type="text" class="form-control" value="{{ $mems->kpkNum }}"></td>
                                <td><input readonly name="name1" scope="col" type="text" class="form-control"  value="{{ $mems->Fullname }}"></td>
                            </tr>
                            @endforeach
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
                            <tbody id="baseRow">
                              <tr class="text-dark">
                                <td class="text-center">
                                <p class="text">Baseline 1</p>
                                </td>
                                <td>
                                  <textarea class="form-control" id="base1" name="base1" rows="1"></textarea>
                                </td>
                                
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
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
              </div>
          </form>
                    

                
        </div>

@endsection