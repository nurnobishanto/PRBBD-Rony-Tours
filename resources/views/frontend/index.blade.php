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
                                <!-- One Way -->
                                <div class="tab-pane fade show active" id="oneway_flight" role="tabpanel"
                                    aria-labelledby="oneway-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="oneway_search_form">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                        <div class="flight_Search_boxed">
                                                            <p>From </p>
                                                            <select class="from_airport" id="one_way_from" name="one_way_from">
                                                            </select>
                                                            <div class="plan_icon_posation">
                                                                <i class="fas fa-plane-departure"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                        <div class="flight_Search_boxed">
                                                            <p>To</p>
                                                            <select class="to_airport" id="one_way_to" name="one_way_to">

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
                                                                    <input type="text" class="date"  id="one_way_date" value="{{$today}}">
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
                                                                <button type="button"  data-bs-toggle="modal" data-bs-target="#oneWaypassengerModal" id="one_way_total_count">
                                                                    0 Passenger
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="oneWaypassengerModal" tabindex="-1" aria-labelledby="oneWaypassengerModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Passengers</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row border-bottom">
                                                                                    <div class="col-2">
                                                                                        <h2 id="adult_count">1</h2>
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
                                                                                        <h2 id="child_count">0</h2>
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
                                                                                        <h2 id="infant_count">0</h2>
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
                                                                <select id="CabinClass" name="CabinClass">
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
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Round Trip -->
                                <div class="tab-pane fade" id="roundtrip" role="tabpanel"
                                    aria-labelledby="roundtrip-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="oneway_search_form">
                                                <div class="row">
                                                    <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                        <div class="flight_Search_boxed">
                                                            <p>From</p>
                                                            <select class="from_airport" id="rt_from" name="rt_from"></select>
                                                            <div class="plan_icon_posation">
                                                                <i class="fas fa-plane-departure"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                        <div class="flight_Search_boxed">
                                                            <p>To</p>
                                                            <select class="to_airport" id="rt_to" name="rt_to"></select>
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
                                                                    <input class="date" type="text"  id="rt_date_jd" value="{{$today}}">
                                                                </div>
                                                                <div class="Journey_date">
                                                                    <p>Return date</p>
                                                                    <input class="date" type="text"  id="rt_date_rd" value="{{$today}}">
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
                                                                <button type="button"  data-bs-toggle="modal" data-bs-target="#rtPassengerModal" id="rt_total_count">
                                                                    0 Passenger
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="rtPassengerModal" tabindex="-1" aria-labelledby="rtPassengerModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Passengers</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row border-bottom">
                                                                                    <div class="col-2">
                                                                                        <h2 id="rt_adult_count">1</h2>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <h5>Adult</h5>
                                                                                        <i>12+ yrs</i>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <div class="button-set">
                                                                                            <button type="button" id="rt_adult_add"><i  class="fas fa-plus"></i></button>
                                                                                            <button type="button" id="rt_adult_minus"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row border-bottom my-2">
                                                                                    <div class="col-2">
                                                                                        <h2 id="rt_child_count">0</h2>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <h5>Children</h5>
                                                                                        <i>2 - Less than 12 yrs</i>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <div class="button-set">
                                                                                            <button type="button" id="rt_child_add"><i  class="fas fa-plus"></i></button>
                                                                                            <button type="button" id="rt_child_minus"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-2">
                                                                                        <h2 id="rt_infant_count">0</h2>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <h5>Infant</h5>
                                                                                        <i>Less than 2 yrs</i>
                                                                                    </div>
                                                                                    <div class="col-3">
                                                                                        <div class="button-set">
                                                                                            <button type="button"  id="rt_infant_add"><i  class="fas fa-plus"></i></button>
                                                                                            <button type="button" id="rt_infant_minus"><i class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <select id="rtCabinClass" name="CabinClass">
                                                                    <option value="1">Economy</option>
                                                                    <option value="2">Premium</option>
                                                                    <option value="3">Business</option>
                                                                    <option value="4">First Class</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="top_form_search_button">
                                                    <button id="rt_search" class="btn btn_theme btn_md">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Multi City -->
                                <div class="tab-pane fade" id="multi_city" role="tabpanel"
                                    aria-labelledby="multi_city-tab">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="multi_city_search_form">
                                                <div class="multi_city_form_wrapper">
                                                    <div class="multi_city_form">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed">
                                                                    <p>From</p>
                                                                    <select class="from_airport" id="multi_city_from0" name="multi_city_from"></select>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-departure"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed">
                                                                    <p>To</p>
                                                                    <select class="to_airport" id="multi_city_to0" name="multi_city_to"></select>

                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-arrival"></i>
                                                                    </div>
                                                                    <div class="range_plan">
                                                                        <i class="fas fa-exchange-alt"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                                                                <div class="form_search_date">
                                                                    <div
                                                                        class="flight_Search_boxed date_flex_area">
                                                                        <div class="Journey_date">
                                                                            <p>Journey date</p>
                                                                            <input id="multi_city_date0" class="date" type="text"
                                                                                value="{{$today}}">
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
                                                                        <button type="button"  data-bs-toggle="modal" data-bs-target="#multiCityPassengerModal" id="mc_total_count">
                                                                            0 Passenger
                                                                        </button>

                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="multiCityPassengerModal" tabindex="-1" aria-labelledby="multiCityPassengerModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Passengers</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row border-bottom">
                                                                                            <div class="col-2">
                                                                                                <h2 id="mc_adult_count">1</h2>
                                                                                            </div>
                                                                                            <div class="col-7">
                                                                                                <h5>Adult</h5>
                                                                                                <i>12+ yrs</i>
                                                                                            </div>
                                                                                            <div class="col-3">
                                                                                                <div class="button-set">
                                                                                                    <button type="button" id="mc_adult_add"><i  class="fas fa-plus"></i></button>
                                                                                                    <button type="button" id="mc_adult_minus"><i class="fas fa-minus"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row border-bottom my-2">
                                                                                            <div class="col-2">
                                                                                                <h2 id="mc_child_count">0</h2>
                                                                                            </div>
                                                                                            <div class="col-7">
                                                                                                <h5>Children</h5>
                                                                                                <i>2 - Less than 12 yrs</i>
                                                                                            </div>
                                                                                            <div class="col-3">
                                                                                                <div class="button-set">
                                                                                                    <button type="button" id="mc_child_add"><i  class="fas fa-plus"></i></button>
                                                                                                    <button type="button" id="mc_child_minus"><i class="fas fa-minus"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-2">
                                                                                                <h2 id="mc_infant_count">0</h2>
                                                                                            </div>
                                                                                            <div class="col-7">
                                                                                                <h5>Infant</h5>
                                                                                                <i>Less than 2 yrs</i>
                                                                                            </div>
                                                                                            <div class="col-3">
                                                                                                <div class="button-set">
                                                                                                    <button type="button"  id="mc_infant_add"><i  class="fas fa-plus"></i></button>
                                                                                                    <button type="button" id="mc_infant_minus"><i class="fas fa-minus"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <select id="mcCabinClass" name="mcCabinClass">
                                                                            <option value="1">Economy</option>
                                                                            <option value="2">Premium</option>
                                                                            <option value="3">Business</option>
                                                                            <option value="4">First Class</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="multi_city_form">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed">
                                                                    <p>From</p>
                                                                    <select class="from_airport" id="multi_city_from1" name="multi_city_from"></select>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-departure"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                                <div class="flight_Search_boxed">
                                                                    <p>To</p>
                                                                    <select class="to_airport" id="multi_city_to1" name="multi_city_to"></select>
                                                                    <div class="plan_icon_posation">
                                                                        <i class="fas fa-plane-arrival"></i>
                                                                    </div>
                                                                    <div class="range_plan">
                                                                        <i class="fas fa-exchange-alt"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-6 col-sm-12 col-12">
                                                                <div class="form_search_date">
                                                                    <div
                                                                        class="flight_Search_boxed date_flex_area">
                                                                        <div class="Journey_date">
                                                                            <p>Journey date</p>
                                                                            <input id="multi_city_date1" class="date" type="text"
                                                                                   value="{{$today}}">
                                                                        </div>
                                                                    </div>
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
                                                    <button class="btn btn_theme btn_md" id="mc_search">Search</button>
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
            <div class="col-lg-3 col-md-12">
                <div class="left_side_search_area d-none" id="filter_area">
                    <div class="left_side_search_boxed">
                        <div class="left_side_search_heading">
                            <h5>Filter by price</h5>
                        </div>
                        <div class="tour_search_type">
                            <div class="form-check">
                                <div>
                                    <input type="radio" class="form-check-input" name="sort-by" id="sort-by-asc" value="asc">
                                    <label class="form-check-label" for="sort-by-asc">Low to High</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <input type="radio" class="form-check-input" name="sort-by" id="sort-by-desc" value="desc">
                                    <label class="form-check-label" for="sort-by-desc">High to Low</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <input type="radio" class="form-check-input" name="sort-by" id="sort-by-desc" value="default">
                                    <label class="form-check-label" for="sort-by-desc">Default</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left_side_search_boxed">
                        <div class="left_side_search_heading">
                            <h5>Filter by stop</h5>
                        </div>
                        <div class="tour_search_type">
                            <div class="form-check">
                                <div>
                                    <input type="radio" class="form-check-input" name="sort-by-stop" id="sort-by-asc" value="multi">
                                    <label class="form-check-label" for="sort-by-asc">Multi Stop</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <input type="radio" class="form-check-input" name="sort-by-stop" id="sort-by-desc" value="non">
                                    <label class="form-check-label" for="sort-by-desc">Non Stop</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <div>
                                    <input checked type="radio" class="form-check-input" name="sort-by-stop" id="sort-by-asc" value="both">
                                    <label class="form-check-label" for="sort-by-asc">Both</label>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="flight_search_result_wrapper">
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
<div id="loading-overlay">
    <img src="{{asset(getSetting('loading'))}}" alt="Loading" />
