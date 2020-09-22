<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lean Management System</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/customCss.css" rel="stylesheet">
  <link href="css/home-css.css" rel="stylesheet">

  <!-- <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
  <script>
    $(document).ready(function(){
        $("#modalAlert").modal('show');
    });
</script> -->
</head>

<body id="page-top" class="fontstyle bg-abstract-black">
    
      <!-- Main Content -->
  <div id="content">

      <!-- <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalAlertLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAlertLabel">Message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @if(\Session::has('alert'))
                      <div class="alert alert-danger">
                          <div>{{Session::get('alert')}}</div>
                      </div>
                @endif
                @if(\Session::has('alert-success'))
                      <div class="text blk">
                          <div>{{Session::get('alert-success')}}</div>
                      </div>
                @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-customyel" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
    </div> -->

      <div id="content-wrapper" class="d-flex flex-column">
           <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top transparent navbar-inverse">

            <!-- Topbar Title -->
            <form class=" d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                <div class="text">
                    <h3 class="p-2 text-light" style="font-family: Arial, Helvetica, sans-serif;"><a href="{{ url('/homepage') }}" class="text-white">L E A N</a></h3>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="userimg/{{ $acc->image }}">
                        <span class="mr-2 ml-2 d-lg-inline text-white-600 small">{{ $acc->fName }}</span>
                        <i class="fas fa-caret-down ml-1 text-white"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('/user/details') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/user/edit') }}">
                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/user/changepassword') }}">
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

      <!-- Main Content -->
      <div id="content">

       

        <!-- Begin Page Content -->
        <div class="container rounded pr-3 pl-3 pb-4 pt-3">
          
          <div class="row justify-content-md-center">
            <div class="col d-flex justify-content-center">
              <div class="title text-center">
              <img class="rounded-circle z-depth-2" style="width: 150px; height:150px;" alt="" src="userimg/{{ $acc->image }}">
               <h2 class="text-white fontApple" style="font-weight: 600;">Hello, {{ $acc->fName }}</h2>
                <div class="inline">
                  <a href="{{ url('/user/details') }}" class="text-white">Account Settings</a>
                  <!-- <a href="{{ url('/logout') }}" class="text-danger">Logout</a> -->
                </div>
              </div>
            </div>
          </div>
          

          <!-- Section for button home -->
         
            <div class="row mt-4">
              <div class="col-sm-4 mt-2">
                <div class="card card_three text-center" onclick="goWeb(1)">
                  <div class="title">
                    <i class="fa fa-chart-line" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">Kaizen Form</h2>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mt-2">
                <div class="card card_three text-center">
                  <div class="title">
                    <i class="fa fa-file-alt" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">Project Form</h2>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mt-2">
                <div class="card card_three text-center">
                  <div class="title">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">Kerja Bersama</h2>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        
      </div>
      <!-- End of Main Content -->
        



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

<script>
var i;
  function goWeb(i){
    if(i == 1){
      window.open("/kaiform","_self");
    }
  }
</script>
</body>

</html>
