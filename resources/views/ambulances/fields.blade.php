<div class="row">
    <!-- Vehicle Number Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('vehicle_number', __('messages.ambulance.vehicle_number').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('vehicle_number', null, ['class' => 'form-control','required', 'placeholder' => __('messages.ambulance.vehicle_number')]) }}
    </div>

    <!-- Vehicle Model Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('vehicle_model', __('messages.ambulance.vehicle_model').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('vehicle_model', null, ['class' => 'form-control','required', 'placeholder' => __('messages.ambulance.vehicle_model')]) }}
    </div>

    <!-- Year Made Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('year_made', __('messages.ambulance.year_made').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('year_made', null, ['class' => 'form-control','required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'placeholder' => __('messages.ambulance.year_made')]) }}
    </div>

    <!-- Driver Name Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_name', __('messages.ambulance.driver_name').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('driver_name', null, ['class' => 'form-control','required', 'placeholder' => __('messages.ambulance.driver_name')]) }}
    </div>

    <!-- Driver Contact Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_contact', __('messages.ambulance.driver_contact').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        <br>
        {{ Form::tel('driver_contact', null, ['class' => 'form-control phoneNumber','id' => 'phoneNumber', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required']) }}
        {{ Form::hidden('prefix_code',null,['class'=>'prefix_code']) }}
        {{ Form::hidden('country_iso', null, ['class' => 'country_iso']) }}
        <span class="text-success valid-msg d-none fw-400 fs-small mt-2" id="valid-msg">✓ &nbsp; {{__('messages.valid')}}</span>
        <span class="text-danger error-msg d-none fw-400 fs-small mt-2" id="error-msg"></span>
    </div>

    <!-- Driver License Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('driver_license', __('messages.ambulance.driver_license').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::text('driver_license', null, ['class' => 'form-control','required', 'placeholder' => __('messages.ambulance.driver_license')]) }}
    </div>

    <!-- Note Field -->
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('note', __('messages.ambulance.note').(':'),['class' => 'form-label']) }}
        {{ Form::textarea('note', null, ['class' => 'form-control','rows'=>'2', 'placeholder' => __('messages.ambulance.note')]) }}
    </div>
    <div class="form-group col-sm-6 mb-5">
        {{ Form::label('vehicle_type', __('messages.ambulance.vehicle_type').(':'),['class' => 'form-label']) }}
        <span class="required"></span>
        {{ Form::select('vehicle_type', $type,null, ['id'=>'ambulancesVehicleType','class' => 'form-select','required','data-control' => 'select2']) }}
    </div>
    <div class="col-md-3 mb-3">
        {{ Form::label('is_available',__('messages.common.is_available').(':'),['class' => 'form-label']) }}
        <br>
        <div class="form-check form-switch">
            <input class="form-check-input w-35px h-20px is-active" name="is_available" type="checkbox" value="1"
                   checked>
        </div>
    </div>

    <!-- Submit Field -->
    <div class="d-flex justify-content-end">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary', 'id' => 'ambulancesBtnSave']) }}
        <a href="{{ route('ambulances.index') }}"
           class="btn btn-secondary ms-2">{{ __('messages.common.cancel') }}</a>
    </div>
</div>
