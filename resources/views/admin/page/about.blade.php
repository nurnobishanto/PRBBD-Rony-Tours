@extends('adminlte::page')

@section('title', 'About Page')

@section('content_header')
    <h1>About Page</h1>
@stop

@section('content')
    <form action="{{route('admin.update_about_us')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="about_us">About US</label>
                    <textarea type="about_us" name="about_us" class="form-control" id="about_us" placeholder="Enter about us">{{getSettingDetails('about_us')}}</textarea>
                </div>
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
@stop

@section('css')

@stop

@section('js')

@stop
