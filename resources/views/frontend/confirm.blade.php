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
                                        <a href="{{route('ticket_issue',['id'=>$order->id])}}" class="btn btn-danger">Ticket issue</a>
                                    @endif
                                </div>
                                @if($order->payment_status == 'pending' || $order->status == 'hold' || $order->status == null || $order->status == 'pending')
                                <div class="col-md-6">
                                    <form action="{{route('order_pay',['id'=>$order->id])}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="payment">Payment Method:</label><br>
                                            <input type="radio" id="book_hold" @if($order->booking_expired != null || $order->status !='pending'  ) disabled @endif name="payment" value="book_hold">
                                            <label for="book_hold">Book & Hold</label><br>
                                            <input type="radio" id="fund" name="payment" @if($order->payment_status == 'paid' || $balance < $order->net_pay_amount || $order->paid_amount == $order->net_pay_amount) disabled @endif value="fund">
                                            <label for="fund">Pay By Fund ( BDT {{ number_format($order->net_pay_amount,2)}} ) will deduct from your fund </label><br>
                                            <input type="radio" id="SSLCOMMERZ" name="payment" value="SSLCOMMERZ" @if($order->payment_status == 'paid' || $order->paid_amount == $order->net_pay_amount) disabled @endif>
                                            @if(auth('web')->user()->user_type  == 1)
                                            <label for="SSLCOMMERZ">Pay Via SSLCOMMERZ ( BDT {{ number_format($order->total_ws_amount,2)}} ) (Merchant Fee Apply) </label><br>
                                            @else
                                            <label for="SSLCOMMERZ">Pay Via SSLCOMMERZ ( BDT {{ number_format($order->net_pay_amount,2)}} ) (Merchant Fee Apply) </label><br>
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
                        <h5 class="card-header">Order Details</h5>
                        <div class="card-body table-responsive">
                            <div class="table-responsive border">
                                <table class="table table-borderless table-striped">
                                    <tr>
                                        <th>Airline PNR</th>
                                        <td>{{$order->airline_pnr}}</td>
                                    </tr>
                                    <tr>
                                        <th>GDS PNR</th>
                                        <td>{{$order->gds_pnr}}</td>
                                    </tr>
                                    <tr>
                                        <th>PNR Status</th>
                                        <td>{{$order->pnr_status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking ID</th>
                                        <td>{{$order->booking_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Status</th>
                                        <td>{{$order->booking_status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Ticket Number</th>
                                        <td>{{$order->ticket_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Ticket Date</th>
                                        <td>{{date('d M Y, h:m A',strtotime($order->last_ticket_date))  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Time</th>
                                        <td>{{date('d M Y, h:m A',strtotime($order->booking_time))}}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Expired</th>
                                        <td>{{$order->booking_expired}}</td>
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
                                        <td>{{$order->trxid}}</td>
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
                                        <th>Payment Status</th>
                                        <td>{{$order->payment_status}}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>{{$order->payment_method}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12  mb-3">
                    <div class="card">
                        <h5 class="card-header">Passengers Details</h5>
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
                                    <th>Passport No</th>
                                    <th>Passport Expired</th>
                                    <th>Ticket</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $p = 0;?>
                                @foreach($order->passengers as $passenger)
                                    <tr>
                                        <td>{{++$p}}</td>
                                        <td>{{$passenger->title.' '.$passenger->first_name.' '.$passenger->last_name}}</td>
                                        <td>{{$passenger->pax_index}}</td>
                                        <td>{{$passenger->pax_type}}</td>
                                        <td>{{$passenger->gender}}</td>
                                        <td>{{date('d M, Y',strtotime($passenger->dob)) }}</td>
                                        <td>{{$passenger->passport_no}}</td>
                                        <td>{{$passenger->passport_expire_date}}</td>
                                        <td>{{$passenger->ticket}}</td>
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
@endsection
