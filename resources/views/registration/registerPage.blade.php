<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
        
          <div class="col">
            <div class="text-center">
                <img src="img/leanLogo.png" alt="" class="img.fluid">
            </div>
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
              </div>
              <form class="user" method="post" action="/register">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input required type="text" class="form-control form-control-user" id="fName" name="fName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input required type="text" class="form-control form-control-user" id="lName" name="lName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input required type="email" class="form-control form-control-user @error('emailAdd') is-invalid @enderror" id="emailAdd" name="emailAdd" placeholder="Email Address">
                  @error('emailAdd')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" onkeydown="limit(this, 6);" onkeyup="limit(this, 6);" onkeyup="this.value = minmax(this.value, 0, 6)" class="form-control form-control-user @error('kpknum') is-invalid @enderror" id="kpknum" name="kpknum" placeholder="KPK Number">
                    @error('kpknum')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-sm-6">
                      <select class="form-control custom-select align-self-center" style="font-size: 0.8rem; border-radius: 10rem; height: 100%;" name="department" id="department">
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
                <div class="form-group">
                
                  
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
                <button class="btn btn-primary btn-user btn-block">Register Account</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="/">Already have an account? Login!</a>
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
  <script src="js/checkPass.js"></script>
</body>

</html>

