@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
<h1 class="ml-2">Pages</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-start">
        @can('permission.create')
            <a href="{{route('admin.pages.create')}}" class="btn btn-primary mt-2">Add New</a>
        @endcan
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-center">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Pages</li>
        </ol>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 d-flex justify-content-end">
        <a href="{{route('admin.pages.trashed')}}" class="btn btn-danger mt-2">Trashed</a>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('permission.list')
                <div class="card">

                    <div class="card-body">

                        <table id="pagesList" class="table table-responsive dataTable table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Body</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td class="text-capitalize">{{$page->name}}</td>
                                    <td class="text-capitalize">{{$page->slug}} </td>
                                    <td class="text-capitalize">{{$page->body}} </td>
                                    <td class="text-capitalize">{{$page->link}} </td>
                                    <td>
                                        @empty($page->deleted_at)
                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            @can('permission.update')
                                                <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>
                                            @endcan
                                            @can('permission.delete')
                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </form>
                                        @else
                                        <a href="{{route('admin.pages.restore', $page->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-undo"></i></a>
                                        @endempty
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Body</th>
                                <th>Link</th>
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
