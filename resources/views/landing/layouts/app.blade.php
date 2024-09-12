<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ getSuperAdminSettingKeyValue('app_name') }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google" content="notranslate">
    @php
        $settingValue = getSuperAdminSettingValue();
    @endphp
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="turbo-cache-control" content="no-cache">
    <link rel="icon" href="{{ asset($settingValue['favicon']['value']) }}" type="image/png">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="{{ mix('css/landing-third-party.css') }}">
    <link rel="stylesheet" href="{{ mix('css/landing-pages.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}"> --}}
    {{--    <link href="{{asset('landing_front/css/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{asset('landing_front/css/bootstrap.css')}}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{mix('landing_front/css/custom.css')}}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{mix('landing_front/css/layout.css')}}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{ asset('landing_front/css/toast.css') }}" rel="stylesheet" type="text/css"> --}}
    {{--    <link href="{{ mix('css/landing-front-pages.css') }}" rel="stylesheet" type="text/css"> --}}

    {{--    <link href="{{asset('assets/landing-theme/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/animate.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/magnific-popup/magnific-popup.css')}}" rel="stylesheet" --}}
    {{--          type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/owl-carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/spacing.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/base.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/shortcodes.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--        <link href="{{asset('assets/landing-theme/css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/responsive.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/landing-theme/css/theme-color/color-5.css')}}" rel="stylesheet" type="text/css"/> --}}
    {{--    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/> --}}
    @yield('page_css')
    @yield('css')
    @routes
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="//js.stripe.com/v3/"></script>
       @livewireScripts
       @livewireStyles
    {{-- <script src="{{ asset('vendor/livewire/livewire.js') }}" data-turbolinks-eval="false" data-turbo-eval="false"></script>
    @include('livewire.livewire-turbo')
    <script src="{{ asset('js/turbo.js') }}" data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
    data-turbolinks-eval="false" data-turbo-eval="false"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
    <script src="{{ mix('js/landing-third-party.js') }}"></script>
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ mix('js/landing-front-pages.js') }}"></script>
    <script>
        // $(document).ready(function(){
        //     $('.payment-type').selectize();
        // });
        if ($('.mySwiper').length) {
            var swiper = new Swiper('.mySwiper', {
                spaceBetween: 40,
                centeredSlides: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1.2,
                        spaceBetween: 20,
                    },
                    576: {
                        slidesPerView: 1.5,
                        spaceBetween: 20,
                    },
                    992: {
                        slidesPerView: 2.5,
                    },
                    1400: {
                        slidesPerView: 3.5,
                    },
                },
            })
        }

        setTimeout(function() {
            $('.custom-message').fadeOut()
        }, 2000)
    </script>
    <script data-turbo-eval="false">
        let frontLanguage = "{{ checkLanguageSession() }}";
        Lang.setLocale(frontLanguage);
    </script>
</head>

