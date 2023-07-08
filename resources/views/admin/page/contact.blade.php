@extends('adminlte::page')

@section('title', 'Contact Page')

@section('content_header')
    <h1>Contact Page</h1>
@stop

@section('content')
    <form action="{{route('admin.update_custom_page')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="contact_page">Contact US</label>
                    <textarea  name="contact_page" class="form-control" id="contact_page" placeholder="Enter about us">{{getSettingDetails('contact_page')}}</textarea>
                </div>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
@stop
@section('plugins.Summernote', true)
@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#contact_page').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });

    </script>
@stop
