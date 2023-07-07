@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Fly hub Balance</span>
                    <span class="info-box-number">{{ flyhubBalance() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-money-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Fly hub Credit</span>
                    <span class="info-box-number">{{ flyhubCredit() }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <span class="info-box-number">{{\App\Models\User::all()->count()}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User Balance</span>
                    <span class="info-box-number">Tk. {{\App\Models\User::all()->sum('balance')}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Deposits</span>
                    <span class="info-box-number">Tk. {{\App\Models\Deposit::where('status','success')->sum('amount')}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Deposit</span>
                    <span class="info-box-number">Tk. {{\App\Models\Deposit::where('status','pending')->count()}}</span>
                </div>

            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="far fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Reject Deposit</span>
                    <span class="info-box-number">Tk. {{\App\Models\Deposit::where('status','pending')->count()}}</span>
                </div>

            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Refunds</span>
                    <span class="info-box-number">Tk. {{\App\Models\Refund::where('status','success')->sum('amount')}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Agent</span>
                    <span class="info-box-number">{{\App\Models\User::where('user_type',1)->get()->count()}}</span>
                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Order</span>
                    <span class="info-box-number">{{\App\Models\User::where('user_type',1)->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Complete Order</span>
                    <span class="info-box-number">{{\App\Models\User::where('user_type',1)->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Order</span>
                    <span class="info-box-number">{{\App\Models\User::where('user_type',1)->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Refunded Order</span>
                    <span class="info-box-number">{{\App\Models\User::where('user_type',1)->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Canceled Order</span>
                    <span class="info-box-number">{{\App\Models\User::where('user_type',1)->get()->count()}}</span>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
