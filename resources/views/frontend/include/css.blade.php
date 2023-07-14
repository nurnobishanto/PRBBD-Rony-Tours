<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>{{getSetting('site_title')}} - {{getSetting('site_tagline')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.all.min.css') }}" />
    {{-- <link rel="stylesheet" href="../../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.8.2/font/bootstrap-icons.css"> --}}
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <!-- owl.theme.default css -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}" />
    <!-- navber css -->
    <link rel="stylesheet" href="{{ asset('assets/css/navber.css') }}" />
    <!-- meanmenu css -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}" />
    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" /> --}}
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset(getSetting('site_favicon')) }}">
{{--    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">--}}
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui/jquery-ui.css')}}">

    <script src="{{asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>

    <link href="{{asset('assets/select2/css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/select2/js/select2.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <script src="{{asset('vendor/moment/moment.min.js')}}"></script>


