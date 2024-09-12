<div class="alert alert-danger d-none hide" id="customValidationErrorsBox"></div>
<div class="row gx-10 mb-5">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name', __('messages.user.first_name').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control', 'required', 'tabindex' => '1', 'placeholder' => __('messages.user.first_name')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name', __('messages.user.last_name').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control','required', 'tabindex' => '2','placeholder' => __('messages.user.last_name')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email', __('messages.user.email').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control','required', 'tabindex' => '3', 'placeholder' => __('messages.user.email')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('designation', null, ['class' => 'form-control','required', 'tabindex' => '4', 'placeholder' => __('messages.user.designation')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mobile-overlapping mb-5">
            {{ Form::label('phone', __('messages.user.phone').':', ['class' => 'form-label']) }}
            <br>
            {{ Form::tel('phone', isset($user->phone) ? $user->region_code.$user->phone : null , ['class' => 'form-control iti phoneNumber','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'tabindex' => '5']) }}
            {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
            {{ Form::hidden('country_iso', null, ['class' => 'country_iso']) }}
            <span class="text-success valid-msg d-none fw-400 fs-small mt-2" id="valid-msg">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="text-danger error-msg d-none fw-400 fs-small mt-2" id="error-msg"></span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender', __('messages.user.gender').':', ['class' => 'form-label']) }}
            <span class="required"></span> &nbsp;<br>
            <div class="d-flex align-items-center">
                <div class="form-check me-10">
                    <label class="form-label" for="maleCaseHandler">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                    {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'tabindex' => '6','id'=>'maleCaseHandler']) }}
                    &nbsp;
                </div>
                <div class="form-check me-10">
                    <label class="form-label" for="femaleCaseHandler">{{ __('messages.user.female') }}</label>
                    {{ Form::radio('gender', '1',false, ['class' => 'form-check-input', 'tabindex' => '7','id'=>'femaleCaseHandler']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label']) }}
            <br>
            <label class="form-check form-switch">
                <input class="form-check-input is-active" name="status" type="checkbox" value="1"
                       tabindex="11" {{ ($user->status === 1) ? 'checked' : '' }} >
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('qualification', null, ['class' => 'form-control','required', 'tabindex' => '8', 'placeholder' => __('messages.user.qualification')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label']) }}
            {{ Form::text('dob', null, ['id'=>'editCaseHandlerBirthDate', 'class' => (getLoggedInUser()->theme_mode) ? 'form-control bg-light' : 'form-control bg-white','autocomplete' => 'off', 'tabindex' => '9', 'placeholder' => __('messages.user.dob')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group', __('messages.user.blood_group').':', ['class' => 'form-label']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select', 'id' => 'bloodGroupCasehandler','placeholder'=>__('messages.user.select_blood_group'), 'data-control' => 'select2', 'tabindex' => '10']) }}
        </div>
    </div>
    <div class="form-group col-md-4">
        <div class="row2">
            {{ Form::label('image', __('messages.common.profile').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
            <div class="d-block">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>
                <div class="image-picker">
                    <div class="image previewImage" id="previewImage"
                         style="background-image: url('{{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png') }}')"></div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title={{ __('messages.profile.change_Profile') }}>
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                        <input type="file" name="image" id="" class="image-upload d-none" accept="image/*"/>
                <input type="hidden" name="avatar_remove">
                                          </label>
                                </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3 mb-5">
    <div class="col-md-12 mb-3">
        <h5>{{ __('messages.user.address_details') }}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1', __('messages.user.address1').':', ['class' => 'form-label']) }}
            {{ Form::text('address1', $caseHandler->address->address1 ?? null, ['class' => 'form-control', 'placeholder' => __('messages.user.address1')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2', __('messages.user.address2').':', ['class' => 'form-label']) }}
            {{ Form::text('address2', $caseHandler->address->address2 ?? null, ['class' => 'form-control', 'placeholder' => __('messages.user.address2')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city', __('messages.user.city').':', ['class' => 'form-label']) }}
            {{ Form::text('city',$caseHandler->address->city ?? null, ['class' => 'form-control', 'placeholder' => __('messages.user.city')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('zip', __('messages.user.zip').':', ['class' => 'form-label']) }}
            {{ Form::text('zip', $caseHandler->address->zip ?? null, ['class' => 'form-control', 'maxlength' => '6','minlength' => '6', 'placeholder' => __('messages.user.zip')]) }}
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','id' => 'btnSave']) }}
    &nbsp;&nbsp;&nbsp;
    <a href="{{ route('case-handlers.index') }}"
       class="btn btn-secondary">{{ __('messages.common.cancel') }}</a>
</div>
