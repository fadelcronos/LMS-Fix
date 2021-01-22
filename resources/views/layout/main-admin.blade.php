<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LMS - @yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/customCss.css" rel="stylesheet">
  <link href="css/home-css.css" rel="stylesheet">

</head>

<body id="page-top" class="fontstyle">
    
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top transparent navbar-inverse">

            <!-- Topbar Title -->
            <form class=" d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                <div class="text">
                    <h3 class="p-2 text-light" style="font-family: Arial, Helvetica, sans-serif;"><a href="{{ url('/admin-homepage') }}" class="text-red">L E A N</a></h3>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="adminimg/{{ $acc->image }}">
                        <span class="mr-2 ml-2 d-lg-inline text-red-600 small"><div class="text-red">{{ $acc->Fullname }}</div></span>
                        <i class="fas fa-caret-down ml-1 text-red"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('/admin-profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-danger-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/admin-edit') }}">
                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-danger-400"></i>
                            Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/admin-changepassword') }}">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-danger-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/logout') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger-400"></i>
                            Logout
                        </a>
                        
                    </div>
                </li>

            </ul>

        </nav>

      @yield('container')



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  @yield('script')


</body>

</html>
