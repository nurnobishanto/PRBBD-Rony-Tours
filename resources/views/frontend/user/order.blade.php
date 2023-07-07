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

                    <div class=" table-responsive-lg table_common_area" >
                        <table class="table " id="dataTable">
                            <thead>
                                <tr>
                                    <th>Trx. ID</th>
                                    <th>Payment</th>
                                    <th>Travel</th>
                                    <th>Person</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->trxid}}</td>
                                    <td>{{$order->payment_status}}</td>
                                    <td>{{$order->from()->from}} - {{$order->to()->to}}</td>
                                    <td>{{$order->passengers->count()}}</td>
                                    <td>{{$order->net_pay_amount}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>
                                        <a href="{{route('order_details',['id'=> $order->id])}}" ><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>

    $(document).ready( function () {

        $('#dataTable').DataTable();
    } );
</script>
@endsection
