@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection
@section('page_css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/int-tel/css/intlTelInput.css') }}">--}}
@endsection
@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/sub-header.css') }}">--}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <div>
                    <span class="text-dark">{{  $errors->first() }}</span>
                </div>
            </div>
        @endif
        <div class="card-body p-0">
            {{Form::hidden('setting',true,['id'=>'editSetting'])}}
            {{Form::hidden('utilsScript',asset('assets/js/int-tel/js/utils.min.js'),['class'=>'utilsScript'])}}
            {{Form::hidden('isEdit',true,['class'=>'isEdit'])}}

            {{Form::hidden('moduleUrl',route('module.index'),['id'=>'editGeneralModuleUrl'])}}
            {{Form::hidden('imageValidation',__('messages.setting.image_validation'),['id'=>'editGeneralImageValidation'])}}
            {{Form::hidden('searchExist',false,['id'=>'editGeneralSearchExist'])}}
            @yield('section')
        </div>
    </div>
@endsection
{{--        let utilsScript = "{{asset('assets/js/int-tel/js/utils.min.js')}}";--}}
{{--        let isEdit = true;--}}
{{--        let moduleUrl = '{{ route('module.index') }}';--}}
{{--        let imageValidation = '{{  __('messages.setting.image_validation') }}';--}}
{{--        let searchExist = false;--}}
{{--    <script src="{{ mix('assets/js/settings/setting.js') }}"></script>--}}
{{--    <script src="{{ mix('assets/js/custom/phone-number-country-code.js') }}"></script>--}}
