@extends('adminlte::page')

@section('title', 'Deposits Log')

@section('content_header')
    <h1 class="ml-2">Deposits Log</h1>
    <div class="d-flex justify-content-center">
        <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-start">
            {{-- @can('permission.create') --}}
                <a href="{{route('admin.deposits.create')}}" class="btn btn-primary mt-2">Add New</a>
            {{-- @endcan --}}
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Deposits Log</li>
            </ol>
        </div>
        {{-- <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-end">
            <a href="" class="btn btn-danger mt-2">Trashed</a>
        </div> --}}
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
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->user->name}}</td>
                                    <td>{{$deposit->trxid}}</td>
                                    <td>{{$deposit->amount}} </td>
                                    <td>{{$deposit->paid_by}} </td>
                                    <td>{{$deposit->updated_at->format('d-M-y, h:sA')}} </td>
                                    <td class="@if($deposit->status == 'success') text-success @elseif($deposit->status == 'pending') text-primary @else text-danger @endif">{{$deposit->status}} </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" onclick="depositInfo({{$deposit}})">View</a>
                                        @if($deposit->status == 'pending')
                                        <a href="{{route('admin.deposit_approve',['id'=>$deposit->id])}}" class="btn btn-sm btn-success">Accept</a>
                                        <a href="{{route('admin.deposit_reject',['id'=>$deposit->id])}}" class="btn btn-sm btn-danger">Reject</a>
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
        function depositInfo(param) {
            Swal.fire({
                title: 'Deposit Log.',
                icon: 'info',
                html:
                    '<table class="table table-striped">' +
                    '<tr><th>Trx.ID</th><td>'+param['trxid']+'</td></tr>'+
                    '<tr><th>Amount</th><td>'+param['amount']+'</td></tr>'+
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
