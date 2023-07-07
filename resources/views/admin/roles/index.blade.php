@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Roles</h1>
            @can('roles.create')
                <a href="{{route('admin.roles.create')}}" class="btn btn-primary mt-2">Add New</a>
            @endcan

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('roles.list')
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="rolesList" class="table  dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Guard</th>
                                <th>Permissions</th>
                                <th width="70px" >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>

                                    <td>{{$role->name}}</td>
                                    <td>{{$role->guard_name}}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <a class="badge badge-success text-capitalize">{{$permission->name}}</a>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @can('roles.view')
                                                <a href="{{route('admin.roles.show',['role'=>$role->id])}}" class="btn btn-info px-1 py-0 btn-sm"><i class="fa fa-eye"></i></a>
                                            @endcan
                                            @can('roles.update')
                                                <a href="{{route('admin.roles.edit',['role'=>$role->id])}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            @endcan
                                            @can('roles.delete')
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
                                <th>Guard</th>
                                <th>Permissions</th>
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
@section('plugins.Sweetalert2', true)


@section('css')

@stop

@section('js')

    <script>
        $(document).ready(function() {
            $("#rolesList").DataTable({
                dom: 'Bfrtip',
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                searching: true,
                ordering: true,
                info: true,
                paging: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
        });

    </script>
@stop
