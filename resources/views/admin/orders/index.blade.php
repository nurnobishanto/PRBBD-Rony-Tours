@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
<h1 class="ml-2">Order</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
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
                <div class="card-body table-responsive">
                    <table id="orderList" class="table  dataTable table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Trx/Order ID</th>
                            <th>Booking ID</th>
                            <th>Name Email & Phone</th>
                            <th>Destination</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Payment Status</th>
                            <th>Booking Date</th>
                            <th width="10%" >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl = 1;?>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $sl++}}</td>
                                <td class="text-uppercase">{{ $order->trxid }}</td>
                                <td >{{ $order->booking_id }}</td>
                                <td><strong>{{ $order->user->name }},</strong> {{ $order->user->email }}, {{ $order->user->phone }}</td>
                                <td>{{ $order->from()->from??'--' }} - {{ $order->to()->to??'--' }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ $order->paid_amount }}</td>
                                <td class="text-capitalize">{{ $order->payment_status }} - {{ $order->payment_method }}</td>
                                <td>{{($order->booking_time)?date('d M Y, h:m A',strtotime($order->booking_time)):'---'}}</td>
                                <td class="text-center">
                                    @if($order->from())
                                    <a href="{{route('admin.order_details',['id'=>$order->id])}}" class="badge small badge-info">Details</a>
                                    @else
                                        <a href="{{route('admin.order_delete',['id'=>$order->id])}}" class="badge small badge-danger">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Trx/Order ID</th>
                            <th>Booking ID</th>
                            <th>Name Email & Phone</th>
                            <th>Destination</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Payment Status</th>
                            <th>Booking Date</th>
                            <th width="10%" >Action</th>
                        </tr>
                        </tfoot>
                    </table>
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
