<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kaizen Form - @yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/customCss.css" rel="stylesheet">
  <link href="../css/home-css.css" rel="stylesheet">

</head>

<body id="page-top" onload="getDate()">

  <!-- Page Wrapper -->
  <div id="wrapper">

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

      <li class="nav-item @yield('listKaizen')">
        <a class="nav-link" href="{{url('/kaizen-form/list-kaizen')}}">
          <i class="fas fa-list"></i>
          <span>List Kaizen</span></a>
      </li>
      <hr class="sidebar-divider my-0">

      <li class="nav-item @yield('addKaizen')">
        <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
          <i class="fas fa-plus"></i>
          <span>Add Kaizen</span></a>
      </li>

      <hr class="sidebar-divider my-0">

      <li class="nav-item @yield('updateKaizen')">
        <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
          <i class="fas fa-edit"></i>
          <span>Update Kaizen</span></a>
      </li>

      <hr class="sidebar-divider my-0">

      @if(Session::has('admin'))
      <li class="nav-item @yield('updateKaizen')">
        <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
          <i class="fas fa-check-square"></i>
          <span>Approval Kaizen</span></a>
      </li>

      <hr class="sidebar-divider my-0">
      @endif

      <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider my-0">


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-red"></i>
          </button>
          <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="../userimg/{{ $acc->image }}">
                        <span class="mr-2 ml-2 d-lg-inline text-red-600 small">{{ $acc->Fullname }}</span>
                        <i class="fas fa-caret-down ml-1 text-red"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('/admin-profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/admin-edit') }}">
                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/admin-changepassword') }}">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/logout') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        
                    </div>
                </li>

            </ul>
        </nav>

        
        <!-- End of Topbar -->
      @yield('container')
      </div>
      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->   
    </div>
 

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../js/kaiform.js"></script>
</body>
</html>
