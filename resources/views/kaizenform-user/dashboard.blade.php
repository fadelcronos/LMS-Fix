@extends('layout/main-kaizenForm')

@section('title', 'Dashboard')
@section('collapseClass', 'show')
@section('formClass', 'active')
@section('addKaizen', '')
@section('listKaizen', '')
@section('updateKaizen', '')
@section('dashboard', 'active')

@section('container')
<div class="container">
    <iframe src="https://app.powerbi.com/view?r=eyJrIjoiNjc2MmYxNzYtZDgwMS00ZWMyLWJiMDgtNWNkZDkwYTYwMDNiIiwidCI6IjVmNDBiOTRkLWRlOTItNGM4MS1hNjJhLTQwMTQ0NTU3OTFlNiIsImMiOjZ9&pageName=ReportSection" width="100%" height="700" style="border:none;"></iframe>
</div>
@endsection
