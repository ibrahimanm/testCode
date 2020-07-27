<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="Booking by BrightTech">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <h3 class="m-login__title">{{ __('Login') }}</h3>
                    </div>
                    <login inline-template>
                        <div class="m-login__form m-form">
                            <div class="form-group m-form__group" :class="{ 'has-danger': form.error && form.validations.email }">
                                <input class="form-control m-input" v-model="email" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" autocomplete="off" autofocus>
                                <div v-if="form.error && form.validations.email" class="form-control-feedback">@{{ form.validations.email[0] }}</div>
                            </div>
                            <div class="form-group m-form__group" :class="{ 'has-danger': form.error && form.validations.password }">
                                <input class="form-control m-input m-login__form-input--last" v-model="password" type="password" name="password">
                                <div v-if="form.error && form.validations.password" class="form-control-feedback">@{{ form.validations.password[0] }}</div>
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--focus">
                                        <input type="checkbox" v-model="remember" name="remember"> {{ __('Remember Me') }}
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col m--align-right m-login__form-right">
                                    <a href="javascript:;" id="m_login_forget_password" class="m-link">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button @click="login" :disabled="form.disabled" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </login>
                </div>
                <password-reset inline-template>
                    <div class="m-login__forget-password">
                        <div class="m-login__head">
                            <h3 class="m-login__title">{{ __('Reset Password') }}</h3>
                        </div>
                        <div class="m-login__form m-form" :class="{ 'has-danger': form.error && form.validations.email }">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" v-model="email" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" id="m_email" autocomplete="off">
                                <div v-if="form.error && form.validations.email" class="form-control-feedback">@{{ form.validations.email[0] }}</div>
                            </div>
                            <div class="m-login__form-action">
                                <button @click="reset" :disabled="form.disabled" id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">{{ __('Send Password Reset Link') }}</button>&nbsp;&nbsp;
                                <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">{{ __('Cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </password-reset>
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
<script>
    var e = $("#m_login");
    var a = function () {
        e.removeClass("m-login--forget-password"), e.removeClass("m-login--signup"), e.addClass("m-login--signin"), mUtil.animateClass(e.find(".m-login__signin")[0], "flipInX animated")
    };
    $("#m_login_forget_password").click(function (i) {
        i.preventDefault(), e.removeClass("m-login--signin"), e.removeClass("m-login--signup"), e.addClass("m-login--forget-password"), mUtil.animateClass(e.find(".m-login__forget-password")[0], "flipInX animated")
    })
    $("#m_login_forget_password_cancel").click(function (e) {
        e.preventDefault(), a()
    })
</script>
<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
