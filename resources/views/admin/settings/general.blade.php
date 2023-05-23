@extends('adminlte::page')

@section('title', 'General Settings')

@section('content_header')
    <h1>General Settings</h1>
@stop

@section('content')
    <form action="{{route('admin.update_general_settings')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="site_favicon">Site Icon</label>
                    <img width="100%" style="max-height: 150px" src="{{asset(getSetting('site_favicon'))}}">
                    <input type="text" name="site_favicon_old" class="form-control d-none"  value="{{getSetting('site_favicon')}}" >
                    <input type="file" name="site_favicon" class="form-control" id="site_favicon"  placeholder="Upload site icon">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="site_logo">Site Logo ( Light )</label>
                    <img width="100%" style="max-height: 150px" src="{{asset(getSetting('site_logo'))}}">
                    <input type="text" name="site_logo_old" class="form-control d-none"  value="{{getSetting('site_logo')}}" >
                    <input type="file" name="site_logo" class="form-control" id="site_logo"  placeholder="Upload site logo">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="site_logo_dark">Site Logo ( Dark )</label>
                    <img width="100%" style="max-height: 150px" src="{{asset(getSetting('site_logo_dark'))}}">
                    <input type="text" name="site_logo_dark_old" class="form-control d-none"  value="{{getSetting('site_logo_dark')}}" >
                    <input type="file" name="site_logo_dark" class="form-control" id="site_logo_dark"  placeholder="Upload site logo">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="site_title">Site Title</label>
                    <input type="text" name="site_title" class="form-control" id="site_title" value="{{getSetting('site_title')}}" placeholder="Enter site title">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="site_tagline">Site tagline</label>
                    <input type="text" name="site_tagline" class="form-control" id="site_tagline" value="{{getSetting('site_tagline')}}" placeholder="Enter site tagline">
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
