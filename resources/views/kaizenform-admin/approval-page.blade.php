@extends('layout/main-kaizenForm-detail')


@section('title', 'Approval Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', '')
@section('updateKaizen', 'active')
@section('dashboard', '')

@section('container')

<div class="container-fluid" >

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

              <!-- <nav>
                <div class="nav nav-tabs nav-justified mb-3" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kaizen Approval Send Mail</a>
                </div>
              </nav> -->
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  @if($acc->kpkNum == '393560')
                    <div class="form-group row justify-content-center ">
                      <div class="col-md-3 border-0 rounded pt-2 pb-3">
                        <label for="exampleSelect1" class="bmd-label-floating blk text-uppercase font-weight-bold">Room</label>
                        <select class="form-control" id="exampleSelect1" name="kzroom" required>
                          @if($main->Kaizen_room == "")
                            <option value="" selected hidden>Select Room</option>
                          @else
                            <option value="{{ $main->Kaizen_room }}" selected hidden>{{$main->Kaizen_room}}</option>
                          @endif

                            <option value="" disabled>--- EAST ---</option>
                            <option value="Banda Aceh">Banda Aceh</option>
                            <option value="Banda Naira">Banda Naira</option>
                            <option value="Batik 1">Batik 1</option>
                            <option value="Batik 2">Batik 2</option>
                            <option value="Batik 3">Batik 3</option>
                            <option value="Kresna Dewa">Kresna Dewa</option>
                            <option value="Kolaka">Kolaka</option>
                            <option value="Jogjakarta">Jogjakarta</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Toraja">Toraja</option>
                            <option value="Other">Other</option>
                            <option value="" Disabled>--- WEST ---</option>
                            <option value="Executive">Executive</option>
                            <option value="Kalianda">Kalianda</option>
                            <option value="Jepara">Jepara</option>
                            <option value="Other">Other</option>
                        </select>
                      </div>
                      <div class="col-md-6 border-0 rounded pt-2 pb-2">
                        <div id="date" class="row justify-content-center">
                          <div class="col-md-5" id="dates">
                            <label for="dat" class="bmd-label-floating blk text-uppercase font-weight-bold">date From</label>
                            <input class="form-control" type="date" name="dateFrom" value="{{ $dates->Kaizen_DateFrom }}" required>
                          </div>
                          <div class="col-md-5">
                            <label for="dat" class="bmd-label-floating blk text-uppercase font-weight-bold">date To</label>
                            <input class="form-control" type="date" name="dateTo" value="{{ $dates->Kaizen_DateTo }}" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  @else
                    <input type="text" name="kzroom" id="kzidi" hidden value="{{ $main->Kaizen_room }}">
                  @endif
                  <input type="text" name="kzroom" id="kzidi" hidden value="{{ $main->Kaizen_room }}">


                  

                  <div class="form-group row justify-content-center d-flex">
                    <div class="col-md-10 border-0 shadow-lg rounded pt-2 pb-2">
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
                          <button id="btnAdd" type="button" onclick="addMemss()" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                        </div>
                      </div>

                      <div class="row">
                        <table class="table text-center" id="myTab">
                          <thead class="text-center blk">
                              <th>Role</th>
                              <th>KPK</th>
                              <th>Name</th>
                              <th>Email</th>
                          </thead>
                          <tbody id="myRows" class="text-white">
                          @foreach($member as $mems)
                            <tr>
                                <td><input readonly name="role[]" scope="col" type="text" class="form-control" value="{{$mems->member_roles}}"></td>
                                <td><input readonly name="kpk[]" scope="col" type="text" class="form-control" value="{{ $mems->kpkNum }}"></td>
                                <td><input readonly name="name[]" scope="col" type="text" class="form-control"  value="{{ $mems->Fullname }}"></td>
                                <td><input name="email[]" scope="col" type="text" class="form-control"  value="{{ $mems->Fullname }}"></td>
                            </tr>
                            
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                          <input type="text" id="totRow" name="totRow" hidden value="{{ $member->count() }}">
                          
                      
                    </div>
                  </div>
                  

                  <div class="form-group row justify-content-center">
                    <div class="col-md-6 border-0 shadow-lg rounded pt-2 pb-2">
                      <label for="date" class="bmd-label-floating blk text-uppercase font-weight-bold">Dates</label>
                      <div id="date" class="row justify-content-center">
                        <div class="col-md-4" id="dates">
                          <label for="dat" class="bmd-label-floating blk">From</label>
                          <input class="form-control" type="date" name="dateFrom" value="{{ $dates->Kaizen_DateFrom }}" required>
                        </div>
                        <div class="col-md-4">
                          <label for="dat" class="bmd-label-floating blk">To</label>
                          <input class="form-control" type="date" name="dateTo" value="{{ $dates->Kaizen_DateTo }}" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-customyel btn-user btn-block text-uppercase">
                          APPROVE
                      </button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
              </div>
          </form>
                    

                
        </div>

@endsection