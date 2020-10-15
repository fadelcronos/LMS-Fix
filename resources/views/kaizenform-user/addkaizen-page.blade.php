@extends('layout/main-kaizenForm')


@section('title', 'Add Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')


@section('sidebar')
<!-- Sidebar -->
<ul class="navbar-nav bg-red sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a style="padding-top: 30px" class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/homepage') }}">
  <div class="sidebar-brand-icon rotate-n-15">
    <img class="img-fluid" src="https://cdn.freebiesupply.com/logos/large/2x/mattel-logo-black-and-white.png" alt="">
  </div>
  <div class="sidebar-brand-text mx-3">kaizen form</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Home -->
<li class="nav-item">
  <a class="nav-link" href="{{url('/kaizen-form/list-kaizen')}}">
    <i class="fas fa-list"></i>
    <span>List Kaizen</span></a>
</li>
<hr class="sidebar-divider my-0">

<li class="nav-item active">
  <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
    <i class="fas fa-plus"></i>
    <span>Add Kaizen</span></a>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
  <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
    <i class="fas fa-edit"></i>
    <span>Update Kaizen</span></a>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
  <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
    <i class="fas fa-tachometer-alt"></i>
    <span>Dashboard</span>
  </a>
</li>

<hr class="sidebar-divider my-0">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-cog"></i>
    <span>Kaizen</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Menu</h6>
      <a class="collapse-item " href="{{url('/kaiform')}}">Kaizen Form</a>
      <a class="collapse-item " href="cards.html">Kaizen Updates</a>
      <a class="collapse-item " href="cards.html">Kaizen Aprroval</a>
      <a class="collapse-item " href="cards.html">Kaizen Dashboard</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
@endsection



@section('container')
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
              <div class="form-group row justify-content-center">
                <div class="col-md-6">
                  <label for="exampleSelect1" class="bmd-label-floating blk">Kaizen Type</label>
                  <select class="form-control" id="exampleSelect1" name="kztype">
                      <option value="" selected disabled hidden>Kaizen Type</option>
                      <option value="BPK">BPK</option>
                      <option value="SFK">SFK</option>
                      <option value="DK">DK</option>
                      <option value="555">555</option>
                  </select>
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-md-6">
                  <label for="exampleInputEmail" class="bmd-label-floating blk">Title</label>
                  <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Title here...">
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-md-6">
                  <label for="exampleSelect1" class="bmd-label-floating blk">Department</label>
                  <select class="form-control" id="exampleSelect1">
                      <option value="None" selected disabled hidden>Select Department</option>
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
                <div class="col-md-6">
                <label for="myTab" class="bmd-label-floating blk">Members</label>
                      <table class="table text-center" id="myTab">
                          <thead class="text-center">
                              <th>Role</th>
                              <th>KPK</th>
                              <th>Name</th>
                              <th>Action</th>
                          </thead>
                          <tbody id="myRows" class="text-white">
                              <tr>
                                  <td>
                                    <select class="form-control" name="role1" id="role1" style="width:auto">
                                      <option value="Sponsor">Sponsor</option>
                                      <option value="Facilitator">Facilitator</option>
                                      <option value="Leader">Leader</option>
                                      <option value="Co-Leader">Co-Leader</option>
                                      <option value="Participant">Participant</option>
                                    </select>
                                  </td>
                                  <td><input name="kpk1" scope="col" type="text" class="form-control"></td>
                                  <td><input name="name1" scope="col" type="text" class="form-control"></td>
                                  <td><button  type="button" onclick="delRow()" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                              </tr>
                          </tbody>
                        </table>
                      
                      <input type="text" id="totRow" name="totRow" hidden value="1">
                </div>
              </div>
              <div class="row mb-2">
                <div class="col text-center">
                <button onclick="addRow()" type="button" class="btn btn-danger justify-content-center"><i class="fas fa-plus"></i></button>
                </div>
              </div>

              <div class="form-group row justify-content-center">
                <div class="col-md-6">
                  <label for="date" class="bmd-label-floating blk">Dates</label>
                  <div id="date" class="row justify-content-center">
                    <div class="col-md-4" id="dates">
                      <label for="dat" class="bmd-label-floating blk">From</label>
                      <input class="form-control" type="date">
                    </div>
                    <div class="col-md-4">
                      <label for="dat" class="bmd-label-floating blk">To</label>
                      <input class="form-control" type="date">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-md-6">
                  <label for="exampleTextarea" class="bmd-label-floating blk">Details</label>
                  <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
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