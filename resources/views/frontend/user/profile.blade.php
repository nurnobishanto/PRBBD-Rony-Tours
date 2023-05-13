@extends('layouts.frontend')
@section('main_content')
    <!-- Dashboard Area -->

    <section id="dashboard_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('frontend.user.partial.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="dashboard_common_table">
                        <h3>My Profile</h3>

                        <div class="profile_update_form">
                            <form action="{{ route('user.profile.update', $user->id) }}" id="profile_form_area" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="f-name">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="l-name">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="mail-address">Country</label>
                                            <select name="country" id="country" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->name }}" {{$country->name == $user->country ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <select name="phoneCode" id="phoneCode" class="form-control">
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->phoneCode }}">{{ $country->phoneCode }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-8">
                                                    <input type="text" class="form-control" name="phone"
                                                    value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" class="form-control" name="company_name" value="{{ $user->company_name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="passport_no">Passport No</label>
                                            <input type="text" class="form-control" name="passport_no" value="{{ $user->passport_no }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="passport_exp">Passport Exp</label>
                                            <input type="date" class="form-control" name="passport_exp" value="{{ $user->passport_exp }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="post_code">Post Code</label>
                                            <input type="text" class="form-control" name="post_code" value="{{ $user->post_code }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" value="{{ $user->city }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="time_zone">Time Zone</label>
                                            <input type="text" class="form-control" name="time_zone" value="{{ $user->time_zone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" value="{{ $user->dob }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <select name="is_active" id="status" class="form-control">
                                                <option value="0" {{ 0 == $user->is_active ? 'selected' : '' }}>Deactivate</option>
                                                <option value="1" {{ 1 == $user->is_active ? 'selected' : '' }}>Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="0" {{ 0 == $user->gender ? 'selected' : '' }}>Male</option>
                                                <option value="1" {{ 1 == $user->gender ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" id="status" class="form-control">
                                                <option value="0" {{ 0 == $user->user_type ? 'selected' : '' }}>General</option>
                                                <option value="1" {{ 1 == $user->user_type ? 'selected' : '' }}>Agency</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn_theme btn_md w-50" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dashboard_common_table" style="margin-top: 50px">
                        <h3>Change Password</h3>

                        <div class="profile_update_form">
                            <form action="{{ route('user.password.update', $user->id) }}" id="profile_form_area" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="current_password">Current Password</label>
                                            <input type="text" class="form-control" name="current_password" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="text" class="form-control" name="password" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="text" class="form-control" name="confirm_password" placeholder="Re Password">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn_theme btn_md w-40" type="submit">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
