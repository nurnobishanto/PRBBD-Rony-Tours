{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Flight Booking Invoice</title>--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">--}}
{{--    <style>--}}
{{--        *{--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--        }--}}
{{--        p{--}}
{{--            margin: 0;--}}
{{--        }--}}
{{--        body{--}}
{{--            max-width: 650px;--}}
{{--            margin: 0 auto;--}}
{{--        }--}}
{{--        hr{--}}
{{--            margin: 0;--}}
{{--        }--}}
{{--        table{--}}
{{--            width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--        }--}}
{{--        td,  th {--}}
{{--            border: 1px solid #ddd;--}}
{{--            padding: 8px;--}}
{{--            border-collapse: collapse;--}}
{{--        }--}}

{{--        tr:nth-child(even){background-color: #f2f2f2;}--}}


{{--        th {--}}
{{--            padding-top: 12px;--}}
{{--            padding-bottom: 12px;--}}
{{--            text-align: left;--}}
{{--            background-color: #4d6dfc!important;--}}
{{--            color: white!important;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="container mt-2">--}}

{{--    <div class="header text-center">--}}
{{--        <img src="{{asset(getSetting('site_logo'))}}" alt="Company Logo" width="150">--}}
{{--        <h3 class="mt-2">Flight Booking Invoice <a href="{{route('invoice',['id'=>$order->id])}}" class="btn btn-success">Download</a></h3>--}}
{{--    </div>--}}
{{--    <hr>--}}
{{--    <div class="row justify-content-between text-uppercase">--}}
{{--        <div class="col-md-6">--}}
{{--            <h5>{{getSetting('site_title')}} {{getSetting('site_tagline')}}</h5>--}}
{{--            <p>Bakra Bazar, Jhikargachha, </p>--}}
{{--            <p>Jessore, Bangladesh</p>--}}
{{--            <p><strong>Email:</strong> {{getSetting('support_email')}}</p>--}}
{{--            <p><strong>Phone:</strong> {{getSetting('support_phone')}}</p>--}}
{{--            <p><strong>What's App:</strong> {{getSetting('whatsapp')}}</p>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <h5>User Information</h5>--}}
{{--            <p><strong>Name:</strong> {{$user->name}}</p>--}}
{{--            <p><strong>Email:</strong> {{$user->email}}</p>--}}
{{--            <p><strong>Phone:</strong> {{$user->phone}}</p>--}}
{{--            <p><strong>Booking ID:</strong> {{$order->booking_id}}</p>--}}
{{--            <p ><strong>Booking Status:</strong> {{$order->payment_status}}</p>--}}

{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="row mt-1">--}}
{{--        <div class="col-md-12">--}}
{{--            <h5>Passenger Information</h5><hr>--}}
{{--            <div id="passengerList" class="table-responsive">--}}
{{--                @foreach($passengers as $passenger)--}}
{{--                    <table class="table table-bordered">--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Gender</th>--}}
{{--                                <th>Age</th>--}}
{{--                                <th>PNR</th>--}}
{{--                                <th>Ticket Number</th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            <tr>--}}
{{--                                <td>{{$passenger->title}} {{$passenger->first_name}} {{$passenger->last_name}}</td>--}}
{{--                                <td>{{$passenger->gender}} {{$passenger->pax_type}}</td>--}}
{{--                                <td>{{calculateAge($passenger->dob)}}</td>--}}
{{--                                <td>{{$passenger->pax_index}}</td>--}}
{{--                                @php--}}
{{--                                    $ticketData = json_decode($passenger->ticket, true);--}}
{{--                                    $ticketNo = isset($ticketData[0]['TicketNo']) ? $ticketData[0]['TicketNo'] : '';--}}
{{--                                @endphp--}}
{{--                                <td>{{$ticketNo}}</td>--}}
{{--                            </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row mt-1">--}}
{{--        <div class="col-md-12">--}}
{{--            <h5>Journey Details</h5>--}}
{{--            <hr>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table text-center table-bordered">--}}
{{--                    <thead>--}}
{{--                        <tr>--}}
{{--                            <th>AIRLINE</th>--}}
{{--                            <th>FROM</th>--}}
{{--                            <th>TO</th>--}}
{{--                            <th>CARRIER</th>--}}
{{--                            <th>CLASS</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        <tr>--}}
{{--                            @foreach($travels as $travel)--}}
{{--                                <td>{{$travel->airline_name}} ({{$travel->airline_code}})</td>--}}
{{--                                <td>{{$travel->from}}<br>{{date('d M y, H:i',strtotime($travel->arrival_time))}}</td>--}}
{{--                                <td>{{$travel->to}}<br>{{date('d M y, H:i',strtotime($travel->departure_time))}}</td>--}}
{{--                                <td>{{$travel->carrier}}</td>--}}
{{--                                <td>{{$travel->cabin_class}}</td>--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row mt-1">--}}
{{--        <div class="col-md-12">--}}
{{--            <h5>Payment Summary</h5>--}}
{{--            <table class="table table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Description</th>--}}
{{--                    <th>Amount</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td>Total</td>--}}
{{--                    <td>{{$order->total_ws_amount}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-danger">Discount</td>--}}
{{--                    <td class="text-danger"> - {{$order->discount_amount}}</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>Net Pay</th>--}}
{{--                    <th>{{$order->net_pay_amount}}</th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>Paid Amount</td>--}}
{{--                    <td>{{$order->paid_amount}}</td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--</div>--}}

{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}

{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking Invoice</title>
    <style>
        *{
            margin: 0;
            padding: 0;

        }
        p{
            margin-top: 5px;
        }
        body{
            margin: 20px auto;
            max-width: 575px;
        }
        hr{
            margin: 5px auto;
        }
        h2{
            margin-top: 10px;
        }
        caption{
            font-size: 25px;
            margin: 10px auto;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td,  th {
            border: 1px solid #ddd;
            padding: 8px;
            border-collapse: collapse;
        }

        tr:nth-child(even){background-color: #f2f2f2;}


        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4d6dfc;
            color: white;
        }
        .btn{
            background-color: green;
            padding: 5px 15px;
            border-radius: 15px;
            color: white;
            text-decoration: none;
            font-size: 15px;
        }
    </style>
</head>
<body>

<div class="container mt-2">
    <table>


        <caption>
            <img src="{{asset(getSetting('site_logo'))}}" alt="Company Logo" width="150"><br>
            Flight Booking Invoice <a href="{{route('invoice',['id'=>$order->id])}}" class="btn" >Download</a>
        </caption>
        <thead>
        <tr>
            <th>{{getSetting('site_title')}} {{getSetting('site_tagline')}}</th>
            <th>User Information</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <p>Bakra Bazar, Jhikargachha, </p>
                <p>Jessore, Bangladesh</p>
                <p><strong>Email:</strong> {{getSetting('support_email')}}</p>
                <p><strong>Phone:</strong> {{getSetting('support_phone')}}</p>
                <p><strong>What's App:</strong> {{getSetting('whatsapp')}}</p>
            </td>
            <td>
                <p><strong>Name:</strong> {{$user->name}}</p>
                <p><strong>Email:</strong> {{$user->email}}</p>
                <p><strong>Phone:</strong> {{$user->phone}}</p>
                <p><strong>Booking ID:</strong> {{$order->booking_id}}</p>
                <p ><strong>Booking Status:</strong> {{$order->payment_status}}</p>
            </td>
        </tr>
        </tbody>
    </table>



    <div class="row mt-1">
        <div class="col-md-12">
            <h2>Passenger Information</h2>
            <hr>
            <table >
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>PNR</th>
                    <th>Ticket Number</th>
                </tr>
                </thead>
                <tbody>
                @foreach($passengers as $passenger)
                    <tr>
                        <td>{{$passenger->title}} {{$passenger->first_name}} {{$passenger->last_name}}</td>
                        <td>{{$passenger->gender}} {{$passenger->pax_type}}</td>
                        <td>{{calculateAge($passenger->dob)}}</td>
                        <td>{{$passenger->pax_index}}</td>
                        @php
                            $ticketData = json_decode($passenger->ticket, true);
                            $ticketNo = isset($ticketData[0]['TicketNo']) ? $ticketData[0]['TicketNo'] : '';
                        @endphp
                        <td>{{$ticketNo}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12">
            <h2>Journey Details</h2>
            <hr>
            <div class="table-responsive">
                <table class="table text-center table-bordered">
                    <thead>
                    <tr>
                        <th>AIRLINE</th>
                        <th>FROM</th>
                        <th>TO</th>
                        <th>CARRIER</th>
                        <th>CLASS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($travels as $travel)
                        <tr>
                            <td>{{$travel->airline_name}} ({{$travel->airline_code}})</td>
                            <td>{{$travel->from}}<br>{{date('d M y, H:i',strtotime($travel->departure_time))}}</td>
                            <td>{{$travel->to}}<br>{{date('d M y, H:i',strtotime($travel->arrival_time))}}</td>
                            <td>{{$travel->carrier}}</td>
                            <td>{{$travel->cabin_class}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12">
            <h2>Payment Summary</h2>
            <hr>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Total</td>
                    <td>{{$order->total_ws_amount}}</td>
                </tr>
                <tr>
                    <td class="text-danger">Discount</td>
                    <td class="text-danger"> - {{$order->discount_amount}}</td>
                </tr>
                <tr>
                    <th>Net Pay</th>
                    <th>{{$order->net_pay_amount}}</th>
                </tr>
                <tr>
                    <td>Paid Amount</td>
                    <td>{{$order->paid_amount}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
