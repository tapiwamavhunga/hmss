<div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('sr no', __('messages.employee_payroll.sr_no').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->sr_no}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('payroll id', __('messages.employee_payroll.payroll_id').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->payroll_id}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('payroll role', __('messages.employee_payroll.role').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->type_string}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('full name', __('messages.employee_payroll.employee').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->owner->user->full_name}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('month', __('messages.employee_payroll.month').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->month}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('year', __('messages.employee_payroll.year').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{$employeePayroll->year}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <p class="m-0"><span
                                        class="badge bg-{{$employeePayroll->status == 0 ? 'danger' : 'success'}}">{{ ($employeePayroll->status == 0) ? 'Unpaid' : 'Paid' }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('salary', __('messages.employee_payroll.basic_salary').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span
                                    class="fs-5 text-gray-800"> {{ getCurrencyFormat($employeePayroll->basic_salary) }}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('allowance', __('messages.employee_payroll.allowance').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span
                                    class="fs-5 text-gray-800">{{ getCurrencyFormat($employeePayroll->allowance) }}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('deductions', __('messages.employee_payroll.deductions').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{ getCurrencyFormat($employeePayroll->deductions)}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('net salary', __('messages.employee_payroll.net_salary').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{ getCurrencyFormat($employeePayroll->net_salary)}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('created on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{ $employeePayroll->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            {{ Form::label('updated at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                            <span class="fs-5 text-gray-800">{{ $employeePayroll->updated_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
