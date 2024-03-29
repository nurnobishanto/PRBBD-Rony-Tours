@extends('adminlte::page')

@section('title', 'Refund')

@section('content_header')
    <h1 class="ml-2">Refund</h1>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <a href="{{route('admin.refunds.create')}}" class="btn btn-primary mt-2">Add New</a>
        </div>
        <div class="col-md-8 col-sm-12 justify-content-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Refund</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="pagesList" class="table  dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Trx. ID</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Note</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($refunds as $refund)
                                <tr>
                                    <td>{{$refund->user->name}}</td>
                                    <td>{{$refund->trxid}}</td>
                                    <td>{{$refund->amount}} </td>
                                    <td>{{$refund->paid_by}} </td>
                                    <td>{{$refund->note}} </td>
                                    <td>{{$refund->updated_at->format('d-M-y, h:iA')}} </td>
                                    <td class="@if($refund->status == 'success') text-success @elseif($refund->status == 'pending') text-primary @else text-danger @endif">{{$refund->status}} </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" onclick="refundInfo({{$refund}})">View</a>
                                        @if($refund->status == 'pending')
                                            <a href="{{route('admin.refund_approve',['id'=>$refund->id])}}" class="btn btn-sm btn-success">Accept</a>
                                            <a href="{{route('admin.refund_reject',['id'=>$refund->id])}}" class="btn btn-sm btn-danger">Reject</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>User</th>
                                <th>Trx. ID</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Note</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)


@section('css')

@stop

@section('js')
    <script>
        function refundInfo(param) {
            Swal.fire({
                title: 'Deposit.',
                icon: 'info',
                html:
                    '<table class="table table-striped">' +
                    '<tr><th>Trx.ID</th><td>'+param['trxid']+'</td></tr>'+
                    '<tr><th>Amount</th><td>'+param['amount']+'</td></tr>'+
                    '<tr><th>Currency</th><td>'+param['currency']+'</td></tr>'+
                    '<tr><th>Paid By</th><td>'+param['paid_by']+'</td></tr>'+
                    '<tr><th>Note</th><td>'+param['note']+'</td></tr>'+
                    '<tr><th>Slip</th><td><img src="'+param['note']+'"></td></tr>'+
                    '</table>',
            });
        }

        $(function () {
            $("#pagesList").DataTable({
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
