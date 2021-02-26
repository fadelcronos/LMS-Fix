@extends('layout/main-kaizenForm')

@section('title', 'Dashboard')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', '')
@section('updateKaizen', '')
@section('dashboard', 'active')

@section('container')
<div class="d-flex justify-content-md-center">
    <div class="text-center mx-auto">
        <div class="error mx-auto" data-text="COMING">COMING</div>
        <div class="error mx-auto" data-text="SOON!">SOON!</div>
    </div>
</div>
<div class="text-center">
    <p class="lead text-gray-800 mb-5">The Page Coming Soon</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="index.html">&larr; Back to Dashboard</a>
</div>
@endsection
