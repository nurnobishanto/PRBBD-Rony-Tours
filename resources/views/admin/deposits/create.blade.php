@extends('adminlte::page')

@section('title', 'Deposit')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Deposit</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.deposits.index') }}">Deposit</a></li>
                <li class="breadcrumb-item active">Create Deposit</li>
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

                    <form action="{{ route('admin.deposits.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <select name="user_id" class="js-example-basic-single form-control">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="amount">Amount (BDT)</label>
                                <input name="amount" type="text" required class="form-control" id="amount"
                                    placeholder="6000">
                            </div>
                            <div class="form-group col-6">
                                <label for="amount">Deposit Type</label>
                                <select name="deposit_type" class="form-control">
                                    <option value="cradit">Cradit</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="trxid">Transetion Id</label>
                            <input name="trxid" type="text" required class="form-control" id="trxid"
                                placeholder="XIY6654DD">
                        </div>

                        <div class="form-group">
                            <label for="slip">Slip</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="slip" name="slip" onchange="previewImage(this, 'slip_image');">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <img src="{{ asset('default.jpg') }}"
                                    id="slip_image_image"
                                    class="img-slip_image img-preview d-none"
                                    role="button"
                                    height="200" width="550" >
                                <button class="btn btn-danger btn-sm d-none" id="slip_image_deleteBtn" type="button" onclick="clearImage('slip_image');" style="height: 30px;">
                                    <i class="fas fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control" id="note" cols="10" rows="5"></textarea>
                        </div>
                        {{-- @can('permission.create') --}}
                            <button class="btn btn-primary" type="submit">Create</button>
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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    @include('admin.includes.image_preview')
@stop
