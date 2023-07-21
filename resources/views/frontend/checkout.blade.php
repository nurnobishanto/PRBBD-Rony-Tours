@extends('layouts.frontend')
@section('main_content')
<section >
    <div style="height: 100px"></div>
</section>
<section id="">
    <div class="container">
        <form action="{{route('flight_booking_step2')}}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info">Additional Information</div>
                        <div class="card- table-responsive" >
                            <table class="table table-bordered">
                                <tr>
                                    <th>Passport Mandatory</th>
                                    <input name="passport_mandatory" value="{{$PassportMadatory}}" class="d-none"/>
                                    <input name="passport_date" value="{{$passport_date}}" class="d-none"/>
                                    <td>{{($PassportMadatory)?'YES':'NO'}}</td>
                                </tr>
                                <tr>
                                    <th>Refundable</th>
                                    <input name="is_refundable" value="{{$IsRefundable}}" class="d-none"/>
                                    <td>{{($IsRefundable)?'YES':'NO'}}</td>
                                </tr>
                                <tr>
                                    <th>Hold Allowed</th>
                                    <input name="can_hold" value="{{$HoldAllowed}}" class="d-none"/>
                                    <td>{{($HoldAllowed)?'YES':'NO'}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-header bg-primary text-white"> Fare Summary</div>
                            <div class="card-body">
                                <table class="table table-border">
                                    <tr>
                                        <th colspan="2">Base fare</th>
                                    </tr>
                                    @foreach($airs['Results'][0]['Fares'] as $item)
                                        @if($item['PaxType'] == 'Adult')
                                        <tr>
                                            <td>{{$item['PaxType']}} ({{$item['PassengerCount']}} x {{$adult_price}})</td>
                                            <td style="text-align: right;">{{$item['PassengerCount']*$adult_price}} BDT</td>
                                        </tr>
                                        @elseif($item['PaxType'] == 'Child')
                                        <tr>
                                            <td>{{$item['PaxType']}} ({{$item['PassengerCount']}} x {{$child_price}})</td>
                                            <td style="text-align: right;">{{$item['PassengerCount']*$child_price}} BDT</td>
                                        </tr>
                                        @elseif($item['PaxType'] == 'Infant')
                                        <tr>
                                            <td>{{$item['PaxType']}} ({{$item['PassengerCount']}} x {{$infant_price}})</td>
                                            <td style="text-align: right;">{{$item['PassengerCount']*$infant_price}} BDT</td>
                                        </tr>
                                        @endif

                                    @endforeach
                                    <tr>
                                        <th>Sub Total</th>
                                        <th style="text-align: right;">{{$total_ws_amount}} BDT</th>
                                    </tr>
                                    <tr>
                                        <td>Total Discount</td>
                                        <td style="text-align: right;">{{$user_profit}} BDT</td>
                                    </tr>
                                    <tr>
                                        <td>Total Fare</td>
                                        <td style="text-align: right;">{{$net_pay}} BDT</td>
                                    </tr>
                                    <tr class="bg-warning text-dark">
                                        <th>Net Total</th>
                                        <th style="text-align: right;">{{$net_pay}} BDT</th>
                                    </tr>
                                    <input name="total_amount" value="{{$airs['Results'][0]['TotalFare']}}" class="d-none"/>
                                    <input name="gross_amount" value="{{$airs['Results'][0]['TotalFare']}}" class="d-none"/>
                                    <input name="profit_amount" value="{{$airs['Results'][0]['Discount']}}" class="d-none"/>
                                    <input name="fare_type" value="{{$airs['Results'][0]['FareType']}}" class="d-none"/>

                                </table>
                            </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card my-2">
                        <div class="card-header bg-primary text-white">Flight Details</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Airlines</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Duration</th>
                                    </tr>
                                    <?php $t = 1;?>
                                    @foreach($airs['Results'][0]['segments'] as $item)

                                    <input name="from_{{$t}}" class="d-none" value="{{$item['Origin']['Airport']['AirportCode']}}"/>
                                    <input name="to_{{$t}}" class="d-none" value="{{$item['Destination']['Airport']['AirportCode']}}"/>
                                    <input name="carrier_{{$t}}" class="d-none" value="{{$item['Airline']['OperatingCarrier']}}"/>
                                    <input name="carrier_{{$t}}" class="d-none" value="{{$item['Airline']['OperatingCarrier']}}"/>
                                    <input name="distance_{{$t}}" class="d-none" value=""/>

                                    <input name="duration_{{$t}}" class="d-none" value="{{$item['JourneyDuration']}}"/>
                                    <input name="cabin_class_{{$t}}" class="d-none" value="{{$item['Airline']['CabinClass']}}"/>
                                    <input name="arrival_time_{{$t}}" class="d-none" value="{{$item['Destination']['ArrTime']}}"/>
                                    <input name="departure_time_{{$t}}" class="d-none" value="{{$item['Origin']['DepTime']}}"/>
                                    <input name="airline_name_{{$t}}" class="d-none" value="{{$item['Airline']['AirlineName']}}"/>
                                    <input name="airline_code_{{$t}}" class="d-none" value="{{$item['Airline']['AirlineCode']}}"/>
                                    <input name="trip_group_{{$t}}" class="d-none" value="{{$item['SegmentGroup']}}"/>
                                    <input name="trip_indicator_{{$t}}" class="d-none" value="{{$item['TripIndicator']}}"/>

                                        <tr>
                                            <td class="small">{{$item['Airline']['AirlineName']}} ({{$item['Airline']['AirlineCode']}} - {{$item['Airline']['FlightNumber']}})</td>
                                            <td class="small">{{$item['Origin']['Airport']['CityName']}} ({{$item['Origin']['Airport']['CityCode']}}), {{$item['Origin']['Airport']['AirportName']}}<br>{{date('d M Y, h:i A',strtotime($item['Origin']['DepTime'])) }} </td>
                                            <td class="small">{{$item['Destination']['Airport']['CityName']}} ({{$item['Destination']['Airport']['CityCode']}}), {{$item['Destination']['Airport']['AirportName']}}<br>{{date('d M Y, h:i A',strtotime($item['Destination']['ArrTime'])) }} </td>
                                            <td class="small">{{convertMinutesToDuration($item['JourneyDuration'])}}</td>
                                        </tr>
                                            <?php $t++;?>
                                    @endforeach
                                    <input name="result_id" class="d-none" value="{{$ResultID}}"/>
                                    <input name="search_id" class="d-none" value="{{$SearchId}}"/>
                                    <input name="count_travel" class="d-none" value="{{$t}}"/>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card my-2">
                        <div class="card-header bg-primary text-white">Travelers Information</div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <?php $p = 1;?>
                            @foreach($airs['Results'][0]['Fares'] as $item)
                                @for($i = 0;$i<$item['PassengerCount'];$i++)

                                    <h3 class="my-1">Passenger ({{$p}}) <sup class="bg-dark text-light px-2 rounded-pill" style="font-size: 12px;">{{$item['PaxType']}}</sup></h3>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-3">
                                            <div class="form-group">
                                                <label for="title_{{$p}}">Title</label>
                                                <input required value="{{$item['PaxType']}}" name="PaxType_{{$p}}" class="d-none">
                                                <select required name="title_{{$p}}" class="form-control" id="title_{{$p}}">
                                                    @if($item['PaxType'] == 'Adult')
                                                        <option value="Mr" @if(old('title_'.$p) == 'Mr') selected @endif >Mr</option>
                                                        <option value="Ms" @if(old('title_'.$p) == 'Ms') selected @endif >Ms</option>
                                                        <option value="Mrs" @if(old('title_'.$p) == 'Mrs') selected @endif >Mrs</option>
                                                    @else
                                                        <option value="Mstr" @if(old('title_'.$p) == 'Mstr') selected @endif >Mstr</option>
                                                        <option value="Miss" @if(old('title_'.$p) == 'Miss') selected @endif >Miss</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <label for="first_name_{{$p}}">First Name</label>
                                                <input required type="text" value="{{old('first_name_'.$p)}}" class="form-control" id="first_name_{{$p}}" name="first_name_{{$p}}" placeholder="Enter first name">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-4">
                                            <div class="form-group">
                                                <label for="last_name_{{$p}}">Last Name</label>
                                                <input required type="text" value="{{old('last_name_'.$p)}}" class="form-control" id="last_name_{{$p}}" name="last_name_{{$p}}" placeholder="Enter last name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email_{{$p}}">Email</label>
                                                <input required type="email" value="{{old('email_'.$p)}}" name="email_{{$p}}" class="form-control" id="email_{{$p}}" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_{{$p}}">Phone</label>
                                                <input required type="tel" name="phone_{{$p}}" value="{{old('phone_'.$p)}}" class="form-control" id="phone_{{$p}}" placeholder="Enter phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="DateOfBirth_{{$p}}">Date of birth</label>
                                                <input required type="text" value="{{old('DateOfBirth_'.$p)}}" class="form-control date {{$item['PaxType']}}" name="DateOfBirth_{{$p}}" id="DateOfBirth_{{$p}}" placeholder="Enter date of birth">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_no_{{$p}}">Passport no</label>
                                                <input @if($PassportMadatory) required @endif type="text" value="{{old('passport_no_'.$p)}}" class="form-control" name="passport_no_{{$p}}" id="passport_no_{{$p}}" placeholder="Enter passport no">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="passport_expire_date_{{$p}}">Passport Expire date</label>
                                                <input @if($PassportMadatory) required @endif type="text" value="{{old('passport_expire_date_'.$p)}}" class="form-control date_passport" name="passport_expire_date_{{$p}}" id="passport_expire_date_{{$p}}" placeholder="Enter passport expire">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender_{{$p}}">Gender</label>
                                                <select required  class="form-control" name="gender_{{$p}}" id="gender_{{$p}}">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address_{{$p}}">Address</label>
                                                <input required type="text" value="{{old('address_'.$p)}}" class="form-control" name="address_{{$p}}" id="nationality_{{$p}}" placeholder="Enter address">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                <?php $p++;?>
                                @endfor


                            @endforeach
                            <input required name="p_count" value="{{$p}}" class="d-none">

                            <input required name="total_amount" value="{{$total_amount}}" class="d-none">
                            <input required name="gross_amount" value="{{$gross_amount}}" class="d-none">
                            <input required name="total_ws_amount" value="{{$total_ws_amount}}" class="d-none">
                            <input required name="discount_amount" value="{{$user_profit}}" class="d-none">
                            <input required name="net_pay" value="{{$net_pay}}" class="d-none">
                            <input required name="profit_amount" value="{{$profit_amount}}" class="d-none">
                            <input  type="submit" class="btn btn-warning" value="Continue">
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>
</section>

<script>
    const currentYear = new Date().getFullYear();
    const next15Years = currentYear + 15;

    $('.date').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:{{ date('Y') }}",
    });

    $('.date_passport').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: currentYear + ':' + next15Years,
    });
</script>
@endsection





