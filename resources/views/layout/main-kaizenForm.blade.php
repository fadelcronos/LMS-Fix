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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <style>
    .vertical-scrollable { 
      height:60vh;
      overflow-y: scroll;
      overflow-x: hidden;
        }

        .badge-notify{
   background:white;
   height: 15px !important;
   width: auto;
   position:relative;
   left: 7px;
  }
  </style>

</head>

<body id="page-top" onload="getDate()">

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

  <!-- Page Wrapper -->
  <div id="wrapper">

  <ul class="navbar-nav bg-red sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      @if(Session::has('admin'))
        <a style="padding-top: 30px" class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin-homepage') }}">
      @else
        <a style="padding-top: 30px" class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/homepage') }}">
      @endif
        <div class="sidebar-brand-icon p-2 pb-3">
          <img class="" src="../img/MATTEL LOGO WHITE.png" style="height:3.5em; width:auto"  alt="">
        </div>
        <div class="sidebar-brand-text mx-3 font1">kaizen form</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Home -->

      <li class="nav-item @yield('listKaizen')">
        <a class="nav-link" href="{{url('/kaizen-form/list-kaizen')}}">
          <i class="fas fa-list"></i>
          <span class="font2">List Kaizen</span></a>
      </li>
      <hr class="sidebar-divider my-0">

      @if(Session::has('login'))
        <li class="nav-item @yield('addKaizen')">
          <a class="nav-link" href="{{url('/kaizen-form/add-kaizen')}}">
            <i class="fas fa-plus"></i>
            <span class="font2">Add Kaizen</span></a>
        </li>

        <!-- <hr class="sidebar-divider my-0">

        <li class="nav-item @yield('updateKaizen')">
          <a class="nav-link" href="{{url('/kaizen-form/update-kaizen')}}">
            <i class="fas fa-edit"></i>
            <span>Update Kaizen</span></a>
        </li> -->

        <hr class="sidebar-divider my-0">

        @if(Session::has('admin') && $acc->kpkNum == '393560')
          <li class="nav-item @yield('approvalKaizen')">
            <a class="nav-link notification" href="{{url('/kaizen-form/approval-kaizen')}}">
              <i class="fas fa-check-square"></i>
              <span class="font2">Approval Kaizen</span>
              @if(count($totWait) <= 0)
              @else
                <span class="badge-notify text-red rounded font-weight-bold pr-2 pl-2 pt-1 pb-1">{{ count($totWait)}}</span>
              @endif 
            
            </a>
          </li>

          <hr class="sidebar-divider my-0">
          
          <li class="nav-item @yield('attendance')">
          <a class="nav-link" href="{{url('/kaizen-form/attendance-kaizen')}}">
            <i class="fas fa-user-edit"></i>
            <span class="font2">Attendance</span></a>
          </li>

          <hr class="sidebar-divider my-0">
        @endif

        <li class="nav-item @yield('dashboard')">
          <a class="nav-link" href="{{url('/kaizen-form/dashboard')}}">
            <i class="fas fa-tachometer-alt"></i>
            <span class="font2">Dashboard</span>
          </a>
        </li>

        <hr class="sidebar-divider my-0">
      @else
        <li class="nav-item @yield('addKaizen')">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter" href="">
            <i class="fas fa-plus"></i>
            <span class="font2">Add Kaizen</span></a>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item @yield('updateKaizen')">
          <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-edit"></i>
            <span class="font2">Update Kaizen</span></a>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item @yield('dashboard')">
          <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-tachometer-alt"></i>
            <span class="font2">Dashboard</span>
          </a>
        </li>

        <hr class="sidebar-divider my-0">
      @endif

      <!-- Divider -->
      <hr class="sidebar-divider">
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

      <!-- Sidebar Toggler (Sidebar) -->
      <!-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div> -->

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
            @if(Session::has('login'))
              @if(Session::has('user'))
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle font2" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="../userimg/{{ $acc->image }}">
                        <span class="mr-2 ml-2 d-lg-inline text-red-600 small"><div class="text-red">{{ $acc->Fullname }}</div></span>
                        <i class="fas fa-caret-down ml-1 text-red"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item font2" href="{{ url('/user/details') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-danger-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font2" href="{{ url('/user/details') }}">
                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-danger-400"></i>
                            Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font2" href="{{ url('/user/changepassword') }}">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-danger-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font2" href="{{ url('/logout') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
              @else
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle font2" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="../adminimg/{{ $acc->image }}">
                        <span class="mr-2 ml-2 d-lg-inline text-red-600 small"><div class="text-red">{{ $acc->Fullname }}</div></span>
                        <i class="fas fa-caret-down ml-1 text-red"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item font2" href="{{ url('/admin-profile') }}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-danger-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font2" href="{{ url('/admin-edit') }}">
                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-danger-400"></i>
                            Edit Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font2" href="{{ url('/admin-changepassword') }}">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-danger-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item font2" href="{{ url('/logout') }}">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger-400"></i>
                            Logout
                        </a>
                        
                    </div>
                </li>
              @endif
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

            </ul>
        </nav>

        
        <!-- End of Topbar -->
      @yield('container')
      </div>
      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Fadel Cahyo LSC Intern</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->   
    </div>
 

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  @if(Session::has('send'))
  <script>
    $(document).ready(function sendEmail(){
    var mail = 'mailto:Mail.invite.com?subject=Mail Invitation&body=For sending mail invitation please Ctrl + click link below %0D%0Afile:///\\\apckrm06a\\Namlos\\Kaizen_mails\\Kaizen_Mail\\Testing\\bin\\Debug\\Testing.exe';
    var a = document.createElement('a');
    a.href = mail;
    a.click();
}
);
  </script>
  @endif

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../js/kaiform.js"></script>
  <script src="../js/search.js"></script>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

  <script src="../js/modal/showModal.js"></script>



  

  <script type="text/javascript">

        $("#nameEmp").select2({
              placeholder: "Select a Name or KPK",
              allowClear: true
          });

           
  </script>



</body>
</html>
