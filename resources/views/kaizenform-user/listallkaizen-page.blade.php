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



        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div id="allK">
                <div class="row justify-content-center mb-4">
                    <div class="col text-center">
                        <button class="p-3 bg-danger rounded-left text-light no-und" href="">All Kaizen</button><button class="p-3 bg-secondary rounded-right text-light no-und" onclick="changePage()">My Kaizen</button>
                    </div>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-4 text-center">
                        <form class="form">
                            <div class="input-group">
                            <input type="text" class="form-control bg-white border-1 small border-dark" placeholder="Search all kaizen..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-customyel" type="button">
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Members</th>
                                <th>Duration</th>
                                <th>Department</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
               
            <div style="display:none" id="myK">
                <div class="row justify-content-center mb-4">
                    <div class="col text-center">
                        <button class="p-3 bg-secondary rounded-left text-light no-und" onclick="changePage()">All Kaizen</button><button class="p-3 bg-danger rounded-right text-light no-und">My Kaizen</button>
                    </div>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-md-4 text-center">
                        <form class="form">
                            <div class="input-group">
                            <input type="text" class="form-control bg-white border-1 small border-dark" placeholder="Search my kaizen..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-customyel" type="button">
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Members</th>
                                <th>Duration</th>
                                <th>Department</th>
                                <th>Start</th>
                                <th>End</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>


                
        </div>
        <!-- /.container-fluid -->
    
@endsection