@extends('adminlte::page')

@section('title', 'Passenger')

@section('content_header')
<h1 class="ml-2">Passenger</h1>
<div class="row ">
    <div class="col-sm-12 col-md-6 ">
        <a href="{{route('admin.passengers.trashed')}}" class="btn btn-danger mt-2">Trashed</a>
    </div>
    <div class="col-sm-12 col-md-6 ">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Passenger</li>
        </ol>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="passengerList" class="table  dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Added By</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($passengers as $passenger)
                                <tr>
                                    <td> {{$passenger->user->name}} </td>
                                    <td> {{$passenger->title.' '.$passenger->first_name.' '.$passenger->last_name}} </td>
                                    <td> {{$passenger->email ?? '--'}} </td>
                                    <td> {{$passenger->contact_number ?? '--'}} </td>
                                    <td> {{$passenger->dob ?? '--'}} </td>
                                    <td> {{$passenger->gender}} </td>
                                    <td>
                                        @empty($passenger->deleted_at)
                                        <form action="{{ route('admin.passengers.destroy', $passenger->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
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
                                <th>Added By</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Action</th>
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
