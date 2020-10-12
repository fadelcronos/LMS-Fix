<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LMS - Sign In</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/customCss.css" rel="stylesheet">
<style>
  .colorA{
    background: #0f0c29;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #24243e, #302b63, #0f0c29); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  }
</style>


</head>

<body class="bg-white">

<!-- Modal -->
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


  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center pt-3 pt-md-5 mt-md-1 mt-5">
      
      <div class="col-xl-10 col-lg-12 col-md-9 mt-2 mt-md-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                
              <div class="col-lg-6 d-none d-lg-block bg-red">
                <div class="row d-flex justify-content-center mt-2">
                  <div class="col d-flex justify-content-center mt-5">
                    <!-- <i class="fas fa-globe-asia fa-5x text-white"></i> -->
                    <img src="img/MattelWhite.png" class="img-fluid" alt="" width="150px" height="auto">
                  </div>
                </div>
                <div class="row mt-5 pt-5">
                  <div class="col">
                    <h3 class="text text-white text-center">Welcome Back!</h3>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col d-flex justify-content-center">
                    <p class="text text-white">Please log in to keep us connected!</p>
                  </div>
                </div>
                <!-- <div class="row justify-content-center">
                  <div class="col d-flex justify-content-center">
                    <p class="text text-white">Not Registered ?</p>
                  </div>
                </div>
                <div class="row justify-content-center mb-5">
                  <div class="col d-flex justify-content-center">
                    <a href="{{ url('/register') }}" class="btn btn-customblk rounded-pill pl-4 pr-4 text-uppercase">Register Here</a>
                  </div>
                </div> -->
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center d-lg-none d-sm-block mb-3">
                    <i class="fas fa-user fa-3x text-red"></i>
                  </div>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Sign In</h1>
                  </div>
                  <form class="user mt-4" method="post" action="{{ url('/login') }}">
                    @csrf
                    <div class="form-group">
                      <input required type="text" class="form-control form-control-user" name="user" id="user" aria-describedby="emailHelp" placeholder="Enter KPK Number..." value="{{ old('user') }}">
                    </div>
                    <div class="form-group">
                      <input required type="password" class="form-control form-control-user" name="pass" id="pass" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-user btn-block btn-customblk">
                      LOGIN
                    </button>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-dark" href="{{ url('/forgot-password') }}">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-red" href="{{ url('/register') }}">Not Registered? Register Here!</a>
                  </div>
                  <!-- <div class="text-center">
                    <a  class="small d-lg-none d-sm-block text-dark" href="{{ url('/register') }}">Create an Account!</a>
                  </div> -->
                </div>
              </div>
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

  <script src="js/modal/showModal.js"></script>

</body>

</html>
