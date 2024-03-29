@extends('layouts.frontend')
@section('main_content')


    <!-- About Us -->
    <section id="page" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about_us_left">
                        <h5>Cancellation Policy</h5>
                        <p>{!! getSettingDetails('cancellation_policy') !!}</p>
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
