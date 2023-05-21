@extends('layouts.frontend')
@section('main_content')
    <section id="common_banner" style="padding: 0px;background-image: none">
    </section>

    <!-- About Us -->
    <section id="about_us_top" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about_us_left">
                        <h5>About us</h5>
                        <p>{!! getSettingDetails('about_us') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('js')

@stop
@endsection
