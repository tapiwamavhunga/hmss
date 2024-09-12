<div class="ms-0 ms-md-2" wire:ignore>
    <div class="dropdown d-flex align-items-center me-4 me-md-5">
        <button
                class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
                type="button" data-bs-auto-close="outside"
                data-bs-toggle="dropdown" aria-expanded="false"
                id="paymentReportFilter">
            <i class='fas fa-filter'></i>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="paymentReportFilter">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">{{ __('messages.common.filter_options') }}</h3>
            </div>
            <div class="p-5">
                <div class="mb-10">
                    <label for="filterPaymentAccount" class="form-label">{{ __('messages.account.type').':' }}</label>
{{--                    {{ Form::select('account_type', $filterHeads[0], null,['id' => 'filterPaymentAccount', 'data-control' =>'select2', 'class' => 'form-select status-filter']) }}--}}
                    <select class="form-select status-filter" id="filterPaymentAccount" data-control="select2" name="account_type">
                        <option value="0">{{ __('messages.filter.all') }}</option>
                        <option value="1">{{ __('messages.accountant.debit') }}</option>
                        <option value="2">{{ __('messages.accountant.credit') }}</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" id="resetPaymentReportFilter" class="btn btn-secondary">{{ __('messages.common.reset') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

