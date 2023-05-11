@extends('adminlte::page')

@section('title', 'Slider')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Slider</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Slider</a></li>
                <li class="breadcrumb-item active">Create Slider</li>
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

                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" required class="form-control" id="title"
                                placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImage(this, 'slider_image');">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <img src="{{ asset('default.jpg') }}"
                                    id="slider_image_image"
                                    class="img-slider_image img-preview d-none"
                                    role="button"
                                    height="200" width="550" >
                                <button class="btn btn-danger btn-sm d-none" id="slider_image_deleteBtn" type="button" onclick="clearImage('slider_image');" style="height: 30px;">
                                    <i class="fas fa fa-trash"></i>
                                </button>
                            </div>
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
@section('toastr', true)
@section('css')

@stop

@section('js')
    @include('admin.includes.image_preview')
@stop
