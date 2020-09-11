<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>

     <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow">

            <!-- Topbar Title -->
            <div class="d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100">
            <h3 class="p-2 text-light" style="font-family: Arial, Helvetica, sans-serif;">L E A N</h3>
            </div>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" style="width:40px; height:auto;" src="https://media-exp1.licdn.com/dms/image/C5603AQGJ2oTm-Ma0vA/profile-displayphoto-shrink_200_200/0?e=1600905600&v=beta&t=jPcctvt-ce7Q7WuWvRmPjg71qUbrjdWrrLhS5uPWq7c">
                        <span class="mr-2 ml-2 d-lg-inline text-white-600 small">User</span>
                        <i class="fas fa-caret-down ml-1 text-white"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                        
                    </div>
                </li>

            </ul>

        </nav>
        <div class="container">
            <div class="row justify-content-md-center mt-5">
                <div class="col justify-content-md-center">
                    <div class="title text-center">
                        <h2 class="text-primary text-uppercase">Profile Detail</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6 mb-4">
                    <div class="title text-center">
                        <img class="rounded-circle z-depth-2" style="width: 150px; height:auto;" alt="" src="https://media-exp1.licdn.com/dms/image/C5603AQGJ2oTm-Ma0vA/profile-displayphoto-shrink_200_200/0?e=1600905600&v=beta&t=jPcctvt-ce7Q7WuWvRmPjg71qUbrjdWrrLhS5uPWq7c"
                        data-holder-rendered="true">
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col">
                <form class="user" method="post" action="/updateprofile">
                  @csrf
                <div class="form-group row d-flex justify-content-center">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="fName">First Name</label>
                    <input required type="text" class="form-control form-control-user" id="fName" name="fName" placeholder="First Name" value="">
                  </div>
                  <div class="col-sm-4">
                    <label for="lName">Last Name</label>
                    <input required type="text" class="form-control form-control-user" id="lName" name="lName" placeholder="Last Name" value="">
                  </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                  <div class="col-sm-8">
                    <label for="email">Email Address</label>
                    <input required type="email" class="form-control form-control-user @error('emailAdd') is-invalid @enderror" id="emailAdd" value="" name="emailAdd" placeholder="Email Address">
                    @error('emailAdd')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                
                <div class="form-group row d-flex justify-content-center">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <label for="kpknum">KPK ID</label>
                    <input type="number" onkeydown="limit(this, 6);" onkeyup="limit(this, 6);" onkeyup="this.value = minmax(this.value, 0, 6)" class="form-control form-control-user @error('kpknum') is-invalid @enderror" id="kpknum" name="kpknum" placeholder="KPK Number" value="">
                    @error('kpknum')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-4">
                    <label for="department">Department</label>
                      <select class="form-control custom-select align-self-center" style="font-size: 0.8rem; border-radius: 10rem; height: 62%; !important" name="department" id="department">
                        <option value="" selected hidden>Select Department</option>
                        <option value="EHS" >EHS</option>
                        <option value="Engineering" >Engineering</option>
                        <option value="IT & Finance" >IT & Finance</option>
                        <option value="Human Resource" >Human Resource</option>
                        <option value="Manufacturing East" >Manufacturing East</option>
                        <option value="Manufacturing West" >Manufacturing West</option>
                        <option value="Quality" >Quality</option>
                        <option value="Product Development" >Product Development</option>
                        <option value="Materials" >Materials</option>
                      </select>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                  <div class="col-8 col-md-3">
                    <button class="btn btn-primary btn-user btn-block mt-3 mb-1 text-uppercase"><i class="fas fa-edit fa-sm fa-fw mr-2 text-white"></i>Update Account</button>
                  </div>
                </div>
              </form>
              <div class="row d-flex justify-content-center">
                <div class="col-sm-8 text-center">
                  <a href="{{ url('/homepage') }}" class="btn btn-danger mt-3 mb-5 text-uppercase"><i class="fas fa-angle-left fa-sm fa-fw mr-2 text-white"></i>Back to Homepage</a>
                </div>
              </div>
              
                </div>
            </div>
        </div>
    </div>

     <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
</body>
</html>