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
                <div class="card-header">Manually Deposit ({{$bank->bank_name}} - {{($bank->operator==1)?'Bank':'Mobile Bank'}})</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.bank_deposit_submit',['id'=>$bank->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row justify-content-between">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Operator</th>
                                        <td>{{($bank->operator ==1)?'Bank':'Mobile Banking'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Bank Name</th>
                                        <td>{{$bank->bank_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Name</th>
                                        <td>{{$bank->account_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Number</th>
                                        <td>{{$bank->account_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>Branch Name</th>
                                        <td>{{$bank->branch_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Swift Code</th>
                                        <td>{{$bank->swift_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Routing No</th>
                                        <td>{{$bank->routing_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>Charge Info</th>
                                        <td>{{$bank->charge_info}}</td>
                                    </tr>
                                    <tr>
                                        <th>Operator Type</th>
                                        <td>{{($bank->operator_type == 1)?'Personal':'Agent'}}</td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-md-6">
                                <!-- Amount -->
                                <div class="form-group">
                                    <label for="amount" class="form-label">{{ __('Amount') }} <span class="text-danger">*</span> </label>
                                    <input id="amount" class="form-control" type="number" name="amount" min="100"
                                           value="{{ old('amount') }}" required autofocus placeholder="Enter Amount">
                                    @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- trxid -->
                                <div class="form-group">
                                    <label for="trxid" class="form-label">{{ __('Trans. ID') }} <span class="text-danger">*</span> </label>
                                    <input id="trxid" class="form-control" type="text" name="trxid"
                                           value="{{ old('trxid') }}" required autofocus placeholder="Enter trxid">
                                    @error('trxid')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Slip -->
                                <div class="form-group">
                                    <label for="slip" class="form-label">{{ __('Slip/Screenshot') }} <span class="text-danger">*</span> </label>
                                    <input id="slip" class="form-control" type="file" name="slip"
                                              placeholder="Select slip">
                                    @error('slip')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Note -->
                                <div class="form-group">
                                    <label for="note" class="form-label">{{ __('Note') }} </label>
                                    <input id="note" class="form-control" type="text" name="note"
                                           value="{{ old('note') }}"  autofocus placeholder="Enter note">
                                    @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
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
