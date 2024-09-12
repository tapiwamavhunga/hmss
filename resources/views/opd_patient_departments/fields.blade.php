{{ Form::hidden('revisit', isset($data['last_visit']) ? $data['last_visit']->id : null) }}
<div class="row gx-10 mb-5">
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('patient_id', __('messages.ipd_patient.patient_id') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('patient_id', $data['patients'], isset($data['last_visit']) ? $data['last_visit']->patient_id : null, ['class' => 'form-select', 'required', 'id' => 'opdPatientId', 'placeholder' => __('messages.document.select_patient'), 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('case_id', __('messages.ipd_patient.case_id') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('case_id', [null], null, ['class' => 'form-select', 'required', 'id' => 'opdCaseId', 'disabled', 'data-control' => 'select2', 'placeholder' => 'Choose Case']) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('opd_number', __('messages.opd_patient.opd_number').':', ['class' => 'form-label']) }}
                {{ Form::text('opd_number', $data['opdNumber'], ['class' => 'form-control', 'readonly', 'placeholder' => __('messages.opd_patient.opd_number')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('height', __('messages.ipd_patient.height').':', ['class' => 'form-label']) }}
                {{ Form::number('height', (isset($data['last_visit'])) ? $data['last_visit']->height : 0, ['class' => 'form-control', 'max' => '7', 'step' => '.01', 'placeholder' => __('messages.ipd_patient.height')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('weight', __('messages.ipd_patient.weight').':', ['class' => 'form-label']) }}
                {{ Form::number('weight', (isset($data['last_visit'])) ? $data['last_visit']->weight : 0, ['class' => 'form-control', 'max' => '200', 'step' => '.01', 'placeholder' => __('messages.ipd_patient.weight')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('bp', __('messages.ipd_patient.bp').':', ['class' => 'form-label']) }}
                {{ Form::text('bp', (isset($data['last_visit'])) ? $data['last_visit']->bp : null, ['class' => 'form-control', 'placeholder' => __('messages.ipd_patient.bp')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('appointment_date', __('messages.opd_patient.appointment_date') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::text('appointment_date', null, ['class' => (getLoggedInUser()->thememode ? 'bg-light form-control' : 'bg-white form-control'),'id' => 'opdAppointmentDate','autocomplete' => 'off', 'required', 'placeholder' => __('messages.opd_patient.appointment_date')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('doctor_id', __('messages.ipd_patient.doctor_id') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('doctor_id', $data['doctors'], isset($data['last_visit']) ? $data['last_visit']->doctor_id : null, ['class' => 'form-select', 'required', 'id' => 'opdDoctorId', 'placeholder' => __('messages.web_home.select_doctor'), 'data-control' => 'select2']) }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                <div class="form-group">
                    {{ Form::label('standard_charge', __('messages.doctor_opd_charge.standard_charge') . ':', ['class' => 'form-label']) }}
                    <span class="required"></span>
                    <div class="input-group">
                        {{ Form::text('standard_charge', null , ['class' => 'form-control price-input', 'id' => 'opdStandardCharge', 'required', 'placeholder' => __('messages.doctor_opd_charge.standard_charge')]) }}
                        <div class="input-group-text border-0"><a><span>{{ getCurrencySymbol() }}</span></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('payment_mode', __('messages.ipd_payments.payment_mode') . ':', ['class' => 'form-label']) }}
                <span class="required"></span>
                {{ Form::select('payment_mode', $data['paymentMode'], null, ['class' => 'form-select', 'required', 'id' => 'opdPaymentMode', 'data-control' => 'select2', 'placeholder' => __('messages.opd_payments.choose_payment')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('symptoms',__('messages.ipd_patient.symptoms').':', ['class' => 'form-label']) }}
                {{ Form::textarea('symptoms', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('messages.ipd_patient.symptoms')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('notes',__('messages.ipd_patient.notes').':', ['class' => 'form-label']) }}
                {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('messages.ipd_patient.notes')]) }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <div class="mb-5">
                {{ Form::label('is_old_patient', __('messages.ipd_patient.is_old_patient') . ':', ['class' => 'form-label']) }}<br>
                <div class="form-check form-switch">
                    <input class="form-check-input w-35px h-20px" name="is_old_patient" type="checkbox" value="1">
                </div>
            </div>
        </div>
    </div>
    @if ($customField >= 0)
        @foreach ($customField as $field)
            @php
                $field_values = explode(',', $field['values']);
                $dateType = $field['field_type'] == 6 ? 'customFieldDate' : 'customFieldDateTime';
                $field_type = \App\Models\CustomField::FIELD_TYPE_ARR[$field['field_type']];
                $fieldName = 'field' . $field['id'];
            @endphp
            <div class="form-group col-sm-{{ $field['grid'] }} mb-5">
                {{ Form::label($field['field_name'], $field['field_name'] . ':', ['class' => $field['is_required'] == 1 ? 'form-label dynamic-field' : 'form-label']) }}
                @if ($field['is_required'] == 1)
                    <span class="required"></span>
                @endif
                @if ($field_type == 'date' || $field_type == 'date & Time')
                    {{ Form::text($fieldName, null, ['id' => $dateType, 'class' => getLoggedInUser()->thememode ||  $field['is_required'] == 1 ? 'bg-light form-control dynamic-field' : 'bg-white form-control', 'autocomplete' => 'off', 'placeholder' => $field['field_name'], $field['is_required'] == 1 ? 'required' : '']) }}
                @elseif ($field_type == 'toggle')
                    <div class="form-check form-switch form-check-custom">
                        <input class="form-check-input w-35px h-20px is-active {{ $field['is_required'] == 1 ? 'dynamic-field' : '' }}" name={{ $fieldName }}
                            type="checkbox" value="1" tabindex="8">
                    </div>
                @elseif ($field_type == 'select')
                    {{ Form::select($fieldName, $field_values, null, ['class' => $field['is_required'] == 1 ? 'form-select dynamic-field' : 'form-select', 'placeholder' => $field['field_name'], 'data-control' => 'select2', $field['is_required'] == 1 ? 'required' : '']) }}
                @elseif ($field_type == 'multiSelect')
                    {{ Form::select($fieldName . '[]', $field_values, 0, ['class' => $field['is_required'] == 1 ? 'form-select opd-multi-select dynamic-field' : 'form-select opd-multi-select','data-placeholder' => $field['field_name'], 'data-control' => 'select2', 'multiple' => true, $field['is_required'] == 1 ? 'required' : '']) }}
                @else
                    {{ Form::$field_type($fieldName, null, ['class' => $field['is_required'] == 1 ? 'dynamic-field form-control' : 'form-control', $field['is_required'] == 1 ? 'required' : '', 'rows' => $field_type == 'textarea' ? 4 : '', 'placeholder' => $field['field_name']]) }}
                @endif
            </div>
        @endforeach
    @endif
</div>
<div class="d-flex justify-content-end">
    {!! Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3', 'id' => 'btnOpdSave']) !!}
    <a href="{!! route('opd.patient.index') !!}" class="btn btn-secondary">{!! __('messages.common.cancel') !!}</a>
</div>
