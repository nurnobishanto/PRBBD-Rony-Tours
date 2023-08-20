@extends('layouts.frontend')
@section('main_content')
    <section >
        <div style="height: 100px"></div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12  mb-3">
                    <div class="card">
                        <h5 class="card-header">Available Balance and Payment option</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="card-title">{{ $balance = auth('web')->user()->balance}} BDT</h2>
                                    @if($order->booking_id)
                                        <a href="{{route('order_refresh',['id'=>$order->id])}}" class="btn btn-info">Refresh</a>
                                        <a href="{{route('download_booking_invoice',['id'=>$order->id])}}" class="btn btn-success">INVOICE</a>
                                    @endif
                                    @if($order->booking_status == 'Booked' && $order->payment_status != 'paid')
                                        <a href="{{route('cancel_ticket',['id'=>$order->id])}}" class="btn btn-danger">Cancel</a>
                                    @endif
                                    @if($order->booking_status == 'Booked' && $order->payment_status == 'paid')
                                        @if(strtotime($order->last_ticket_date) >= time())
                                        <a href="{{route('ticket_issue',['id'=>$order->id])}}" class="btn btn-danger">Ticket issue</a>
                                        @else
                                            <h4 class="text-danger text-bold">Time to purchase tickets has expired</h4>
                                            <span>Contact our <a href="{{route('user.support')}}">support</a>  for refunds or Call us <a href="tel:{{getSetting('support_phone')}}">{{getSetting('support_phone')}}</a> </span>
                                        @endif
                                    @endif

                                </div>
                                @if($order->payment_status != 'paid' )
                                <div class="col-md-6">
                                    <form action="{{route('order_pay',['id'=>$order->id])}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="payment">Payment Method:</label><br>
                                            @if($order->booking_id == null && $order->can_hold && $order->status == 'pending')
                                                <input type="radio" id="book_hold"  name="payment" value="book_hold">
                                            @else
                                                <input type="radio" id="book_hold" disabled>
                                            @endif
                                            <label for="book_hold">Book & Hold</label><br>

                                            @if($order->payment_status == 'pending' && $balance >= $order->net_pay_amount)
                                                <input type="radio" id="fund" name="payment" value="fund">
                                            @else
                                                <input type="radio" id="fund"  disabled >
                                            @endif
                                            <label for="fund">Pay By Fund ( BDT {{ number_format($order->net_pay_amount,2)}} ) will deduct from your fund </label><br>
                                            @if($order->payment_status != 'paid' )
                                                <input type="radio" id="AMAR PAY" name="payment" value="AMAR PAY" >
                                            @else
                                                <input type="radio" id="AMAR PAY" name="payment" value="AMAR PAY"  disabled >
                                            @endif

                                            @if(auth('web')->user()->user_type  == 1)
                                            <label for="AMAR PAY">Pay Via AMAR PAY ( BDT {{ number_format($order->total_ws_amount,2)}} ) (Merchant Fee Apply) </label><br>
                                            @else
                                            <label for="AMAR PAY">Pay Via AMAR PAY ( BDT {{ number_format($order->net_pay_amount,2)}} ) (Merchant Fee Apply) </label><br>
                                            @endif
                                        </div>
                                        <input type="submit" value="Confirm" class="btn btn-warning">
                                    </form>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6  mb-3">
                    <div class="card">
                        <h5 class="card-header">Order Details ( {{$order->is_refundable?'Refundable':'Non Refundable'}} )</h5>
                        <div class="card-body table-responsive">
                            <div class="table-responsive border">
                                <table class="table table-borderless table-striped">
                                    <tr>
                                        <th>Booking ID</th>
                                        <td>{{$order->booking_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Status</th>
                                        <td>{{$order->booking_status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Time</th>
                                        <td>{{($order->booking_time)?date('d M Y, h:m A',strtotime($order->booking_time)):'---'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Ticket Date</th>
                                        <td>{{($order->last_ticket_date)?date('d M Y, h:m A',strtotime($order->last_ticket_date)):'---'}}</td>
                                    </tr>

                                    <tr>
                                        <th>Booking Expired</th>
                                        <td>{{($order->last_ticket_date)?date('d M Y, h:m A',strtotime($order->last_ticket_date)):'---'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Fare Type / Hold Allow</th>
                                        <td>{{$order->fare_type}}/{{$order->can_hold?'YES':'NO';}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6  mb-3">
                    <div class="card">
                        <h5 class="card-header">Payment Details</h5>
                        <div class="card-body table-responsive">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Order ID</th>
                                        <td class="text-uppercase">{{$order->trxid}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>{{$order->total_ws_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount Amount</th>
                                        <td>{{$order->discount_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Net Pay</th>
                                        <td>{{$order->net_pay_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Paid Amount</th>
                                        <td>{{$order->paid_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status & Method</th>
                                        <td>{{$order->payment_status}} - {{$order->payment_method}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12  mb-3">
                    <div class="card">
                        <h5 class="card-header">Passengers Details</h5>
                        @if ($errors->any())
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{$error}}</li>
                            @endforeach
                            </ul>
                        @endif
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Full Name</th>
                                    <th>PNR</th>
                                    <th>Type</th>
                                    <th>Gender</th>
                                    <th>Date of birth</th>
                                    <th>Passport No @if($order->passport_mandatory)<i class="fas fa-star text-danger"></i>@endif</th>
                                    <th>Passport Expired</th>
                                    <th>Ticket</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $p = 0;?>
                                @foreach($order->passengers as $passenger)
                                    <tr>
                                        <td>{{++$p}}</td>
                                        <td>{{$passenger->title.' '.$passenger->first_name.' '.$passenger->last_name}}
                                        @if($order->status == 'pending')
                                            <button class="badge btn-success  small" onclick="openPassenger({{$passenger}})"> <i class="fas fa-pen"></i></button>
                                        @endif
                                        </td>
                                        <td>{{$passenger->pax_index}}</td>
                                        <td>{{$passenger->pax_type}}</td>
                                        <td>{{$passenger->gender}}</td>
                                        <td>{{date('d M, Y',strtotime($passenger->dob)) }}</td>
                                        <td>{{$passenger->passport_no}}</td>
                                        <td>{{$passenger->passport_expire_date}}</td>
{{--                                            <?php $data = json_decode($passenger->ticket, true);?>--}}
{{--                                        <td>@if(!empty($data) && $passenger->pax_index){{$data[0]['TicketNo']}} <a href="{{route('downloadTicket',['id' => $order->id,'ticket' =>$data[0]['TicketNo'],  'pax_index' => $passenger->pax_index])}}" class="badge btn-primary"> <i class="fas fa-download"> </i> </a>@endif</td>--}}
{{--                                        --}}
                                        <td><a href="{{route('ticket',['id'=>$order->id,'p'=>$passenger->id])}}" class="badge btn-primary"><i class="fas fa-download"> </i></a> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Journey Details</h5>
                        <div class="card-body">
                            <?php $t = 0;?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>From</th>
                                        <th width="120px">Departure</th>
                                        <th>To</th>
                                        <th width="120px">Arrival</th>
                                        <th>Carrier</th>
                                        <th>Duration</th>
                                        <th>Cabin</th>
                                        <th>Airline</th>
                                        <th>Group </th>
                                        <th>Trip</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->travels as $travel)
                                        <tr>
                                            <td>{{++$t}}</td>
                                            <td>{{$travel->from}}</td>
                                            <td>{{date('d M, Y H:m A',strtotime( $travel->departure_time))}}</td>
                                            <td>{{$travel->to}}</td>
                                            <td>{{date('d M, Y H:m A',strtotime( $travel->arrival_time))}}</td>
                                            <td>{{$travel->carrier}}</td>
                                            <td>{{convertMinutesToDuration($travel->duration)}}</td>
                                            <td>{{$travel->cabin_class}}</td>
                                            <td>{{$travel->airline_name.'-'.$travel->airline_code}}</td>
                                            <td>{{$travel->trip_group}}</td>
                                            <td>{{$travel->trip_indicator}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>From</th>
                                        <th width="120px">Departure</th>
                                        <th>To</th>
                                        <th width="120px">Arrival</th>
                                        <th>Carrier</th>
                                        <th>Duration</th>
                                        <th>Cabin</th>
                                        <th>Airline</th>
                                        <th>Group </th>
                                        <th>Trip</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- The Modal -->
    <div id="editPassenger" class="modal">
        <!-- Modal content -->
        <div class="modal-content">

            <div class="card card-primary">

                <form action="{{route('passenger_update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card-header">
                    <input id="pid" name="pid" class="d-none">
                    <input id="pax_type" name="pax_type" class="d-none">
                    <input id="passport_mandatory" name="passport_mandatory" class="d-none">
                    <h5 class="card-title">Update Passenger Data <span class="bg-info p-2 rounded" id="paxInfo"></span> </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <select id="title" name="title" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input id="first_name" name="first_name" class="form-control" placeholder="Enter First name">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-4">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input id="last_name"  name="last_name" class="form-control" placeholder="Enter Last name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input  type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input  type="tel" name="phone" class="form-control" id="phone" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="DateOfBirth">Date of birth</label>
                                <input   type="date"  class="form-control" name="DateOfBirth" id="DateOfBirth" placeholder="Enter date of birth">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="passport_no">Passport no</label>
                                <input type="text"  class="form-control" name="passport_no" id="passport_no" placeholder="Enter passport no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="passport_expire_date">Passport Expire date</label>
                                <input  type="date"  class="form-control" name="passport_expire_date" id="passport_expire_date" placeholder="Enter passport expire">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select   class="form-control" name="gender" id="gender">
                                    <option value="">Select Option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input  type="text"  class="form-control" name="address" id="address" placeholder="Enter address">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-success" value="Save Changes">
                    <input id="close" class="btn btn-secondary" value="Cancel">
                </div>
                </form>
            </div>
        </div>


    </div>
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */

            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;

        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function openPassenger(param) {
            modal.style.display = "block";
           var title = document.getElementById('title');
           title.innerHTML = "";
            if (param['pax_type'] === 'Adult'){
                var optMr = document.createElement('option');
                var optMs = document.createElement('option');
                var optMrs = document.createElement('option');
                optMr.value = 'Mr';optMs.value = 'Ms';optMrs.value = 'Mrs';
                optMr.text = "Mr";optMs.text = "Ms";optMrs.text = "Mrs";
                title.appendChild(optMr); title.appendChild(optMs);title.appendChild(optMrs);

            }else {
                var optMstr = document.createElement('option');
                var optMiss = document.createElement('option');
                optMstr.value = 'Mstr';optMiss.value = 'Miss';
                optMstr.text = "Mstr";optMiss.text = "Miss";
                title.appendChild(optMstr);title.appendChild(optMiss);

            }
            console.log(param);
            document.getElementById("first_name").value = param['first_name'];
            document.getElementById("pid").value = param['id'];
            document.getElementById("last_name").value = param['last_name'];
            document.getElementById("email").value = param['email'];
            document.getElementById("phone").value = param['contact_number'];
            document.getElementById("DateOfBirth").value = param['dob'];
            document.getElementById("passport_no").value = param['passport_no'];
            document.getElementById("passport_expire_date").value = param['passport_expire_date'];
            document.getElementById("address").value = param['address'];
            document.getElementById("gender").value = param['gender'];
            document.getElementById("paxInfo").innerHTML = param['pax_type'];
            document.getElementById("pax_type").value = param['pax_type'];
            document.getElementById("passport_mandatory").value = param['passport_mandatory'];

        }
        var modal = document.getElementById("editPassenger");
        var close = document.getElementById("close");


        close.onclick = function() {
            modal.style.display = "none";
        }
      //  When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
