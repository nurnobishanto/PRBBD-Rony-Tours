<header class="main_header_arae navbar_color_black">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset(getSetting('site_logo'))}}" style="max-height: 60px" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('visa')}}">Visa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('about')}}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
                    @if(Auth::guard('web')->check())
                    <a href="{{route('user.dashboard')}}" class="btn btn-success"> Dashboard</a>
                    @elseif(Auth::guard('admin')->check())
                        <a href="{{route('admin.dashboard')}}" class="btn btn-success">Admin</a>
                    @else
                    <a href="{{route('login')}}" style="margin-right: 10px" class="btn btn-danger ">Login</a>
                    <a href="{{route('register')}}" class="btn btn-info">Registration</a>
                    @endif
                </div>
            </div>
        </nav>
</header>
