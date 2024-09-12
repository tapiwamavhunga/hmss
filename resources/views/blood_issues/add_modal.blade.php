<div id="bloodIssuesAddModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.blood_issue.new_blood_issue') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'bloodIssuesAddNewForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="bloodIssuesValidationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('issue_date', __('messages.blood_issue.issue_date').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('issue_date', '', ['id'=>'bloodIssueDate','class' => 'form-control bg-white','required', 'placeholder' => __('messages.blood_issue.issue_date')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_id', __('messages.blood_issue.doctor_name').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select select2Selector', 'required', 'id' => 'bloodIssuesDoctorName', 'placeholder' => __('messages.user.select_donor_name'), 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.blood_issue.patient_name').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select select2Selector', 'required', 'id' => 'bloodIssuesPatientName', 'placeholder' => __('messages.user.select_donor_name'), 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('donor_id', __('messages.blood_issue.donor_name').(':'),['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('donor_id', $donors, null, ['class' => 'form-select select2Selector', 'required', 'id' => 'bloodIssuesDonorName', 'placeholder' => __('messages.user.select_donor_name'), 'data-control' => 'select2', 'required']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('blood_group', __('messages.user.blood_group').(':'),['class' => 'form-label']) }}
                        {{ Form::select('blood_group', [], null, ['class' => 'form-select select2Selector', 'required', 'id' => 'bloodIssuesBloodGroup', 'placeholder' => __('messages.user.select_blood_group'), 'data-control' => 'select2', 'disabled']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('amount', __('messages.blood_issue.amount').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('amount', '', ['id'=>'BloodIssueAmount','class' => 'form-control price-input price','required', 'maxlength' => '9', 'placeholder' => __('messages.blood_issue.amount')]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('remarks', __('messages.blood_issue.remarks').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('remarks', '', ['id' => 'BloodIssueRemarks','class' => 'form-control','rows' => 3,'cols' => 3, 'placeholder' => __('messages.blood_issue.remarks')]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary','id' => 'bloodIssuesBtnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
