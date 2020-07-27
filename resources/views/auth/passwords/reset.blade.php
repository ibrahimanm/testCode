<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="Booking by BrightTech">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{ asset('assets/vendors/base/vendors.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/demo/demo5/base/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" id="app">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('assets/app/media/img//bg/bg-3.jpg') }});">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo">
                    <a href="{{url('/')}}">
                        <img  src="{{ asset('/img/logo.png') }}" style="max-width: 100%;height: 85px;">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">{{ __('Reset Password') }}</h3>
                    </div>
                    <form class="m-login__form m-form" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group m-form__group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <input class="form-control m-input" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="off" value="{{ $email ?? old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <input class="form-control m-input" type="password" placeholder="{{ __('Password') }}" name="password" required>

                            @if ($errors->has('password'))
                                <div class="form-control-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <input class="form-control m-input" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                        </div>

                        <div class="m-login__form-action">
                            <button type="submit" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!--begin::Global Theme Bundle -->
<script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/demo/demo5/base/scripts.bundle.js') }}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->


<script src="{{ mix('js/auth.js') }}"></script>
<!--begin::Page Scripts -->

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
