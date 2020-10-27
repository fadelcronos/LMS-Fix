@extends('layout/main-admin')
@section('title', 'Home')


@section('container')
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

      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container rounded pr-3 pl-3 pb-4 pt-3">
          
          <div class="row justify-content-md-center">
            <div class="col d-flex justify-content-center">
              <div class="title text-center">
              <img class="rounded-circle z-depth-2" style="width: 150px; height:150px;" alt="" src="adminimg/{{ $acc->image }}">
               <h2 class="text-primary fontApple" style="font-weight: 600;">Hello, {{ $acc->Fullname }}</h2>
                <div class="inline">
                  <a href="{{ url('/admin-profile') }}" class="text-red">Account Settings</a>
                </div>
              </div>
            </div>
          </div>
          

          <div class="row mt-4">
            <div class="col">
              <h2 class="text text-red text-center">Main Menu</h2>
            </div>
          </div>
            <div class="row">
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
            </div>
            <div class="row mt-5">
              <div class="col text-center">
                <h2 class="text text-red">Admin Menu</h2>
              </div>
            </div>
            <div class="row">
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
<script src="../js/modal/showModal.js"></script>
<script>
var i;
  function goWeb(i){
    if(i == 1){
      window.open("{{ url('/kaizen-form/add-kaizen') }}","_self");
    }else if(i == 4){
      window.open("{{ url('/admin-listuser') }}","_self");
    }else if(i == 5){
      window.open("{{ url('/register') }}","_self");
    }
  }
</script>
@endsection
