@extends('layouts.frontend')
@section('main_content')
<!-- Dashboard Area -->

<section id="dashboard_main_arae" class="section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('frontend.user.partial.sidebar')
            </div>
            <div class="col-lg-8">
                @include('frontend.user.partial.widget')
            </div>
        </div>
    </div>
</section>

@endsection
