@extends('adminlte::page')

@section('title', 'Pages')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Pages</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
                <li class="breadcrumb-item active">Create Pages</li>
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

                    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" required class="form-control" id="name"
                                placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug" type="text" required class="form-control" id="slug"
                                placeholder="Enter slug">
                        </div>

                        <div class="form-group">
                            <label for="summernote">Body</label>
                            <textarea name="body"  required class="form-control" id="body"
                                      placeholder="Enter body"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" name="url" class="form-control" id="url"
                                placeholder="Enter url here ..">
                        </div>

                        @can('permission.create')
                            <button class="btn btn-primary" type="submit">Create</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.Summernote', true)
@section('toastr', true)
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
        $('#slug').on('input', function() {
            var slug = $(this).val();

            // Update the slug value only if it is not empty
            if (slug.trim() !== '') {
                $('#slug').val(slug);
            }
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
