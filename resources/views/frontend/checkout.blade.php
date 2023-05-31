@extends('layouts.frontend')
@section('main_content')
<section >
    <div style="height: 100px"></div>
</section>
<section id="">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Departure :
                        @foreach ($airPrice['Results'][0]['segments'] as $item)
                            {{ $item['Origin']['Airport']['AirportCode'] }} -
                        @endforeach
                    </div>
                    @foreach ($airPrice['Results'][0]['segments'] as $item)
                    <div class="card-body">
                        {{$item['Airline']['AirlineName']}} ({{$item['Airline']['FlightNumber']}}) - {{$item['Origin']['Airport']['CityCode']}} - {{ \Carbon\Carbon::parse($item['Origin']['DepTime'])->format('d-M-y h:i A') }}
                        {{-- {{$item['Origin']['DepTime']}} - 12:55 --}}
                        {{-- VQ -909: From DAC (21-May-23 12:00 PM) To CGP (21-May-23 12:55 PM) --}}
                    </div>
                    @endforeach
                    {{-- <div class="card-header bg-primary text-white">
                        Departure : DAC - CGP : 21-May-23
                    </div>
                    <div class="card-body">

                        NOVOAIR (909)
                        12:00 - 12:55
                        VQ -909: From DAC (21-May-23 12:00 PM) To CGP (21-May-23 12:55 PM)
                    </div> --}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Passenger List &nbsp;&nbsp;
                        <span style="font-size: 1.3rem; color: #fff"><i class="fas fa-male pr-1" style="color: #fff;" aria-hidden="true"></i><span style="font-size: 1.1rem;">{{$airPrice['Results'][0]['Fares'][0]['PassengerCount'] ?? '0'}}</span></span>
                        <span style="font-size: 1.1rem; color: #fff"><i class="fas fa-child pr-1" style="color: #fff;" aria-hidden="true"></i><span style="font-size: 1.1rem;">{{ $airPrice['Results'][0]['Fares'][1]['PassengerCount'] ?? '0' }}</span></span>
                        <span style="font-size: 1rem; color: #fff"><i class="fas fa-baby pr-1" style="color: #fff;" aria-hidden="true"></i><span style="font-size: 1.1rem;">{{ $airPrice['Results'][0]['Fares'][2]['PassengerCount'] ?? '0' }}</span></span>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="SearchId" value="{{ $airPrice['SearchId'] }}">
                        <!-- Passenger List -->
                        <div id="passengerAdd" class="mb-3 text-center">
                            @if ($airPrice['Results'][0]['Fares'][0]['PassengerCount'] != 0)
                                @for ($i = 0; $i < $airPrice['Results'][0]['Fares'][0]['PassengerCount']; $i++)
                                    <button type="button" onclick="openModal('adult-'+{{$i + 1}}, 0)" class="btn btn-primary adult-{{$i + 1}}">
                                       Adult {{$i + 1}}
                                    </button>
                                @endfor
                            @endif
                            @if ($airPrice['Results'][0]['Fares'][1]['PassengerCount'] != 0)
                                @for ($i = 0; $i < $airPrice['Results'][0]['Fares'][1]['PassengerCount']; $i++)
                                    <button type="button" onclick="openModal('child-'+{{$i + 1}}, 1)" class="btn btn-primary child-{{$i + 1}}">
                                        Child {{$i + 1}}
                                    </button>
                                @endfor
                            @endif
                            @if ($airPrice['Results'][0]['Fares'][2]['PassengerCount'] != 0)
                                @for ($i = 0; $i < $airPrice['Results'][0]['Fares'][2]['PassengerCount']; $i++)
                                    <button type="button" onclick="openModal('infant-'+{{$i + 1}}, 2)" class="btn btn-primary infant-{{$i + 1}}">
                                        Infant {{$i + 1}}
                                    </button>
                                @endfor
                            @endif
                        </div>

                        <div class="passanger_list mb-3">
                            <div class="bus_ticket_tabel">
                                <table class="tabel">
                                    <thead>
                                        <td>Pax Type</td>
                                        <td>First Name</td>
                                        <td>Gender</td>
                                        <td>Age</td>
                                        <td>Action</td>
                                    </thead>
                                    <tbody class="passangerInfo">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <table class="table">

                            {{-- @dump($airPrice) --}}
                            <tr>
                                <th colspan="2">Bill ID: 146518 - MD NURNOBI HOSEN</th>
                            </tr>
                            <tr>
                                <th>Total Fare</th>
                                <td>{{$airPrice['Results'][0]['TotalFare']}}</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{$airPrice['Results'][0]['TotalFare'] - $airPrice['Results'][0]['TotalFareWithAgentMarkup']}}</td>
                            </tr>
                            <tr>
                                <th>Net Pay</th>
                                <td>{{$airPrice['Results'][0]['TotalFareWithAgentMarkup']}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-danger font-italic">Avail Extra Discount on selected Card
                                    T&C Apply
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="small">
                                    <span class="text-bold">Refund</span>
                                    <hr>
                                    Cancellation Fee = Airline's Fee + Amy's Fee (BDT 300)
                                    Refund Amount = Paid Amount - Cancellation Fee
                                    <hr>
                                    <span class="text-bold">Re-issue</span>
                                    <hr>
                                    Re-issue Fee= Airline's Fee + Fare Difference + Amy's Fee ( BDT 200 )
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Payment Options
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Select a Payment Option</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentOption" id="option1" value="option1">
                            <label class="form-check-label" for="option1">
                                Credit Card
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentOption" id="option2" value="option2">
                            <label class="form-check-label" for="option2">
                                PayPal
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentOption" id="option3" value="option3">
                            <label class="form-check-label" for="option3">
                                Bank Transfer
                            </label>
                        </div>

                        <div class="text-danger small">
                            We Don't Save any of your Card's information. We will redirect you to Bank's Secured Payment Gateway.
                            Please complete payment within 10 minutes.
                            BKash/Nagad Charge, Credit Card Charge Applicable.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="addPassanger" tabindex="-1" aria-labelledby="addPassangerL" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add <span id="addPassangerTitle"></span>  Passanger</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row mb-3">
                        <div class="col-2">
                            <select class="form-control" name="title" required aria-label="Default select example">
                                <option selected disabled>Choose Title</option>
                                <option value="1">Mr</option>
                                <option value="2">Ms</option>
                                <option value="3">Mrs</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <input type="text" class="form-control" disabled id="paxName">
                            <input type="hidden" id="paxVal" name="pax_type">
                        </div>
                        <div class="col-4">
                            <select class="form-control" name="gender" required aria-label="Default select example">
                                <option selected disabled>Choose Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" name="age" placeholder="Age">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-passenger">Add Passenger</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function openModal(name, pax_type) {
        $('#paxVal').val(pax_type);
        let pax_type_na = pax_type_name(pax_type);

        $('#addPassangerTitle').text(name);
        $('#paxName').val(pax_type_na);

        $('#addPassanger').modal('show');
    };

    $(".add-passenger").click(function(e){

        e.preventDefault();
        let SearchId = $('#SearchId').val();
        let title = $("select[name=title]").val();
        let first_name = $("input[name=first_name]").val();
        let last_name = $("input[name=last_name]").val();
        let email = $("input[name=email]").val();
        let contact_number = $("input[name=contact_number]").val();
        let pax_type = $("input[name=pax_type]").val();
        let gender = $("select[name=gender]").val();
        let age = $("input[name=age]").val();

        $.ajax({
        type:'POST',
        url:"{{ route('add.passenger') }}",
        data:{
                SearchId:SearchId,
                title:title,
                first_name:first_name,
                last_name:last_name,
                email:email,
                contact_number:contact_number,
                pax_type:pax_type,
                gender:gender,
                age:age
            },
            success:function(response){
                let res = response.data;
                let adultBtn = 1;
                let childBtn = 1;
                let infantBtn = 1;
                $(".passangerInfo").html('');
                for (let i = 0; i < res.length; i++){
                    let res1 = res[i];
                    if (res1 && res1.pax_type) {

                        if(res1.pax_type == 0) {
                            $('.adult-'+adultBtn).prop('disabled', true);
                            adultBtn++;
                        }
                        if(res1.pax_type == 1) {
                            $('.child-'+childBtn).prop('disabled', true);
                            childBtn++;
                        }
                        if(res1.pax_type == 2) {
                            $('.infant-'+infantBtn).prop('disabled', true);
                            infantBtn++;
                        }
                    }

                    passengerList(res1);
                }

                $('#addPassanger').modal('hide');
                $("select[name=title]").val('');
                $("input[name=first_name]").val('');
                $("input[name=last_name]").val('');
                $("input[name=email]").val('');
                $("input[name=contact_number]").val('');
                $("input[name=pax_type]").val('');
                $("select[name=gender]").val('');
                $("input[name=age]").val('');
            },
            error: function(response) {
                console.log(response);
            }
        });

    });

    $(window).on('load', function() {

        let SearchId = $('#SearchId').val();

        $.ajax({
            type: 'GET',
            url: '/passenger/session/'+SearchId,
            success:function(response) {
                if(response.data)
                {
                    let res = response.data;
                    let adultBtn = 1;
                    let childBtn = 1;
                    let infantBtn = 1;
                    $(".passangerInfo").html('');
                    for (let i = 0; i <= res.length; i++){
                        let res1 = res[i];

                        if (res1 && res1.pax_type) {
                            if(res1.pax_type == 0) {
                                $('.adult-'+adultBtn).prop('disabled', true);
                                adultBtn++;
                            }
                            if(res1.pax_type == 1) {
                                $('.child-'+childBtn).prop('disabled', true);
                                childBtn++;
                            }
                            if(res1.pax_type == 2) {
                                $('.infant-'+infantBtn).prop('disabled', true);
                                infantBtn++;
                            }
                        }
                        passengerList(res1);
                    }
                }
            },
            error:function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    function passengerList(res)
    {
        if(res && res.pax_type)
        {
            let pax_type_na = pax_type_name(res.pax_type);
            let gender_na = gender_name(res.gender);
            if(pax_type_name && gender_name)
            {
                let html = '<tr>' +
                        '<td>'  + pax_type_na + '</td>' +
                        '<td>'  + res.first_name + '</td>' +
                        '<td>'  + gender_na + '</td>' +
                        '<td>'  + res.age + '</td>' +
                        '<td><button data-item-id="'+ res.id +'" class="btn btn-warning btn-sm passenger_edit"><i class="fas fa-pencil-alt"></i></button></td>' +
                    '</tr>';

                $(".passangerInfo").append(html);
            }
        }
    }

    function gender_name(gender)
    {
        if (gender == 1) {
            return 'Male';
        }
        if (gender == 2) {
            return 'Female';
        }
    }

    function pax_type_name(pax_type)
    {
        if (pax_type == 0) {
            return 'Adult';
        }
        if (pax_type == 1) {
            return 'Child';
        }
        if (pax_type == 2) {
            return 'Infant';
        }
    }

    $(".passenger_edit").click(function(e){
        e.preventDefault();

        console.log('ok');
        var itemId = $(this).data('item-id');
        console.log(itemId);
    });

</script>

@endsection
