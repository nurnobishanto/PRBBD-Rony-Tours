@extends('adminlte::page')

@section('title', 'Edit Page')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Page - {{$page->name}}</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">Page</a></li>
                <li class="breadcrumb-item active">Edit Page</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.includes.message')

                    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" required class="form-control" id="name"
                                value="{{ $page->name }}">
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug" type="text" required class="form-control" id="slug"
                                value="{{ $page->slug }}">
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <input name="body" type="text" required class="form-control" id="body"
                                value="{{ $page->body }}">
                        </div>

                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" name="url" class="form-control" id="url"
                                value="{{ $page->url }}">
                        </div>

                        @can('permission.create')
                            <button class="btn btn-primary" type="submit">Update</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.Summernote', true)
@section('toastr',true)
@section('css')

@stop

@section('js')

@include('admin.includes.image_preview')
<script>
    $(document).ready(function() {
        $('#body').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true // set focus to editable area after initializing summernote
        });
    });
    $('#name').on('input', function() {
        var title = $(this).val();
        var slug = slugify(title);

        $('#slug').val(slug);
    });

    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')        // Replace spaces with -
            .replace(/[^\w-]+/g, '')     // Remove all non-word characters
            .replace(/--+/g, '-')        // Replace multiple - with single -
            .replace(/^-+/, '')          // Trim - from start of text
            .replace(/-+$/, '');         // Trim - from end of text
    }

</script>
@stop
