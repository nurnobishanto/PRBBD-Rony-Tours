@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1 class="ml-2">User</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-start">
        <a href="{{route('admin.users.create')}}" class="btn btn-primary mt-2">Add New</a>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-end">
        <a href="{{route('admin.users.trashed')}}" class="btn btn-danger mt-2">Trashed</a>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('roles.list')
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="userList" class="table  dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <img src="{{ getImageUrl($user->image)}}" height="60px" width="80px" alt="">
                                     </td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->dob }}</td>
                                    <td>{{ ($user->user_type) }}</td>
                                    <td>{{ $user->is_active == 1 ? 'True' : 'False' }}</td>
                                    <td class="text-center">
                                        @empty($user->deleted_at)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            {{-- @can('user.view') --}}
                                                <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-info px-1 py-0 btn-sm"><i class="fa fa-eye"></i></a>
                                            {{-- @endcan --}}
                                            {{-- @can('user.update') --}}
                                                <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            {{-- @endcan --}}
                                            {{-- @can('user.delete') --}}
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            {{-- @endcan --}}
                                        </form>
                                        @else
                                            <a href="{{route('admin.users.restore', $user->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-undo"></i></a>
                                        @endempty
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Image</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>User Type</th>
                                <th>Status</th>
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
