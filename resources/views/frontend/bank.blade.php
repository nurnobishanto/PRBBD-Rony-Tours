@extends('layouts.frontend')
@section('main_content')
<!-- Dashboard Area -->

<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="dashboard_main_top">
            <div class="row">
                @foreach ($banks as $bank)
                <div class="col-md-6 mt-2">
                    <div class="tour_details_right_boxed">
                        <div class="tour_package_details_bar_list">
                            <h5>Bank Info</h5>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Operator</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->operator == 1 ? 'Bank' : ( $bank->operator == 2 ? 'Mobile Banking' : '') }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Bank Name</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->bank_name }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Account Name</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->account_name }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Account No</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->account_no }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Branch Name</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->branch_name ?? '---' }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Swift Code</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->swift_code ?? '---' }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Routing No</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->routing_no ?? '---' }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Charge Info</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->charge_info ?? '---' }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Charge</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6>{{ $bank->charge ?? '---' }}</h6>
                                </div>
                            </div>
                            <div class="select_person_item">
                                <div class="select_person_left">
                                    <h6>Operator Type</h6>
                                </div>
                                <div class="select_person_right">
                                    <h6> {{ $bank->operator_type == 1 ? 'Personal' : ( $bank->operator_type == 2 ? 'Agent' : '---') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
