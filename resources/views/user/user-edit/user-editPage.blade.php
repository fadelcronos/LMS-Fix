<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

     <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/customCss.css" rel="stylesheet">
  <link href="../css/home-css.css" rel="stylesheet">
</head>
<body id="page-top" class="fontstyle bg-abstract-black">
    <div id="content">
    <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top transparent navbar-inverse">

            <!-- Topbar Title -->
            <div class="d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100">
            <h3 class="p-2 text-light" style="font-family: Arial, Helvetica, sans-serif;">L E A N</h3>
            </div>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle img-forprof" src="../userimg/{{ $acc->image }}">
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
        <div class="container bg-white rounded">
            <div class="row justify-content-md-center mt-3 mb-2">
                <div class="col justify-content-md-center">
                    <div class="title text-center">
                        <h2 class="text-uppercase text-dark">Edit Profile</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6 mb-4">
                    <div class="title text-center">
                        <img class="rounded-circle z-depth-2" style="width: 150px; height:auto;" alt="" src="../userimg/{{ $acc->image }}"
                        data-holder-rendered="true">
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col">
                  <form class="user" method="post" action="{{ url('/user/edit') }}" enctype="multipart/form-data">
                      @csrf
                    <div class="form-group row d-flex justify-content-center">
                      <div class="col-8 col-md-4 d-flex justify-content-center">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                              aria-describedby="inputGroupFileAddon01" name="image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                          </div>
                        </div>
                      </div>  
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-8 text-center">
                        <div class="text text-dark">{{ $acc->fName }} {{ $acc->lName }}</div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-8 text-center">
                        <div class="text text-dark">{{ $acc->fName }} {{ $acc->lName }}</div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-8 text-center">
                        <div class="text text-dark">{{ $acc->fName }} {{ $acc->lName }}</div>
                      </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <div class="col-8 text-center">
                        <div class="text text-dark">{{ $acc->fName }} {{ $acc->lName }}</div>
                      </div>
                    </div>
                   
                  <div class="row d-flex justify-content-center">
                    <div class="col-sm-8 text-center">
                      <button class="btn btn-customyel mt-3 mb-1 text-uppercase"><i class="fas fa-edit fa-sm fa-fw mr-2 text-white"></i>Save Edit</button>
                    </div>
                  </div>  
                  </form>
                  <div class="row d-flex justify-content-center">
                    <div class="col-sm-8 text-center">
                      <a href="{{ url('/homepage') }}" class="btn btn-customyel mt-3 mb-5 text-uppercase"><i class="fas fa-angle-left fa-sm fa-fw mr-2 text-white"></i>Back to Homepage</a>
                    </div>
                  </div>  
                </div>
            </div>
        </div>
    </div>

     <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>
</html>