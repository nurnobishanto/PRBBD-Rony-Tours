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

                    <div class="table-responsive table_common_area">
                        <table class="table " id="dataTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order ID</th>
                                    <th>Payment</th>
                                    <th>Travel</th>
                                    <th>Person</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-uppercase">{{$order->trxid??'Unknown'}}</td>
                                    <td>{{$order->payment_status??'Unknown'}}</td>
                                    <td>{{$order->from()->from??'Unknown'}} - {{$order->to()->to??'Unknown'}}</td>
                                    <td>{{$order->passengers->count()??'Unknown'}}</td>
                                    <td>{{$order->net_pay_amount??'Unknown'}}</td>
                                    <td class="text-uppercase">{{$order->status??'Unknown'}}</td>
                                    <td>
                                        <a href="{{route('order_details',['id'=> $order->id])}}" >View</a>
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
