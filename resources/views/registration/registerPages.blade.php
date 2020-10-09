<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>LMS - Create User Account</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/customCss.css" rel="stylesheet">
</head>

<body class="pt-0 pt-md-5 mt-5 mt-md-3 mb-4 mb-md-5">

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

  <div class="container mt-4 mt-md-5">
    
      <div class="card o-hidden border-0 shadow-lg"  style="@if(Session::has('none'))display:none;@endif">
        <div class="card-body p-0">
          <div class="row rounded justify-content-center">
            <div class="col-md-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-dark mb-4 text-uppercase">Register</h1>
                </div>
                <form class="user" method="post" action="{{ url('/check-kpk') }}">
                  @csrf
                  
                  <div class="form-group">
                    <input onkeydown="limit(this, 6);" onkeyup="limit(this, 6);" onkeyup="this.value = minmax(this.value, 0, 6)" required type="number" class="form-control form-control-user @error('emailAdd') is-invalid @enderror" id="kpkNum" name="kpkNum" placeholder="Insert Your KPK Number..." value="">
                  </div>

                
                  <button class="btn btn-user text-uppercase btn-block btn-customyel mt-0 mt-md-4 mb-md-2">Check KPK</button> 
                </form>
                <hr class="d-md-none">
                @if(Session::has('admin'))
                <a href="{{ url('/admin-homepage') }}" class="btn btn-user text-uppercase btn-block btn-customyel mt-0 mt-md-4 mb-md-2">go to homepage</a> 
                @else
                <div class="text-center mt-0 mt-md-4 mb-md-2">
                  <a href="{{ url('/login') }}" class="text-center text-red ">Already have an account? Login Here!</a> 
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    
    @if(Session::has('data')) 
    <div class="card o-hidden border-0 shadow-lg">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-red">
            <div class="row d-flex justify-content-center mt-2">
              <div class="col d-flex justify-content-center mt-5">
                <i class="fas fa-globe-asia fa-5x text-white"></i>
              </div>
            </div>
            <hr class="mt-5 ml-3">
          <div class="row ml-3">
            <div class="col">
              <h3 class="text-light"><em>Quotes of The Day</em></h3>
            </div>
          </div>
            <div class="row ml-3">
              <div class="col">
                <em class="text-light">“The message of the Kaizen strategy is that not a day 
                  should go by without some kind of improvement being made somewhere in the company.”
                </em>
                <hr>
                <em class="text text-white">
                – Masaaki Imai
                </em>
              </div>
            </div> 
            
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4 text-uppercase">Create Account</h1>
              </div>
              <form class="user" method="post" action="{{ url('/register') }}">
                @csrf
                <div class="form-group row">
                  <div class="col">
                    <input readonly required type="text" class="form-control form-control-user" id="fName" name="fName" placeholder="Fullname" value="{{ Session('Fullname') }}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col">
                    <input required pattern=".+@mattel.com" type="email" class="form-control form-control-user @error('emailAdd') is-invalid @enderror" id="emailAdd" name="emailAdd" placeholder="Email Address" value="{{ old('emailAdd') }}">
                    @error('emailAdd')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input readonly type="number" onkeydown="limit(this, 6);" onkeyup="limit(this, 6);" onkeyup="this.value = minmax(this.value, 0, 6)" class="form-control form-control-user @error('kpknum') is-invalid @enderror" id="kpknum" name="kpknum" placeholder="KPK Number" value="{{ Session('kpkno') }}">
                    @error('kpknum')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6">
                      <!-- <select class="form-control custom-select align-self-center" style="font-size: 0.8rem; border-radius: 10rem; height: 100%;" name="department" id="department">
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
                      </select> -->
                    <input readonly type="text" class="form-control form-control-user" id="dept" name="dept" placeholder="Department" value="{{ Session('dept') }}">
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input onkeyup="checkChar()" required type="password" class="form-control form-control-user @error('pass') is-invalid @enderror" id="pass" name="pass" placeholder="Password">
                    <div class="invalid-feedback" id="pwMsg"></div>
                  </div>
                  <div class="col-sm-6">
                    <input onkeyup="checkPw()" required type="password" class="form-control form-control-user" id="pass2" placeholder="Repeat Password">
                    <div class="invalid-feedback" id="msgErrPass"></div>
                  </div>
                </div>
                <button class="btn btn-user text-uppercase btn-block btn-customyel mt-0 mt-md-4 mb-md-2">Register Account</button> 
              </form>
              <hr class="d-md-none">
              @if(Session::has('admin'))
              <a href="{{ url('/admin-homepage') }}" class="btn btn-user text-uppercase btn-block btn-customyel mt-0 mt-md-4 mb-md-2">go to homepage</a> 
              @else
              <div class="text-center mt-0 mt-md-4 mb-md-2">
                <a href="{{ url('/login') }}" class="text-center text-red ">Already have an account? Login Here!</a> 
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/validation/validate.js"></script>
  <script src="js/modal/showModal.js"></script>

  <script>
    $(document).ready(function(){
      if ($('#mylogo').css('display') == 'block') {
          $('#sign_up_now').css('display', 'none');
      }
    });
  </script>
</body>

</html>
