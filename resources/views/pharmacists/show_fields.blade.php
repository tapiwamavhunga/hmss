<div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="image image-circle image-small">
                        <img src="{{$pharmacist->user->image_url}}" alt="image" class="object-fit-cover"/>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                   class="text-gray-800 text-hover-primary fs-2 me-4 text-decoration-none">{{$pharmacist->user->full_name}}</a>
                                <span
                                        class="text-{{ $pharmacist->user->status === 1 ? 'success' : 'danger' }} mb-2 d-block">{{ ($pharmacist->user->status === 1) ? __('messages.common.active') : __('messages.common.de_active') }}</span>
                            </div>
                            <div class="d-flex flex-wrap fs-6 mb-4 pe-2">
                                <a href="mailto: {{$pharmacist->user->email}}"
                                   class="text-decoration-none d-flex align-items-center text-gray-400 text-hover-primary mb-2 me-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                  fill="black"></path>
                                            <path
                                                    d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                    fill="black"></path>
                                        </svg>
                                    </span>
                                    {{$pharmacist->user->email}}
                                </a>
                                <sapn class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    @if(!empty($pharmacist->address->address1) || !empty($pharmacist->address->address2) || !empty($pharmacist->address->city) || !empty($pharmacist->address->zip))
                                        <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                  fill="black"></path>
                                            <path
                                                    d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                    fill="black"></path>
                                        </svg>
                                    </span>
                                    @endif
                                    {{ !empty($pharmacist->address->address1) ? $pharmacist->address->address1 : '' }}{{ !empty($pharmacist->address->address2) ? !empty($pharmacist->address->address1) ? ',' : '' : '' }}
                                    {{ empty($pharmacist->address->address1) || !empty($pharmacist->address->address2)  ? !empty($pharmacist->address->address2) ? $pharmacist->address->address2 : '' : '' }}
                                    {{!empty($pharmacist->address->city) ? ','.$pharmacist->address->city : ''}} {{ !empty($pharmacist->address->zip) ? ','.$pharmacist->address->zip : '' }}
                                </sapn>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-7 overflow-hidden">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#aoverview">{{ __('messages.overview') }}</a>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <a class="nav-link text-active-primary me-6" data-bs-toggle="tab"
                   href="#apayrolls">{{__('messages.my_payrolls')}}</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="aoverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body p-9">
                        <div class="row">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.phone')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{!empty($pharmacist->user->phone) ? $pharmacist->user->region_code.$pharmacist->user->phone:'N/A'}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.gender')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ $pharmacist->user->gender == 0 ? 'Male' : 'Female' }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.blood_group')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-6 stext-{{!empty($pharmacist->user->blood_group) ? 'success' : 'danger'}}">{{ !empty($pharmacist->user->blood_group) ? $pharmacist->user->blood_group : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.dob')  }}</label>
                                <div class="col-lg-8">
                                    <span class="fs-5 text-gray-800">{{ !empty($pharmacist->user->dob) ? \Carbon\Carbon::parse($pharmacist->user->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.designation')  }}</label>
                                <div class="col-lg-8">
                                <span
                                        class="fs-5 text-gray-800">{{ !empty($pharmacist->user->designation) ? $pharmacist->user->designation : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.user.qualification')  }}</label>
                                <div class="col-lg-8">
                                <span
                                        class="fs-5 text-gray-800">{{ !empty($pharmacist->user->qualification) ? $pharmacist->user->qualification : __('messages.common.n/a')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_at') }}</label>
                                <div class="col-lg-8">
                                <span
                                        class="fs-5 text-gray-800 me-2">{{ !empty($pharmacist->user->created_at) ? $pharmacist->user->created_at->diffForHumans() : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-5">
                                <label class="pb-2 fs-5 text-gray-600">{{ __('messages.common.updated_at') }}</label>
                                <div class="col-lg-8">
                                <span
                                        class="fs-5 text-gray-800 me-2">{{ !empty($pharmacist->user->updated_at) ? $pharmacist->user->updated_at->diffForHumans() : __('messages.common.n/a') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="apayrolls" role="tabpanel">
            <div class="container-fluid">
                <livewire:pharmacist-payroll-table pharmacist="{{$pharmacist->id}}" lazy/>
            </div>
        </div>
    </div>
</div>
{{--            <h1 class="m-5">{{__('messages.my_payrolls')}}</h1>--}}
{{--            <div class="card mb-5 mb-xl-10">--}}
{{--                <div class="card-header border-0">--}}
{{--                    <div class="card-title m-0">--}}
{{--                        <h3 class="m-0">{{__('messages.my_payrolls')}}</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <div class="card-body p-9">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="table-responsive viewList">--}}
{{--                                    @include('layouts.search-component')--}}
{{--                                    <livewire:pharmacist-payroll-table pharmacist="{{$pharmacist->id}}"/>--}}
{{--                                    <table id="accountantPayrolls"--}}
{{--                                           class="display table table-responsive-sm table-striped align-middle table-row-dashed fs-6 gy-5 gx-5 dataTable w-100 mt-5">--}}
{{--                                        <thead>--}}
{{--                                        <tr class="text-start text-muted fs-7 text-uppercase gs-0">--}}
{{--                                            <th class="w-10 text-center">{{ __('messages.employee_payroll.payroll_id') }}</th>--}}
{{--                                            <th class="w-10">{{ __('messages.employee_payroll.month') }}</th>--}}
{{--                                            <th class="w-10">{{ __('messages.employee_payroll.year') }}</th>--}}
{{--                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.basic_salary') }}</th>--}}
{{--                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.allowance') }}</th>--}}
{{--                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.deductions') }}</th>--}}
{{--                                            <th class="w-10 text-right">{{ __('messages.employee_payroll.net_salary') }}</th>--}}
{{--                                            <th class="w-10 text-center">{{ __('messages.common.status') }}</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody class="text-gray-600 fw-bold">--}}
{{--                                        @foreach($payrolls as $payroll)--}}
{{--                                            <tr>--}}
{{--                                                <td class="text-center"><a--}}
{{--                                                            href="{{url('employee-payrolls', $payroll->id)}}"><span--}}
{{--                                                                class="badge bg-light-info fs-6">{{ $payroll->payroll_id }}</span></a>--}}
{{--                                                </td>--}}
{{--                                                <td>{{ $payroll->month }}</td>--}}
{{--                                                <td>{{ $payroll->year }}</td>--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->basic_salary, 2) }}--}}
{{--                                                </td>--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->allowance, 2) }}--}}
{{--                                                </td>--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->deductions, 2) }}--}}
{{--                                                </td>--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <b>{{ getCurrencySymbol() }}</b> {{ number_format($payroll->net_salary, 2) }}--}}
{{--                                                </td>--}}
{{--                                                <td class="text-center"><span--}}
{{--                                                            class="badge bg-light-{{($payroll->status == 1  ? 'success' : 'danger')}}">{{ ($payroll->status) ? __('messages.employee_payroll.paid') : __('messages.employee_payroll.not_paid') }}</span>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
