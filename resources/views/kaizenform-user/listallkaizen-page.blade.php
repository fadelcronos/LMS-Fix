@extends('layout/main-kaizenForm')


@section('title', 'List Kaizen')
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
<li class="nav-item active">
  <a class="nav-link" href="{{url('/kaizen-form/list-kaizen')}}">
    <i class="fas fa-list"></i>
    <span>List Kaizen</span></a>
</li>
<hr class="sidebar-divider my-0">

<li class="nav-item">
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
            <div id="allK">
                <div class="row justify-content-center mb-4">
                    <div class="col text-center">
                        <button class="p-3 bg-danger rounded-left text-light no-und" href="">All Kaizen</button><button class="p-3 bg-secondary rounded-right text-light no-und" onclick="changePage()">My Kaizen</button>
                    </div>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-4 text-center">
                        <form class="form">
                            <div class="input-group">
                            <input type="text" class="form-control bg-white border-1 small border-dark" placeholder="Search all kaizen..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-customyel" type="button">
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Members</th>
                                <th>Duration</th>
                                <th>Department</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
               
            <div style="display:none" id="myK">
                <div class="row justify-content-center mb-4">
                    <div class="col text-center">
                        <button class="p-3 bg-secondary rounded-left text-light no-und" onclick="changePage()">All Kaizen</button><button class="p-3 bg-danger rounded-right text-light no-und">My Kaizen</button>
                    </div>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-4 text-center">
                        <form class="form">
                            <div class="input-group">
                            <input type="text" class="form-control bg-white border-1 small border-dark" placeholder="Search my kaizen..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-customyel" type="button">
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Members</th>
                                <th>Duration</th>
                                <th>Department</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>


                
        </div>
        <!-- /.container-fluid -->
    
@endsection