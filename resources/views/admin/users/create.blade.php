@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create User</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
                <li class="breadcrumb-item active">Create User</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
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
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" type="text"  class="form-control" id="first_name" placeholder="Enter user first Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" type="text"  class="form-control" id="last_name" placeholder="Enter user last Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="email"  class="form-control" id="email" placeholder="Enter user email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Code</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <select name="phoneCode" id="phoneCode" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->phoneCode }}">{{ $country->phoneCode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="phone" placeholder="1334584850" maxlength="10" pattern="\d{10}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input name="company_name" type="text"  class="form-control" id="company_name" placeholder="Enter user company_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_no">Passport No</label>
                                    <input name="passport_no" type="text"  class="form-control" id="passport_no" placeholder="Enter user passport_no">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_exp">Passport Exp</label>
                                    <input name="passport_exp" type="date"  class="form-control" id="passport_exp" placeholder="Enter user passport_exp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" type="text"  class="form-control" id="address" placeholder="Enter user address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="post_code">Post Code</label>
                                    <input name="post_code" type="text"  class="form-control" id="post_code" placeholder="Enter user post_code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input name="city" type="text"  class="form-control" id="city" placeholder="Enter city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_zone">Time Zone</label>
                                    <select name="time_zone" id="time_zone" class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->time_zone }}">{{ $country->time_zone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="balance">Balance</label>
                                    <input name="balance" type="text"  class="form-control" id="balance" placeholder="Enter user balance">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">Date Of Birth</label>
                                    <input name="dob" type="date"  class="form-control" id="dob" placeholder="Enter user dob">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="is_active" id="status" class="form-control">
                                        <option value="0">Deactivate</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Gender</label>
                                    <select name="gender" id="status" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">User Type</label>
                                    <select name="user_type" id="status" class="form-control">
                                        <option value="0">General</option>
                                        <option value="1">Agent</option>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_logo">Company Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="company_logo" class="custom-file-input" id="company_logo">
                                            <label class="custom-file-label" for="company_logo">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trade_licence">Trade Licence</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="trade_licence" class="custom-file-input" id="trade_licence">
                                            <label class="custom-file-label" for="trade_licence">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport">Passport</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="passport" class="custom-file-input" id="passport">
                                            <label class="custom-file-label" for="passport">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         @can('user.create')
                            <button class="btn btn-success" type="submit">Create</button>
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
