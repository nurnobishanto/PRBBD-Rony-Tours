@extends('adminlte::page')

@section('title', 'Transactions Log')

@section('content_header')
    <h1 class="ml-2">Transactions Log</h1>
    <div class="row">
        <div class="col-md-8 col-sm-12 justify-content-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Transactions Log</li>
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
                                <th>SL</th>
                                <th>Trx. ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Note</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($trans as $tran)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$tran->trxid}}</td>
                                    <td>{{$tran->debit_credit}} </td>
                                    <td>{{$tran->amount}} </td>
                                    <td>{{$tran->method}} </td>
                                    <td>{{$tran->note}} </td>
                                    <td>{{$tran->created_at->format('d M-y, h:iA')}} </td>
                                    <td class="@if($tran->status == 'success') text-success @elseif($tran->status == 'pending') text-primary @else text-danger @endif">{{$tran->status}} </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Trx. ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Note</th>
                                <th>Time</th>
                                <th>Status</th>

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
        function tranInfo(param) {
            Swal.fire({
                title: 'Deposit Log.',
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
                "order": [[0, "asc"]],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@stop
