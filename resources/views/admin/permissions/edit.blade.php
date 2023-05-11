@extends('adminlte::page')

@section('title', 'Edit Permissions')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Permission - {{$permission->name}}</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">Permissions</a></li>
                <li class="breadcrumb-item active">Edit Permission</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.permissions.update',['permission'=>$permission->id])}}" method="POST">
                        @method('PUT')
                        @csrf
                        @if (count($errors) > 0)
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" value="{{$permission->name}}" required class="form-control" id="name" placeholder="Enter Permission Name">
                        </div>
                        <div class="form-group">
                            <label for="guard">Select User Type</label>
                            <select name="guard_name" id="guard" required class="form-control">
                                <option value="">Select User Type</option>
                                <option value="web" @if($permission->guard_name == 'web') selected @endif>General User</option>
                                <option value="employee" @if($permission->guard_name == 'employee') selected @endif>Employee</option>
                                <option value="admin" @if($permission->guard_name == 'admin') selected @endif>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="group">Group</label>
                            <input type="text" name="group_name" required value="{{$permission->group_name}}" class="form-control" id="group" placeholder="Enter Permission Group Name">
                        </div>
                        @can('permission.update')
                            <button class="btn btn-primary" type="submit">Update</button>
                        @endcan

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr',true)
@section('css')

@stop

@section('js')


@stop
