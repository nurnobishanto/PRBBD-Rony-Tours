@extends('adminlte::page')

@section('title', 'Edit Passenger')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Passenger - {{$passenger->name}}</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.passengers.index')}}">Passenger</a></li>
                <li class="breadcrumb-item active">Edit Passenger</li>
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

                    <form action="{{ route('admin.passengers.update', $passenger->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>User</label>
                                <select class="form-control select2 js-example-basic-single" name="user_id" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $passenger->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" required class="form-control" id="name"
                                    value="{{ $passenger->name }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" required class="form-control" id="email"
                                    value="{{ $passenger->email }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input name="phone" type="number" required class="form-control" id="phone"
                                    value="{{ $passenger->phone }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="age">Age</label>
                                <input name="age" type="number" required class="form-control" id="age"
                                    value="{{ $passenger->age }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="1" {{ $passenger->gender == 1 ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ $passenger->gender == 2 ? 'selected' : '' }}>Female</option>
                                    <option value="3" {{ $passenger->gender == 3 ? 'selected' : '' }}>Other</option>
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
@section('toastr',true)
@section('css')

@stop

@section('js')

@include('admin.includes.image_preview')

@stop
