<div class="alert alert-danger d-none hide" id="customValidationErrorsBox"></div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('first_name',__('messages.user.first_name').(':'), ['class' => 'form-label ']) }}
            <span class="required"></span>
            {{ Form::text('first_name', null, ['class' => 'form-control','required', 'placeholder' => __('messages.user.first_name')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('last_name',__('messages.user.last_name').(':'), ['class' => 'form-label ']) }}
            <span class="required"></span>
            {{ Form::text('last_name', null, ['class' => 'form-control','required', 'placeholder' => __('messages.user.last_name')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('email',__('messages.user.email').(':'), ['class' => 'form-label ']) }}
            <span class="required"></span>
            {{ Form::email('email', null, ['class' => 'form-control','required', 'placeholder' => __('messages.user.email')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('phone',__('messages.user.phone').(':'), ['class' => 'form-label ']) }}
            <br>
            {{ Form::tel('phone', isset($user->phone) ? $user->region_code.$user->phone : null , ['class' => 'form-control iti phoneNumber','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
            {{ Form::hidden('prefix_code',null,['class' => 'prefix_code']) }}
            {!! Form::hidden('country_iso', null, ['class' => 'country_iso']) !!}
            <span class="text-success d-none fw-400 fs-small mt-2 valid-msg" id="valid-msg">✓ &nbsp; {{__('messages.valid')}}</span>
            <span class="text-danger d-none fw-400 fs-small mt-2 error-msg" id="error-msg"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('blood_group',__('messages.user.blood_group').(':'), ['class' => 'form-label ']) }}
            {{ Form::select('blood_group', $bloodGroup, null, ['class' => 'form-select', 'id' => 'editAccountantBloodGroup','placeholder'=>__('messages.user.select_blood_group')]) }}
        </div>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('designation', __('messages.user.designation').':', ['class' => 'form-label ']) }}
        <span class="required"></span>
        {{ Form::text('designation', null, ['class' => 'form-control','required', 'placeholder' => __('messages.user.designation')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('qualification', __('messages.user.qualification').':', ['class' => 'form-label ']) }}
        <span class="required"></span>
        {{ Form::text('qualification', null, ['class' => 'form-control','required', 'placeholder' => __('messages.user.qualification')]) }}
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('dob', __('messages.user.dob').':', ['class' => 'form-label ']) }}
            {{ Form::text('dob', null, ['class' => (getLoggedInUser()->theme_mode) ? 'form-control bg-light' : 'form-control bg-white','id' => 'editAccountantBirthDate','autocomplete' => 'off', 'placeholder' => __('messages.user.dob')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('gender',__('messages.user.gender').(':'), ['class' => 'form-label ']) }}
            <span class="required"></span> &nbsp;<br>
            <div class="d-flex align-items-center">
                <div class="form-check me-10">
                    <label class="form-label" for="editMale">{{ __('messages.user.male') }}</label>&nbsp;&nbsp;
                    {{ Form::radio('gender', '0', true, ['class' => 'form-check-input', 'id' => 'editMale']) }}
                </div>
                <div class="form-check me-10">
                    <label class="form-label" for="editFemale">{{ __('messages.user.female') }}</label>&nbsp;
                    {{ Form::radio('gender', '1',false, ['class' => 'form-check-input', 'id' => 'editFemale']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('status',__('messages.common.status').(':'), ['class' => 'form-label ']) }}
            <br>
            <div class="form-check form-switch">
                <input class="form-check-input" name="status" type="checkbox" value="1"
                       tabindex="8" {{(isset($user) && ($user->status)) ? 'checked' : ''}} >
            </div>
        </div>
    </div>
    <div class="form-group col-md-4 mb-5">
        <div class="row2" io-image-input="true">
            {{ Form::label('image',__('messages.common.profile').(':'), ['class' => 'form-label']) }}


            <div class="d-block">
                <?php
                $style = 'style=';
                $background = 'background-image:';
                ?>

                <div class="image-picker">
                    <div class="image previewImage" id="previewImage"
                    {{$style}}"{{$background}}
                    url('{{ isset($user->media[0]) ? $user->image_url : asset('assets/img/avatar.png')}}')">
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title="{{ __('messages.profile.change_Profile') }}">
                        <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="" name="image"
                                   class="image-upload d-none" accept=".png, .jpg, .jpeg, .gif, .webp"/>
                            <input type="hidden" name="avatar_remove"/>
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row mt-3">
    <div class="col-md-12 mb-3">
        <h5>{{__('messages.user.address_details')}}</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address1',__('messages.user.address1').(':'), ['class' => 'form-label ']) }}
            {{ Form::text('address1', isset($accountant->address->address1) ? $accountant->address->address1 : null, ['class' => 'form-control ', 'placeholder' => __('messages.user.address1')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-5">
            {{ Form::label('address2',__('messages.user.address2').(':'), ['class' => 'form-label ']) }}
            {{ Form::text('address2', isset($accountant->address->address2) ? $accountant->address->address2 : null, ['class' => 'form-control ', 'placeholder' => __('messages.user.address2')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('city',__('messages.user.city').(':'), ['class' => 'form-label ']) }}
            {{ Form::text('city', isset($accountant->address->city) ? $accountant->address->city : null, ['class' => 'form-control ', 'placeholder' => __('messages.user.city')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('zip',__('messages.user.zip').(':'), ['class' => 'form-label ']) }}
            {{ Form::text('zip', isset($accountant->address->zip) ? $accountant->address->zip : null, ['class' => 'form-control ', 'maxlength' => '6','minlength' => '6', 'placeholder' => __('messages.user.zip')]) }}
        </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('accountants.index') }}"
           class="btn btn-secondary">{{__('messages.common.cancel')}}</a>
    </div>
</div>
