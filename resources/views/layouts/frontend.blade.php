<!DOCTYPE html>
<html lang="zxx">


<head>
    @include('frontend.include.css')
</head>

<body>
<!-- Messenger Chat plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "112039008626903");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v17.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

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
