<!DOCTYPE html>
<html lang="zxx">


<head>
    @include('frontend.include.css')
</head>

<body>

{{--    <div class="preloader">--}}
{{--        <div class="d-table">--}}
{{--            <div class="d-table-cell">--}}
{{--                <div class="lds-spinner">--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                    <div></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/646dbf6374285f0ec46d5062/1h16b77gk';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
