@extends('adminlte::page')

@section('title', 'Admin')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Admin</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Admin</a></li>
                <li class="breadcrumb-item active">Create Admin</li>
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

                    <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name"
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email"
                                   placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password"
                                   placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm password</label>
                            <input name="password_confirmation" type="password" class="form-control" id="confirm_password"
                                   placeholder="Enter confirm password">
                        </div>
                        <div class="form-group">
                            <label for="role">Select Role</label>
                            <select name="role" class="form-control" id="role">
                                <option value="">Select role</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>



                        @can('admin.create')
                            <button class="btn btn-primary" type="submit">Create</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.Summernote', true)
@section('toastr', true)
@section('css')
@stop

@section('js')

    @include('admin.includes.image_preview')
    <script>
        $(document).ready(function() {
            $('#body').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });

    </script>
@stop