<body>

    {{-- <div class="page-wrapper"> --}}
    {{--    <div id="ht-preloader"> --}}
    {{--        <div class="clear-loader"> --}}
    {{--            <div class="loader"> --}}
    {{--                <div class="loader-div"><span>{{ getAppName()}}</span> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    <div class="page-wrapper">

        @include('landing.layouts.header')

        @yield('content')

        @include('landing.layouts.footer')
    </div>
    {{ Form::hidden('invalidNumber', __('messages.common.invalid_number'), ['class' => 'invalidNumber']) }}
    {{ Form::hidden('invalidCountryNumber', __('messages.common.invalid_country_code'), ['class' => 'invalidCountryNumber']) }}
    {{ Form::hidden('tooShort', __('messages.common.too_short'), ['class' => 'tooShort']) }}
    {{ Form::hidden('tooLong', __('messages.common.too_long'), ['class' => 'tooLong']) }}

    {{-- <script src="{{asset('landing_front/js/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/js/custom/helpers.js') }}"></script> --}}
    {{-- <script src="{{asset('landing_front/js/swiper-bundle.min.js')}}"></script> --}}
    {{-- <script src="{{asset('landing_front/js/bootstrap.bundle.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('landing_front/js/jquery.toast.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('landing_front/js/toast.js') }}"></script> --}}
    {{-- <script src="{{ mix('assets/js/custom/helpers.js') }}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/common-theme.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/jquery.nice-select.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/owl-carousel/owl.carousel.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/magnific-popup/jquery.magnific-popup.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/counter/counter.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/isotope/isotope.pkgd.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/particles.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/vivus/pathformer.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/vivus/vivus.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/raindrops/jquery-ui.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/raindrops/raindrops.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/countdown/jquery.countdown.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/contact-form/contact-form.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/wow.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/landing-theme/js/theme-script.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/js/landing/languageChange/languageChange.js') }}"></script> --}}
    {{-- <script src="{{ mix('assets/js/subscribe/create.js') }}"></script> --}}
    {{-- <script src="https://js.stripe.com/v3/"></script> --}}
    @yield('page_scripts')
    @yield('scripts')
</body>

</html>


{{-- <!DOCTYPE html> --}}
{{-- <html> --}}
{{-- <head> --}}
{{--    <meta charset="UTF-8"> --}}
{{--    <title>@yield('title') | {{ getAppName()}} </title> --}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}"/> --}}
{{--    <meta name="google" content="notranslate"> --}}
{{--    @php --}}
{{--        $settingValue = getSuperAdminSettingValue(); --}}
{{--    @endphp --}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1"/> --}}
{{--    <link rel="icon" href="{{ $settingValue['favicon']['value'] }}" type="image/png"> --}}
{{--    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/> --}}

{{--    <link href="{{asset('assets/landing-theme/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/animate.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/magnific-popup/magnific-popup.css')}}" rel="stylesheet" --}}
{{--          type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/owl-carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/spacing.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/base.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/shortcodes.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/style.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/responsive.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/landing-theme/css/theme-color/color-5.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    <link href="{{asset('assets/css/landing/landing.css')}}" rel="stylesheet" type="text/css"/> --}}
{{--    @yield('page_css') --}}
{{--    @yield('css') --}}
{{-- </head> --}}
{{-- <body> --}}

{{-- <div class="page-wrapper"> --}}
{{--    <div id="ht-preloader"> --}}
{{--        <div class="clear-loader"> --}}
{{--            <div class="loader"> --}}
{{--                <div class="loader-div"><span>{{ getAppName()}}</span> --}}
{{--                </div> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    </div> --}}
{{-- <div class="page-wrapper"> --}}
{{-- @include('landing.layouts.header') --}}

{{-- @yield('content') --}}

{{-- <div id="waterdrop"></div> --}}
{{-- @include('landing.layouts.footer') --}}
{{-- </div> --}}

{{-- @routes --}}
{{-- <script src="{{asset('assets/landing-theme/js/common-theme.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/jquery.nice-select.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/owl-carousel/owl.carousel.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/magnific-popup/jquery.magnific-popup.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/counter/counter.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/isotope/isotope.pkgd.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/particles.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/vivus/pathformer.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/vivus/vivus.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/raindrops/jquery-ui.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/raindrops/raindrops.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/countdown/jquery.countdown.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/contact-form/contact-form.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/wow.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/landing-theme/js/theme-script.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/js/landing/languageChange/languageChange.js') }}"></script> --}}
{{-- <script src="{{ mix('assets/js/subscribe/create.js') }}"></script> --}}
{{-- <script> --}}
{{--    setTimeout(function () { --}}
{{--        $('.custom-message').fadeOut(); --}}
{{--    }, 2000) --}}
{{-- </script> --}}
{{-- @yield('page_scripts') --}}
{{-- @yield('scripts') --}}
{{-- </body> --}}
{{-- </html> --}}
