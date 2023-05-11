@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Permissions</h1>
        @can('permission.create')
            <a href="{{route('admin.permissions.create')}}" class="btn btn-primary mt-2">Add New</a>
        @endcan

    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Permissions</li>
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

                        <table id="permissionsList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead>
                            <tr>

                                <th width="22%">Permission</th>
                                <th width="20%">Guard</th>
                                <th width="18%">Group</th>
                                <th width="20%">Roles</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>

                                    <td class="text-capitalize">{{$permission->name}}</td>
                                    <td class="text-capitalize">{{$permission->guard_name}} </td>
                                    <td class="text-capitalize">{{$permission->group_name}} </td>
                                    <th>
                                        @foreach($permission->roles as $role)
                                            <span class="badge badge-secondary text-capitalize">{{$role->name}}</span>
                                        @endforeach
                                    </th>
                                    <td>
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @can('permission.view')
                                                <a href="{{route('admin.permissions.show',['permission'=>$permission->id])}}" class="btn btn-info px-1 py-0 btn-sm"><i class="fa fa-eye"></i></a>
                                            @endcan
                                            @can('permission.update')
                                                <a href="{{route('admin.permissions.edit',['permission'=>$permission->id])}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            @endcan
                                            @can('permission.delete')
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>

                                <th>Permission Name</th>
                                <th>Guard</th>
                                <th>permissions</th>
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
            $("#permissionsList").DataTable({
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