</div>
<style>

  .select2 {
      width: 100%!important;
  }
  .select2 span{
      padding-top:0px;
      font-size: 16px;
  }
  #loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      z-index: 9999;
  }

  #loading-overlay img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
  }
</style>
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
@stop
<script>
    function hideLoadingSpinner() {
        $('#loading-overlay').fadeOut();
    }
    function showLoadingSpinner() {
        $('#loading-overlay').fadeIn();
    }
    function loadContries(param,skip) {
        $('.to_airport,.from_airport').select2({
            placeholder: 'Select an option'
        });

        $.ajax({
            type: 'GET',
            url: '{{route('airports')}}',
            dataType: 'html',
            success: function (response) {
                let data = JSON.parse(response);
               // console.log(data);
                $(param).empty();
                $(param).append('<option value="">Select a airport<option');
                for (let i = 0; i < data.length; i++) {
                    if(data[i]['iata_code'] != skip){
                        let html = '<option value="'+data[i]['iata_code']+'">'+data[i]['city']+' - '+data[i]['iata_code']+' - '+data[i]['country']+'</option>'
                        $(param).append(html);
                    }
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    loadContries('.from_airport','');
    loadContries('.to_airport','');
    $(document).ready(function() {

        $('.to_airport').select2({
            placeholder: 'Select an option'
        });
        $('.from_airport').select2({
            placeholder: 'Select an option',
        });
        $('#one_way_from').on('select2:select', function(e) {
            var selectedValue = $(this).val();
            loadContries('#one_way_to',selectedValue);
        });
        $('#rt_from').on('select2:select', function(e) {
            var selectedValue = $(this).val();
            loadContries('#rt_to',selectedValue);
        });
        $('#one_way_date').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: -0
        });
        $('.date').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: -0
        });
        function checkAdultBtn(){
            var one_way_adult = parseInt($('#adult_count').text());
            var one_way_child = parseInt($('#child_count').text());
            var one_way_infant = parseInt($('#infant_count').text());
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
        function checkAdultBtnRT(){
            var rt_adult = parseInt($('#rt_adult_count').text());
            var rt_child = parseInt($('#rt_child_count').text());
            var rt_infant = parseInt($('#rt_infant_count').text());
            $('#rt_total_count').text(rt_adult+rt_child+rt_infant+" Passenger")

            if(rt_adult<2){
                $("#rt_adult_minus").addClass('d-none');
            }else{
                $("#rt_adult_minus").removeClass('d-none');
            }
            if(rt_child<1){
                $("#rt_child_minus").addClass('d-none');
            }else{
                $("#rt_child_minus").removeClass('d-none');
            }
            if(rt_infant<1){
                $("#rt_infant_minus").addClass('d-none');
            }else{
                $("#rt_infant_minus").removeClass('d-none');
            }

        }
        function checkAdultBtnMC(){
            var mc_adult = parseInt($('#mc_adult_count').text());
            var mc_child = parseInt($('#mc_child_count').text());
            var mc_infant = parseInt($('#mc_infant_count').text());
            $('#mc_total_count').text(mc_adult+mc_child+mc_infant+" Passenger")

            if(mc_adult<2){
                $("#mc_adult_minus").addClass('d-none');
            }else{
                $("#mc_adult_minus").removeClass('d-none');
            }
            if(mc_child<1){
                $("#mc_child_minus").addClass('d-none');
            }else{
                $("#mc_child_minus").removeClass('d-none');
            }
            if(mc_infant<1){
                $("#mc_infant_minus").addClass('d-none');
            }else{
                $("#mc_infant_minus").removeClass('d-none');
            }

        }
        checkAdultBtn();
        $('#one_way_adult_add').click(function (){
            var one_way_adult = parseInt($('#adult_count').text());
            one_way_adult = 1 + one_way_adult;
            $('#adult_count').text(one_way_adult);
            checkAdultBtn();
        });
        $('#one_way_adult_minus').click(function (){
            var one_way_adult = parseInt($('#adult_count').text());
            one_way_adult =  one_way_adult - 1;
            $('#adult_count').text(one_way_adult);
            checkAdultBtn();
        });
        $('#one_way_child_add').click(function (){
            var one_way_child = parseInt($('#child_count').text());
            one_way_child = 1 + one_way_child;
            $('#child_count').text(one_way_child);
            checkAdultBtn();
        });
        $('#one_way_child_minus').click(function (){
            var one_way_child = parseInt($('#child_count').text());
            one_way_child =  one_way_child - 1;
            $('#child_count').text(one_way_child);
            checkAdultBtn();
        });
        $('#one_way_infant_add').click(function (){
            var one_way_infant = parseInt($('#infant_count').text());
            one_way_infant = 1 + one_way_infant;
            $('#infant_count').text(one_way_infant);
            checkAdultBtn();
        });
        $('#one_way_infant_minus').click(function (){
            var one_way_infant = parseInt($('#infant_count').text());
            one_way_infant =  one_way_infant - 1;
            $('#infant_count').text(one_way_infant);
            checkAdultBtn();
        });

        checkAdultBtnRT();
        $('#rt_adult_add').click(function (){
            var rt_adult = parseInt($('#rt_adult_count').text());
            rt_adult = 1 + rt_adult;
            $('#rt_adult_count').text(rt_adult);
            checkAdultBtnRT();
        });
        $('#rt_adult_minus').click(function (){
            var rt_adult = parseInt($('#rt_adult_count').text());
            rt_adult =  rt_adult - 1;
            $('#rt_adult_count').text(rt_adult);
            checkAdultBtnRT();
        });
        $('#rt_child_add').click(function (){
            var rt_child = parseInt($('#rt_child_count').text());
            rt_child = 1 + rt_child;
            $('#rt_child_count').text(rt_child);
            checkAdultBtnRT();
        });
        $('#rt_child_minus').click(function (){
            var rt_child = parseInt($('#rt_child_count').text());
            rt_child =  rt_child - 1;
            $('#rt_child_count').text(rt_child);
            checkAdultBtnRT();
        });
        $('#rt_infant_add').click(function (){
            var rt_infant = parseInt($('#rt_infant_count').text());
            rt_infant = 1 + rt_infant;
            $('#rt_infant_count').text(rt_infant);
            checkAdultBtnRT();
        });
        $('#rt_infant_minus').click(function (){
            var rt_infant = parseInt($('#rt_infant_count').text());
            rt_infant =  rt_infant - 1;
            $('#rt_infant_count').text(rt_infant);
            checkAdultBtnRT();
        });

        checkAdultBtnMC();
        $('#mc_adult_add').click(function (){
            var mc_adult = parseInt($('#mc_adult_count').text());
            mc_adult = 1 + mc_adult;
            $('#mc_adult_count').text(mc_adult);
            checkAdultBtnMC();
        });
        $('#mc_adult_minus').click(function (){
            var mc_adult = parseInt($('#mc_adult_count').text());
            mc_adult =  mc_adult - 1;
            $('#mc_adult_count').text(mc_adult);
            checkAdultBtnMC();
        });
        $('#mc_child_add').click(function (){
            var mc_child = parseInt($('#mc_child_count').text());
            mc_child = 1 + mc_child;
            $('#mc_child_count').text(mc_child);
            checkAdultBtnMC();
        });
        $('#mc_child_minus').click(function (){
            var mc_child = parseInt($('#mc_child_count').text());
            mc_child =  mc_child - 1;
            $('#mc_child_count').text(mc_child);
            checkAdultBtnMC();
        });
        $('#mc_infant_add').click(function (){
            var mc_infant = parseInt($('#mc_infant_count').text());
            mc_infant = 1 + mc_infant;
            $('#mc_infant_count').text(mc_infant);
            checkAdultBtnMC();
        });
        $('#mc_infant_minus').click(function (){
            var mc_infant = parseInt($('#mc_infant_count').text());
            mc_infant =  mc_infant - 1;
            $('#mc_infant_count').text(mc_infant);
            checkAdultBtnMC();
        });
        hideLoadingSpinner();
        $('#one_way_change').click(function (){
            var one_way_from = $('#one_way_from').val();
            var one_way_to = $('#one_way_to').val();
            $("#one_way_from").val(one_way_to).trigger("change");
            $("#one_way_to").val(one_way_from).trigger("change");
        });
        function convertMinutesToDuration(minutes) {
            var hours = Math.floor(minutes / 60);
            var mins = minutes % 60;
            if(hours>0){
                var duration = hours + " hours " + mins + " minutes";
            }else {
                var duration =  mins + " minutes";
            }

            return duration;
        }
        $('#one_way_search').click(function (){
            var one_way_from = $('#one_way_from').val();
            var one_way_to = $('#one_way_to').val();
            var one_way_date = $('#one_way_date').val();
            var CabinClass = $('#CabinClass').val();
            var one_way_infant = parseInt($('#infant_count').text());
            var one_way_child = parseInt($('#child_count').text());
            var one_way_adult = parseInt($('#adult_count').text());
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
                        CabinClass: CabinClass,
                        one_way_infant: one_way_infant,
                        one_way_child: one_way_child,
                        one_way_adult: one_way_adult,
                        JourneyType: JourneyType,
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
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
                        for (let i = 0; i < data.length; i++) {
                            let html = '<div id="oneWayItem'+i+'" class="flight_search_item_wrappper '+data[i]['stopped']+'" data-price="'+data[i]['TotalFare']+'">' +
                                '<div class="flight_search_items">' +
                                '<div class="multi_city_flight_lists">' +
                                '<form id="one_way_booking" action="{{route('flight_booking')}}" method="GET" ">'+
                                '<input type="text" style="display:none" name="SearchId" value="'+data[i]['SearchId']+'">' +
                                '<input type="text" style="display:none" name="ResultID" value="'+data[i]['ResultID']+'">' +
                                '</form>'+
                                '<div class="flight_multis_area_wrapper">' +
                                '<div class="flight_search_left"> ' +
                                '<div class="flight_logo">' +
                                '<p id="StopQuantity" style="display:none">'+data[i]['StopQuantity']+'</p>' +
                                '<img src="https://content.airhex.com/content/logos/airlines_'+data[i]['segments'][0]['Airline']['AirlineCode']+'_100_50_r.png?proportions=keep" alt="img"></div>' +
                                '<div class="flight_search_destination">' +
                                '<p>From</p><h3 id="fromCity">'+data[i]['FromCityName']+'</h3><h6>'+data[i]['FromAirportCode']+'-'+data[i]['FromAirportName']+'</h6></div></div>' +
                                '<div class="flight_search_middel"><div class="flight_right_arrow">' +
                                '<img src="assets/img/icon/right_arrow.png" alt="icon">' +
                                '<h6>'+data[i]['stop']+' stop</h6><p id="JourneyDuration">'+data[i]['JourneyDuration']+'</p></div>' +
                                '<div class="flight_search_destination">' +
                                '<p>To</p><h3 id="ToCityName">'+data[i]['ToCityName']+' </h3><h6>'+data[i]['ToAirportCode']+'-'+data[i]['ToAirportName']+'</h6></div></div></div></div>' +
                                '<div id="TotalFare" class="flight_search_right"><h5><del>'+data[i]['TotalFare']+'</del></h5><h2 id="TotalFare1">'+data[i]['TotalFare1']+'<sup>*20% OFF</sup></h2>' +
                                '<button onclick="oneWayBook('+i+')" class="btn btn_theme btn_sm">Book now </button>' +
                                '<p>*Discount applicable on some conditions</p>' +
                                '<h6 data-bs-toggle="collapse" data-bs-target="#flightDetails'+i+'" aria-expanded="false" aria-controls="flightDetails'+i+'">Show more <i class="fas fa-chevron-down"></i></h6></div></div>' +
                                '<div class="flight_policy_refund collapse" id="flightDetails'+i+'">';
                                for (let j = 0; j < data[i]['segments'].length; j++){
                                    html += '<div class="flight_show_down_wrapper"><div class="flight-shoe_dow_item">' +
                                '<div class="airline-details"><div class="img"><img src="https://content.airhex.com/content/logos/airlines_'+data[i]['segments'][j]['Airline']['AirlineCode']+'_70_20_r.png?proportions=keep" alt="img"></div>' +
                                '<span class="airlineName fw-500">'+data[i]['segments'][j]['Airline']['AirlineName']+' &nbsp; </span>' +
                                '<span class="flightNumber">'+data[i]['segments'][j]['Airline']['AirlineCode']+''+data[i]['segments'][j]['Airline']['FlightNumber']+'</span> </div><div class="flight_inner_show_component"><div class="flight_det_wrapper"><div class="flight_det">' +
                                '<div class="code_time"><span class="code">'+data[i]['segments'][j]['Origin']['Airport']['AirportCode']+'</span><span class="time">'+moment(data[i]['segments'][j]['Origin']['DepTime']).format('hh:mmA')+'</span></div>' +
                                '<p class="airport">'+data[i]['segments'][j]['Origin']['Airport']['AirportName']+'</p>' +
                                '<p class="date">'+moment(data[i]['segments'][j]['Origin']['DepTime']).format('Do MMM YYYY')+'</p></div> </div><div class="flight_duration"><div class="arrow_right"></div>' +
                                '<span>'+convertMinutesToDuration(data[i]['segments'][j]['JourneyDuration'])+'</span></div><div class="flight_det_wrapper"><div class="flight_det">' +
                                '<div class="code_time"><span class="code">'+data[i]['segments'][j]['Destination']['Airport']['AirportCode']+'</span><span class="time">'+moment(data[i]['segments'][j]['Destination']['ArrTime']).format('hh:mmA')+'</span></div> ' +
                                '<p class="airport">'+data[i]['segments'][j]['Destination']['Airport']['AirportName']+'</p>' +
                                '<p class="date">'+moment(data[i]['segments'][j]['Destination']['ArrTime']).format('Do MMM YYYY')+'</p></div></div></div> </div> ' +
                                '<div class="flight_refund_policy"> <div class="TabPanelInner flex_widht_less"> <h4>Refund Policy</h4> <p class="fz12">1. Refund and Date Change are done as per the following policies.</p> <p class="fz12">2. Refund Amount= Refund Charge (as per airline policy + ShareTrip Convenience Fee). </p> <p class="fz12">3. Date Change Amount= Date Change Fee (as per Airline Policy + ShareTrip Convenience Fee).</p> </div> ' +
                                '<div class="TabPanelInner"> <h4>Baggage</h4><div class="flight_info_taable"><h3>'+data[i]['segments'][j]['Origin']['Airport']['AirportCode']+'-'+data[i]['segments'][j]['Destination']['Airport']['AirportCode']+'</h3> <p><span>'+data[i]['segments'][j]['Baggage']+' /</span> person</p> </div> </div> </div> </div> ';
                                }

                            html += '</div>';
                            $(".flight_search_result_wrapper").append(html);

                        }
                        hideLoadingSpinner();
                    },
                    error: function(error) {
                        hideLoadingSpinner();
                        console.log(error);
                    }
                });
            }
        });
        $('#rt_search').click(function (){
            var CabinClass = $('#rtCabinClass').val();
            var infant = parseInt($('#rt_infant_count').text());
            var child = parseInt($('#rt_child_count').text());
            var adult = parseInt($('#rt_adult_count').text());
            var rt_from = $('#rt_from').val();
            var rt_to = $('#rt_to').val();
            var date_jd = $('#rt_date_jd').val();
            var date_rd = $('#rt_date_rd').val();
            var JourneyType = parseInt(2);
            if(rt_from == rt_to){
                Swal.fire('From and To both are same destination, Please make different ');
                Swal.fire(
                    'From and To both are same destination!',
                    'Please make different .',
                    'error'
                );
            }else if(date_jd > date_rd){
                Swal.fire('Invalid journey date ');
            }else {
                $(".flight_search_result_wrapper").empty();
                $('#filter_area').addClass('d-none');
                $('#flight_count').addClass('d-none');
                showLoadingSpinner();
                $.ajax({
                    type: 'GET',
                    url: 'flight/search-rt',
                    dataType: 'html',
                    data: {
                        from: rt_from,
                        to: rt_to,
                        date_jd: date_jd,
                        date_rd: date_rd,
                        CabinClass: CabinClass,
                        infant: infant,
                        child: child,
                        adult: adult,
                        JourneyType: JourneyType,
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);
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
                        for (let i = 0; i < data.length; i++) {
                            let html = '<div id="rtItem'+i+'" class="flight_search_item_wrappper '+data[i]['stopped']+'" data-price="'+data[i]['TotalFare']+'">' +
                                '<div class="flight_search_items">' +
                                '<div class="multi_city_flight_lists row">' +
                                '<form id="return_booking" action="{{route('flight_booking')}}" method="GET" ">'+
                                '<input type="text" style="display:none" name="SearchId" value="'+data[i]['SearchId']+'">' +
                                '<input type="text" style="display:none" name="ResultID" value="'+data[i]['ResultID']+'">' +
                                '</form>'+
                                '<div class="flight_multis_area_wrapper col-md-9">' ;

                            html = html+'<div class="flight_policy_refund border-0" id="flightDetails'+i+'">';
                            for (let j = 0; j < data[i]['segments'].length; j++){
                                html += '<div class="flight_show_down_wrapper">' +
                                    '<div class="flight-shoe_dow_item">' +
                                    '<div class="airline-details"><div class="img"><img src="https://content.airhex.com/content/logos/airlines_'+data[i]['segments'][j]['Airline']['AirlineCode']+'_70_20_r.png?proportions=keep" alt="img"></div>' +
                                    '<span class="airlineName fw-500">'+data[i]['segments'][j]['Airline']['AirlineName']+' &nbsp; </span>' +
                                    '<span class="flightNumber">'+data[i]['segments'][j]['Airline']['AirlineCode']+''+data[i]['segments'][j]['Airline']['FlightNumber']+'</span> </div><div class="flight_inner_show_component"><div class="flight_det_wrapper"><div class="flight_det">' +
                                    '<div class="code_time"><span class="code">'+data[i]['segments'][j]['Origin']['Airport']['AirportCode']+'</span><span class="time">'+moment(data[i]['segments'][j]['Origin']['DepTime']).format('hh:mmA')+'</span></div>' +
                                    '<p class="airport">'+data[i]['segments'][j]['Origin']['Airport']['AirportName']+'</p>' +
                                    '<p class="date">'+moment(data[i]['segments'][j]['Origin']['DepTime']).format('Do MMM YYYY')+'</p></div> </div><div class="flight_duration"><div class="arrow_right"></div>' +
                                    '<span>'+convertMinutesToDuration(data[i]['segments'][j]['JourneyDuration'])+'</span></div><div class="flight_det_wrapper"><div class="flight_det">' +
                                    '<div class="code_time"><span class="code">'+data[i]['segments'][j]['Destination']['Airport']['AirportCode']+'</span><span class="time">'+moment(data[i]['segments'][j]['Destination']['ArrTime']).format('hh:mmA')+'</span></div> ' +
                                    '<p class="airport">'+data[i]['segments'][j]['Destination']['Airport']['AirportName']+'</p>' +
                                    '<p class="date">'+moment(data[i]['segments'][j]['Destination']['ArrTime']).format('Do MMM YYYY')+'</p></div></div></div> </div> ' +
                                    '<div class="TabPanelInner">' +
                                    '<h4>Baggage</h4>' +
                                    '<div class="flight_info_taable">' +
                                    '<h3>'+data[i]['segments'][j]['Origin']['Airport']['AirportCode']+'-'+data[i]['segments'][j]['Destination']['Airport']['AirportCode']+'</h3> ' +
                                    '<p><span>'+data[i]['segments'][j]['Baggage']+' /</span> person</p> ' +
                                    '</div> </div> </div>  ';
                            }
                            html = html+'</div>' +
                                '</div>' +
                                '<div id="TotalFare" class="flight_search_right col-md-3">' +
                                '<h5>' +
                                '<del>'+data[i]['TotalFare']+'</del></h5><h2 id="TotalFare1">'+data[i]['TotalFare1']+'<sup>*20% OFF</sup></h2>' +
                                '<button onclick="returnBook('+i+')" class="btn btn_theme btn_sm">Book now </button>' +
                                '<p>*Discount applicable on some conditions</p>' +
                                '</div>' +
                                '</div>';




                            $(".flight_search_result_wrapper").append(html);

                        }
                        hideLoadingSpinner();

                    },
                    error: function(error) {
                        hideLoadingSpinner();
                        console.log(error);
                    }
                });
            }

        });
        $('#mc_search').click(function (){
            var CabinClass = $('#mcCabinClass').val();
            var infant = parseInt($('#mc_infant_count').text());
            var child = parseInt($('#mc_child_count').text());
            var adult = parseInt($('#mc_adult_count').text());
            var JourneyType = parseInt(3);
            let l = document.querySelectorAll('.multi_city_form').length;
            var mc_from = [];
            var mc_to = [];
            var mc_date = [];
            let status = true;
            for (let c = 0; c < l; c++) {
                mc_from[c] = $('#multi_city_from'+c).val();
                mc_to[c] = $('#multi_city_to'+c).val();
                mc_date[c] = $('#multi_city_date'+c).val();

                if(mc_from[c] == mc_to[c]){
                    status = false;
                    Swal.fire('From and To both are same destination, Please make different ');
                    Swal.fire(
                        'From and To both are same destination!',
                        'Please make different .',
                        'error'
                    );
                }

                if(c > 0){
                    if(mc_date[c] < mc_date[c-1]){
                        status = false;
                        Swal.fire('Invalid journey date ');
                    }
                }

            }
            if (status){
                $(".flight_search_result_wrapper").empty();
                $('#filter_area').addClass('d-none');
                $('#flight_count').addClass('d-none');
                showLoadingSpinner();
                $.ajax({
                    type: 'GET',
                    url: 'flight/search-mc',
                    dataType: 'html',
                    data: {
                        from: mc_from,
                        to: mc_to,
                        date: mc_date,
                        CabinClass: CabinClass,
                        infant: infant,
                        child: child,
                        adult: adult,
                        JourneyType: JourneyType,
                        count: l,
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        console.log(data);
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
                        for (let i = 0; i < data.length; i++) {
                            let html = '<div id="mcItem'+i+'" class="flight_search_item_wrappper '+data[i]['stopped']+'" data-price="'+data[i]['TotalFare']+'">' +
                                '<div class="flight_search_items">' +
                                '<div class="multi_city_flight_lists row">' +
                                '<form id="multi_booking" action="{{route('flight_booking')}}" method="GET" ">'+
                                '<input type="text" style="display:none" name="SearchId" value="'+data[i]['SearchId']+'">' +
                                '<input type="text" style="display:none" name="ResultID" value="'+data[i]['ResultID']+'">' +
                                '</form>'+
                                '<div class="flight_multis_area_wrapper col-md-9">' ;

                            html = html+'<div class="flight_policy_refund border-0" id="flightDetails'+i+'">';
                            for (let j = 0; j < data[i]['segments'].length; j++){
                                html += '<div class="flight_show_down_wrapper">' +
                                    '<div class="flight-shoe_dow_item">' +
                                    '<div class="airline-details"><div class="img">' +
                                    '<img src="https://content.airhex.com/content/logos/airlines_'+data[i]['segments'][j]['Airline']['AirlineCode']+'_70_20_r.png?proportions=keep" alt="img"></div>' +
                                    '<span class="airlineName fw-500">'+data[i]['segments'][j]['Airline']['AirlineName']+' &nbsp; </span>' +
                                    '<span class="flightNumber">'+data[i]['segments'][j]['Airline']['AirlineCode']+''+data[i]['segments'][j]['Airline']['FlightNumber']+'</span> </div><div class="flight_inner_show_component"><div class="flight_det_wrapper"><div class="flight_det">' +
                                    '<div class="code_time"><span class="code">'+data[i]['segments'][j]['Origin']['Airport']['AirportCode']+'</span><span class="time">'+moment(data[i]['segments'][j]['Origin']['DepTime']).format('hh:mmA')+'</span></div>' +
                                    '<p class="airport">'+data[i]['segments'][j]['Origin']['Airport']['AirportName']+'</p>' +
                                    '<p class="date">'+moment(data[i]['segments'][j]['Origin']['DepTime']).format('Do MMM YYYY')+'</p></div> </div>' +
                                    '<div class="flight_duration">' +
                                    '<span>Trip '+(parseInt(data[i]['segments'][j]['SegmentGroup'])+1)+'</span>' +
                                    '<div class="arrow_right"></div>' +
                                    '<span>'+convertMinutesToDuration(data[i]['segments'][j]['JourneyDuration'])+'</span></div><div class="flight_det_wrapper"><div class="flight_det">' +
                                    '<div class="code_time"><span class="code">'+data[i]['segments'][j]['Destination']['Airport']['AirportCode']+'</span><span class="time">'+moment(data[i]['segments'][j]['Destination']['ArrTime']).format('hh:mmA')+'</span></div> ' +
                                    '<p class="airport">'+data[i]['segments'][j]['Destination']['Airport']['AirportName']+'</p>' +
                                    '<p class="date">'+moment(data[i]['segments'][j]['Destination']['ArrTime']).format('Do MMM YYYY')+'</p></div></div></div> </div> ' +
                                    '<div class="TabPanelInner">' +
                                    '<h4>Baggage</h4>' +
                                    '<div class="flight_info_taable">' +
                                    '<h3>'+data[i]['segments'][j]['Origin']['Airport']['AirportCode']+'-'+data[i]['segments'][j]['Destination']['Airport']['AirportCode']+'</h3> ' +
                                    '<p><span>'+data[i]['segments'][j]['Baggage']+' /</span> person</p> ' +
                                    '</div> </div> </div>  ';
                            }
                            html = html+'</div>' +
                                '</div>' +
                                '<div id="TotalFare" class="flight_search_right col-md-3">' +
                                '<h5>' +
                                '<del>'+data[i]['TotalFare']+'</del></h5><h2 id="TotalFare1">'+data[i]['TotalFare1']+'<sup>*20% OFF</sup></h2>' +
                                '<button onclick="multiBook('+i+')" class="btn btn_theme btn_sm">Book now </button>' +
                                '<p>*Discount applicable on some conditions</p>' +
                                '</div>' +
                                '</div>';




                            $(".flight_search_result_wrapper").append(html);

                        }
                        hideLoadingSpinner();
                    },
                    error: function(error) {
                        console.log(error);
                        hideLoadingSpinner();
                    }
                });
            }




        });
        $('input[name="sort-by-stop"]').change(function () {
            var sortBy = $('input[name="sort-by-stop"]:checked').val();
            if (sortBy === 'both') {
                $('.multi-stop').removeClass('d-none');
                $('.non-stop').removeClass('d-none');
            }else if(sortBy === 'multi'){
                $('.multi-stop').removeClass('d-none');
                $('.non-stop').addClass('d-none');
            }else if(sortBy === 'non'){
                $('.multi-stop').addClass('d-none');
                $('.non-stop').removeClass('d-none');
            }
            else {
                $('.multi-stop').removeClass('d-none');
                $('.non-stop').removeClass('d-none');
            }
        });
        // Handle sort by price
        $('input[name="sort-by"]').change(function () {
            var sortBy = $('input[name="sort-by"]:checked').val();

            // Get the product items
            var productList = $('.flight_search_result_wrapper .flight_search_item_wrappper');

            // Sort the product items based on the selected option
            productList.sort(function (a, b) {
                var priceA = parseFloat($(a).data('price'));
                var priceB = parseFloat($(b).data('price'));

                if (sortBy === 'asc') {
                    return priceA - priceB;
                }else if(sortBy === 'desc'){
                    return priceB - priceA;
                }
                else {
                    return priceA - priceB ;
                }
            });

            // Append the sorted product items back to the product list
            $('.flight_search_result_wrapper').html(productList);
        });
    });


    function oneWayBook(i) {
        
        $('#oneWayItem'+i+' #one_way_booking').submit();
    }
    function returnBook(i) {

        $('#rtItem'+i+' #return_booking').submit();
    }
    function multiBook(i) {

        $('#mcItem'+i+' #multi_booking').submit();
    }


</script>


@endsection
