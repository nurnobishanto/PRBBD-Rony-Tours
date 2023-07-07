@extends('adminlte::page')

@section('title', 'Refund')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create Refund</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.refunds') }}">Refund</a></li>
                <li class="breadcrumb-item active">Create Refund</li>
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

                    <form action="{{ route('admin.refunds.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Select User</label>
                                    <select name="user_id" id="user_id" class="js-example-basic-single form-control">
                                        <option value="">Select a user</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name.' - '.$user->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order_id">Select Order</label>
                                    <select name="order_id" id="order_id" class="js-example-basic-single form-control">

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
                        <button class="btn btn-primary" type="submit">Refund</button>
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
    <script>
        $(document).ready(function() {
            $('#user_id').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: '{{ route('get_user_orders') }}',
                    method: 'GET',
                    data: { user_id: id },
                    success: function(response) {
                        $('#order_id').empty();
                        $('#order_id').append('<option value="">Select Order</option>');
                        var html = '';
                        for (var i = 0 ; i<response.length;i++){
                            html = html + '<option value="'+response[i]['id']+'">'+response[i]['trxid']+' - '+response[i]['status']+' ('+response[i]['payment_status']+' '+response[i]['paid_amount']+' BDT)</option>';
                        }
                        $('#order_id').append(html);
                    },
                    error: function(xhr) {
                        // Handle error if needed
                    }
                });
            });
        });
    </script>
@stop
