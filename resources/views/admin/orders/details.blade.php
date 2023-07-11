@extends('adminlte::page')

@section('title', 'Orders Details')

@section('content_header')
<h1 class="ml-2">Order Details</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Order Details</li>
        </ol>
    </div>
{{--    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-end">--}}
{{--        <a href="{{route('admin.orders.trashed')}}" class="btn btn-danger mt-2">Trashed</a>--}}
{{--    </div>--}}
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Order Details</h5>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <a href="{{route('admin.order_refresh',['id'=>$order->id])}}" class="btn btn-info">Refresh</a>
                            <a href="{{route('admin.ticket_issue',['id'=>$order->id])}}" class="btn btn-success">Ticket Issue</a>
                            <a href="{{route('admin.invoice',['id'=>$order->id,'p'=>1])}}" class="btn btn-warning">Invoice (With Passengers)</a>
                            <a href="{{route('admin.invoice',['id'=>$order->id,'p'=>0])}}" class="btn btn-outline-warning">Invoice (Without Passengers)</a>
                            <a href="{{route('admin.cancel_ticket',['id'=>$order->id])}}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
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
                                        <td>{{$order->booking_time}}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Expired</th>
                                        <td>{{$order->booking_expired}}</td>
                                    </tr>
                                    <tr>
                                        <th>Result ID</th>
                                        <td>{{$order->result_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Search ID</th>
                                        <td>{{$order->search_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{$order->status}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Order ID</th>
                                        <td>{{$order->trxid}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>{{$order->total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Gross Amount</th>
                                        <td>{{$order->gross_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Paid Amount</th>
                                        <td>{{$order->paid_amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>Profit Amount</th>
                                        <td>{{$order->profit_amount}}</td>
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

                        <div class="col-md-4 mb-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Issued By</th>
                                        <td>{{$order->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$order->user->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{$order->user->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>From</th>
                                        <td>{{$order->from()->from}}</td>
                                    </tr>
                                    <tr>
                                        <th>Departure Time</th>
                                        <td>{{ date('d M, Y, h:m A',strtotime($order->from()->departure_time))}}</td>
                                    </tr>
                                    <tr>
                                        <th>To</th>
                                        <td>{{$order->to()->to}}</td>
                                    </tr>
                                    <tr>
                                        <th>Arrival Time</th>
                                        <td>{{ date('d M, Y, h:m A',strtotime($order->to()->arrival_time))}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Passengers Details</h5>
                <div class="card-body">
                    <div class="row ">
                    <?php $p = 0;?>
                    @foreach($order->passengers as $passenger)
                            <div class="col-md-4 mb-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th colspan="2" class="text-center">Passenger {{++$p}}</th>
                                        </tr>
                                        <tr>
                                            <th>PNR</th>
                                            <td>{{$passenger->pax_index}}</td>
                                        </tr>
                                        <tr>
                                            <th>Full Name</th>
                                            <td>{{$passenger->title.' '.$passenger->first_name.' '.$passenger->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Passenger Type</th>
                                            <td>{{$passenger->pax_type}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{$passenger->gender}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of birth</th>
                                            <td>{{date('d M, Y',strtotime($passenger->dob)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Passport No</th>
                                            <td>{{$passenger->passport_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Passport Expired</th>
                                            <td>{{$passenger->passport_expire_date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ticket</th>
                                            <?php $data = json_decode($passenger->ticke, true);?>
                                            <td>@if(!empty($data)){{$data[0]['TicketNo']}}<a href="{{route('admin.downloadTicket',['id' => $order->id])}}" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>@endif</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Journey Details</h5>
                <div class="card-body">
                    <?php $t = 0;?>
                    <div class="table-responsive border">
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


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('plugins.datatablesPlugins', true)
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)


@section('css')

@stop

@section('js')

    <script>
        $(function () {
            $("#orderList").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "paging": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@stop
