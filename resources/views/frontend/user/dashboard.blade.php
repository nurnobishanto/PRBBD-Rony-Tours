@extends('layouts.frontend')
@section('main_content')
<!-- Dashboard Area -->
<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="dashboard_sidebar">
                    <div class="dashboard_sidebar_user">
                        <img src="assets/img/common/dashboard-user.png" alt="img">
                        <h3>Sherlyn Chopra</h3>
                        <p><a href="tel:+00-123-456-789">+00 123 456 789</a></p>
                        <p><a href="mailto:sherlyn@domain.com">sherlyn@domain.com</a></p>
                    </div>
                    <div class="dashboard_menu_area">
                        <ul>
                            <li><a href="dashboard.html" class="active"><i
                                        class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                            <li class="dashboard_dropdown_button" id="dashboard_dropdowns"><i
                                    class="fas fa-address-card"></i>My bookings
                                <span> <i class="fas fa-angle-down"></i></span>
                                <div class="booing_sidebar_dashboard" id="show_dropdown_item"
                                    style="display: none;">
                                    <ul>
                                        <li><a href="hotel-booking.html"><i class="fas fa-hotel"></i>Hotel
                                                booking</a></li>
                                        <li><a href="flight-booking.html"><i class="fas fa-paper-plane"></i>Flight
                                                booking</a></li>
                                        <li>
                                            <a href="tour-booking.html">
                                                <i class="fas fa-map"></i>Tour booking
                                            </a>
                                        </li>
                                        <li><a href="booking-history.html">
                                                <i class="fas fa-history"></i>Booking history</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="my-profile.html"><i class="fas fa-user-circle"></i>My profile</a></li>
                            <li><a href="wallet.html"><i class="fas fa-wallet"></i>Wallet</a></li>
                            <li><a href="notification.html"><i class="fas fa-bell"></i>Notifications</a></li>
                            <li>
                                <a href="#!" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-sign-out-alt"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="dashboard_main_top">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div class="dashboard_top_text">
                                    <h3>Total bookings</h3>
                                    <h1>231</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_top_boxed">
                                <div class="dashboard_top_icon">
                                    <i class="fas fa-sync"></i>
                                </div>
                                <div class="dashboard_top_text">
                                    <h3>Pending bookings</h3>
                                    <h1>23</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="pagination_area">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
