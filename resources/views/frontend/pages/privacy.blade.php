@extends('layouts.frontend')
@section('main_content')


    <!-- About Us -->
    <section id="page" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about_us_left">
                        <h5>Privacy Policy</h5>
                        <p>{!! getSettingDetails('privacy_policy') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        #page ul li{
            list-style-type: circle;
            margin-top: 5px;
        }
    </style>
@section('js')

@stop
@endsection
