@extends('adminlte::page')

@section('title', 'Refund Policy Page')

@section('content_header')
    <h1>Refund Policy Page</h1>
@stop

@section('content')
    <form action="{{route('admin.update_custom_page')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="refund_policy">Refund Policy</label>
                    <textarea  name="refund_policy" class="form-control" id="refund_policy" >{{getSettingDetails('refund_policy')}}</textarea>
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
            $('#refund_policy').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });

    </script>
@stop
