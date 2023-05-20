@extends('adminlte::page')

@section('title', 'Edit Bank')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Bank - {{$bank->name}}</h1>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.banks.index')}}">Bank</a></li>
                <li class="breadcrumb-item active">Edit Bank</li>
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

                    <form action="{{ route('admin.banks.update', $bank->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="operator">Operator</label>
                                    <select class="form-control" name="operator" required>
                                        <option selected disabled>-- Select Operator -- </option>
                                        <option value="1" {{ $bank->operator == 1 ? 'selected' : '' }}>Bank</option>
                                        <option value="2" {{ $bank->operator == 2 ? 'selected' : '' }}>Mobile Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name</label>
                                    <input type="text" name="bank_name" class="form-control"  value="{{ $bank->bank_name }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" name="account_name" class="form-control"  value="{{ $bank->account_name }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="account_no">Account No</label>
                                    <input type="text" name="account_no" class="form-control"  value="{{ $bank->account_no }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="branch_name">Branch Name</label>
                                    <input type="text" name="branch_name" class="form-control"  value="{{ $bank->branch_name }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="swift_code">Swift Code</label>
                                    <input type="text" name="swift_code" class="form-control"  value="{{ $bank->swift_code }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="routing_no">Routing No</label>
                                    <input type="text" name="routing_no" class="form-control"  value="{{ $bank->routing_no }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="charge_info">Charge Info</label>
                                    <input type="text" name="charge_info" class="form-control"  value="{{ $bank->charge_info }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="charge">Charge</label>
                                    <input type="text" name="charge" class="form-control" value="{{ $bank->charge }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="operator_type">Operator Type</label>
                                    <select class="form-control" name="operator_type" required>
                                        <option selected disabled>-- Select Operator Type -- </option>
                                        <option value="1" {{ $bank->operator_type == 1 ? 'selected' : '' }}>Personal</option>
                                        <option value="2" {{ $bank->operator_type == 2 ? 'selected' : '' }}>Agent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- @can('permission.edit') --}}
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                        {{-- @endcan --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr',true)
@section('css')

@stop

@section('js')

@include('admin.includes.image_preview')

@stop
