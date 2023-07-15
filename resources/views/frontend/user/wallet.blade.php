@extends('layouts.frontend')
@section('main_content')
    <!-- Dashboard Area -->

    <section id="dashboard_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('frontend.user.partial.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="dashboard_common_table">
                        <div class="wallwt_area_top">
                            <h3>Wallet</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="wallet_area_boxed">
                                        <h4>My wallet</h4>
                                        <div class="wallet_blance_boxed">
                                            <p>Wallet balance</p>
                                            <h5>BDT {{auth('web')->user()->balance}}</h5>
                                        </div>
                                        <div class="wallet_boxed_flex">
                                            <div class="wallet_blance_boxed">
                                                <p>Total Deposit</p>
                                                <h5>BDT {{$deposits->where('status','success')->sum('amount')}}</h5>
                                            </div>
                                            <div class="wallet_blance_boxed">
                                                <p>Total Purchase</p>
                                                <h5>BDT {{\App\Models\Order::where('user_id',auth('web')->user()->id)->sum('paid_amount')}}</h5>
                                            </div>
                                        </div>
                                        <div class="wallet_blance_boxed">
                                            <p>Total Refund balance</p>
                                            <h5>BDT {{\App\Models\Refund::where('user_id',auth('web')->user()->id)->sum('amount')}}</h5>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wallet_area_boxed">
                                        <h4>Add wallet</h4>
                                        <form method="POST" action="{{route('user.add_balance_SSLCOMMERZ')}}">
                                            @csrf
                                            <div class="add_balance_area">
                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="input-group">
                                                    <span class="input-group-text">৳</span>
                                                    <input type="number" name="amount" id="amount" min="10" class="form-control" placeholder="Enter amount" aria-label="Amount (to the nearest dollar)">
                                                </div>
                                                <div class="other_add_balance_area">
                                                    <span>or</span>
                                                    <div class="other_add_bal_button">
                                                        <span id="add_1000" class="btn btn_add_bal">BDT 1000</span>
                                                        <span id="add_5000" class="btn btn_add_bal">BDT 5000</span>
                                                        <span id="add_10000" class="btn btn_add_bal">BDT 10,000</span>
                                                    </div>
                                                    <button type="submit" class="btn btn_theme btn_md w-100">Add wallet</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <h3 class="wallet_table_top">Transaction</h3>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Deposit Transaction
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-responsive">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#Trans. ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Method</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($deposits as $deposit)
                                                <tr>
                                                    <th scope="row" class="text-uppercase">{{$deposit->trxid}}</th>
                                                    <td>{{$deposit->amount}} {{$deposit->currency}}</td>
                                                    <td>{{$deposit->paid_by}}</td>
                                                    @if($deposit->status == 'success')
                                                        <td class="text-success">{{$deposit->status}}</td>
                                                        <td><button class="btn btn-sm btn-success">Paid</button></td>
                                                    @elseif($deposit->status == 'pending')
                                                        <td class="text-primary">{{$deposit->status}}</td>
                                                        <td>
                                                        @if($deposit->paid_by=='SSLCOMMERZ')
                                                                <form method="POST" action="{{route('user.add_balance_SSLCOMMERZ')}}">
                                                                    @csrf
                                                                    <input type="number" name="amount" value="{{$deposit->amount}}"  class="d-none">
                                                                    <input type="text" name="trxid" value="{{$deposit->trxid}}"  class="d-none">
                                                                    <button type="submit" class="btn btn-sm btn-primary">Pay</button>
                                                                </form>
                                                        @else
                                                            Contact
                                                        @endif
                                                        </td>
                                                    @else
                                                        <td class="text-danger">{{$deposit->status}}</td>
                                                        <td>Try Again</td>
                                                    @endif

                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                            Refund Transaction
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-responsive">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#Trans. ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Method</th>
                                                    <th scope="col">Status</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(\App\Models\Refund::where('user_id',auth()->user()->id)->get() as $deposit)
                                                <tr>
                                                    <th scope="row" class="text-uppercase">{{$deposit->trxid}}</th>
                                                    <td>{{$deposit->amount}} {{$deposit->currency}}</td>
                                                    <td>{{$deposit->paid_by}}</td>
                                                    @if($deposit->status == 'success')
                                                        <td class="text-success">{{$deposit->status}}</td>
                                                    @elseif($deposit->status == 'pending')
                                                        <td class="text-primary">{{$deposit->status}}</td>
                                                    @else
                                                        <td class="text-danger">{{$deposit->status}}</td>
                                                    @endif

                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {

            $("#add_1000").click(function() {
                $("#add_1000").addClass('active');
                $("#add_5000").removeClass('active');
                $("#add_10000").removeClass('active');
                $('#amount').val(1000);
            });
            $("#add_10000").click(function() {
                $("#add_10000").addClass('active');
                $("#add_5000").removeClass('active');
                $("#add_1000").removeClass('active');
                $('#amount').val(10000);
            });
            $("#add_5000").click(function() {
                $("#add_10000").removeClass('active');
                $("#add_5000").addClass('active');
                $("#add_1000").removeClass('active');
                $('#amount').val(5000);
            });
        });

    </script>
@endsection
