<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking Ticket</title>
    <style>
        *{
            margin: 0;
            padding: 0;

        }
        p{
            margin: 5px 0;
        }
        body{
            margin: 20px 20px;

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


         th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #F2F2F2;
            color: black;
        }

         #passenger table, #passenger th, #passenger td{
             border: none;
             font-size: 15px;
             padding: 5px;
         }
    </style>
</head>
<body>

<div class="container mt-2">
    <table>
        <caption>e-Ticket</caption>
        <thead>
            <tr>
                <th>{{getSetting('site_title')}} {{getSetting('site_tagline')}}</th>
                <th>User Information</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p><strong>Email:</strong> {{getSetting('support_email')}}</p>
                    <p><strong>Phone:</strong> {{getSetting('support_phone')}}</p>
                    <p><strong>What's App:</strong> {{getSetting('whatsapp')}}</p>
                </td>
                <td>
                    <p><strong>Name:</strong> {{$user->name}}</p>
                    <p><strong>Email:</strong> {{$user->email}}</p>
                    <p><strong>Phone:</strong> {{$user->phone}}</p>

                </td>
            </tr>
        </tbody>
    </table>
    <table id="passenger" style="margin-top: 20px">
        <thead>
            <tr>
            <th>PASSENGER NAME</th>
            <th>TICKET NUMBER</th>
            <td>REFERENCE ID</td>
            <td><strong>{{$order->booking_id}}</strong></td>

        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$passenger->title}} {{$passenger->first_name}} {{$passenger->last_name}}</td>
                @php
                    $ticketData = json_decode($passenger->ticket, true);
                    $ticketNo = isset($ticketData[0]['TicketNo']) ? $ticketData[0]['TicketNo'] : '';
                @endphp
                <td>{{$ticketNo}}</td>
                <td>A-PNR</td>
                <td>{{$passenger->pax_index}}</td>

            </tr>
        <tr>
            <td colspan="2" rowspan="3"></td>
            <td>STATUS</td>
            <td><strong>{{$order->booking_status}}</strong></td>
        </tr>
            <tr>

                <td>ISSUE DATE</td>
                <td><strong>{{date('d M y, H:i',strtotime($order->booking_time))}}</strong></td>
            </tr>
        </tbody>
    </table>


    <table style="margin-top: 20px">
        <caption>JOURNEY DETAILS</caption>
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
                <td>{{$travel->from}} ( {{date('d M y, H:i',strtotime($travel->arrival_time))}} )</td>
                <td>{{$travel->to}} ( {{date('d M y, H:i',strtotime($travel->departure_time))}} )</td>
                <td>{{$travel->carrier}}</td>
                <td>{{$travel->cabin_class}}</td>

        </tr>
        @endforeach
        </tbody>
    </table>
    <table style="margin-top: 20px">
        <thead>
            <tr>
                <th>CONDITIONS AND IMPORTANT NOTICE:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h3>E-Ticket Notice:</h3>
                    <p>
                        Carriage and other services provided by the carrier are subject to conditions of carriage which are hereby incorporated by reference. These
                        conditions may be obtained from the issuing carrier.
                    </p>
                    <h3>Passport/Visa/Health :</h3>
                    <p>
                        Please ensure that you have all the required travel documents for your entire journey - i.e. valid passport &necessary visas - and that you have
                        had the recommended inoculations for your destination(s).
                    </p>
                    <h3>Reconfirmation of flights :</h3>
                    <p>
                        Please reconfirm all flights at least 72 hours in advance direct with the airline concerned. Failure to do so could result in the cancellation of your
                        reservation and possible `no-show` charges.
                    </p>
                    <h3>Insurance :</h3>
                    <p>
                        We strongly recommend that you take out travel insurance for the whole of your journey.
                    </p>
                    @php
                        echo '<img src="data:image/png;base64,' . (new \Milon\Barcode\DNS2D)->getBarcodePNG($order->booking_id, 'PDF417',2,1,array(1,1,1), true) . '" alt="barcode"   />';
                    @endphp
                </td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
