@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @can('dashboard.view')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-times"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Last Check</span>
                    <span class="info-box-number">{{ getSetting('subscription_expire_date') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-warning"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Expire Date</span>
                    <span class="info-box-number">{{ getSetting('subscription_expire_date') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-question"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Remaining</span>
                    <span class="info-box-number">{{ getSetting('subscription_remaining') }} Days</span>
                </div>
            </div>
        </div>
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
                <span class="info-box-icon bg-primary"><i class="fas fa-money-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Profit</span>
                    <span class="info-box-number">Tk.  {{   round(\App\Models\Order::where('status','Ticketed')->sum('profit_amount'))}}</span>
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
                    <span class="info-box-number">Tk. {{ round(\App\Models\User::all()->sum('balance')) }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Deposits</span>
                    <span class="info-box-number">Tk. {{ round(\App\Models\Deposit::where('status','success')->sum('amount'))}}</span>
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
                    <span class="info-box-number">Tk. {{\App\Models\Deposit::where('status','reject')->count()}}</span>
                </div>

            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Refunds</span>
                    <span class="info-box-number">Tk. {{round(\App\Models\Refund::where('status','success')->sum('amount'))}}</span>
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
                    <span class="info-box-number">{{\App\Models\Order::all()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ticketed Flight</span>
                    <span class="info-box-number">{{\App\Models\order::where('status','Ticketed')->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Booked Flight</span>
                    <span class="info-box-number">{{\App\Models\order::where('status','Booked')->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Flight</span>
                    <span class="info-box-number">{{\App\Models\Order::where('status','pending')->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Refunded Flight</span>
                    <span class="info-box-number">{{\App\Models\Order::where('status','refund')->get()->count()}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-plane"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Canceled Flight</span>
                    <span class="info-box-number">{{\App\Models\Order::where('status','Cancelled')->get()->count()}}</span>
                </div>
            </div>
        </div>

    </div>
    @endcan
@stop

@section('css')
{{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
{{--    <script> console.log('Hi!'); </script>--}}
@stop
