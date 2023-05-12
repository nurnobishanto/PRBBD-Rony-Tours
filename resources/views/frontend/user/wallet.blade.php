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
                                <div class="col-lg-6">
                                    <div class="wallet_area_boxed">
                                        <h4>My wallet</h4>
                                        <div class="wallet_blance_boxed">
                                            <p>Wallet balance</p>
                                            <h5>BDT {{auth('web')->user()->balance}}</h5>
                                        </div>
                                        <div class="wallet_boxed_flex">
                                            <div class="wallet_blance_boxed">
                                                <p>Total credit</p>
                                                <h5>BDT 52,050.00</h5>
                                            </div>
                                            <div class="wallet_blance_boxed">
                                                <p>Total debit</p>
                                                <h5>BDT 52,050.00</h5>
                                            </div>
                                        </div>
                                        <div class="dashboard_price_range">
                                            <div class="main_range_price"></div>
                                            <div class="price_range_blance">
                                                <p>BDT 52,050.00</p>
                                                <p>BDT 52,050.00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="wallet_area_boxed">
                                        <h4>Add wallet</h4>
                                        <form method="POST" action="{{route('user.add_balance')}}">
                                            @csrf
                                            <div class="add_balance_area">
                                                <div class="input-group">
                                                    <span class="input-group-text">৳</span>
                                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" aria-label="Amount (to the nearest dollar)">
                                                    <input type="text" name="paid_for"  class="d-none" >
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
                            <h3 class="wallet_table_top">Wallet transaction</h3>
                            <div class="wallet_data_table">
                                <div class="table-responsive-lg table_common_area">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Sl no.</th>
                                            <th>Date</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>01.</td>
                                            <td>30 Jan 2022</td>
                                            <td>$500.00</td>
                                            <td>-</td>
                                            <td>$500.00 </td>
                                            <td class="complete">Completed</td>
                                        </tr>
                                        <tr>
                                            <td>02.</td>
                                            <td>30 Jan 2022</td>
                                            <td>$500.00</td>
                                            <td>-</td>
                                            <td>$500.00 </td>
                                            <td class="complete">Completed</td>
                                        </tr>
                                        <tr>
                                            <td>03.</td>
                                            <td>30 Jan 2022</td>
                                            <td>-</td>
                                            <td>$500.00</td>
                                            <td>$500.00 </td>
                                            <td class="cancele">Canceled</td>
                                        </tr>
                                        <tr>
                                            <td>04.</td>
                                            <td>30 Jan 2022</td>
                                            <td>$500.00</td>
                                            <td>-</td>
                                            <td>$500.00 </td>
                                            <td class="complete">Completed</td>
                                        </tr>
                                        <tr>
                                            <td>05.</td>
                                            <td>30 Jan 2022</td>
                                            <td>-</td>
                                            <td>$500.00</td>
                                            <td>$500.00</td>
                                            <td class="cancele">Canceled</td>
                                        </tr>
                                        <tr>
                                            <td>06.</td>
                                            <td>30 Jan 2022</td>
                                            <td>$500.00</td>
                                            <td>-</td>
                                            <td>$500.00 </td>
                                            <td class="complete">Completed</td>
                                        </tr>
                                        </tbody>
                                    </table>
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
