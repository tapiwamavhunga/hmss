<div class="alert alert-danger d-none hide" id="customValidationErrorsBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name', __('messages.user.first_name') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.user.first_name')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name', __('messages.user.last_name') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.user.last_name')]) }}
        </div>
    </div>
    <div class="form-group col-sm-6  mb-5">
        {{ Form::label('department_name', __('messages.doctor_department.doctor_department') . ':', ['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('doctor_department_id', $doctorsDepartments, null, ['class' => 'form-select', 'id' => 'doctorsDepartmentId', 'placeholder' => __('messages.web_appointment.select_department'), 'data-control' => 'select2', 'required']) }}
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control', 'required', 'id' => 'createAccountantEmail', 'placeholder' => __('messages.user.email')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation', __('messages.user.designation') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('designation', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.user.designation')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('phone', __('messages.user.phone') . ':', ['class' => 'form-label']) }}
            <br>
            {{ Form::tel('phone', null, ['class' => 'form-control phoneNumber', 'id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code', null, ['class' => 'prefix_code']) }}
            {{ Form::hidden('country_iso', null, ['class' => 'country_iso']) }}
            <span class="text-success valid-msg d-none fw-400 fs-small mt-2" id="valid-msg">✓ &nbsp;
                {{ __('messages.valid') }}</span>
            <span class="text-danger error-msg d-none fw-400 fs-small mt-2" id="error-msg"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification', __('messages.user.qualification') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('qualification', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.user.qualification')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob') . ':', ['class' => 'form-label']) }}
            {{ Form::text('dob', null, ['class' => getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control', 'id' => 'doctorBirthDate', 'autocomplete' => 'off', 'placeholder' => __('messages.user.dob')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group', __('messages.user.blood_group') . ':', ['class' => 'form-label']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select', 'id' => 'doctorBloodGroup', 'placeholder' => __('messages.user.select_blood_group')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender', __('messages.user.gender') . ':', ['class' => 'form-label']) }}
            <span class="required"></span> &nbsp;<br>
            <div class="d-flex align-items-center">
                <div class="form-check me-10">
                    <label class="form-label" for="doctorMale">{{ __('messages.user.male') }}</label>
                    {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'doctorMale']) }}
                </div>
                <div class="form-check me-10">
                    <label class="form-label" for="doctorFemale">{{ __('messages.user.female') }}</label>&nbsp;
                    {{ Form::radio('gender', '1', false, ['class' => 'form-check-input', 'id' => 'doctorFemale']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status', __('messages.common.status') . ':', ['class' => 'form-label']) }}
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input is-active" name="status" type="checkbox" value="1" tabindex="8"
                    checked>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('specialist', __('messages.doctor.specialist') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('specialist', isset($doctor) ? $doctor->specialist : '', ['class' => 'form-control', 'required', 'placeholder' => __('messages.doctor.specialist')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('appointment_charge', __('messages.appointment_charge') . ':', ['class' => 'form-label']) }}
            {{ Form::text('appointment_charge', null, ['class' => 'form-control price-input price', 'placeholder' => __('messages.appointment_charge')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('password', __('messages.user.password') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::password('password', ['class' => 'form-control', 'required', 'min' => '6', 'max' => '10', 'placeholder' => __('messages.user.password')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('password_confirmation', __('messages.user.password_confirmation') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'required', 'min' => '6', 'max' => '10', 'placeholder' => __('messages.user.password_confirmation')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.doctor_department.description') . ':', ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'id' => 'description', 'placeholder' => __('messages.doctor_department.description')]) }}
        </div>
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2" io-image-input="true">
            {{ Form::label('image', __('messages.common.profile') . ':', ['class' => 'form-label']) }}


            <div class="d-block">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>

                <div class="image-picker">
                    <div class="image previewImage" id="previewImage" {{ $style }}"{{ $background }}
                        url({{ asset('assets/img/avatar.png') }}">
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                            data-placement="top" data-bs-original-title="{{ __('messages.profile.change_Profile') }}">
                            <label>
                                <i class="fa-solid fa-pen" id="doctorProfileImage"></i>
                                <input type="file" id="doctorProfileImage" name="image"
                                    class="image-upload d-none profileImage" accept=".png, .jpg, .jpeg, .gif, .webp" />
                                <input type="hidden" name="avatar_remove" />
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-3">
        <div class="col-md-12 mb-3">
            <h5>{{ __('messages.user.address_details') }}</h5>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-5">
                {{ Form::label('address1', __('messages.user.address1') . ':', ['class' => 'form-label']) }}
                {{ Form::text('address1', null, ['class' => 'form-control', 'placeholder' => __('messages.user.address1')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-5">
                {{ Form::label('address2', __('messages.user.address2') . ':', ['class' => 'form-label']) }}
                {{ Form::text('address2', null, ['class' => 'form-control', 'placeholder' => __('messages.user.address2')]) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-5">
                {{ Form::label('city', __('messages.user.city') . ':', ['class' => 'form-label']) }}
                {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('messages.user.city')]) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-5">
                {{ Form::label('zip', __('messages.user.zip') . ':', ['class' => 'form-label']) }}
                {{ Form::text('zip', null, ['class' => 'form-control', 'maxlength' => '6', 'minlength' => '6', 'placeholder' => __('messages.user.zip')]) }}
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-3 mb-5">
        <div class="col-md-12 mb-3">
            <h5>{{ __('messages.setting.social_details') }}</h5>
        </div>

        <!-- Facebook URL Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('facebook_url', __('messages.facebook_url') . ':', ['class' => 'form-label']) }}
            {{ Form::text('facebook_url', null, ['class' => 'form-control facebookUrl', 'id' => 'doctorFacebookUrl', 'onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.facebook_url')]) }}
        </div>

        <!-- Twitter URL Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('twitter_url', __('messages.twitter_url') . ':', ['class' => 'form-label']) }}
            {{ Form::text('twitter_url', null, ['class' => 'form-control twitterUrl', 'id' => 'doctorTwitterUrl', 'onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.twitter_url')]) }}
        </div>

        <!-- Instagram URL Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('instagram_url', __('messages.instagram_url') . ':', ['class' => 'form-label']) }}
            {{ Form::text('instagram_url', null, ['class' => 'form-control instagramUrl', 'id' => 'doctorInstagramUrl', 'onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.instagram_url')]) }}
        </div>

        <!-- LinkedIn URL Field -->
        <div class="form-group col-sm-6 mb-5">
            {{ Form::label('linkedIn_url', __('messages.linkedIn_url') . ':', ['class' => 'form-label']) }}
            {{ Form::text('linkedIn_url', null, ['class' => 'form-control linkedInUrl', 'id' => 'doctorLinkdInUrl', 'onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.linkedIn_url')]) }}
        </div>

    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
    </div>
