@extends('adminlte::page')

@section('title', 'View Permissions')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>View Permission - {{$permission->name}}</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">Permissions</a></li>
                <li class="breadcrumb-item active">View Permission</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

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
                            <input name="name" type="text" value="{{$permission->name}}" disabled required class="form-control" id="name" placeholder="Enter Permission Name">
                        </div>
                        <div class="form-group">
                            <label for="guard">Guard</label>
                            <input type="text" name="guard_name" disabled required value="{{$permission->guard_name}}" class="form-control" id="guard" placeholder="Enter Permission Name">
                        </div>
                        <div class="form-group">
                            <label for="group">Group</label>
                            <input type="text" name="group_name" disabled required value="{{$permission->group_name}}" class="form-control" id="group" placeholder="Enter Permission Group Name">
                        </div>
                        <a href="{{route('admin.permissions.index')}}" class="btn btn-primary" type="submit">Go Back</a>

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
