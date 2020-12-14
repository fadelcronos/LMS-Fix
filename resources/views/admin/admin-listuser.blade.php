@extends('layout/main-admin')
@section('title', 'List User')


@section('container')
<div class="container">
    <div class="row">
        <div class="col">
             <table class="table table-light text-center rounded">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->fName }} {{ $user->lName }}</td>
                        <td>{{ $user->department }}</td>
                        <td><a href="" class="btn btn-success">Edit</a><a href="" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
             </table>      
        </div>
    </div>
</div>
@endsection