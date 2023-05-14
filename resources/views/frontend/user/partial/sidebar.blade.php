<div class="dashboard_sidebar">
    <div class="dashboard_sidebar_user">
        <img src="assets/img/common/dashboard-user.png" alt="img">
        <h3>{{auth('web')->user()->name}}</h3>
        <p><a href="tel:{{auth('web')->user()->phone}}">{{auth('web')->user()->phone}}</a></p>
        <p><a href="mailto:{{auth('web')->user()->email}}">{{auth('web')->user()->email}}</a></p>
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
            <li><a href="{{ route('user.profile', auth()->user()->id )}}"><i class="fas fa-user-circle"></i>My profile</a></li>
            <li><a href="{{route('user.wallet')}}"><i class="fas fa-wallet"></i>Wallet</a></li>
            <li><a href="notification.html"><i class="fas fa-bell"></i>Notifications</a></li>
            <li><a href="notification.html"><i class="fas fa-question-circle"></i>Support</a></li>
            <li> <a href="{{ route('user.logout') }}" > <i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
