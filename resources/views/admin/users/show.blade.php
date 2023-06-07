@extends('adminlte::page')

@section('title', 'User Information')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Information for - {{$user->name}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">View user</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"  class="form-control" disabled value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"  class="form-control" disabled value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->name }}" {{$country->name == $user->country ? 'selected' : '' }} disabled>{{ $country->name }}</option>
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
                                                    <option value="{{ $country->phoneCode }}" disabled>{{ $country->phoneCode }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-9">
                                            <input class="form-control" type="text"  readonly value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" readonly value="{{ $user->company_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_no">Passport No</label>
                                    <input type="text" class="form-control" readonly value="{{ $user->passport_no }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport_exp">Passport Exp</label>
                                    <input type="date" class="form-control" readonly value="{{ $user->passport_exp }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text"  class="form-control" readonly value="{{ $user->address }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="post_code">Post Code</label>
                                    <input type="text"  class="form-control" readonly value="{{ $user->post_code }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select class="form-control">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->code }}" {{ $country->code == $user->city ? 'selected' : '' }} disabled>{{ $country->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_zone">Time Zone</label>
                                    <input type="text"  class="form-control" readonly value="{{ $user->time_zone }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="balance">balance</label>
                                    <input type="text"  class="form-control" readonly value="{{ $user->balance }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">Date Of Birth</label>
                                    <input type="date"  class="form-control" readonly value="{{ $user->dob }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control">
                                        <option value="0" {{ 0 == $user->is_active ? 'selected' : '' }} disabled>Deactivate</option>
                                        <option value="1" {{ 1 == $user->is_active ? 'selected' : '' }} disabled>Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control">
                                        <option value="0" {{ 0 == $user->gender ? 'selected' : '' }} disabled>Male</option>
                                        <option value="1" {{ 1 == $user->gender ? 'selected' : '' }} disabled>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">User Type</label>
                                    <select class="form-control">
                                        <option value="0" {{ 0 == $user->user_type ? 'selected' : '' }} disabled>General</option>
                                        <option value="1" {{ 1 == $user->user_type ? 'selected' : '' }} disabled>Agency</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <br>
                                    <img src="{{getImageUrl($user->image)}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_logo">Company Logo</label>
                                    <br>
                                    <img src="{{getImageUrl($user->company_logo)}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="trade_licence">Trade Licence</label>
                                    <br>
                                    <img src="{{getImageUrl($user->company_logo)}}" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passport">Passport</label>
                                    <br>
                                    <img src="{{getImageUrl($user->company_logo)}}" alt="">
                                </div>
                            </div>
                        </div>
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
