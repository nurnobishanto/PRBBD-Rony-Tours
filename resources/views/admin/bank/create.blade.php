@extends('adminlte::page')

@section('title', 'Bank')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Bank</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.banks.index') }}">Bank</a></li>
                <li class="breadcrumb-item active">Create Bank</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.includes.message')

                    <form action="{{ route('admin.banks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="operator">Operator</label>
                                    <select class="form-control" name="operator" required>
                                        <option selected disabled>-- Select Operator -- </option>
                                        <option value="1" @if(old('operator')==1) selected @endif >Bank</option>
                                        <option value="2" @if(old('operator')==2) selected @endif >Mobile Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" name="bank_name" value="{{old('bank_name')}}" class="form-control" placeholder="Enter Bank Name ..">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" name="account_name" value="{{old('account_name')}}" class="form-control" placeholder="Enter Account Name ..">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="account_no">Account No</label>
                                    <input type="text" name="account_no" value="{{old('account_no')}}" class="form-control" placeholder="Enter Account No ..">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="branch_name">Branch Name</label>
                                    <input type="text" name="branch_name" value="{{old('branch_name')}}" class="form-control" placeholder="Enter Branch Name ..">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="swift_code">Swift Code</label>
                                    <input type="text" name="swift_code" value="{{old('swift_code')}}" class="form-control" placeholder="Enter Swift Code ..">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="routing_no">Routing No</label>
                                    <input type="text" name="routing_no" value="{{old('routing_no')}}" class="form-control" placeholder="Enter Routing No ..">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="charge_info">Charge Info</label>
                                    <input type="text" name="charge_info" value="{{old('charge_info')}}" class="form-control" placeholder="Enter charge info">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="charge">Charge</label>
                                    <input type="text" name="charge" value="{{old('charge')}}" class="form-control" placeholder="Enter Charge">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="operator_type">Operator Type</label>
                                    <select class="form-control" name="operator_type" required>
                                        <option selected disabled>-- Select Operator Type -- </option>
                                        <option value="1" @if(old('operator_type')==1) selected @endif >Personal</option>
                                        <option value="2" @if(old('operator_type')==2) selected @endif >Agent</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- @can('permission.create') --}}
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                        {{-- @endcan --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr', true)
@section('css')

@stop

@section('js')

@stop
