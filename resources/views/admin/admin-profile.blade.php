@extends('layout/main-admin')
@section('title', 'Profile')


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

    <div class="container bg-white rounded mt-5">
        <div class="row justify-content-md-center mt-3 mb-2">
            <div class="col justify-content-md-center">
                <div class="title text-center">
                    <h2 class="text-uppercase text-dark">My Profile</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center mt-3 align-items-center">
            <div class="col-md-6 mb-4">
                <div class="title text-center">
                    <img class="rounded-circle z-depth-2" style="width: 150px; height:150px;" alt="" src="../adminimg/{{ $acc->image }}"
                    data-holder-rendered="true">
                </div>
            </div>    
        
            <div class="col">
              <form class="user" method="post">
            
                <div class="row d-flex">
                  <div class="col-4 col-md-3">
                      <div class="text">
                        Name
                      </div>      
                  </div>
                  <div class="col-1 col-md-1">
                          :
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="text text-dark">{{ $acc->Fullname}}</div>
                  </div>
                </div>
                <div class="row d-flex">
                  <div class="col-4 col-md-3">
                      <div class="text">
                        E-mail
                      </div>      
                  </div>
                  <div class="col-1 col-md-1">
                          :
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="text text-dark">{{ $acc->email }}</div>
                  </div>
                </div>
                <div class="row d-flex">
                  <div class="col-4 col-md-3">
                      <div class="text text-dark">
                        KPK ID
                      </div>      
                  </div>
                  <div class="col-1 col-md-1">
                          :
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="text text-dark">{{ $acc->kpkNum }}</div>
                  </div>
                </div>
                <div class="row d-flex">
                  <div class="col-4 col-md-3">
                      <div class="text">
                        Department
                      </div>      
                  </div>
                  <div class="col-1 col-md-1">
                          :
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="text text-dark">{{ $acc->Dept }}</div>
                  </div>
                </div>
                <div class="row d-flex">
                  <div class="col-4 col-md-3">
                      <div class="text">
                        Section
                      </div>      
                  </div>
                  <div class="col-1 col-md-1">
                          :
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="text text-dark">{{ $acc->Section }}</div>
                  </div>
                </div>  
              </form>
          
          
            </div>
        </div>
          <div class="row d-flex justify-content-center">
            <div class="col-sm-8 text-center">
              <a href="{{ url('/admin-homepage') }}" class="btn btn-customyel mt-3 mb-5 text-uppercase"><i class="fas fa-angle-left fa-sm fa-fw mr-2 text-white"></i>Back to Homepage</a>
            </div>
          </div>
    </div>
@endsection
@section('script')
<script src="../js/modal/showModal.js"></script>
@endsection