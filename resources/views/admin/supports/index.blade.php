@extends('adminlte::page')

@section('title', 'Support Tickets')

@section('content_header')
<h1 class="ml-2">Support Tickets</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Support Tickets</li>
        </ol>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('permission.list')
                <div class="card">

                    <div class="card-body">

                        <table  id="pagesList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead >
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">User</th>
                                <th width="50%">Subject</th>
                                <th width="15%">Status</th>
                                <th width="20%">Last Replay</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supports as $support)
                                <tr>
                                    <td>{{$support->id}}</td>
                                    <td>{{$support->user->name}}</td>
                                    <td>{{$support->support_department->name}}</td>
                                    <td class="complete">{{($support->status)?'OPEN':'CLOSED'}}</td>
                                    <td class="complete">{{$support->updated_at}}</td>
                                    <td>
                                        <a href="{{route('admin.support_chat',['id'=>$support->id])}}" ><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Last Replay</th>
                                <th>Action</th>
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
