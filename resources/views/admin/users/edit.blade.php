@extends('adminlte::page')

@section('title', 'Update user')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Update user - {{$user->name}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Update user</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.users.update',['user'=>$user->id])}}" method="POST" enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input name="username" value="{{$user->username}}" type="text"  class="form-control" id="username" placeholder="Enter user Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" value="{{$user->name}}" type="text"  class="form-control" id="name" placeholder="Enter user full Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" value="{{$user->email}}"  class="form-control" id="email" placeholder="Enter user email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input name="mobile" value="{{$user->mobile}}" type="text"  class="form-control" id="mobile" placeholder="Enter user mobile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="photo" type="file" class="custom-file-input" id="photo">
                                            <label class="custom-file-label" for="photo">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="is_active" id="status" class="form-control">
                                        <option value="0" @if(!$user->is_active) selected @endif>Deactivate</option>
                                        <option value="1" @if($user->is_active) selected @endif>Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input name="password" type="password"  class="form-control" id="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input name="confirm_password" type="password"  class="form-control" id="confirm_password" placeholder="Enter Confirm Password">
                                </div>
                            </div>
                        </div>


                        @can('user.update')
                            <button class="btn btn-success" type="submit">Update</button>
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
