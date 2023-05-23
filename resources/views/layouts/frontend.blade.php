<!DOCTYPE html>
<html lang="zxx">


<head>
    @include('frontend.include.css')
</head>

<body>

    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="lds-spinner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Area -->
    @include('frontend.include.header')




    @yield('main_content')

    <!-- Footer  -->

    @include('frontend.include.footer')
    @include('frontend.include.copyright')

    <div class="go-top">
        <i class="fas fa-chevron-up"></i>
        <i class="fas fa-chevron-up"></i>
    </div>

    @include('frontend.include.js')



</body>

</html>
