@extends('adminlte::page')

@section('title', 'Compose and Send')
@section('content_header')
    <h1 class="ml-2">Compose and Send</h1>
    <div class="row">
        <div class="col-md-8 col-sm-12 justify-content-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Compose and Send</li>
            </ol>
        </div>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.email_send')}}" method="POST">
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>From Email <span class="text-danger">*</span></label>
                                    <input class="form-control" name="from" disabled value="{{env('MAIL_FROM_ADDRESS')}}" placeholder="Enter form email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>To Email <span class="text-danger">*</span></label>
                                    <input class="form-control" name="to" value="{{old('to')}}" placeholder="Enter to email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input class="form-control" name="subject" value="{{old('subject')}}" placeholder="Enter subject">
                        </div>
                        <div class="form-group">
                            <label>Body <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="10" name="body" placeholder="Enter subject">{{old('body')}}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Send Email" class="btn btn-success">
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
