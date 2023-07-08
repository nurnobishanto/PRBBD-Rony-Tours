<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>




</head>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <!-- First Name -->
                                <div class="form-group">
                                    <label for="first_name" class="form-label">{{ __('First Name') }} <span class="text-danger">*</span> </label>
                                    <input id="first_name" class="form-control" type="text" name="first_name"
                                           value="{{ old('first_name') }}" required autofocus placeholder="Enter First name">
                                    @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--Last Name -->
                                <div class="form-group">
                                    <label for="last_name" class="form-label">{{ __('Last name') }} <span class="text-danger">*</span> </label>
                                    <input id="last_name" class="form-control" type="text" name="last_name"
                                           value="{{ old('last_name') }}" required autofocus placeholder="Enter Last name">
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Gender-->
                                <div class="form-group">
                                    <label for="gender" class="form-label">{{ __('Gender') }} <span class="text-danger">*</span> </label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                    </select>
                                    @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Date of birth-->
                                <div class="form-group">
                                    <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span> </label>
                                    <input id="dob" class="form-control" type="text" name="dob">
                                    @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span> </label>
                                    <input id="email" class="form-control" type="email" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone" class="form-label">{{ __('Phone Number') }} <span class="text-danger">*</span> </label>
                                    <input id="phone" class="form-control" type="text" name="phone"
                                           value="{{ old('phone') }}" required autocomplete="phone" placeholder="Enter Phone number">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input name="time_zone" id="time_zone" class="d-none">
                                    <input name="phone_code" id="phone_code" class="d-none">
                                    <input name="country_code" id="country_code" class="d-none">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Select Country and Country Code -->
                                <div class="form-group">
                                    <label for="country" class="form-label">Country</label>
                                    <select id="country" class="form-control" name="country" onchange="handleCountryChange(this)">
                                        <option value="">Select Country</option>
                                        <!-- Loop through JSON data and generate options -->
                                        @foreach ($countries as $country)
                                            <option value="{{$country->name}}" data-phoneCode="{{$country->phoneCode}}" data-timezone="{{$country->time_zone}}">{{ $country->name }} ({{ $country->phoneCode }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- City -->
                                <div class="form-group">
                                    <label for="city" class="form-label">{{ __('City') }} <span class="text-danger">*</span> </label>
                                    <input id="city" class="form-control" type="text" name="city"
                                           value="{{ old('city') }}" required autocomplete="city" placeholder="Enter city ">
                                    @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Post Code -->
                                <div class="form-group">
                                    <label for="post_code" class="form-label">{{ __('Post Code') }} <span class="text-danger">*</span> </label>
                                    <input id="post_code" class="form-control" type="text" name="post_code"
                                           value="{{ old('post_code') }}" required autocomplete="post_code" placeholder="Enter Post Code ">
                                    @error('post_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address" class="form-label">{{ __('Address') }} <span class="text-danger">*</span> </label>
                                    <input id="address" class="form-control" type="text" name="address"
                                           value="{{ old('address') }}" required autocomplete="address" placeholder="Enter address ">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span> </label>
                                    <input id="password" class="form-control" type="password" name="password" placeholder="Enter Password"
                                           required autocomplete="new-password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation"
                                           class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span> </label>
                                    <input id="password_confirmation" class="form-control" type="password"
                                           name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <a class="text-sm text-gray-600"
                                       href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function handleCountryChange(selectElement) {
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var countryCode = selectedOption.value;
        var phoneCode = selectedOption.getAttribute('data-phoneCode');
        var timeZone = selectedOption.getAttribute('data-timezone');
        $('#time_zone').val(timeZone);
        $('#country_code').val(countryCode);
        $('#phone_code').val(phoneCode);

    }
    $(document).ready(function() {

        $("#dob").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:{{ date('Y') }}",
        });
    });
</script>
</body>

</html>
