@extends('adminlte::page')

@section('title', 'Passenger')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Passenger</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.passengers.index') }}">Passenger</a></li>
                <li class="breadcrumb-item active">Create Passenger</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.includes.message')

                    <form action="{{ route('admin.passengers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>User</label>
                                <select class="form-control select2 js-example-basic-single" name="user_id" required>
                                    <option selected disabled>-- Select User -- </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" required class="form-control" id="name"
                                    placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" required class="form-control" id="email"
                                    placeholder="Enter Email">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input name="phone" type="number" required class="form-control" id="phone"
                                    placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="age">Age</label>
                                <input name="age" type="number" required class="form-control" id="age"
                                    placeholder="Enter age">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option selected disabled>-- Select Gender -- </option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Other</option>
                                </select>
                            </div>
                        </div>
                        @can('permission.create')
                            <button class="btn btn-primary" type="submit">Create</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr', true)
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@stop
