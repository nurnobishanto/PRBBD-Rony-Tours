@extends('layouts.frontend')
@section('main_content')

<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="dashboard_main_top">
            <h3>Bank Info</h3>
            <div class="row">
                @foreach ($banks as $bank)
                <div class="col-md-6 m-2">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Operator ({{ $bank->operator_type == 1 ? 'Personal' : ( $bank->operator_type == 2 ? 'Agent' : '---') }})</th>
                                    <th>{{ $bank->operator == 1 ? 'Bank' : ( $bank->operator == 2 ? 'Mobile Banking' : '') }}</th>
                                </tr>
                                <tr>
                                    <th>Bank Name</th>
                                    <td>{{ $bank->bank_name }}</td>
                                </tr>
                                <tr>
                                    <th>Account Name</th>
                                    <td>{{ $bank->account_name }}</td>
                                </tr>
                                <tr>
                                    <th>Account No</th>
                                    <td>{{ $bank->account_no }}</td>
                                </tr>
                                <tr>
                                    <th>Branch Name</th>
                                    <td>{{ $bank->branch_name ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Swift Code</th>
                                    <td>{{ $bank->swift_code ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Routing No</th>
                                    <td>{{ $bank->routing_no ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <th>Charge Info ({{ $bank->charge ?? '0' }}%)</th>
                                    <td>{{ $bank->charge_info ?? '---' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            @if(auth()->guard('web')->user())
                                <a class="btn btn-sm btn-primary" href="">Deposit Amount</a>
                            @else
                                <div class="text-danger">Please <a href="">Login</a>  or <a href="">Signup</a>  for deposit</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
