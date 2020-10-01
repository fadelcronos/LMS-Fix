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
<body id="page-top" class="fontstyle">

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


    <div id="content">
        <div class="container bg-white rounded mt-3 mt-md-5">
            <div class="row justify-content-md-center mt-3 mb-2">
                <div class="col justify-content-md-center bg-red pb-2 rounded">
                    <div class="title text-center">
                        <h2 class="text-uppercase text-light">Change Password</h2>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col">
                  <form class="user" method="post" action="{{url('/changepass')}}">
                      @csrf
                    
                    <div class="form-group row d-flex justify-content-center">
                      <div class="col-4 col-sm-4 d-flex justify-content-end">
                        <label for="kpknum">KPK ID</label>
                      </div>
                      <div class="col-4 col-sm-4">
                      {{ $acc->kpkNum }}
                      </div>
                    </div>
                    <div class="form-group row justify-content-center">
                      <div class="col-12 col-md-6 align-self-center">
                        <label for="current_password">New Password</label>
                        <input onkeyup="checkChar2()" type="password" class="form-control form-control-user" id="new_password" name="new_password" required placeholder="Enter New Password...">
                        <div class="invalid-feedback" id="pwMsg"></div>
                      </div>
                    </div>
                    <div class="form-group row justify-content-center">
                      <div class="col-12 col-md-6 align-self-center">
                        <label for="current_password">Re-type New Password</label>
                        <input onkeyup="checkPw2()" type="password" class="form-control form-control-user" id="renew_password" name="renew_password" required placeholder="Re-enter New Password...">
                        <div class="invalid-feedback" id="msgErrPass"></div>
                      </div>
                    </div>
                    
                  <div class="row d-flex justify-content-center">
                    <div class="col-sm-8 text-center">
                      <button class="btn btn-customyel mt-3 mb-1 text-uppercase"><i class="fas fa-key fa-sm fa-fw mr-2 text-white"></i>Change Password</button>
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
  <script src="../js/validation/validate.js"></script>
  <script src="../js/modal/showModal.js"></script>

</body>
</html>