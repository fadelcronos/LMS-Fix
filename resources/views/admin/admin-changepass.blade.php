@extends('layout/main-admin')
@section('title', 'Change Password')


@section('container')
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
                <div class="col justify-content-md-center">
                    <div class="title text-center">
                        <h2 class="text-uppercase text-dark">Change Password</h2>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col">
                  <form class="user" method="post" action="{{ url('/admin-changepassword') }}">
                      @csrf
                    <div class="form-group row d-flex justify-content-center">
                      <div class="col-4 col-sm-4 d-flex justify-content-end">
                        <label for="kpknum">Admin ID : </label>
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
                      <a href="{{ url('/admin-homepage') }}" class="btn btn-customyel mt-3 mb-5 text-uppercase"><i class="fas fa-angle-left fa-sm fa-fw mr-2 text-white"></i>Back to Homepage</a>
                    </div>
                  </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="../js/validation/validate.js"></script>
  <script src="../js/modal/showModal.js"></script>
@endsection