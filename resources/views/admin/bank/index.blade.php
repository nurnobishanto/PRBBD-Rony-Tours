@extends('adminlte::page')

@section('title', 'Bank')

@section('content_header')
<h1 class="ml-2">Bank</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-start">
        @can('permission.create')
            <a href="{{route('admin.banks.create')}}" class="btn btn-primary mt-2">Add New</a>
        @endcan
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Bank</li>
        </ol>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-end">
        <a href="{{route('admin.banks.trashed')}}" class="btn btn-danger mt-2">Trashed</a>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            {{-- @can('permission.list') --}}
                <div class="card">
                    <div class="card-body">
                        <table id="bankList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Operator</th>
                                    <th>Bank Name</th>
                                    <th>Account Name</th>
                                    <th>Account No</th>
                                    <th>Branch Name</th>
                                    <th>Swift Code</th>
                                    <th>Routing No</th>
                                    <th>Charge Info</th>
                                    <th>Charge</th>
                                    <th>Operator Type</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($banks as $bank)
                                <tr>
                                    <td>{{ App\Models\Bank::getOperator($bank->operator)}}</td>
                                    <td>{{$bank->bank_name}}</td>
                                    <td>{{$bank->account_name}}</td>
                                    <td>{{$bank->account_no}}</td>
                                    <td>{{$bank->branch_name ?? '---'}}</td>
                                    <td>{{$bank->swift_code ?? '---'}}</td>
                                    <td>{{$bank->routing_no ?? '---'}}</td>
                                    <td>{{$bank->charge_info ?? '---'}}</td>
                                    <td>{{$bank->charge ?? '---'}}</td>
                                    <td>{{ App\Models\Bank::getOperatorType($bank->operator_type)}}</td>
                                    <td>
                                        @empty($bank->deleted_at)
                                        <form action="{{ route('admin.banks.destroy', $bank->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            {{-- @can('permission.update') --}}
                                                <a href="{{route('admin.banks.edit', $bank->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            {{-- @endcan
                                            @can('permission.delete') --}}
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            {{-- @endcan --}}
                                        </form>
                                        @else
                                        <a href="{{route('admin.banks.restore', $bank->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-undo"></i></a>
                                        @endempty
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Operator</th>
                                    <th>Bank Name</th>
                                    <th>Account Name</th>
                                    <th>Account No</th>
                                    <th>Branch Name</th>
                                    <th>Swift Code</th>
                                    <th>Routing No</th>
                                    <th>Charge Info</th>
                                    <th>Charge</th>
                                    <th>Operator Type</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            {{-- @endcan --}}

        </div>
    </div>
@stop
@section('plugins.datatablesPlugins', true)
@section('plugins.Datatables', true)


@section('css')

@stop

@section('js')

    <script>
        $(function () {
            $("#bankList").DataTable({
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
