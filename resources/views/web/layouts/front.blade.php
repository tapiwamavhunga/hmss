<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="{{getAppName()}}">

    <meta name="keywords" content="Hospital Management System"/>

    <meta name="description" content="Hospital Management System | HMS"/>
    <meta name="author" content="hms.infyom.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbo-cache-control" content="no-cache">
    <title>@yield('title') | {{ getAppName() }}</title>
    @php
        $hospitalSettingValue = getSettingValue();
    @endphp
    <link rel="icon" href="{{ asset($hospitalSettingValue['favicon']['value']) }}" type="image/png">

    <!-- Links of CSS files -->
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-slick.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/slick-theme.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-bootstrap.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-custom.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-home.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('web_front/css/hospital-layout.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-doctors.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-about.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-contact.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-appointment.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-working-hours.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/hospital-testimonials.css') }}">--}}

    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/bootstrap.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/aos.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/animate.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/meanmenu.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/remixicon.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/odometer.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/owl.carousel.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/owl.theme.default.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/jquery-ui.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/magnific-popup.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('web_front/css/fancybox.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/selectize.min.css') }}">--}}
{{--    <link href="{{ mix('assets/css/selectize-input.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/style.scss') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ mix('assets/css/custom.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('web_front/css/style.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" type="text/css"/>--}}


<!-- Links of JS files -->
    {{--    <script src="{{ asset('web_front/js/jquery.min.js') }}"></script>--}}

    {{--    <script src="{{ asset('assets/landing-theme/js/toastr.min.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/select2.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/bootstrap.bundle.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/jquery.meanmenu.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/owl.carousel.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/jquery.appear.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/odometer.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/jquery.magnific-popup.min.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/fancybox.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/jquery-ui.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/selectize.min.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/TweenMax.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/aos.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/jquery.ajaxchimp.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/form-validator.min.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/custom/helpers.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/contact-form-script.js') }}"></script>--}}
    {{--<script src="{{ asset('web_front/js/wow.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/main.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/fontawesome.js') }}"></script>--}}
    {{--    <script src="{{ asset('web_front/js/slick.min.js') }}"></script>--}}

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="{{ mix('css/front-third-party.css') }}">
    <link rel="stylesheet" href="{{ mix('css/front-pages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @yield('page_css')
    @yield('css')
    <script src="{{ mix('js/front-third-party.js')}}"></script>
    <script src="{{ asset('assets/landing-theme/js/toastr.min.js') }}"></script>
    <script src="{{ asset('landing_front/js/moment.min.js') }}"></script>
    <script src="{{ asset('landing_front/js/flatpickr.js') }}"></script>
    <script src="https://npmcdn.com/flatpickr@4.5.2/dist/l10n"></script>
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ mix('js/hospital-front-pages.js') }}"></script>
{{--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>--}}
    @if(isset($userName) && getSettingForReCaptcha($userName)  )
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
    @endif

    <script>
        $(document).ready(function () {
            $('.alert').delay(5000).slideUp(300)
        })
        $(document).on('click', '.languageSelection', function () {
            let languageName = $(this).data('prefix-value')

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'POST',
                url: '/change-language',
                data: { languageName: languageName },
                success: function () {
                    location.reload()
                },
            })
        })
    </script>
    <script data-turbo-eval="false">
        let frontLanguage = "{{ checkLanguageSession() }}";
        Lang.setLocale(frontLanguage);
    </script>
    @yield('page_scripts')
    @yield('scripts')
</head>
<body>
{{--@include('web.layouts.web_loader')--}}
@include('web.layouts.header')
@yield('content')
@include('web.layouts.footer')

<!-- Start Go Top Area -->
{{--<div class="go-top">--}}
{{--    <i class="ri-arrow-up-s-line"></i>--}}
{{--</div>--}}
<div class="go-top bg-success d-flex align-items-center justify-content-center">
    <i class="fas fa-chevron-up next-arrow"></i>
    {{Form::hidden('userCurrentLanguage',checkLanguageSession(),['class'=>'userCurrentLanguage'])}}
</div>
<!-- End Go Top Area -->

</body>
</html>
