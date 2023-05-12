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



    <div class="modal fade" id="pricingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Login</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body m-3">
              <form action="">

                <div class="mb-3">
                  <label for="user_id" class="form-label">Amy ID/Mobile Number</label>
                  <input type="text" class="form-control" id="user_id">
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password">
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="remember_me">
                  <label class="form-check-label" for="remember_me">
                    Remember Me
                  </label>
                </div>

                <div class="form-check text-center mt-5">
                  <button type="button" class="btn btn-primary">Login</button>
                </div>

              </form>

              <div class="d-flex">
                <div class="p-2">
                  <button type="button" class="btn btn-light">Forgot Password</button>
                </div>
                <div class="ms-auto p-2">
                  <button type="button" class="btn btn-light">Create New ID</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

</body>

</html>
