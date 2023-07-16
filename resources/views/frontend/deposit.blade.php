<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">


    <title>{{getSetting('site_title')}} - Deposit</title>
</head>
<body class="" style="background-color: #F0F8FF">

<div class="container">
    <div class="row justify-content-center">
        <!-- Image and text -->
        <nav class="navbar navbar-light bg-light shadow">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset(getSetting('site_logo'))}}"  height="90" class="d-inline-block align-top" alt="{{getSetting('site_title')}}">

            </a>
            <h3>Payment</h3>
        </nav>
        <div class="col-md-12 my-3">
            <button id="btn_bank_list" class="btn btn-primary">Bank List</button>
            <button id="btn_deposit" class="btn btn-primary">Bank Deposit</button>
            <button id="btn_online_payment" class="btn btn-success">Online Payment</button>
            <button id="btn_payment_status" class="btn btn-info">Payment Status</button>
            <a href="{{route('deposit')}}"  class="btn btn-secondary">Refresh</a>
        </div>
        <div class="col-md-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div id="bank_list" class="col-md-12 my-2">
            <div class="card card-secondary shadow">
                <div class="card-header">
                    <h5 class="card-title">All Bank List</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($banks as $bank)
                        <div class="col-md-4 ">
                            <div class="card">
                                <div class="card-body">
                                    <span>Bank Name : <strong>{{$bank->bank_name}}</strong></span><br>
                                    <span>Account Name : <strong>{{$bank->account_name}}</strong></span><br>
                                    <span>Account Number : <strong>{{$bank->account_no}}</strong></span><br>
                                    @if($bank->operator == 1)
                                        <span>Routing Number : <strong>{{$bank->routing_no}}</strong></span><br>
                                        <span>Branch : <strong>{{$bank->branch_name}}</strong></span><br>
                                        <span>Swift Code : <strong>{{$bank->swift_code}}</strong></span><br>
                                    @elseif($bank->operator == 2)
                                        <span>Account Type : <strong>{{($bank->operator_type == 1)?'Personal':'Agent'}}</strong></span><br>
                                    @endif
                                    <span>Charge Info : <strong>{{$bank->charge_info}}</strong></span><br>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="deposit" class="col-md-12 my-2 d-none">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-secondary shadow">
                        <div class="card-header">
                            <h5 class="card-title">Bank Deposit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('bank_deposit')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="bank_id">Select Bank <span class="text-danger">*</span></label>
                                    <select id="bank_id" class="form-control" name="bank_id">
                                        <option onclick="selectBank('')" value="">Select Bank</option>
                                        @foreach($banks as $bank)
                                            <option onclick="selectBank({{$bank}})" value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="bank_information" class="py-2">

                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="amount">Amount: <span class="text-danger">*</span></label>
                                    <input type="number" id="amount" name="amount" placeholder="Enter amount" min="20" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="service">Service: <span class="text-danger">*</span></label>
                                    <select id="service" name="service" class="form-control" >
                                        <option value="">Select a service</option>
                                        <option value="Add Advance Balance">Add Advance Balance</option>
                                        <option value="Advance For Ticket Purchase">Advance For Ticket Purchase</option>
                                        <option value="Advance for Hotel Booking">Advance for Hotel Booking</option>
                                        <option value="Re-Issue Charge">Re-Issue Charge</option>
                                        <option value="Cancellation Charge">Cancellation Charge</option>
                                        <option value="Wheelchair Add">Wheelchair Add</option>
                                        <option value="Meal Add">Meal Add</option>
                                        <option value="Seat Assign">Seat Assign</option>
                                        <option value="Tour Package">Tour Package</option>
                                        <option value="Umrah Package">Umrah Package</option>
                                        <option value="Visa Processing Charge">Visa Processing Charge</option>
                                        <option value="Due Bill&nbsp;Paymentc">Due Bill&nbsp;Payment</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="trxid">Transaction ID <span class="text-danger">*</span></label>
                                    <input name="trxid" type="text" id="trxid" value="{{uniqid()}}" class="form-control" placeholder="Enter Transaction ID">
                                </div>
                                <div class="form-group">
                                    <label for="slip">Select Slip <span class="text-danger">*</span></label>
                                    <input name="slip" id="slip" type="file" class="form-control" onchange="previewImage(event)" accept="image/*">
                                </div>
                                <div class="form-group mt-2">
                                    <label>
                                        <input type="checkbox" id="onlinePaymentFormTerms" required name="terms" > I agree to the terms and conditions
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary my-3">Deposit Request</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <p>Slip/Image Preview</p>
                        <img id="slipPreview" class="img-fluid">
                    </div>
                </div>
            </div>

        </div>
        <div id="online_payment" class="col-md-4 my-2 d-none">
            <div class="card card-secondary shadow">
                <div class="card-header">
                    <h5 class="card-title">Online Payment</h5>
                </div>
                <div class="card-body">
                    <div class="my-3">
                        <form id="onlinePaymentForm" method="POST" action="{{route('user.add_balance_SSLCOMMERZ')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="amount">Amount: <span class="text-danger">*</span></label>
                                        <input type="number" id="amount" name="amount" placeholder="Enter amount" min="20" class="form-control">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="service">Service: <span class="text-danger">*</span></label>
                                        <select id="service" name="service" class="form-control" >
                                            <option value="">Select a service</option>
                                            <option value="Add Advance Balance">Add Advance Balance</option>
                                            <option value="Advance For Ticket Purchase">Advance For Ticket Purchase</option>
                                            <option value="Advance for Hotel Booking">Advance for Hotel Booking</option>
                                            <option value="Re-Issue Charge">Re-Issue Charge</option>
                                            <option value="Cancellation Charge">Cancellation Charge</option>
                                            <option value="Wheelchair Add">Wheelchair Add</option>
                                            <option value="Meal Add">Meal Add</option>
                                            <option value="Seat Assign">Seat Assign</option>
                                            <option value="Tour Package">Tour Package</option>
                                            <option value="Umrah Package">Umrah Package</option>
                                            <option value="Visa Processing Charge">Visa Processing Charge</option>
                                            <option value="Due Bill&nbsp;Paymentc">Due Bill&nbsp;Payment</option>
                                        </select>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label>
                                            <input type="checkbox" id="onlinePaymentFormTerms" required name="terms" > I agree to the terms and conditions
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-success my-3">Pay Via SSLCOMMERZ</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="payment_status" class="col-md-12 my-2 d-none">
            <div class="card card-secondary shadow">
                <div class="card-header">
                    <h5 class="card-title">Payment History</h5>
                </div>
                <div class="card-body">
                    <table id="paymentHistory" class="table table-responsive">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Trx. ID</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Slip</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl = 1;?>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$deposit->trxid}}</td>
                                <td>{{$deposit->amount}}</td>
                                <td>{{$deposit->paid_by}}</td>
                                <td>{{$deposit->note}}</td>
                                <th class="text-uppercase font-weight-bolder
                                @if($deposit->status == 'success')
                                text-success
                                @elseif($deposit->status == 'pending')
                                text-info
                                @elseif($deposit->status == 'failed')
                                text-danger
                                @elseif($deposit->status == 'canceled')
                                text-danger
                                @elseif($deposit->status == 'rejected')
                                text-danger
                                @endif
                                ">{{$deposit->status}}</th>
                                <td>
                                    @if($deposit->slip)
                                    <button onclick="previewSlip('{{asset('images/'.$deposit->slip)}}')" class="btn btn-sm btn-info">Show</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer fixed-bottom text-center bg-dark text-light p-2">
    <div class="container">
        <span class="text-decoration-none"> &copy; {{date('Y')}} {{getSetting('site_title')}}. All rights reserved.</span>
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img id="imageModaPreviewImage" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    function previewSlip(param){
        $("#imageModaPreviewImage").attr("src", param);
        // Show the modal
        $("#imageModal").modal("show");
    }
    function selectBank(param){
        console.log('Print :' +param);
        if (param===''){
            $('#bank_information').html('<span class="text-danger">Select Bank is required</span>');
        }else {
            $('#bank_information').empty();
            let html = '<strong>Bank Name :	</strong>' + param['bank_name'] + '<br>';
            html+= '<strong>Account Name : </strong>'+param['account_name']+'<br>';
            html+= '<strong>Account Number : </strong>'+param['account_no']+'<br>';
            if(param['operator'] === 1 ){
                html+= '<strong>Routing Number : </strong>'+param['routing_no']+'<br>';
                html+= '<strong>Account Branch : </strong>'+param['branch_name']+'<br>';
                html+= '<strong>Swift Code : </strong>'+param['swift_code']+'<br>';
            }else if(param['operator'] === 2){
                if (param['operator_type'] === 1){
                    html+= '<strong>Account Type : </strong>Personal<br>';
                }else {
                    html+= '<strong>Account Type : </strong>Agent<br>';
                }

            }
            html+= '<strong>Charge Info : </strong>'+param['charge_info']+'<br>';
            $('#bank_information').html(html);

        }

    }
    $(document).ready(function (){
        $('#btn_bank_list').click(function (){
            $('#btn_bank_list').addClass('active');
            $('#btn_deposit').removeClass('active');
            $('#btn_online_payment').removeClass('active');
            $('#btn_payment_status').removeClass('active');

            $('#bank_list').removeClass('d-none');
            $('#deposit').addClass('d-none');
            $('#online_payment').addClass('d-none');
            $('#payment_status').addClass('d-none');
        });

        $('#btn_deposit').click(function (){
            $('#btn_bank_list').removeClass('active');
            $('#btn_deposit').addClass('active');
            $('#btn_online_payment').removeClass('active');
            $('#btn_payment_status').removeClass('active');

            $('#bank_list').addClass('d-none');
            $('#deposit').removeClass('d-none');
            $('#online_payment').addClass('d-none');
            $('#payment_status').addClass('d-none');
        });
        $('#btn_online_payment').click(function (){
            $('#btn_bank_list').removeClass('active');
            $('#btn_deposit').removeClass('active');
            $('#btn_online_payment').addClass('active');
            $('#btn_payment_status').removeClass('active');

            $('#bank_list').addClass('d-none');
            $('#deposit').addClass('d-none');
            $('#online_payment').removeClass('d-none');
            $('#payment_status').addClass('d-none');
        });
        $('#btn_payment_status').click(function (){
            $('#btn_bank_list').removeClass('active');
            $('#btn_deposit').removeClass('active');
            $('#btn_online_payment').removeClass('active');
            $('#btn_payment_status').addClass('active');

            $('#bank_list').addClass('d-none');
            $('#deposit').addClass('d-none');
            $('#online_payment').addClass('d-none');
            $('#payment_status').removeClass('d-none');
        });
        $('#paymentHistory').DataTable();
    })
</script>
<script>
    function previewImage(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('slipPreview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>

