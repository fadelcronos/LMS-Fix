
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot</title>
    <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/customCss.css" rel="stylesheet">
  <link href="css/home-css.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center d-flex">
        <div class="col-4 text-center bg-red rounded pt-2">
            <h3 class="text text-white">L E A N</h3>
        </div>
    </div>
    <div class="row justify-content-center d-flex mt-3">
        <div class="col text-center">
            <h3 class="text text-dark font-weight-bold">Verification Code</h3>
        </div>
    </div>
    <div class="row justify-content-center d-flex">
        <div class="col text-center">
            <h3 class="text text-dark">{{ $code }}</h3>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col text-center">
            <p class="dark">Hi, {{ $checkuser->fName }}</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col text-center">
            <p class="dark">Here is your OTP Code</p>
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