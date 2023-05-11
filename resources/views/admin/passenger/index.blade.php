@extends('adminlte::page')

@section('title', 'Passenger')

@section('content_header')
<h1 class="ml-2">Passenger</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-start">
        @can('permission.create')
            <a href="{{route('admin.passengers.create')}}" class="btn btn-primary mt-2">Add New</a>
        @endcan
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Passenger</li>
        </ol>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-end">
        <a href="{{route('admin.passengers.trashed')}}" class="btn btn-danger mt-2">Trashed</a>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('permission.list')
                <div class="card">

                    <div class="card-body">

                        <table id="passengerList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="22%">User Name</th>
                                <th width="20%">Name</th>
                                <th width="18%">Email</th>
                                <th width="18%">Phone</th>
                                <th width="18%">Age</th>
                                <th width="18%">Gender</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($passengers as $passenger)
                                <tr>
                                    <td> {{$passenger->user->name}} </td>
                                    <td> {{$passenger->name}} </td>
                                    <td> {{$passenger->email ?? '--'}} </td>
                                    <td> {{$passenger->phone ?? '--'}} </td>
                                    <td> {{$passenger->age ?? '--'}} </td>
                                    <td> {{\App\Enums\Genders::from($passenger->gender)->title()}} </td>
                                    <td>
                                        @empty($passenger->deleted_at)
                                        <form action="{{ route('admin.passengers.destroy', $passenger->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @can('permission.update')
                                                <a href="{{route('admin.passengers.edit', $passenger->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            @endcan
                                            @can('permission.delete')
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </form>
                                        @else
                                        <a href="{{route('admin.passengers.restore', $passenger->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-undo"></i></a>
                                        @endempty
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="22%">User Name</th>
                                <th width="20%">Name</th>
                                <th width="18%">Email</th>
                                <th width="18%">Phone</th>
                                <th width="18%">Age</th>
                                <th width="18%">Gender</th>
                                <th width="20%">Action</th>
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


@section('css')

@stop

@section('js')

    <script>
        $(function () {
            $("#passengerList").DataTable({
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
