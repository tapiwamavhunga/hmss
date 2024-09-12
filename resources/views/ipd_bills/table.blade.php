<div class="row">
    <div class="col-lg-6 col-md-12">
        <h5>{{ __('messages.ipd_charges') }}</h5>
        <div class="table-responsive-sm">
            <table class="table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gx-5 gy-5 dataTable no-footer w-100">
                <thead class="thead-light">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th scope="col">{{ __('messages.account.type') }}</th>
                    <th scope="col">{{ __('messages.medicine.category') }}</th>
                    <th scope="col">{{ __('messages.ipd_patient_charges.date') }}</th>
                    <th scope="col" class="d-flex justify-content-end me-5">{{ __('messages.invoice.amount') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach($bill['charges'] as $charge)
                    <tr>
                        <td>{{ $charge->charge_type }}</td>
                        <td>{{ $charge->chargecategory->name }}</td>
                        <td>{{ $charge->date->format('d/m/Y') }}</td>
                        <td class="d-flex justify-content-end me-5"><span>{{ getCurrencySymbol() }}</span>{{ number_format($charge->applied_charge,2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td class="w-100" colspan="4">
                        <div class="d-flex justify-content-between">
                            {{ __('messages.bill.total_amount').':' }}
                            <span class="pl-2 font-weight-bold pe-5"><span>{{ getCurrencySymbol() }}</span>
                                                        <span>{{  $bill['total_charges']  }}</span></span>
                        </div>
                    </td>
                    {{--                    <td class="text-right" colspan="4">--}}
                    {{--                        {{ __('messages.bill.total_amount').':' }}--}}
                    {{--                        <span class="pl-2 font-weight-bold"><span>{{ getCurrencySymbol() }}</span>--}}
                    {{--                            <span>{{ $bill['total_charges']  }}</span></span>--}}
                    {{--                    </td>--}}
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <h5>{{ __('messages.account.payments') }}</h5>
        <div class="table-responsive-sm">
            <table class="table table-responsive-sm table-striped box-shadow-none align-middle table-row-dashed fs-6 gx-5 gy-5 dataTable no-footer w-100">
                <thead class="thead-light">
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th scope="col">{{ __('messages.ipd_payments.payment_mode') }}</th>
                    <th scope="col">{{ __('messages.ipd_patient_charges.date') }}</th>
                    <th scope="col" class="d-flex justify-content-end me-5">{{ __('messages.ipd_bill.paid_amount') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                @foreach($bill['payments'] as $payment)
                    <tr>
                        <td>{{ $payment->payment_mode_name }}</td>
                        <td>{{ $payment->date->format('d/m/Y') }}</td>
                        <td class="d-flex justify-content-end me-5"><span>{{ getCurrencySymbol() }}</span>{{ number_format($payment->amount,2) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td class="w-100 " colspan="3">
                        <div class="d-flex justify-content-between">
                            {{ __('messages.bill.total_amount').':' }}
                            <span class="pl-2 font-weight-bold pe-5"><span>{{ getCurrencySymbol() }}</span>
                                                        <span>{{  number_format($bill['total_payment'],2)  }}</span></span>
                        </div>
                    </td>
                    {{--                    <td class="text-right" colspan="4">--}}
                    {{--                        {{ __('messages.bill.total_amount').':' }}--}}
                    {{--                        <span class="pl-2 font-weight-bold"><span>{{ getCurrencySymbol() }}</span>--}}
                    {{--                            <span>{{ $bill['total_payment']  }}</span>--}}
                    {{--                        </span>--}}
                    {{--                    </td>--}}
                </tr>
                </tfoot>
            </table>

        </div>
        <form id="ipdBillForm">
            <input type="hidden" value="{{ $ipdPatientDepartment->id }}" name="ipd_patient_department_id">
            @if($ipdPatientDepartment->bill)
                <input type="hidden" value="{{ $ipdPatientDepartment->bill->id }}" name="bill_id">
            @endif
            <div class="row mb-5">
                <div class="col-lg-12 col-md-12 table-responsive-sm">
                    <table class="table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gx-5 gy-5 dataTable no-footer w-100">
                        <thead class="thead-light">
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="h5 font-weight-bold" scope="col"
                                colspan="2">{{ __('messages.bill.bill_summary') }}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">

                        <tr>
                            <td>{{ __('Bed Charge').':' }}</td>
                            <td class="d-flex justify-content-end me-5 font-weight-bold"> <span
                                        id="bedCharge" data-amount={{$bill['bedCharge']}}>{{ getCurrencyFormat($bill['bedCharge'])  }}</span>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.total_charges').':' }}</td>
                            <td class="d-flex justify-content-end me-5 font-weight-bold" >
                                <span id="totalCharges" data-amount={{$bill['total_charges']}}>
                                    {{ getCurrencyFormat($bill['total_charges'])  }}</span>
                        </tr>
                        @php
                            $grossTotal = $bill['total_charges']+ $bill['bedCharge']
                        @endphp
                        <tr>
                            <td>{{ __('messages.ipd_bill.gross_total').':' }}</td>
                            <td class="d-flex justify-content-end me-5 font-weight-bold"> <span
                                        id="grossTotal" data-amount="{{$grossTotal}}">{{ getCurrencyFormat($grossTotal)  }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.discount_in_percentage').' (%) :' }}</td>
                            <td class="d-flex justify-content-end me-3 font-weight-bold">
                                <div class="input-group w-25 w-sm-50 w-xs-75 float-right ">
                                    <input type="text" class="form-control  text-right price-input"
                                           name="discount_in_percentage" id="discountPercent"
                                           value="{{ $bill['discount_in_percentage'] }}" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.tax_in_percentage').' (%) :' }}</td>
                            <td class="d-flex justify-content-end me-3 font-weight-bold">
                                <div class="input-group w-25 w-sm-50 w-xs-75 float-right ">
                                    <input type="text" name="tax_in_percentage" id="taxPercentage"
                                           class="form-control text-right price-input"
                                           value="{{ $bill['tax_in_percentage'] }}" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.other_charges').':' }}</td>
                            <td class="d-flex justify-content-end me-3 font-weight-bold">
                                <div class="input-group w-25 w-sm-50 w-xs-75 float-right ">
                                    <input type="text" class="form-control  price-input" name="other_charges"
                                           id="otherCharges"
                                           value="{{ $bill['other_charges'] }}" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('messages.ipd_bill.paid_amount').':' }}</td>
                            <td class="d-flex justify-content-end me-5 font-weight-bold"> <span
                                        id="totalPayments" data-amount={{$bill['total_payment']}}>{{ getCurrencyFormat($bill['total_payment'])  }}</span>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">{{ __('messages.ipd_bill.net_payable_amount').':' }}
                                (<span id="billStatus"></span>)
                            </td>
                            <td class="d-flex justify-content-end me-3 font-weight-bold">
                                <span id="netPayabelAmount">{{ getCurrencyFormat($bill['net_payable_amount'])  }}</span></td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
            <a href="{{ url('ipd-bills/'.$ipdPatientDepartment->id.'/pdf') }}" target="_blank"
                class="btn btn-success mb-5 btn-active-light-primary me-2 {{ ($ipdPatientDepartment->bill) ? '' : 'disabled' }} "
                id="printBillBtn" role="button" aria-pressed="true">{{ __('messages.bill.print_bill')  }}</a>
            <a href="{{ url('ipd-discharge-patient/'.$ipdPatientDepartment->id.'/pdf') }}" target="_blank"
                class="btn btn-success mb-5 btn-active-light-primary me-2 {{ ($ipdPatientDepartment->bill) ? '' : 'disabled' }} "
                role="button" aria-pressed="true">{{ __('messages.lunch_break.print_discharge_slip')  }}</a>
            @if (!getLoggedinPatient())
                @if (!$ipdPatientDepartment->bill_status)
                    <button type="submit" class="btn mb-5 btn-secondary btn-active-light-primary me-2" id="saveIpdBillbtn">
                        {{  __('messages.bill.generate_bill'). ' & ' . __('messages.ipd_bill.discharge_patient') }}
                    </button>
                @endif
            @endif

        </form>
    </div>
</div>
