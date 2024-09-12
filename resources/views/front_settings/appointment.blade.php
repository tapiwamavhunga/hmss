@extends('front_settings.index')
@section('title')
    {{ __('messages.front_settings') }}
@endsection
@section('section')
    <div class="d-md-flex align-items-center justify-content-between mb-7">
        <h1 class="mb-0"> {{ __('messages.front_setting.appointment_details') }} </h1>
    </div>
    <div class="card">
        <div class="card-body">
            {{ Form::open(['route' => ['front.settings.update'], 'method' => 'post', 'files' => true, 'id' => 'createFrontSetting']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
            <div class="row">
                <!-- About Us title Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_title', __('messages.front_setting.about_us_title').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::text('appointment_title', $frontSettings['appointment_title'], ['class' => 'form-control ', 'required','onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.front_setting.about_us_title')]) }}
                </div>
                <!-- About Us description Field -->
                <div class="form-group col-sm-12 mb-5">
                    {{ Form::label('about_us_description', __('messages.front_setting.about_us_description').':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    {{ Form::textarea('appointment_description', $frontSettings['appointment_description'], ['class' => 'form-control ', 'required', 'rows' => 5,'onkeypress' => 'return avoidSpace(event);', 'maxlength'=>435, 'placeholder' => __('messages.front_setting.about_us_description')]) }}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <!-- Submit Field -->
                <div class="modal-footer p-0">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
                    {{ Form::reset(__('messages.common.cancel'), ['class' => 'btn btn-secondary ms-2']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

