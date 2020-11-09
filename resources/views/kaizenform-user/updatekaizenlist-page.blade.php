@extends('layout/main-kaizenForm')



@section('title', 'Update Kaizen List')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', '')
@section('updateKaizen', 'active')
@section('dashboard', '')

@section('container')

<div class="container-fluid">
    <!-- <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action data-toggle=">
            <h5>Kaizen Title</h5>
            Type: ... Date: ...
        </a>
    </div> -->
    <div class="row">
        @foreach($kaizen_list as $list)
        <div class="col-sm-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row pt-2 bg-red rounded mb-1">
                        <div class="col">
                            <h5 class="card-title text-light">{{ $list->Kaizen_title }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="card-text">Type</p>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col">
                            {{ $list->Kaizen_type }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="card-text">Date</p>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col">
                        {{ $list->Kaizen_DateTo }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="card-text">Status</p>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-5 text-center">
                            @if($list->Kaizen_status == 'Waiting')
                                <p class="card-text text-dark bg-warning rounded p-1">{{ $list->Kaizen_status }} For Approval</p>
                            @else
                                <p class="card-text text-warning">{{ $list->Kaizen_status }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mt-3 text-center">
                        <div class="col">
                            @if($list->member_roles == 'Sponsor' || $list->member_roles == 'Facilitator' || $list->member_roles == 'Leader')
                                <button class="btn btn-customyel">UPDATE</button>
                            @else
                                <button class="btn btn-warning">UPDATE</button>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection