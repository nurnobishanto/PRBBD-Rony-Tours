<footer id="footer_area" class="bg-light text-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-4 col-12">
                <div class="footer_heading_area">
                    <h5>Need any help?</h5>
                </div>
                <div class="footer_first_area">
                    <div class="footer_inquery_area">
                        <h5>Call 24/7 for any help</h5>
                        <h3> <a href="tel:{{getSetting('support_phone')}}">{{getSetting('support_phone')}}</a></h3>
                    </div>
                    <div class="footer_inquery_area">
                        <h5>What's APP 24/7 for any help</h5>
                        <h3> <a href="tel:{{getSetting('whatsapp')}}">{{getSetting('whatsapp')}}</a></h3>
                    </div>
                    <div class="footer_inquery_area">
                        <h5>Mail to our support team</h5>
                        <h3> <a href="mailto:{{getSetting('support_email')}}">{{getSetting('support_email')}}</a></h3>
                    </div>
                    <div class="footer_inquery_area">
                        <h5>Follow us on</h5>
                        <ul class="soical_icon_footer">
                            <li><a href="{{getSetting('facebook')}}"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="{{getSetting('twitter')}}"><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href="{{getSetting('instagram')}}"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{getSetting('linkedin')}}!"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-2 col-md-4 col-sm-6 col-12">
                <div class="footer_heading_area">
                    <h5>Quick Links</h5>
                </div>
                <div class="footer_link_area">
                    <ul>
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('testimonials')}}">Testimonials</a></li>
                        <li><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('terms_conditions')}}">Terms and Conditions</a></li>
{{--                        <li><a href="{{route('banks')}}">Our Bank List</a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-12">
                <div class="footer_heading_area">
                    <h5>our Services</h5>
                </div>
                <div class="footer_link_area">
                    <ul>
                        <li><a href="#">Flight</a></li>
                        <li><a href="#">Hotel</a></li>
                        <li><a href="#">Visa</a></li>
                        <li><a href="#">List My Hotel</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
