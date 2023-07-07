@extends('adminlte::page')

@section('title', 'SMS Send')
@section('content_header')
    <h1 class="ml-2">SMS Send</h1>
    <div class="row">
        <div class="col-md-8 col-sm-12 justify-content-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">SMS Send</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.sms_send')}}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card card-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>To  <span class="text-danger">*</span></label>
                                    <input class="form-control" minlength="13" maxlength="13" name="to" value="{{old('to')?old('to'):'880'}}" placeholder="Enter to phone number">
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Message  <span class="text-danger">*</span></label>
                                    <input class="form-control" minlength="2"  name="msg" value="{{old('msg')}}" placeholder="Enter message">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Send SMS" class="btn btn-success">
                    </div>
                </div>
            </form>

        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)


@section('css')

@stop

@section('js')
