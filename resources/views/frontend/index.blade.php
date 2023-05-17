@extends('layouts.frontend')
@section('main_content')

<!-- Form Area -->

<!-- Banner Area -->
<section id="home_four_banner">
    <span class="h-25"></span>
</section>
<div class="container" >
    <section id="theme_search_form" >
        <div class="row">
            <div class="col-lg-12">
                <div class="theme_search_form_area">
                    <div class="theme_search_form_tabbtn">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="flights-tab" data-bs-toggle="tab"
                                    data-bs-target="#flights" type="button" role="tab" aria-controls="flights"
                                    aria-selected="true"><i class="fas fa-plane-departure"></i>Flights</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="flights" role="tabpanel"
                            aria-labelledby="flights-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="flight_categories_search">

                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="oneway-tab" data-bs-toggle="tab"
                                                    data-bs-target="#oneway_flight" type="button" role="tab"
                                                    aria-controls="oneway_flight" aria-selected="true">One
                                                    Way</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="roundtrip-tab" data-bs-toggle="tab"
                                                    data-bs-target="#roundtrip" type="button" role="tab"
                                                    aria-controls="roundtrip"
                                                    aria-selected="false">Roundtrip</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="multi_city-tab" data-bs-toggle="tab"
                                                    data-bs-target="#multi_city" type="button" role="tab"
                                                    aria-controls="multi_city" aria-selected="false">Multi
                                                    city</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent1">
                                <div class="tab-pane fade show active" id="oneway_flight" role="tabpanel"
                                    aria-labelledby="oneway-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="oneway_search_form">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                        <div class="flight_Search_boxed">
                                                            <p>From </p>
                                                            <select id="one_way_from" name="one_way_from">
                                                                @foreach($airports as $a)
                                                                    <option value="{{$a->iata_code}}">{{$a->city}} - {{$a->iata_code}} - {{$a->country}}</option>
                                                                @endforeach
                                                            </select>

                                                            <div class="plan_icon_posation">
                                                                <i class="fas fa-plane-departure"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                        <div class="flight_Search_boxed">
                                                            <p>To</p>
                                                            <select id="one_way_to" name="one_way_to">
                                                                @foreach($airports as $a)
                                                                    <option value="{{$a->iata_code}}">{{$a->city}} - {{$a->iata_code}} - {{$a->country}}</option>
                                                                @endforeach
                                                            </select>

                                                            <div class="plan_icon_posation">
                                                                <i class="fas fa-plane-arrival"></i>
                                                            </div>
                                                            <div class="range_plan" id="one_way_change">
                                                                <i class="fas fa-exchange-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                        <div class="form_search_date">
                                                            <div class="flight_Search_boxed date_flex_area">
                                                                <div class="Journey_date">
                                                                    <p>Journey date</p>
                                                                    <input type="text"  id="one_way_date" value="{{$today}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                        <div
                                                            class="flight_Search_boxed dropdown_passenger_area">
                                                            <p>Passenger, Class </p>
                                                            <div class="dropdown">

                                                                <!-- Button trigger modal -->
                                                                <button type="button"  data-bs-toggle="modal" data-bs-target="#one_wayModal" id="one_way_total_count">
                                                                    0 Passenger
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="one_wayModal" tabindex="-1" aria-labelledby="one_wayModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Passengers</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row border-bottom">
                                                                                    <div class="col-2">
                                                                                        <h2 id="one_way_adult_count">1</h2>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <h5>Adult</h5>
                                                                                        <i>12+ yrs</i>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <div class="button-set">
                                                                                            <button type="button" id="one_way_adult_add"><i  class="fas fa-plus"></i></button>
                                                                                            <button type="button" id="one_way_adult_minus"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row border-bottom my-2">
                                                                                    <div class="col-2">
                                                                                        <h2 id="one_way_child_count">0</h2>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <h5>Children</h5>
                                                                                        <i>2 - Less than 12 yrs</i>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <div class="button-set">
                                                                                            <button type="button" id="one_way_child_add"><i  class="fas fa-plus"></i></button>
                                                                                            <button type="button" id="one_way_child_minus"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-2">
                                                                                        <h2 id="one_way_infant_count">0</h2>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <h5>Infant</h5>
                                                                                        <i>Less than 2 yrs</i>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <div class="button-set">
                                                                                            <button type="button"  id="one_way_infant_add"><i  class="fas fa-plus"></i></button>
                                                                                            <button type="button" id="one_way_infant_minus"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <select id="one_wayCabinClass" name="one_wayCabinClass">
                                                                    <option value="1">Economy</option>
                                                                    <option value="2">Premium</option>
                                                                    <option value="3">Business</option>
                                                                    <option value="4">First Class</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="top_form_search_button">
                                                        <button class="btn btn_theme btn_md" id="one_way_search">Search

                                                        </button>
                                                        <div id="loading-spinner" class="spinner">Searching</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="roundtrip" role="tabpanel"
                                    aria-labelledby="roundtrip-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="oneway_search_form">
                                                <form action="#!">
                                                    <div class="row">
                                                        <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                            <div class="flight_Search_boxed">
                                                                <p>From</p>
                                                                <input type="text" value="New York">
                                                                <span>JFK - John F. Kennedy International...</span>
                                                                <div class="plan_icon_posation">
                                                                    <i class="fas fa-plane-departure"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                            <div class="flight_Search_boxed">
                                                                <p>To</p>
                                                                <input type="text" value="London ">
                                                                <span>LCY, London city airport </span>
                                                                <div class="plan_icon_posation">
                                                                    <i class="fas fa-plane-arrival"></i>
                                                                </div>
                                                                <div class="range_plan">
                                                                    <i class="fas fa-exchange-alt"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4  col-md-6 col-sm-12 col-12">
                                                            <div class="form_search_date">
                                                                <div class="flight_Search_boxed date_flex_area">
                                                                    <div class="Journey_date">
                                                                        <p>Journey date</p>
                                                                        <input type="date" value="2022-05-05">
                                                                        <span>Thursday</span>
                                                                    </div>
                                                                    <div class="Journey_date">
                                                                        <p>Return date</p>
                                                                        <input type="date" value="2022-05-08">
                                                                        <span>Saturday</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                            <div
                                                                class="flight_Search_boxed dropdown_passenger_area">
                                                                <p>Passenger, Class </p>
                                                                <div class="dropdown">
                                                                    <button class="dropdown-toggle final-count"
                                                                        data-toggle="dropdown" type="button"
                                                                        id="returnTotalpButton"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        0 Passenger
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown_passenger_info"
                                                                        aria-labelledby="returnTotalpButton">
                                                                        <div class="traveller-calulate-persons">
                                                                            <div class="passengers">
                                                                                <h6>Passengers</h6>
                                                                                <div class="passengers-types">
                                                                                    <div class="passengers-type">
                                                                                        <div class="text"><span
                                                                                                class="count pcount">2</span>
                                                                                            <div class="type-label">
                                                                                                <p>Adult</p>
                                                                                                <span>12+
                                                                                                    yrs</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="button-set">
                                                                                            <button type="button"
                                                                                                class="btn-add">
                                                                                                <i
                                                                                                    class="fas fa-plus"></i>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="btn-subtract">
                                                                                                <i
                                                                                                    class="fas fa-minus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="passengers-type">
                                                                                        <div class="text"><span
                                                                                                class="count ccount">0</span>
                                                                                            <div class="type-label">
                                                                                                <p
                                                                                                    class="fz14 mb-xs-0">
                                                                                                    Children
                                                                                                </p><span>2
                                                                                                    - Less than 12
                                                                                                    yrs</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="button-set">
                                                                                            <button type="button"
                                                                                                class="btn-add-c">
                                                                                                <i
                                                                                                    class="fas fa-plus"></i>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="btn-subtract-c">
                                                                                                <i
                                                                                                    class="fas fa-minus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="passengers-type">
                                                                                        <div class="text"><span
                                                                                                class="count incount">0</span>
                                                                                            <div class="type-label">
                                                                                                <p
                                                                                                    class="fz14 mb-xs-0">
                                                                                                    Infant
                                                                                                </p><span>Less
                                                                                                    than 2
                                                                                                    yrs</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="button-set">
                                                                                            <button type="button"
                                                                                                class="btn-add-in">
                                                                                                <i
                                                                                                    class="fas fa-plus"></i>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="btn-subtract-in">
                                                                                                <i
                                                                                                    class="fas fa-minus"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cabin-selection">
                                                                                <h6>Cabin Class</h6>
                                                                                <div class="cabin-list">
                                                                                    <button type="button"
                                                                                        class="label-select-btn">
                                                                                        <span
                                                                                            class="muiButton-label">Economy
                                                                                        </span>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="label-select-btn active">
                                                                                        <span
                                                                                            class="muiButton-label">
                                                                                            Business
                                                                                        </span>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="label-select-btn">
                                                                                        <span
                                                                                            class="MuiButton-label">First
                                                                                            Class </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span>Business</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top_form_search_button">
                                                        <button class="btn btn_theme btn_md">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="multi_city" role="tabpanel"
                                    aria-labelledby="multi_city-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="oneway_search_form">
                                                <form action="">
                                                    <div class="multi_city_form_wrapper">
                                                        <div class="multi_city_form">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                    <div class="flight_Search_boxed">
                                                                        <p>From</p>
                                                                        <input type="text" value="New York">
                                                                        <span>DAC, Hazrat Shahajalal
                                                                            International...</span>
                                                                        <div class="plan_icon_posation">
                                                                            <i class="fas fa-plane-departure"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                    <div class="flight_Search_boxed">
                                                                        <p>To</p>
                                                                        <input type="text" value="London ">
                                                                        <span>LCY, London city airport </span>
                                                                        <div class="plan_icon_posation">
                                                                            <i class="fas fa-plane-arrival"></i>
                                                                        </div>
                                                                        <div class="range_plan">
                                                                            <i class="fas fa-exchange-alt"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                    <div class="form_search_date">
                                                                        <div
                                                                            class="flight_Search_boxed date_flex_area">
                                                                            <div class="Journey_date">
                                                                                <p>Journey date</p>
                                                                                <input type="date"
                                                                                    value="2022-05-05">
                                                                                <span>Thursday</span>
                                                                            </div>
                                                                            <div class="Journey_date">
                                                                                <p>Return date</p>
                                                                                <input type="date"
                                                                                    value="2022-05-10">
                                                                                <span>Saturday</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                                    <div
                                                                        class="flight_Search_boxed dropdown_passenger_area">
                                                                        <p>Passenger, Class </p>
                                                                        <div class="dropdown">
                                                                            <button
                                                                                class="dropdown-toggle final-count"
                                                                                data-toggle="dropdown" type="button"
                                                                                id="dropdownMenuButton1"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                0 Passenger
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown_passenger_info"
                                                                                aria-labelledby="dropdownMenuButton1">
                                                                                <div
                                                                                    class="traveller-calulate-persons">
                                                                                    <div class="passengers">
                                                                                        <h6>Passengers</h6>
                                                                                        <div
                                                                                            class="passengers-types">
                                                                                            <div
                                                                                                class="passengers-type">
                                                                                                <div class="text">
                                                                                                    <span
                                                                                                        class="count pcount">2</span>
                                                                                                    <div
                                                                                                        class="type-label">
                                                                                                        <p>Adult</p>
                                                                                                        <span>12+
                                                                                                            yrs</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="button-set">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-add">
                                                                                                        <i
                                                                                                            class="fas fa-plus"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-subtract">
                                                                                                        <i
                                                                                                            class="fas fa-minus"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="passengers-type">
                                                                                                <div class="text">
                                                                                                    <span
                                                                                                        class="count ccount">0</span>
                                                                                                    <div
                                                                                                        class="type-label">
                                                                                                        <p
                                                                                                            class="fz14 mb-xs-0">
                                                                                                            Children
                                                                                                        </p><span>2
                                                                                                            - Less
                                                                                                            than 12
                                                                                                            yrs</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="button-set">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-add-c">
                                                                                                        <i
                                                                                                            class="fas fa-plus"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-subtract-c">
                                                                                                        <i
                                                                                                            class="fas fa-minus"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="passengers-type">
                                                                                                <div class="text">
                                                                                                    <span
                                                                                                        class="count incount">0</span>
                                                                                                    <div
                                                                                                        class="type-label">
                                                                                                        <p
                                                                                                            class="fz14 mb-xs-0">
                                                                                                            Infant
                                                                                                        </p><span>Less
                                                                                                            than 2
                                                                                                            yrs</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="button-set">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-add-in">
                                                                                                        <i
                                                                                                            class="fas fa-plus"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-subtract-in">
                                                                                                        <i
                                                                                                            class="fas fa-minus"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="cabin-selection">
                                                                                        <h6>Cabin Class</h6>
                                                                                        <div class="cabin-list">
                                                                                            <button type="button"
                                                                                                class="label-select-btn">
                                                                                                <span
                                                                                                    class="muiButton-label">Economy
                                                                                                </span>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="label-select-btn active">
                                                                                                <span
                                                                                                    class="muiButton-label">
                                                                                                    Business
                                                                                                </span>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="label-select-btn">
                                                                                                <span
                                                                                                    class="MuiButton-label">First
                                                                                                    Class </span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <span>Business</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="multi_city_form">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                    <div class="flight_Search_boxed">
                                                                        <p>From</p>
                                                                        <input type="text" value="New York">
                                                                        <span>DAC, Hazrat Shahajalal
                                                                            International...</span>
                                                                        <div class="plan_icon_posation">
                                                                            <i class="fas fa-plane-departure"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                                                                    <div class="flight_Search_boxed">
                                                                        <p>To</p>
                                                                        <input type="text" value="London ">
                                                                        <span>LCY, London city airport </span>
                                                                        <div class="plan_icon_posation">
                                                                            <i class="fas fa-plane-arrival"></i>
                                                                        </div>
                                                                        <div class="range_plan">
                                                                            <i class="fas fa-exchange-alt"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                    <div class="form_search_date">
                                                                        <div
                                                                            class="flight_Search_boxed date_flex_area">
                                                                            <div class="Journey_date">
                                                                                <p>Journey date</p>
                                                                                <input type="date"
                                                                                    value="2022-05-05">
                                                                                <span>Thursday</span>
                                                                            </div>
                                                                            <div class="Journey_date">
                                                                                <p>Return date</p>
                                                                                <input type="date"
                                                                                    value="2022-05-12">
                                                                                <span>Saturday</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                                    <div
                                                                        class="flight_Search_boxed dropdown_passenger_area">
                                                                        <p>Passenger, Class </p>
                                                                        <div class="dropdown">
                                                                            <button
                                                                                class="dropdown-toggle final-count"
                                                                                data-toggle="dropdown" type="button"
                                                                                id="MultiWayButtonPat"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                0 Passenger
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown_passenger_info"
                                                                                aria-labelledby="MultiWayButtonPat">
                                                                                <div
                                                                                    class="traveller-calulate-persons">
                                                                                    <div class="passengers">
                                                                                        <h6>Passengers</h6>
                                                                                        <div
                                                                                            class="passengers-types">
                                                                                            <div
                                                                                                class="passengers-type">
                                                                                                <div class="text">
                                                                                                    <span
                                                                                                        class="count pcount">2</span>
                                                                                                    <div
                                                                                                        class="type-label">
                                                                                                        <p>Adult</p>
                                                                                                        <span>12+
                                                                                                            yrs</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="button-set">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-add">
                                                                                                        <i
                                                                                                            class="fas fa-plus"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-subtract">
                                                                                                        <i
                                                                                                            class="fas fa-minus"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="passengers-type">
                                                                                                <div class="text">
                                                                                                    <span
                                                                                                        class="count ccount">0</span>
                                                                                                    <div
                                                                                                        class="type-label">
                                                                                                        <p
                                                                                                            class="fz14 mb-xs-0">
                                                                                                            Children
                                                                                                        </p><span>2
                                                                                                            - Less
                                                                                                            than 12
                                                                                                            yrs</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="button-set">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-add-c">
                                                                                                        <i
                                                                                                            class="fas fa-plus"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-subtract-c">
                                                                                                        <i
                                                                                                            class="fas fa-minus"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="passengers-type">
                                                                                                <div class="text">
                                                                                                    <span
                                                                                                        class="count incount">0</span>
                                                                                                    <div
                                                                                                        class="type-label">
                                                                                                        <p
                                                                                                            class="fz14 mb-xs-0">
                                                                                                            Infant
                                                                                                        </p><span>Less
                                                                                                            than 2
                                                                                                            yrs</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="button-set">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-add-in">
                                                                                                        <i
                                                                                                            class="fas fa-plus"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn-subtract-in">
                                                                                                        <i
                                                                                                            class="fas fa-minus"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="cabin-selection">
                                                                                        <h6>Cabin Class</h6>
                                                                                        <div class="cabin-list">
                                                                                            <button type="button"
                                                                                                class="label-select-btn">
                                                                                                <span
                                                                                                    class="muiButton-label">Economy
                                                                                                </span>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="label-select-btn active">
                                                                                                <span
                                                                                                    class="muiButton-label">
                                                                                                    Business
                                                                                                </span>
                                                                                            </button>
                                                                                            <button type="button"
                                                                                                class="label-select-btn">
                                                                                                <span
                                                                                                    class="MuiButton-label">First
                                                                                                    Class </span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <span>Business</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="add_multy_form">
                                                                <button type="button" id="addMulticityRow">+ Add
                                                                    another
                                                                    flight</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top_form_search_button">
                                                        <button class="btn btn_theme btn_md">Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Flight Search Areas -->
