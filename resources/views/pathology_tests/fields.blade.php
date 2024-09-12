<div class="row">
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('patient_name', __('messages.case.patient') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('patient_id', $patients, null, ['class' => 'form-select', 'required', 'id' => 'pathologyTestPatientId', 'placeholder' => __('messages.document.select_patient'), 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('test_name', __('messages.pathology_test.test_name') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('test_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.pathology_test.test_name')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('short_name', __('messages.pathology_test.short_name') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('short_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.pathology_test.short_name')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('test_type', __('messages.pathology_test.test_type') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('test_type', null, ['class' => 'form-control', 'required', 'placeholder' => __('messages.pathology_test.test_type')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('category_id', __('messages.pathology_test.category_name') . ':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('category_id', $data['pathologyCategories'], null, ['class' => 'form-select pathologyCategories', 'required', 'placeholder' => __('messages.medicine.select_category'), 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('unit', __('messages.pathology_test.unit') . ':', ['class' => 'form-label']) }}
            {{ Form::number('unit', null, ['class' => 'form-control', 'placeholder' => __('messages.pathology_test.unit')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('subcategory', __('messages.pathology_test.subcategory') . ':', ['class' => 'form-label']) }}
            {{ Form::text('subcategory', null, ['class' => 'form-control','placeholder' =>__('messages.pathology_test.subcategory')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('method', __('messages.pathology_test.method') . ':', ['class' => 'form-label']) }}
            {{ Form::text('method', null, ['class' => 'form-control', 'placeholder' => __('messages.pathology_test.method')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('report_days', __('messages.pathology_test.report_days') . ':', ['class' => 'form-label']) }}
            {{ Form::number('report_days', null, ['class' => 'form-control', 'placeholder' => __('messages.pathology_test.report_days')]) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('charge_category_id', __('messages.pathology_test.charge_category') . ':', ['class' => 'form-label required']) }}
            {{ Form::select('charge_category_id', $data['chargeCategories'], null, ['class' => 'form-select pChargeCategories', 'required', 'placeholder' => __('messages.pathology_category.select_charge_category'), 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-5">
            {{ Form::label('standard_charge', __('messages.pathology_test.standard_charge') . ':', ['class' => 'form-label required']) }}
            (<b>{{ getCurrencySymbol() }}</b>)
            {{ Form::text('standard_charge', null, ['class' => 'form-control price-input pathologyStandardCharge', 'readonly', 'required', 'placeholder' => __('messages.pathology_test.standard_charge')]) }}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="table-responsive-sm">
            <div class="overflow-auto">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">{{ __('messages.new_change.parameter_name') }}<span class="required"></span>
                            </th>
                            <th class="">{{ __('messages.new_change.patient_result') }}<span class="required"></span>
                            </th>
                            <th class="">{{ __('messages.new_change.reference_range') }}<span class="required"></span>
                            </th>
                            <th class="">{{ __('messages.pathology_test.unit') }}<span class="required"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="pathology-test-container">
                        <tr>
                            <td>
                                {{ Form::select('parameter_id[]', $data['pathologyParameters'], null, ['class' => 'form-select  select2Selector patholory-parameter-data', 'required', 'placeholder' => __('messages.new_change.select_parameter_name'), 'data-id' => '1', 'data-control' => 'select2']) }}
                            </td>
                            <td>
                                {{ Form::text('patient_result[]', null, ['class' => 'form-control ', 'data-id' => 1, 'required', 'placeholder' => __('messages.new_change.patient_result')]) }}
                            </td>
                            <td>
                                {{ Form::text('reference_range[]', null, ['class' => 'form-control', 'id' => 'rangeId', 'readonly', 'placeholder' => __('messages.new_change.reference_range')]) }}
                            </td>
                            <td>
                                {{ Form::text('unit_id[]', null, ['class' => 'form-control', 'id' => 'unitId', 'readonly', 'placeholder' => __('messages.pathology_test.unit')]) }}
                            </td>
                            <td class="table__add-btn-heading text-center form-label fw-bolder text-gray-700 mb-3">
                                <a href="javascript:void(0)" type="button"
                                    class="btn btn-primary text-star add-parameter-test">
                                    {{ __('messages.common.add') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="form-group">
            {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary']) }}
            <a href="{{ route('pathology.test.index') }}"
                class="btn btn-secondary ms-2">{{ __('messages.common.cancel') }}</a>
        </div>
    </div>
</div>
