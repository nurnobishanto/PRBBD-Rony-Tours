<div class="dashboard_sidebar">
    <div class="dashboard_sidebar_user">
        <img src="assets/img/common/dashboard-user.png" alt="img">
        <h3>{{auth('web')->user()->name}}</h3>
        <p><a href="tel:{{auth('web')->user()->phone}}">{{auth('web')->user()->phone}}</a></p>
        <p><a href="mailto:{{auth('web')->user()->email}}">{{auth('web')->user()->email}}</a></p>
    </div>
    <div class="dashboard_menu_area">
        <ul>
            <li><a href="{{route('user.dashboard')}}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i
                        class="fas fa-tachometer-alt"></i>Dashboard</a></li>

            <li class="dashboard_dropdown_button" id="dashboard_dropdowns"><i
                    class="fas fa-address-card"></i>My bookings
                <span> <i class="fas fa-angle-down"></i></span>
                <div class="booing_sidebar_dashboard" id="show_dropdown_item"
                     style="display: none;">
                    <ul>
                        <li><a href="{{route('user.booking_flight')}}" class="{{ request()->is('user/booking/flight') ? 'active' : '' }}"><i
                                    class="fas fa-paper-plane"></i>Flight booking</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="{{ route('user.profile')}}" class="{{ request()->is('user/profile') ? 'active' : '' }}"><i class="fas fa-user-circle"></i>My profile</a></li>
            <li><a href="{{route('user.wallet')}}" class="{{ request()->is('user/wallet') ? 'active' : '' }}"><i class="fas fa-wallet"></i>Wallet</a></li>
            <li><a href="#"><i class="fas fa-bell"></i>Notifications</a></li>
            <li><a href="{{route('user.support')}}" class="{{ request()->is('user/support') ? 'active' : '' }}"><i class="fas fa-question-circle"></i>Support</a></li>
            <li><a href="{{ route('user.logout') }}" class="{{ request()->is('logout') ? 'active' : '' }}"> <i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
