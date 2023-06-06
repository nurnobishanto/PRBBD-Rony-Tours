@extends('adminlte::page')

@section('title', 'Flyhub Settings')

@section('content_header')
    <h1>Flyhub Settings</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <h5 class="card-header">Flyhub Settings</h5>
            <div class="card-body">
                <form action="{{route('admin.update_flyhub_settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="url">Type</label>
                                <select id="url" name="url" class="form-control">
                                    <option value="https://api.flyhub.com/api/v1/" @if(getSetting('flyhub_url') == 'https://api.flyhub.com/api/v1/') selected @endif >Live</option>
                                    <option value="http://api.sandbox.flyhub.com/api/v1/" @if(getSetting('flyhub_url') == 'http://api.sandbox.flyhub.com/api/v1/') selected @endif >Sandbox</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="username"> Username</label>
                                <input type="text" name="username" class="form-control" id="username" value="{{getSetting('flyhub_username')}}" placeholder="Enter fly hub username">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" value="{{getSetting('flyhub_password')}}" placeholder="Enter fly hub password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apikey">API Key</label>
                                <input type="password" name="apikey" class="form-control" id="apikey" value="{{getSetting('flyhub_apikey')}}" placeholder="Enter fly hub apikey">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" id="status" value="{{getSetting('flyhub_status')}}" disabled>
                            </div>
                        </div>

                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
