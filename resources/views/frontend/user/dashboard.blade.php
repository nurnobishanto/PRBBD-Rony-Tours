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
                @include('frontend.user.partial.widget')

                <div class="dashboard_common_table">
                    <h3>My bookings</h3>
                    <div class="table-responsive-lg table_common_area">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl no.</th>
                                    <th>Booking ID</th>
                                    <th>Booking type</th>
                                    <th>Booking amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01.</td>
                                    <td>#JK589V80</td>
                                    <td>Hotel</td>
                                    <td>$754.00</td>
                                    <td class="complete">Completed</td>
                                    <td><i class="fas fa-eye"></i></td>
                                </tr>
                                <tr>
                                    <td>02.</td>
                                    <td>#JK589V80</td>
                                    <td>Hotel</td>
                                    <td>$754.00</td>
                                    <td class="complete">Completed</td>
                                    <td><i class="fas fa-eye"></i></td>
                                </tr>
                                <tr>
                                    <td>03.</td>
                                    <td>#JK589V80</td>
                                    <td>Hotel</td>
                                    <td>$754.00</td>
                                    <td class="complete">Completed</td>
                                    <td><i class="fas fa-eye"></i></td>
                                </tr>
                                <tr>
                                    <td>04.</td>
                                    <td>#JK589V80</td>
                                    <td>Hotel</td>
                                    <td>$754.00</td>
                                    <td class="complete">Completed</td>
                                    <td><i class="fas fa-eye"></i></td>
                                </tr>
                                <tr>
                                    <td>05.</td>
                                    <td>#JK589V80</td>
                                    <td>Hotel</td>
                                    <td>$754.00</td>
                                    <td class="cancele">Canceled</td>
                                    <td><i class="fas fa-eye"></i></td>
                                </tr>
                                <tr>
                                    <td>06.</td>
                                    <td>#JK589V80</td>
                                    <td>Hotel</td>
                                    <td>$754.00</td>
                                    <td class="complete">Completed</td>
                                    <td><i class="fas fa-eye"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
