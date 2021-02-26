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
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/customCss.css" rel="stylesheet">
  <link href="../css/home-css.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,500;1,900&family=Heebo:wght@800&family=Kufam&display=swap" rel="stylesheet">
</head>

<body id="page-top" class="fontstyle">
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
    
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top transparent navbar-inverse">

            <!-- Topbar Title -->
            <form class=" d-sm-inline-block form-inline mr-auto ml-md-1 my-2 my-md-0 mw-100">
                <div class="text">
                  <a href="{{ url('/homepage') }}">
                    <img class="img-fluid" src="../../img/MATTEL LOGO RED.png" alt="" style="height:3.5em;">
                  </a>
                    <!-- <h3 class="p-2 text-light" style="font-family: Arial, Helvetica, sans-serif;"><a href="{{ url('/homepage') }}" class="text-red">L E A N</a></h3> -->
                </div>
            </form>

            <!-- Topbar Navbar -->
            @if(Session::has('login'))
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="../userimg/{{ $acc->image }}">
                        <span class="mr-2 ml-2 d-lg-inline text-danger small">{{ $acc->Fullname }}</span>
                        <i class="fas fa-caret-down ml-1 text-red"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('/user/details') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-danger-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/user/edit') }}">
                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-danger-400"></i>
                            Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/user/changepassword') }}">
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
            @else
            <ul class="navbar-nav ml-auto">
                <a href=""  class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter">Login</a>
                <a href="{{ url('/register') }}"  class="btn btn-danger ml-2">Register</a>
            </ul>

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="text-center mb-4">
                                        <i class="fas fa-user fa-3x text-red"></i>
                                    </div>
                                </div>
                            </div>
                            <form class="user" method="post" action="{{ url('/login') }}">
                                @csrf
                                <div class="form-group row d-flex justify-content-center">
                                    <input required type="text" class="form-control form-control-user col-8 border border-danger" name="user" id="user" aria-describedby="emailHelp" placeholder="Enter KPK Number" value="{{ old('user') }}"> 
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <input required type="password" class="form-control form-control-user col-8 border border-danger" name="pass" id="pass" placeholder="Password">
                                    <p class="text text-dark pt-2" style="font-size: 0.8em">Password format : Birthdate(YYYYMMDD) e.g: 19990128</p>

                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <button class="col-8 btn btn-user btn-block btn-customyel">
                                        LOGIN
                                    </button>
                                </div>
                                <div class="form-group row d-flex justify-content-center">
                                    <p class="text text-dark">Don't have an account? <a class="text-red" href="{{ url('/register') }}">Register</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </nav>

      @yield('container')



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

  @yield('script')


</body>

</html>
