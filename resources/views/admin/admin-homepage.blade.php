@extends('layout/main-admin')
@section('title', 'Home')


@section('container')

      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container rounded pr-3 pl-3 pb-4 pt-3">
          
          <div class="row justify-content-md-center">
            <div class="col d-flex justify-content-center">
              <div class="title text-center">
              <img class="rounded-circle z-depth-2" style="width: 150px; height:150px;" alt="" src="adminimg/{{ $acc->image }}">
               <h2 class="text-white fontApple" style="font-weight: 600;">Hello, {{ $acc->fName }}</h2>
                <div class="inline">
                  <a href="{{ url('/admin-profile') }}" class="text-white">Account Settings</a>
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
              <div class="col-sm-4 mt-2">
                <div class="card card_three text-center" onclick="goWeb(4)">
                  <div class="title">
                    <i class="fa fa-user-friends" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">List User</h2>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 mt-2">
                <div class="card card_three text-center" onclick="goWeb(5)">
                  <div class="title">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <h2 class="fontApple" style="font-weight:400;">Add User</h2>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        
      </div>
      <!-- End of Main Content -->
@endsection        

@section('script')
<script>
var i;
  function goWeb(i){
    if(i == 1){
      window.open("{{ url('/kaiform') }}","_self");
    }else if(i == 4){
      window.open("{{ url('/admin-listuser') }}","_self");
    }else if(i == 5){
      window.open("{{ url('/register') }}","_self");
    }
  }
</script>
@endsection
