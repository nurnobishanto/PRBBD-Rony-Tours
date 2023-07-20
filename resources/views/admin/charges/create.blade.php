@extends('adminlte::page')

@section('title', 'Charge')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Charge</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.charges') }}">Charge</a></li>
                <li class="breadcrumb-item active">Create Charge</li>
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

                    <form action="{{ route('admin.charges.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Select User</label>
                                    <select name="user_id" id="user_id" class="js-example-basic-single form-control">
                                        <option value="">Select a user</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name.' - '.$user->phone.' - '.$user->unique_id}} ({{number_format($user->balance,1) }}BDT)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Select Order</label>
                                    <select name="subject" id="subject" class="js-example-basic-single form-control">
                                        <option value="">Select a Option/Reason</option>
                                        @foreach($departments as $sub)
                                            <option value="{{$sub->name}}">{{$sub->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount">Amount (BDT)</label>
                                    <input name="amount" type="number" min="10" required class="form-control" id="amount" placeholder="6000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="trxid">Transetion Id</label>
                                    <input name="trxid" type="text" value="{{uniqid()}}" required class="form-control" id="trxid" placeholder="XIY6654DD">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note" class="form-control" id="note" placeholder="Enter note"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Charge</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr', true)
@section('plugins.Select2', true)
@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                theme: "classic"
            });

        });
    </script>
    @include('admin.includes.image_preview')
@stop
