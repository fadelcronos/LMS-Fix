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
<style>
.fontApple{
    font-family: SFUIDisplay,Helvetica Neue,sans-serif; 

}

.card {
  position: relative;
  min-width: 300px;
  height: auto;
  overflow: hidden;
  border-radius: 15px;
  margin: 0 auto;
  padding: 20px;
  box-shadow: 0 10px 15px rgba(0,0,0,0.3);
  transition: .5s;
}
.card:hover {
  transform:scale(1.1);
  cursor: pointer;
}
.card_red, .card_red .title .fa {
  background: linear-gradient(-45deg, #ffec61, #f321d7);
}
.card_violet, .card_violet .title .fa  {
  background: linear-gradient(-45deg, #f403d1, #64b5f6);
}
.card_three, .card_three .title .fa  {
  background: linear-gradient(-45deg, #24ff72, #9a4eff);
}

.card:before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 40%;
  background: rgba(255, 255, 255, .1);
  z-index: 1;
  transform: skewY(-5deg) scale(1.5);
}

.title .fa {
  color: #fff;
  font-size: 60px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  text-align: center;
  line-height: 100px;
  box-shadow: 0 10px 10px rgba(0, 0, 0, .1);
}
.title h2 {
  position: relative;
  margin: 20px 0 0;
  padding: 0;
  color: #fff;
  font-size: 28px;
  z-index: 2;
}
.price {
  position: relative;
  z-index: 2;
}
.price h4 {
  margin: 0;
  padding: 20px 0;
  color: #fff;
  font-size: 60px;
}
.option {
  position: relative;
  z-index: 2;
}
.option ul {
  margin: 0;
  padding: 0;
}
.option ul li {
  margin: 0 0 10px;
  padding: 0;
  list-style: none;
  color: #fff;
  font-size: 16px;
}
.card a {
  display: block;
  position: relative;
  z-index: 2;
  background-color: #fff;
  color: #262ff;
  width: 150px;
  height: 40px;
  text-align: center;
  margin: 20px auto 0;
  line-height: 40px;
  border-radius: 40px;
  font-size: 16px;
  cursor: pointer;
  text-decoration: none;
  box-shadow: 0 5px 10px rgba(0,0,0, .1);
}
.card a:hover {
  
}
.bg-tit{
    color: white;
    background: linear-gradient(-45deg, #ffec61, #f321d7);
}
</style>
</head>

<body id="page-top" class="fontstyle">
    
      <!-- Main Content -->
      <div id="content" class="bg-white">

      <div id="content-wrapper" class="d-flex flex-column">
           <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow">

            <!-- Topbar Title -->
            <form class=" d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                <div class="text">
                    <h3 class="p-2 text-light" style="font-family: Arial, Helvetica, sans-serif;">L E A N</h3>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" style="width:30px; height:auto;" src="https://media-exp1.licdn.com/dms/image/C5603AQGJ2oTm-Ma0vA/profile-displayphoto-shrink_200_200/0?e=1600905600&v=beta&t=jPcctvt-ce7Q7WuWvRmPjg71qUbrjdWrrLhS5uPWq7c">
                        <span class="mr-2 ml-2 d-lg-inline text-white-600 small">User</span>
                        <i class="fas fa-caret-down ml-1 text-white"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('/details') }}">
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

      <!-- Main Content -->
      <div id="content">

       

        <!-- Begin Page Content -->
        <div class="container rounded pr-3 pl-3 pb-4 pt-3">
          
          <div class="row justify-content-md-center">
            <div class="col d-flex justify-content-center">
              <div class="title text-center">
              <img class="rounded-circle z-depth-2" style="width: 150px; height:auto;" alt="" src="https://media-exp1.licdn.com/dms/image/C5603AQGJ2oTm-Ma0vA/profile-displayphoto-shrink_200_200/0?e=1600905600&v=beta&t=jPcctvt-ce7Q7WuWvRmPjg71qUbrjdWrrLhS5uPWq7c">
               <h2 class="text-dark fontApple" style="font-weight: 600;">Hello, User</h2>
                <div class="inline">
                  <a href="{{ url('/details') }}" class="text-primary">Account Settings</a>
                  <!-- <a href="{{ url('/logout') }}" class="text-danger">Logout</a> -->
                </div>
              </div>
            </div>
          </div>
          

          <!-- Section for button home -->
         
            <div class="row mt-4">
              <div class="col-sm-4">
                <div class="card card_violet text-center" onclick="goWeb(1)">
                  <div class="title">
                    <i class="fa fa-chart-line" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">Kaizen Form</h2>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card card_three text-center">
                  <div class="title">
                    <i class="fa fa-file-alt" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">Project Form</h2>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card card_red text-center">
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
