<header class="main_header_arae navbar_color_black">
    <!-- Navbar Bar -->
    <div class="navbar-area">
        <div class="main-responsive-nav">
            <div class="container">
                <div class="main-responsive-menu">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="assets/img/logo.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navbar">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="assets/img/logo_black.png" alt="logo">
                    </a>
<<<<<<< HEAD
                    <div class="collapse navbar-collapse mean-menu " id="navbarSupportedContent">
                        <ul class="navbar-nav "></ul>
                        <ul class="navbar-nav ">
                             @if(Auth::guard('web')->check())
                            <li class="nav-item">
                                <a href="{{route('user.dashboard')}}" class="nav-link ">
                                    Dashboard
=======
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                        </ul>
                        <ul class="navbar-nav ">
                            @auth
                            <li class="nav-item">
                                <a href="#" class="nav-link ">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link ">Registration</a>
                            </li>
                            @else
                             <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    Home
                                    <i class="fas fa-angle-down"></i>
>>>>>>> nomandev
                                </a>

<<<<<<< HEAD
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a href="{{route('user.dashboard')}}" class="nav-link">Dashboard</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <!-- Authentication -->--}}
{{--                                            <a href="{{ route('user.logout') }}" >Logout</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                            </li>

                             @else
                            <li class="nav-item">
                                <a href="{{route('login')}}" class="nav-link ">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('register')}}" class="nav-link ">Registration</a>
                            </li>
                             @endif
=======
                                            <a href="{{ route('logout') }}"onclick="event.preventDefault();
                                                                this.closest('form').submit();" class="nav-link active">Logout</a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endauth
>>>>>>> nomandev
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
