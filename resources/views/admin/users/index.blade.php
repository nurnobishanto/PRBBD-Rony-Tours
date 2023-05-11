@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Users</h1>
            @can('roles.create')
                <a href="{{route('admin.users.create')}}" class="btn btn-primary mt-2">Add New</a>
            @endcan

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('roles.list')
                <div class="card">
                    <div class="card-body">
                        <table id="userList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="10%">Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th width="10%" >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>

                                    <td>
                                        <img class="rounded border" width="100px" src="{{asset($user->photo)}}" alt="{{$user->name}}">
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <a class="badge badge-success text-capitalize">{{$role->name}}</a>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($user->is_active>0) <span class="badge-success badge">Active</span>
                                        @else <span class="badge-danger badge">Deactivate</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @can('user.view')
                                                <a href="{{route('admin.users.show',['user'=>$user->id])}}" class="btn btn-info px-1 py-0 btn-sm"><i class="fa fa-eye"></i></a>
                                            @endcan
                                            @can('user.update')
                                                <a href="{{route('admin.users.edit',['user'=>$user->id])}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            @endcan
                                            @can('user.delete')
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            @endcan

                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Status</th>
                                <th width="70px" >Action</th>
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
            $("#userList").DataTable({
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
