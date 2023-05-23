@extends('adminlte::page')

@section('title', 'Subscribers')

@section('content_header')
<h1 class="ml-2">Pages</h1>
<div class="d-flex justify-content-center">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Subscribers</li>
        </ol>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @can('permission.list')
                <div class="card">

                    <div class="card-body table-responsive">

                        <table  id="pagesList" class="table  dataTable table-bordered table-striped">
                            <thead >
                            <tr>
                                <th scope="col" width="70%">Email</th>
                                <th scope="col" width="30%">Time</th>
{{--                                <th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td class="text-capitalize">{{$subscriber->email}}</td>
                                    <td class="text-capitalize">{{$subscriber->created_at}}</td>
{{--                                   --}}
{{--                                    <td>--}}
{{--                                        @empty($subscriber->deleted_at)--}}
{{--                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">--}}
{{--                                            @method('DELETE')--}}
{{--                                            @csrf--}}
{{--                                            @can('permission.update')--}}
{{--                                                <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-pen"></i></a>--}}
{{--                                            @endcan--}}
{{--                                            @can('permission.delete')--}}
{{--                                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm px-1 py-0"><i class="fa fa-trash"></i></button>--}}
{{--                                            @endcan--}}
{{--                                        </form>--}}
{{--                                        @else--}}
{{--                                        <a href="{{route('admin.pages.restore', $page->id)}}" class="btn btn-warning px-1 py-0 btn-sm"><i class="fa fa-undo"></i></a>--}}
{{--                                        @endempty--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Time</th>
{{--                                <th>Action</th>--}}
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
