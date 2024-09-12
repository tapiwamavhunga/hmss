<div id="addOpdPrescriptionModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl overflow-hidden custom-modal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.ipd_patient_prescription.new_prescription') }}</h2>
                <button type="button" aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            {{ Form::open(['id'=>'addOpdPrescriptionForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="opdPrescriptionErrorsBox"></div>
                {{ Form::hidden('opd_patient_department_id',$opdPatientDepartment->id) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('header_note', __('messages.ipd_patient_prescription.header_note').':',['class' => 'form-label']) }}
                        {{ Form::textarea('header_note', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('messages.ipd_patient_prescription.header_note')]) }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 overflow-auto">
                        <div class="table-responsive mb-10 scroll-y" style="max-height: 225px">
                            <table class="table table-striped" id="opdPrescriptionTbl">
                                <thead class="thead-dark sticky-top">
                                <tr class="border-bottom fs-7 fw-bolder text-gray-700 text-uppercase">
                                    <th class="text-center">#</th>
                                    <th class="opdMedicineCategory">{{ __('messages.ipd_patient_prescription.category_id') }}
                                        <span class="required"></span></th>
                                    <th class="opdMedicineId">{{ __('messages.ipd_patient_prescription.medicine_id') }}</th>
                                    <th class="opdDosage">{{ __('messages.ipd_patient_prescription.dosage') }}<span
                                        class="required"></span></th>
                                    <th class="opdDosage">{{ __('messages.purchase_medicine.dose_duration') }}<span
                                        class="required"></span></th>
                                    <th class="opdDosage">{{ __('messages.prescription.time') }}<span
                                        class="required"></span></th>
                                    <th class="opdDosage">{{ __('messages.medicine_bills.dose_interval') }}<span
                                        class="required"></span></th>
                                    <th class="opdPrescriptionInstruction">{{ __('messages.ipd_patient_prescription.instruction') }}
                                        <span class="required"></span></th>
                                    <th class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary w-100"
                                                id="addOpdPrescriptionItem"
                                                data-edit="0">{{ __('messages.common.add') }}</button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="opd-prescription-item-container">
                                <tr>
                                    <td class="text-center opd-prescription-item-number" data-item-number="1">1</td>
                                    <td>
                                        {{ Form::select('category_id[]', $medicineCategories, null, ['class' => 'form-select opdCategoryId select2Selector','required','placeholder'=>__('messages.medicine.select_category'), 'data-id' => '1']) }}
                                    </td>
                                    <td>
                                        <div class="available-qty-div1" id="avlQtyDiv">
                                            {{ Form::select('medicine_id[]', [null], null, ['class' => 'form-select medicineId opd-prescription-medicine select2Selector custom-selector', 'disabled', 'data-medicine-id' => '1','required','placeholder'=>__('messages.medicine_bills.select_medicine')]) }}
                                            <small class="opd-available-quantity1"></small>
                                        </div>
                                    </td>
                                    <td>
                                        {{ Form::text('dosage[]', null, ['class' => 'form-control dosage', 'required', 'onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.ipd_patient_prescription.dosage')]) }}
                                    </td>
                                    <td>
                                        {{ Form::select('day[]', \App\Models\Prescription::DOSE_DURATION, null,['class' => 'form-select select2Selector opdDoseDuration']) }}
                                    </td>
                                    <td>
                                        {{ Form::select('time[]', \App\Models\Prescription::MEAL_ARR, null,['class' => 'form-select select2Selector opdMealList']) }}
                                    </td>
                                    <td>
                                        {{ Form::select('dose_interval[]', \App\Models\Prescription::DOSE_INTERVAL, null,['class' => 'form-select select2Selector opdDoseInterval']) }}
                                    </td>
                                    <td>
                                        {{ Form::textarea('instruction[]', null, ['class' => 'form-control instruction', 'rows' => 1,'required', 'onkeypress' => 'return avoidSpace(event);', 'placeholder' => __('messages.ipd_patient_prescription.instruction')]) }}
                                    </td>
                                    <td class="text-center">
                                        <i class="fa fa-trash text-danger deleteOpdPrescription cursor-pointer"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr class="py-0 my-0 mb-3">
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('footer_note', __('messages.ipd_patient_prescription.footer_note').':',['class' => 'form-label']) }}
                        {{ Form::textarea('footer_note', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('messages.ipd_patient_prescription.footer_note')]) }}
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary me-3','id'=>'btnOpdPrescriptionSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
