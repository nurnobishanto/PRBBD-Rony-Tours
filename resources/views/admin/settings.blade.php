@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="flyhub-tab" data-toggle="pill" href="#flyhub" role="tab" aria-controls="flyhub" aria-selected="false">Fly hub</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="payment-gateway-tab" data-toggle="pill" href="#payment-gateway" role="tab" aria-controls="payment-gateway" aria-selected="false">Payment Gateway</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sms-tab" data-toggle="pill" href="#sms" role="tab" aria-controls="sms" aria-selected="false">SMS</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                      <form action="{{route('admin.general_settings')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="site_title">Site Title</label>
                                      <input type="text" name="site_title" class="form-control" id="site_title" value="{{getSetting('site_title')}}" placeholder="Enter site title">
                                </div>
                              </div>
                          </div>
                          <input type="submit" value="Submit" class="btn btn-primary">
                      </form>
                    </div>
                    <div class="tab-pane fade" id="flyhub" role="tabpanel" aria-labelledby="flyhub-tab">
                        <form action="{{route('admin.flyhub_settings')}}" method="POST" enctype="multipart/form-data">
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
                    <div class="tab-pane fade" id="payment-gateway" role="tabpanel" aria-labelledby="payment-gateway-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="sms" role="tabpanel" aria-labelledby="sms-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
