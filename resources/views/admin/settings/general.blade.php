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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="site_tagline">Site tagline</label>
                    <input type="text" name="site_tagline" class="form-control" id="site_tagline" value="{{getSetting('site_tagline')}}" placeholder="Enter site tagline">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sms_provider">SMS Settings</label>
                    <select name="sms_provider" class="form-control" id="sms_provider" >
                        <option value="off" @if(getSetting('sms_provider')=='off') selected @endif>OFF</option>
                        <option value="bulk_sms_bd" @if(getSetting('sms_provider')=='bulk_sms_bd') selected @endif>BULK SMS BD</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="loading">Site loading</label>
                    <img width="100%" style="max-height: 150px" src="{{asset(getSetting('loading'))}}">
                    <input type="text" name="loading_old" class="form-control d-none"  value="{{getSetting('loading')}}" >
                    <input type="file" name="loading" class="form-control" id="loading"  placeholder="Upload loading">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="support_phone">Support Phone no</label>
                    <input type="text" name="support_phone" class="form-control" id="support_phone" value="{{getSetting('support_phone')}}" placeholder="Enter support phone">
                </div>
                <div class="form-group">
                    <label for="support_email">Support Email</label>
                    <input type="email" name="support_email" class="form-control" id="support_email" value="{{getSetting('support_email')}}" placeholder="Enter support email">
                </div>
                <div class="form-group">
                    <label for="whatsapp">What's APP</label>
                    <input type="url" name="whatsapp" class="form-control" id="whatsapp" value="{{getSetting('whatsapp')}}" placeholder="Enter What's App Number">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="url" name="facebook" class="form-control" id="facebook" value="{{getSetting('facebook')}}" placeholder="Enter facebook url">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="url" name="twitter" class="form-control" id="twitter" value="{{getSetting('twitter')}}" placeholder="Enter twitter url">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="url" name="instagram" class="form-control" id="instagram" value="{{getSetting('instagram')}}" placeholder="Enter instagram url">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="linkedin">Linkedin</label>
                    <input type="url" name="linkedin" class="form-control" id="linkedin" value="{{getSetting('linkedin')}}" placeholder="Enter linkedin url">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="youtube">YouTube</label>
                    <input type="url" name="youtube" class="form-control" id="youtube" value="{{getSetting('youtube')}}" placeholder="Enter youtube url">
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
