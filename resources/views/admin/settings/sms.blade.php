@extends('adminlte::page')

@section('title', 'SMS Settings')

@section('content_header')
    <h1>SMS Settings</h1>
@stop

@section('content')
    <div class="col-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <h5 class="card-header">BULK SMS BD</h5>
            <div class="card-body">
                <form action="{{route('admin.update_settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulk_sms_bd_api">BULK SMS BD API KEY</label>
                                <input type="password" name="bulk_sms_bd_api" class="form-control" id="bulk_sms_bd_api" value="{{getSetting('bulk_sms_bd_api')}}" placeholder="Enter bulk sms bd api">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulk_sms_bd_sender_id">BULK SMS BD SENDER ID</label>
                                <input type="text" name="bulk_sms_bd_sender_id" class="form-control" id="bulk_sms_bd_sender_id" value="{{getSetting('bulk_sms_bd_sender_id')}}" placeholder="Enter bulk sms bd sender id">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulk_sms_bd_url">BULK SMS BD BALANCE</label>
                                <input type="text" readonly  class="form-control" id="bulk_sms_bd_url" value="{{get_balance_bulksmsbd()}}" >
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success">
                </form>
            </div>
            <h5 class="card-header">TEST SMS</h5>
            <div class="card-body">
                <form action="{{route('admin.test_sms_send')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="phone_number" class="form-control" id="phone_number"  placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Send Test SMS" class="btn btn-primary form-control">
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
