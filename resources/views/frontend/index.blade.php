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
                                                <form action="#!">
                                                    <div class="row">
                                                        <div class="col-lg-3  col-md-6 col-sm-12 col-12">
                                                            <div class="flight_Search_boxed">
                                                                <p>From</p>
                                                                <select id="select-tools" placeholder="Pick a tool..."></select>
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
                                                                            <span>Thursday</span>
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
                                                                            <span>Thursday</span>
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
                            <h5>Filter</h5>
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
        function showLoadingSpinner() {
            $('#loading-overlay').fadeIn();
        }
        hideLoadingSpinner();
        function hideLoadingSpinner() {
            $('#loading-overlay').fadeOut();
        }
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
            var imgWrap = "";

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
                        // imgWrap = $(this).closest('.flight_search_result_wrapper').find('.flight_search_item_wrappper');

                        // var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                        // imgWrap.append(html);

                        for (let i = 0; i < data.length; i++) {

                            let html = '<div id="oneWayItem'+i+'" class="flight_search_item_wrappper"><div class="flight_search_items">' +
                                '<div class="multi_city_flight_lists">' +
                                '<form id="one_way_booking" action="{{route('flight_booking')}}" method="POST" ">@csrf'+
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
                        console.log(error);
                    }
                });
            }
        });
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
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }




    });

    function oneWayBook(i)
    {
        $('#oneWayItem'+i+' #one_way_booking').submit();
    }

    $('#select-tools').selectize({
        maxItems: 1,
        valueField: 'iata_code',
        labelField: 'name',
        searchField: ['name', 'iata_code'],
        create: false,
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '{{route('airports')}}',
                dataType: 'json',
                data: {
                    q: query
                },
                success: function(response) {
                    callback(response);
                },
                error: function() {
                    callback();
                }
            });
        },
        render: {
            option: function(item, escape) {
                return '<div>' +
                    '<span class="name">'+escape(item.city)+' - '+escape(item.iata_code)+' - '+escape(item.country)+'</span>' +
                    '</div>';
            }
        }
    });

</script>


@endsection
