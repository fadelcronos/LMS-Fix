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
              <div class="form-group row">
                  <label for="exampleSelect1" class="bmd-label-floating">Kaizen Type</label>
                  <select class="form-control" id="exampleSelect1">
                      <option value="" selected disabled hidden>Kaizen Type</option>
                      <option>BPK</option>
                      <option>SFK</option>
                      <option>DK</option>
                      <option>555</option>
                  </select>
              </div>
              <div class="form-group row">
                  <label for="exampleInputEmail" class="bmd-label-floating">Title</label>
                  <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Title here...">
              </div>
              <div class="form-group row">
                  <label for="exampleSelect1" class="bmd-label-floating">Department</label>
                  <select class="form-control" id="exampleSelect1">
                      <option value="" selected disabled hidden>Select Department</option>
                      <option>EHS</option>
                      <option>Engineering</option>
                      <option>Finance & IT</option>
                      <option>Human Resources</option>
                      <option>Manufacturing East</option>
                      <option>Manufacturing West</option>
                      <option>Quality</option>
                      <option>Product Development</option>
                      <option>Materials</option>
                  </select>
              </div>
              <div class="form-group row justify-content-center">
                      <table class="table text-center" id="myTab">
                          <thead class="text-center">
                              <th>Role</th>
                              <th>KPK</th>
                              <th>Name</th>
                              <th>Action</th>
                          </thead>
                          <tbody id="myRows" class="text-white">
                              <tr>
                                  <td><input scope="col" id="role" type="text" name="role1" value="def" class="form-control"></td>
                                  <td><input name="kpk1" scope="col" type="text" class="form-control"></td>
                                  <td><input name="name1" scope="col" type="text" class="form-control"></td>
                                  <td><button  type="button" onclick="delRow()" class="btn btn-danger">Delete</button></td>
                              </tr>
                          </tbody>
                      </table>
                      <input type="text" id="totRow" name="totRow" hidden value="1">
                      <button onclick="addRow()" type="button" class="btn btn-danger"><i class="fas fa-plus"></i></button>
                  
              </div>
              <div class="form-group">
                  <label for="exampleTextarea" class="bmd-label-floating">Details</label>
                  <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
              </div>
              
              <button type="submit" class="btn btn-customyel btn-user btn-block text-uppercase">
                  Submit
              </button>
          </form>
                    

                
        </div>
        <!-- /.container-fluid -->
    
@endsection