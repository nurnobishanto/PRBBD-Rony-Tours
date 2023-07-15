<div class="dashboard_main_top">
    <div class="row">
        <div class="col-md-6 mt-2">
            <div class="dashboard_top_boxed ">
                <div class="dashboard_top_icon ">
                    <i  class="fas fa-credit-card text-success"></i>
                </div>
                <div class="dashboard_top_text ">
                    <p class="text-success">Personal Balance</p>
                    <h3 class="text-success">{{number_format(auth('web')->user()->balance,2) }} BDT</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="dashboard_top_boxed">
                <div class="dashboard_top_icon">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="dashboard_top_text">
                    <p>Complete Order (Flight)</p>
                    <h3>{{auth('web')->user()->orders->where('status','Ticketed')->count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="dashboard_top_boxed">
                <div class="dashboard_top_icon">
                    <i class="fas fa-plane-arrival"></i>
                </div>
                <div class="dashboard_top_text">
                    <p>Booked/Hold Order (Flight)</p>
                    <h3>{{auth('web')->user()->orders->where('status','Booked')->count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="dashboard_top_boxed">
                <div class="dashboard_top_icon">
                    <i class="fas fa-plane-departure"></i>
                </div>
                <div class="dashboard_top_text">
                    <p>UnConfirmed Order (Flight)</p>
                    <h3>{{auth('web')->user()->orders->where('status','UnConfirmed')->count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="dashboard_top_boxed">
                <div class="dashboard_top_icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="dashboard_top_text">
                    <p>Pending Order (Flight)</p>
                    <h3>{{auth('web')->user()->orders->where('status','pending')->count()}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="dashboard_top_boxed">
                <div class="dashboard_top_icon">
                    <i class="fas fa-money-bill text-warning"></i>
                </div>
                <div class="dashboard_top_text">
                    <p class="text-warning">Pending Deposit</p>
                    <h3 class="text-warning">{{auth('web')->user()->deposits->where('status','pending')->sum('amount')}}</h3>
                </div>
            </div>
        </div>

    </div>
</div>
