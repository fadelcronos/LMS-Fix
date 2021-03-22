@extends('layout/main-kaizenForm')


@section('title', 'List Kaizen')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', 'active')
@section('updateKaizen', '')
@section('dashboard', '')

 
@section('container')
<!-- Main Content -->


        <div class="container">
            <!-- Begin ALL Kaizen Page Content -->
            <!-- <form action="{{ url('/kaizen-form/list-kaizen')}}" method="post">
                @csrf -->
                <div class="row mt-4">
                    <div class="col-3">
                            <div class="border-0 shadow-lg rounded ml-2 mr-2">
                                <div class="pt-2 pl-2 pr-2 pb-3">
                                    <h5 class="text-dark font2 font-weight-bold">Filter</h5>
                                    <label for="exampleSelect1" class="bmd-label-floating blk font-weight-bold text-danger font2">Kaizen Type</label>
                                    <select class="form-control form-control-sm font2" id="kztype" name="kztype">
                                        <option value="" selected>All Kaizen Type</option>
                                        <option value="BPK">BPK</option>
                                        <option value="SFK">SFK</option>
                                        <option value="DK">DK</option>
                                        <option value="555">555</option>
                                    </select>
                                </div>

                                <div class="pl-2 pr-2 pb-3 ">
                                    <label for="exampleSelect1" class="bmd-label-floating blk font-weight-bold text-danger font2">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat0" value="" checked>
                                        <label class="form-check-label" for="stat0">All</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat1" value="Waiting">
                                        <label class="form-check-label" for="stat1">Waiting Approval</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat2" value="Approved">
                                        <label class="form-check-label" for="stat2">Approved</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat3" value="Recorded">
                                        <label class="form-check-label" for="stat3">Recorded</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat4" value="Completed">
                                        <label class="form-check-label" for="stat4">Completed</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="stat5" value="Canceled">
                                        <label class="form-check-label" for="stat5">Canceled</label>
                                    </div>
                                </div>

                                <div class="pl-2 pr-2 pb-3">
                                    <label for="exampleSelect1" class="bmd-label-floating blk font-weight-bold text-danger font2">Department</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept0" value="" checked>
                                        <label class="form-check-label" for="dept0">All Department</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept1" value="EHS">
                                        <label class="form-check-label" for="dept1">EHS & Compliance</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept2" value="Engineering">
                                        <label class="form-check-label" for="dept2">Engineering</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept3" value="Finance & IT">
                                        <label class="form-check-label" for="dept3">Finance & IT</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept4" value="Human Resources">
                                        <label class="form-check-label" for="dept4">Human Resources</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept5" value="Manufacturing East">
                                        <label class="form-check-label" for="dept5">Manufacturing East</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept6" value="Manufacturing West">
                                        <label class="form-check-label" for="dept6">Manufacturing West</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept7" value="Materials">
                                        <label class="form-check-label" for="dept7">Materials</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept8" value="Product Development">
                                        <label class="form-check-label" for="dept8">Product Development</label>    
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="department" id="dept9" value="Quality">
                                        <label class="form-check-label" for="dept9">Quality</label>    
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-9 ">
                        <nav>
                            <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active text-dark" id="nav-allkz-tab" data-toggle="tab" href="#nav-allkz" role="tab" aria-controls="nav-allkz" aria-selected="true">All Kaizen</a>
                                @if(Session::has('login'))
                                    <a class="nav-item nav-link text-dark" id="nav-mykz-tab" data-toggle="tab" href="#nav-mykz" role="tab" aria-controls="nav-mykz" aria-selected="false">My Kaizen</a>
                                @endif
                                <div class="ml-auto">
                                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="search" name="search" placeholder="Search Kaizen...">
                                        <div class="input-group-prepend rounded-right">
                                            <div class="input-group-text rounded-right"><i class="fas fa-search"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>

                        <!--search result-->                         
                        <div class="border-0 shadow-lg rounded pl-3 pt-3 pb-3 pr-3">
                            <div class="tab-content" id="nav-tabContent">
                                <!-- tab all kaizen -->
                                <div class="tab-pane fade show active" id="nav-allkz" role="tabpanel" aria-labelledby="nav-allkz-tab">
                                    <div class="pt-2 pb-2">Search result(s) for all Kaizen</div>
                                    <div class="list-group vertical-scrollable" id="bodyAcc"></div>
                                </div>
                                
                                <!-- tab my kaizen -->
                                @if(Session::has('login'))
                                <div class="tab-pane fade" id="nav-mykz" role="tabpanel" aria-labelledby="nav-mykz-tab">
                                    <div class="pt-2 pb-2">Search result(s) for my Kaizen</div>
                                    <div class="list-group vertical-scrollable" id="myAcc">

                                    </div>

                                    
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--end of search result -->

                    </div>
                </div>
            <!-- </form>   -->
        </div>
        <!-- /.container-fluid -->
       

       <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script>
    $(document).ready(function(){

        fetch_customer_data();

        function fetch_customer_data(query = '', type = '', status = '', dept = '')
        {
            $.ajax({
                url:"{{ route('actionlist') }}",
                method:'GET',
                data:{query:query, type:type, status:status, dept:dept,},
                dataType:'json',
                beforeSend: function(){
                    $('#bodyAcc').html('<h4 class="text-center mt-3 font2">Loading...</h4>');
                    $('#myAcc').html('<h4 class="text-center mt-3 font2">Loading...</h4>');
                },
                success:function(data){
                    // var output = '';
                    // $('#bodyAcc').html(data.table_data);
                    // $.each(data, function(index, ))
                    // console.log(data.total_data);
                    $('#bodyAcc').html(data. total_data);
                    $('#myAcc').html(data.table_data);
                },
                error:function(){
                    $('#bodyAcc').html('<h4 class="text-center mt-3 font2">Error getting data</h4>');
                    $('#myAcc').html('<h4 class="text-center mt-3 font2">Error getting data</h4>');
                },
            });
        }

        $(document).on('keyup', '#search', function(){
            var query = $(this).val();
            var type = $('#kztype').val();
            var status = $('[name=status]:checked').val();

            var dept = $('[name=department]:checked').val();
            fetch_customer_data(query, type, status, dept);
            });

        $(document).on('change', '#kztype', function(){
            var query = $('#search').val();
            var type = $('#kztype').val();
            var status = $('[name=status]:checked').val();

            var dept = $('[name=department]:checked').val();
            fetch_customer_data(query, type, status, dept);
        });

        $(document).on('click', '[name=status]', function(){
            var query = $('#search').val();
            var type = $('#kztype').val();
            var status = $('[name=status]:checked').val();
            var dept = $('[name=department]:checked').val();
            fetch_customer_data(query, type, status, dept);
        });

        $(document).on('click', '[name=department]', function(){
            var query = $('#search').val();
            var type = $('#kztype').val();
            var status = $('[name=status]:checked').val();
            var dept = $('[name=department]:checked').val();
            fetch_customer_data(query, type, status, dept);
        });
    });
  </script>
    
@endsection