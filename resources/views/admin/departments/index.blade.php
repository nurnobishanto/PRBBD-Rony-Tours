@extends('adminlte::page')

@section('title', 'Support Department')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Support Department</h1>
            @can('department.create')
                <a href="{{route('admin.departments.create')}}" class="btn btn-primary mt-2">Add New</a>
            @endcan

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Support Department</li>
            </ol>


        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('department.list')
                <div class="card">
                    <div class="card-body">
                        <table id="rolesList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="25%">Name</th>
                                <th width="15%">Total Ticket</th>
                                <th width="10%" >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $dep)
                                <tr>
                                    <td>{{$dep->name}}</td>
                                    <td>{{$dep->support->count()}}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.departments.destroy', $dep->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf

                                            @can('department.update')
                                                <a href="{{route('admin.departments.edit',['department'=>$dep->id])}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            @endcan
                                            @can('department.delete')
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            @endcan

                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Total Expense</th>
                                <th width="120px" >Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endcan

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
            $("#rolesList").DataTable({
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