<section id="flight_search_area" class="section_padding d-none">
    <div class="container">
        <!-- Section Heading -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="section_heading_center d-none" id="flight_count">
                    <h2></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="left_side_search_area d-none" id="filter_area">
                    <div class="left_side_search_boxed">
                        <div class="left_side_search_heading">
                            <h5>Number of stops</h5>
                        </div>
                        <div class="tour_search_type">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf1">
                                <label class="form-check-label" for="flexCheckDefaultf1">
                                    <span class="area_flex_one">
                                        <span>1 stop</span>
                                        <span>20</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf2">
                                <label class="form-check-label" for="flexCheckDefaultf2">
                                    <span class="area_flex_one">
                                        <span>2 stop</span>
                                        <span>16</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf3">
                                <label class="form-check-label" for="flexCheckDefaultf3">
                                    <span class="area_flex_one">
                                        <span>3 stop</span>
                                        <span>30</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf4">
                                <label class="form-check-label" for="flexCheckDefaultf4">
                                    <span class="area_flex_one">
                                        <span>Non-stop</span>
                                        <span>22</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="left_side_search_boxed">
                        <div class="left_side_search_heading">
                            <h5>Flight class</h5>
                        </div>
                        <div class="tour_search_type">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt1">
                                <label class="form-check-label" for="flexCheckDefaultt1">
                                    <span class="area_flex_one">
                                        <span>Economy</span>
                                        <span>20</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt2">
                                <label class="form-check-label" for="flexCheckDefaultt2">
                                    <span class="area_flex_one">
                                        <span>Business</span>
                                        <span>26</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="left_side_search_boxed">
                        <div class="left_side_search_heading">
                            <h5>Airlines</h5>
                        </div>
                        <div class="tour_search_type">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaults1">
                                <label class="form-check-label" for="flexCheckDefaults1">
                                    <span class="area_flex_one">
                                        <span>Quatar Airways</span>
                                        <span>17</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaults2">
                                <label class="form-check-label" for="flexCheckDefaults2">
                                    <span class="area_flex_one">
                                        <span>Fly Amirates </span>
                                        <span>14</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaults3">
                                <label class="form-check-label" for="flexCheckDefaults3">
                                    <span class="area_flex_one">
                                        <span>Novo Air </span>
                                        <span>62</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaults4">
                                <label class="form-check-label" for="flexCheckDefaults4">
                                    <span class="area_flex_one">
                                        <span>Air Asia </span>
                                        <span>08</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaults5">
                                <label class="form-check-label" for="flexCheckDefaults5">
                                    <span class="area_flex_one">
                                        <span>Singapore Airlines </span>
                                        <span>12</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="left_side_search_boxed">
                        <div class="left_side_search_heading">
                            <h5>Refundable</h5>
                        </div>
                        <div class="tour_search_type">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultp1">
                                <label class="form-check-label" for="flexCheckDefaultp1">
                                    <span class="area_flex_one">
                                        <span>Yes</span>
                                        <span>17</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultp2">
                                <label class="form-check-label" for="flexCheckDefaultp2">
                                    <span class="area_flex_one">
                                        <span>No</span>
                                        <span>14</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultp3">
                                <label class="form-check-label" for="flexCheckDefaultp3">
                                    <span class="area_flex_one">
                                        <span>As per rules</span>
                                        <span>62</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="flight_search_result_wrapper">
                            {{-- <div class="flight_search_item_wrappper">
                                <div class="flight_search_items">
                                    <div class="multi_city_flight_lists">
                                        <div class="flight_multis_area_wrapper">
                                            <div class="flight_search_left">
                                                <div class="flight_logo">
                                                    <img src="assets/img/common/biman_bangla.png" alt="img">
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>From</p>
                                                    <h3>New York</h3>
                                                    <h6>JFK - John F. Kennedy International...</h6>
                                                </div>
                                            </div>
                                            <div class="flight_search_middel">
                                                <div class="flight_right_arrow">
                                                    <img src="assets/img/icon/right_arrow.png" alt="icon">
                                                    <h6>Non-stop</h6>
                                                    <p>01h 05minute </p>
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>To</p>
                                                    <h3>London </h3>
                                                    <h6>LCY, London city airport </h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="flight_search_right">
                                        <h5><del>$9,560</del></h5>
                                        <h2>$7,560<sup>*20% OFF</sup></h2>
                                        <button type="button" class="btn btn_theme btn_sm" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                            Book now
                                        </button>
                                        <p>*Discount applicable on some conditions</p>
                                        <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                            aria-expanded="false" aria-controls="collapseExample">Show more <i
                                                class="fas fa-chevron-down"></i></h6>
                                    </div>
                                </div>
                                <div class="flight_policy_refund collapse" id="collapseExample">
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <!-- Flight Search Item -->
                            <div class="flight_search_item_wrappper">
                                <div class="flight_search_items">
                                    <div class="multi_city_flight_lists">
                                        <div class="flight_multis_area_wrapper">
                                            <div class="flight_search_left">
                                                <div class="flight_logo">
                                                    <img src="assets/img/common/biman_bangla.png" alt="img">
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>From </p>
                                                    <h3>New York</h3>
                                                    <h6>JFK - John F. Kennedy International...</h6>
                                                </div>
                                            </div>
                                            <div class="flight_search_middel">
                                                <div class="flight_right_arrow">
                                                    <img src="assets/img/icon/right_arrow.png" alt="icon">
                                                    <h6>Non-stop</h6>
                                                    <p>01h 05minute </p>
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>To</p>
                                                    <h3>London </h3>
                                                    <h6>LCY, London city airport </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_search_right">
                                        <h5><del>$9,560</del></h5>
                                        <h2>$7,560<sup>*20% OFF</sup></h2>
                                        <button type="button" class="btn btn_theme btn_sm" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                            Book now
                                        </button>
                                        <p>*Discount applicable on some conditions</p>
                                        <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample2"
                                            aria-expanded="false" aria-controls="collapseExample2">Show more <i
                                                class="fas fa-chevron-down"></i></h6>
                                    </div>
                                </div>
                                <div class="flight_policy_refund collapse" id="collapseExample2">
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Flight Search Item -->
                            <div class="flight_search_item_wrappper">
                                <div class="flight_search_items">
                                    <div class="multi_city_flight_lists">
                                        <div class="flight_multis_area_wrapper">
                                            <div class="flight_search_left">
                                                <div class="flight_logo">
                                                    <img src="assets/img/common/biman_bangla.png" alt="img">
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>From</p>
                                                    <h3>New York</h3>
                                                    <h6>JFK - John F. Kennedy International...</h6>
                                                </div>
                                            </div>
                                            <div class="flight_search_middel">
                                                <div class="flight_right_arrow">
                                                    <img src="assets/img/icon/right_arrow.png" alt="icon">
                                                    <h6>Non-stop</h6>
                                                    <p>01h 05minute </p>
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>To</p>
                                                    <h3>London </h3>
                                                    <h6>LCY, London city airport </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_search_right">
                                        <h5><del>$9,560</del></h5>
                                        <h2>$7,560<sup>*20% OFF</sup></h2>
                                        <button type="button" class="btn btn_theme btn_sm" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                            Book now
                                        </button>
                                        <p>*Discount applicable on some conditions</p>
                                        <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample3"
                                            aria-expanded="false" aria-controls="collapseExample3">Show more <i
                                                class="fas fa-chevron-down"></i></h6>
                                    </div>
                                </div>
                                <div class="flight_policy_refund collapse" id="collapseExample3">
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Flight Search Item -->
                            <div class="flight_search_item_wrappper">
                                <div class="flight_search_items">
                                    <div class="multi_city_flight_lists">
                                        <div class="flight_multis_area_wrapper">
                                            <div class="flight_search_left">
                                                <div class="flight_logo">
                                                    <img src="assets/img/common/biman_bangla.png" alt="img">
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>From</p>
                                                    <h3>New York</h3>
                                                    <h6>JFK - John F. Kennedy International...</h6>
                                                </div>
                                            </div>
                                            <div class="flight_search_middel">
                                                <div class="flight_right_arrow">
                                                    <img src="assets/img/icon/right_arrow.png" alt="icon">
                                                    <h6>Non-stop</h6>
                                                    <p>01h 05minute </p>
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>To</p>
                                                    <h3>London </h3>
                                                    <h6>LCY, London city airport </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_search_right">
                                        <h5><del>$9,560</del></h5>
                                        <h2>$7,560<sup>*20% OFF</sup></h2>
                                        <button type="button" class="btn btn_theme btn_sm" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                            Book now
                                        </button>
                                        <p>*Discount applicable on some conditions</p>
                                        <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample4"
                                            aria-expanded="false" aria-controls="collapseExample4">Show more <i
                                                class="fas fa-chevron-down"></i></h6>
                                    </div>
                                </div>
                                <div class="flight_policy_refund collapse" id="collapseExample4">
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Flight Search Item -->
                            <div class="flight_search_item_wrappper">
                                <div class="flight_search_items">
                                    <div class="multi_city_flight_lists">
                                        <div class="flight_multis_area_wrapper">
                                            <div class="flight_search_left">
                                                <div class="flight_logo">
                                                    <img src="assets/img/common/biman_bangla.png" alt="img">
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>From</p>
                                                    <h3>New York</h3>
                                                    <h6>JFK - John F. Kennedy International...</h6>
                                                </div>
                                            </div>
                                            <div class="flight_search_middel">
                                                <div class="flight_right_arrow">
                                                    <img src="assets/img/icon/right_arrow.png" alt="icon">
                                                    <h6>Non-stop</h6>
                                                    <p>01h 05minute </p>
                                                </div>
                                                <div class="flight_search_destination">
                                                    <p>To</p>
                                                    <h3>London </h3>
                                                    <h6>LCY, London city airport </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_search_right">
                                        <h5><del>$9,560</del></h5>
                                        <h2>$7,560<sup>*20% OFF</sup></h2>
                                        <button type="button" class="btn btn_theme btn_sm" data-bs-toggle="modal" data-bs-target="#pricingModal">
                                            Book now
                                        </button>
                                        <p>*Discount applicable on some conditions</p>
                                        <h6 data-bs-toggle="collapse" data-bs-target="#collapseExample5"
                                            aria-expanded="false" aria-controls="collapseExample5">Show more <i
                                                class="fas fa-chevron-down"></i></h6>
                                    </div>
                                </div>
                                <div class="flight_policy_refund collapse" id="collapseExample5">
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flight_show_down_wrapper">
                                        <div class="flight-shoe_dow_item">
                                            <div class="airline-details">
                                                <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div>
                                                <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp;
                                                    BG435</span>
                                                <span class="flightNumber">BOEING 737-800 - 738</span>
                                            </div>
                                            <div class="flight_inner_show_component">
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                                <div class="flight_duration">
                                                    <div class="arrow_right"></div>
                                                    <span>01h 15m</span>
                                                </div>
                                                <div class="flight_det_wrapper">
                                                    <div class="flight_det">
                                                        <div class="code_time">
                                                            <span class="code">DAC</span>
                                                            <span class="time">15:00</span>
                                                        </div>
                                                        <p class="airport">Hazrat Shahjalal International Airport
                                                        </p>
                                                        <p class="date">7th Jun 2022</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flight_refund_policy">
                                            <div class="TabPanelInner flex_widht_less">
                                                <h4>Refund Policy</h4>
                                                <p class="fz12">1. Refund and Date Change are done as per the
                                                    following policies.</p>
                                                <p class="fz12">2. Refund Amount= Refund Charge (as per airline
                                                    policy + ShareTrip Convenience Fee). </p>
                                                <p class="fz12">3. Date Change Amount= Date Change Fee (as per
                                                    Airline Policy + ShareTrip Convenience Fee).</p>
                                            </div>
                                            <div class="TabPanelInner">
                                                <h4>Baggage</h4>
                                                <div class="flight_info_taable">
                                                    <h3>DAC-SPD</h3>
                                                    <p><span>20KG /</span> person</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="top_details_area" class="section_padding_top">
    <div class="container">
        <!-- Section Heading -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="section_heading_left">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="top_details_four_slider button_style_top_left owl-theme owl-carousel">
                    @foreach ($sliders as $slider)
                        <div class="common_card_four">
                            <div class="common_card_four_img">
                                <a href="{{ $slider->url }}">
                                    <img src="{{ getImageUrl($slider->image) }}" alt="img" style="height: 200px">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>
<section id="cta_area" style="margin-top: 50px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="cta_left">
                    <div class="cta_icon">
                        <img src="assets/img/common/email.png" alt="icon">
                    </div>
                    <div class="cta_content">
                        <h4>Get the latest news and offers</h4>
                        <h2>Subscribe to our newsletter</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="cat_form">
                    <form id="cta_form_wrappper">
                        <div class="input-group"><input type="text" class="form-control" placeholder="Enter your mail address"><button class="btn btn_theme btn_md" type="button">Subscribe</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<style>

  .select2 {
      width: 100%!important;
  }
  .select2 span{
      padding-top:0px;
      font-size: 16px;
  }
  .spinner {
      /* Add styles for the loading spinner animation */
      /* Example: */
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 2s linear infinite;
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop
<script>


    $(document).ready(function() {

        $('#one_way_to').select2({
            placeholder: 'Select an option'
        });

        $('#one_way_from').select2({
            placeholder: 'Select an option'
        });
        $('#one_way_date').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: -0
        });
        function checkAdultBtn(){
            var one_way_adult = parseInt($('#one_way_adult_count').text());
            var one_way_child = parseInt($('#one_way_child_count').text());
            var one_way_infant = parseInt($('#one_way_infant_count').text());
            $('#one_way_total_count').text(one_way_adult+one_way_child+one_way_infant+" Passenger")

            if(one_way_adult<2){
                $("#one_way_adult_minus").addClass('d-none');
            }else{
                $("#one_way_adult_minus").removeClass('d-none');
            }
            if(one_way_child<1){
                $("#one_way_child_minus").addClass('d-none');
            }else{
                $("#one_way_child_minus").removeClass('d-none');
            }
            if(one_way_infant<1){
                $("#one_way_infant_minus").addClass('d-none');
            }else{
                $("#one_way_infant_minus").removeClass('d-none');
            }

        }

        checkAdultBtn();
        $('#one_way_adult_add').click(function (){
            var one_way_adult = parseInt($('#one_way_adult_count').text());
            one_way_adult = 1 + one_way_adult;
            $('#one_way_adult_count').text(one_way_adult);
            checkAdultBtn();
        });
        $('#one_way_adult_minus').click(function (){
            var one_way_adult = parseInt($('#one_way_adult_count').text());
            one_way_adult =  one_way_adult - 1;
            $('#one_way_adult_count').text(one_way_adult);
            checkAdultBtn();
        });
        $('#one_way_child_add').click(function (){
            var one_way_child = parseInt($('#one_way_child_count').text());
            one_way_child = 1 + one_way_child;
            $('#one_way_child_count').text(one_way_child);
            checkAdultBtn();
        });
        $('#one_way_child_minus').click(function (){
            var one_way_child = parseInt($('#one_way_child_count').text());
            one_way_child =  one_way_child - 1;
            $('#one_way_child_count').text(one_way_child);
            checkAdultBtn();
        });
        $('#one_way_infant_add').click(function (){
            var one_way_infant = parseInt($('#one_way_infant_count').text());
            one_way_infant = 1 + one_way_infant;
            $('#one_way_infant_count').text(one_way_infant);
            checkAdultBtn();
        });
        $('#one_way_infant_minus').click(function (){
            var one_way_infant = parseInt($('#one_way_infant_count').text());
            one_way_infant =  one_way_infant - 1;
            $('#one_way_infant_count').text(one_way_infant);
            checkAdultBtn();
        });
        function showLoadingSpinner() {
            $('#loading-spinner').show();
        }
        hideLoadingSpinner();
        function hideLoadingSpinner() {
            $('#loading-spinner').hide();
        }
        $('#one_way_change').click(function (){
            var one_way_from = $('#one_way_from').val();
            var one_way_to = $('#one_way_to').val();
            $("#one_way_from").val(one_way_to).trigger("change");
            $("#one_way_to").val(one_way_from).trigger("change");
        });

        $('#one_way_search').click(function (){
            var imgWrap = "";

            var one_way_from = $('#one_way_from').val();
            var one_way_to = $('#one_way_to').val();
            var one_way_date = $('#one_way_date').val();
            var one_wayCabinClass = $('#one_wayCabinClass').val();
            var one_way_infant = parseInt($('#one_way_infant_count').text());
            var one_way_child = parseInt($('#one_way_child_count').text());
            var one_way_adult = parseInt($('#one_way_adult_count').text());
            var JourneyType = parseInt(1);

            if(one_way_from == one_way_to){
                Swal.fire('From and To both are same destination, Please make different ')
                Swal.fire(
                    'From and To both are same destination!',
                    'Please make different .',
                    'error'
                )
            } else {
                $(".flight_search_result_wrapper").empty();
                $('#filter_area').addClass('d-none');
                $('#flight_count').addClass('d-none');
                showLoadingSpinner();
                $.ajax({
                    type: 'GET',
                    url: 'flight/search',
                    dataType: 'html',
                    data: {
                        one_way_from: one_way_from,
                        one_way_to: one_way_to,
                        one_way_date: one_way_date,
                        one_wayCabinClass: one_wayCabinClass,
                        one_way_infant: one_way_infant,
                        one_way_child: one_way_child,
                        one_way_adult: one_way_adult,
                        JourneyType: JourneyType,
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data.length);
                        if (data.length>0){
                            $('#flight_search_area').removeClass('d-none');
                            $('#filter_area').removeClass('d-none');
                            $('#flight_count').removeClass('d-none');
                            $('#flight_count h2').html(data.length+' Flight Found');
                        }else{
                            $('#filter_area').addClass('d-none');
                            $('#flight_search_area').removeClass('d-none');
                            $('#flight_count').removeClass('d-none');
                            $('#flight_count h2').html('No Flight Found')
                        }
                        // imgWrap = $(this).closest('.flight_search_result_wrapper').find('.flight_search_item_wrappper');

                        // var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                        // imgWrap.append(html);

                        for (let i = 0; i < data.length; i++) {
                            $(".flight_search_result_wrapper").append('' +
                                '<div class="flight_search_items mb-3">' +
                                '<div class="multi_city_flight_lists">' +
                                '<div class="flight_multis_area_wrapper">' +
                                '<div class="flight_search_left"> ' +
                                '<div class="flight_logo">' +
                                '<img src="assets/img/common/biman_bangla.png" alt="img"></div>' +
                                '<div class="flight_search_destination">' +
                                '<p>From</p><h3>'+data[i]['FromCityName']+'</h3><h6>'+data[i]['FromAirportCode']+'-'+data[i]['FromAirportName']+'</h6></div></div>' +
                                '<div class="flight_search_middel"><div class="flight_right_arrow">' +
                                '<img src="assets/img/icon/right_arrow.png" alt="icon">' +
                                '<h6>Non-stop</h6><p>'+data[i]['JourneyDuration']+' minute </p></div>' +
                                '<div class="flight_search_destination">' +
                                '<p>To</p><h3>'+data[i]['ToCityName']+' </h3><h6>'+data[i]['ToAirportCode']+'-'+data[i]['ToAirportName']+'</h6></div></div></div></div>' +
                                '<div class="flight_search_right"><h5><del>'+data[i]['TotalFare']+'</del></h5><h2>'+data[i]['TotalFare1']+'<sup>*20% OFF</sup></h2>' +
                                '<button type="button" class="btn btn_theme btn_sm" data-bs-toggle="modal" data-bs-target="#pricingModal">Book now </button>' +
                                '<p>*Discount applicable on some conditions</p>' +
                                '<h6 data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Show more <i class="fas fa-chevron-down"></i></h6></div></div>' +
                                '<div class="flight_policy_refund collapse" id="collapseExample"><div class="flight_show_down_wrapper"><div class="flight-shoe_dow_item">' +
                                '<div class="airline-details"><div class="img"><img src="assets/img/icon/bg.png" alt="img"></div><span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp; BG435</span><span class="flightNumber">BOEING 737-800 - 738</span> </div><div class="flight_inner_show_component"><div class="flight_det_wrapper"><div class="flight_det"><div class="code_time"><span class="code">DAC</span><span class="time">15:00</span></div><p class="airport">Hazrat Shahjalal International Airport </p><p class="date">7th Jun 2022</p></div> </div><div class="flight_duration"><div class="arrow_right"></div><span>01h 15m</span></div><div class="flight_det_wrapper"><div class="flight_det"><div class="code_time"><span class="code">DAC</span><span class="time">15:00</span></div> <p class="airport">Hazrat Shahjalal International Airport</p><p class="date">7th Jun 2022</p></div></div></div> </div> <div class="flight_refund_policy"> <div class="TabPanelInner flex_widht_less"> <h4>Refund Policy</h4> <p class="fz12">1. Refund and Date Change are done as per the following policies.</p> <p class="fz12">2. Refund Amount= Refund Charge (as per airline policy + ShareTrip Convenience Fee). </p> <p class="fz12">3. Date Change Amount= Date Change Fee (as per Airline Policy + ShareTrip Convenience Fee).</p> </div> <div class="TabPanelInner"> <h4>Baggage</h4><div class="flight_info_taable"><h3>DAC-SPD</h3> <p><span>20KG /</span> person</p> </div> </div> </div> </div> <div class="flight_show_down_wrapper"> <div class="flight-shoe_dow_item"> <div class="airline-details"> <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div> <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp; BG435</span> <span class="flightNumber">BOEING 737-800 - 738</span> </div> <div class="flight_inner_show_component"> <div class="flight_det_wrapper"> <div class="flight_det"> <div class="code_time"> <span class="code">DAC</span> <span class="time">15:00</span> </div> <p class="airport">Hazrat Shahjalal International Airport </p> <p class="date">7th Jun 2022</p> </div> </div> <div class="flight_duration"> <div class="arrow_right"></div> <span>01h 15m</span> </div><div class="flight_det_wrapper"> <div class="flight_det">  <div class="code_time"> <span class="code">DAC</span> <span class="time">15:00</span> </div> <p class="airport">Hazrat Shahjalal International Airport </p> <p class="date">7th Jun 2022</p> </div>  </div> </div> </div> <div class="flight_refund_policy">  <div class="TabPanelInner flex_widht_less"> <h4>Refund Policy</h4> <p class="fz12">1. Refund and Date Change are done as per the following policies.</p> <p class="fz12">2. Refund Amount= Refund Charge (as per airline policy + ShareTrip Convenience Fee). </p> <p class="fz12">3. Date Change Amount= Date Change Fee (as per Airline Policy + ShareTrip Convenience Fee).</p> </div> <div class="TabPanelInner"> <h4>Baggage</h4> <div class="flight_info_taable"> <h3>DAC-SPD</h3> <p><span>20KG /</span> person</p> </div> </div></div></div><div class="flight_show_down_wrapper"> <div class="flight-shoe_dow_item"> <div class="airline-details"> <div class="img"><img src="assets/img/icon/bg.png" alt="img"></div> <span class="airlineName fw-500">Biman Bangladesh Airlines &nbsp; BG435</span> <span class="flightNumber">BOEING 737-800 - 738</span> </div> <div class="flight_inner_show_component"> <div class="flight_det_wrapper"> <div class="flight_det"> <div class="code_time"> <span class="code">DAC</span> <span class="time">15:00</span> </div> <p class="airport">Hazrat Shahjalal International Airport </p> <p class="date">7th Jun 2022</p> </div> </div> <div class="flight_duration"> <div class="arrow_right"></div> <span>01h 15m</span> </div> <div class="flight_det_wrapper"> <div class="flight_det"> <div class="code_time"> <span class="code">DAC</span> <span class="time">15:00</span> </div> <p class="airport">Hazrat Shahjalal International Airport </p> <p class="date">7th Jun 2022</p> </div> </div> </div> </div> <div class="flight_refund_policy"> <div class="TabPanelInner flex_widht_less"> <h4>Refund Policy</h4> <p class="fz12">1. Refund and Date Change are done as per the following policies.</p> <p class="fz12">2. Refund Amount= Refund Charge (as per airline policy + ShareTrip Convenience Fee). </p> <p class="fz12">3. Date Change Amount= Date Change Fee (as per Airline Policy + ShareTrip Convenience Fee).</p> </div> <div class="TabPanelInner"> <h4>Baggage</h4> <div class="flight_info_taable"> <h3>DAC-SPD</h3> <p><span>20KG /</span> person</p> </div> </div> </div> </div> </div>');
                        }
                        hideLoadingSpinner();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>


@endsection
