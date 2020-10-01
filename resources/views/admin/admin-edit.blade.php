@extends('layout/main-admin')
@section('title', 'Edit Profile')


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
        <div class="container bg-white rounded">
            <div class="row justify-content-md-center mt-3 mb-2">
                <div class="col justify-content-md-center">
                    <div class="title text-center">
                        <h2 class="text-uppercase text-dark">Edit Profile</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6 mb-4">
                    <div class="title text-center">
                        <img class="rounded-circle z-depth-2" style="width: 150px; height:150px;" alt="" src="../adminimg/{{ $acc->image }}"
                        data-holder-rendered="true">
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col">
                    <form class=adminr" method="post" action="{{ url('/admin-edit') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-8 col-md-4 d-flex justify-content-center">
                        <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" name="image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        </div>  
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mb-3">
                        <label for="validationCustom01">First name</label>
                        <input type="text" class="form-control text-center" id="validationCustom01" placeholder="First name" readonly value="{{ $acc->fName }}">
                        </div>
                        <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Email</label>
                        <input type="text" class="form-control text-center" id="validationCustom02" placeholder="Last name" value="{{ $acc->email }}" readonly>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mb-3">
                        <label for="validationCustom01">KPK ID</label>
                        <input type="text" class="form-control text-center" id="validationCustom01" placeholder="KPK ID" readonly value="{{ $acc->kpkNum }}">
                        </div>
                        <div class="col-md-4 mb-3">
                        <label for="validationCustom02">Department</label>
                        <input type="text" class="form-control text-center" id="validationCustom02" placeholder="department" value="{{ $acc->department }}" readonly>
                        </div>
                    </div>
                    
                    
                    <div class="row d-flex justify-content-center">
                    <div class="col-sm-8 text-center">
                        <button class="btn btn-customyel mt-3 mb-1 text-uppercase"><i class="fas fa-edit fa-sm fa-fw mr-2 text-white"></i>Save Edit</button>
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
  <script src="../js/modal/showModal.js"></script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection