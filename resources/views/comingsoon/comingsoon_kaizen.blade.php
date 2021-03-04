@extends('layout/main-kaizenForm')

@section('title', 'Dashboard')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', '')
@section('updateKaizen', '')
@section('dashboard', 'active')

@section('container')
<div class="">
    <div class="text-center mx-auto">
        <div class="error mx-auto" data-text="404">404</div>
    </div>
</div>
<div class="text-center">
    <p class="lead text-gray-800 mb-5">Dashboard Page Still On Progress</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="/kaizen-form/list-kaizen">&larr; Back to List Kaizen</a>
</div>
@endsection
