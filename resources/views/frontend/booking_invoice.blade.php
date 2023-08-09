<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
        }
        body{
            max-width: 650px;
            margin: 0 auto;
        }
        hr{
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container mt-2">

    <div class="header text-center">
        <img src="{{asset(getSetting('site_logo'))}}" alt="Company Logo" width="150">
        <h3 class="mt-2">Flight Booking Invoice</h3>
    </div>
    <hr>
    <div class="row justify-content-between text-uppercase">
        <div class="col-md-6">
            <h5>{{getSetting('site_title')}} {{getSetting('site_tagline')}}</h5>
            <p>Bakra Bazar, Jhikargachha, </p>
            <p>Jessore, Bangladesh</p>
            <p><strong>Email:</strong> {{getSetting('support_email')}}</p>
            <p><strong>Phone:</strong> {{getSetting('support_phone')}}</p>
            <p><strong>What's App:</strong> {{getSetting('whatsapp')}}</p>
        </div>
        <div class="col-md-6">
            <h5>User Information</h5>
            <p><strong>Name:</strong> {{$user->name}}</p>
            <p><strong>Email:</strong> {{$user->email}}</p>
            <p><strong>Phone:</strong> {{$user->phone}}</p>
            <p><strong>Booking ID:</strong> {{$order->booking_id}}</p>
            <p ><strong>Booking Status:</strong> {{$order->payment_status}}</p>
        </div>
    </div>


    <div class="row mt-1">
        <div class="col-md-12">
            <h5>Passenger Information</h5><hr>
            <div id="passengerList" class="table-responsive">
                @foreach($passengers as $passenger)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ticket Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$passenger->title}} {{$passenger->first_name}} {{$passenger->last_name}}</td>
                                <td>{{$passenger->gender}} {{$passenger->pax_type}}</td>
                                <td>{{calculateAge($passenger->dob)}}</td>
                                @php
                                    $ticketData = json_decode($passenger->ticket, true);
                                    $ticketNo = isset($ticketData[0]['TicketNo']) ? $ticketData[0]['TicketNo'] : '';
                                @endphp
                                <td>{{$ticketNo}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12">
            <h5>Journey Details</h5>
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
                        <tr>
                            @foreach($travels as $travel)
                                <td>{{$travel->airline_name}} ({{$travel->airline_code}})</td>
                                <td>{{$travel->from}}<br>{{date('d M y, H:i',strtotime($travel->arrival_time))}}</td>
                                <td>{{$travel->to}}<br>{{date('d M y, H:i',strtotime($travel->departure_time))}}</td>
                                <td>{{$travel->carrier}}</td>
                                <td>{{$travel->cabin_class}}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12">
            <h5>Payment Summary</h5>
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
{{--    <div class="text-md-end">--}}
{{--        <button id="downloadPdf" class="btn btn-primary">Download PDF</button>--}}
{{--    </div>--}}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        $("#downloadPdf").on("click", function () {
            // Define dynamic passenger information
            const passengersData = [
                { name: "Passenger 1", age: 30 },
                { name: "Passenger 2", age: 25 },
                // Add more passengers as needed
            ];

            // Define the content for the PDF using pdfmake syntax
            const content = [

                { text: "Flight Booking Invoice", fontSize: 16, bold: true, margin: [0, 0, 0, 10],alignment:'center'},
                { columns: [

                        { width: "50%", text: [
                                { text: "Company Address:", fontSize: 14, bold: true, margin: [0, 0, 0, 5] },
                                "123 Main Street\nCity, Country\nPostal Code: 12345\nEmail: info@example.com\nPhone: (123) 456-7890"
                            ] },
                        { width: "50%", text: [
                                { text: "Contact Information:", fontSize: 14, bold: true, margin: [0, 10, 0, 5] },
                                "Name: John Doe\nEmail: john@example.com\nPhone: (987) 654-3210"
                            ] }
                    ] },

                { text: "Passenger Information:", fontSize: 14, bold: true, margin: [0, 10, 0, 5] },
                {
                    table: {
                        widths: ['50%', '50%'],
                        body: passengersData.map(passenger => [
                            { text: `Name: ${passenger.name}`, fontSize: 12 },
                            { text: `Age: ${passenger.age}`, fontSize: 12 }
                        ])
                    },
                    layout: 'lightHorizontalLines'
                },

                { text: "Journey Details:", fontSize: 14, bold: true, margin: [0, 10, 0, 5] },
                "Flight Number: ABC123\nDeparture: New York\nDestination: London\nDate: October 15, 2023",

                { text: "Payment Summary:", fontSize: 14, bold: true, margin: [0, 10, 0, 5] },
                {
                    table: {
                        widths: ['70%', '30%'],
                        body: [
                            [{ text: 'Description', bold: true }, { text: 'Amount', bold: true }],
                            ['Base Fare', '$500'],
                            ['Taxes and Fees', '$50'],
                            ['Total', '$550']
                        ]
                    },
                    layout: 'noBorders'
                }
            ];

            // Create a PDF document definition
            const docDefinition = {
                content: content,
                defaultStyle: {
                    fontSize: 12,
                },
            };

            // Generate and open the PDF
            pdfMake.createPdf(docDefinition).open();
        });
    });
</script>
</body>
</html>
