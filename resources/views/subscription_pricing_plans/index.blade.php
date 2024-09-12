@extends('layouts.app')
@section('title')
    {{__('messages.subscription_plans.subscription_plans')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            @include('subscription_pricing_plans.pricing_plan_button')
            <div class="row">
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="monthContent" role="tabpanel"
                             aria-labelledby="monthContentTab">
                            <div class="row justify-content-center">
                                @php
                                    $activeSubscription = getCurrentActiveSubscriptionPlan();
                                    $currentActiveSubscription = currentActiveSubscription();
                                @endphp
                                @forelse($subscriptionPricingMonthPlans as $subscriptionsPricingPlan)
                                    @include('subscription_pricing_plans.pricing_plan_section')
                                @empty
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card text-center empty_featured_card">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <div>
                                                    <div class="empty-featured-portfolio">
                                                        <i class="fas fa-question"></i>
                                                    </div>
                                                    <h3 class="card-title mt-3">
                                                        {{ __('messages.subscription_month_plan_not_found') }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane fade" id="yearContent" role="tabpanel"
                             aria-labelledby="yearContentTab">
                            <div class="row justify-content-center">
                                @forelse($subscriptionPricingYearPlans as $subscriptionsPricingPlan)
                                    @include('subscription_pricing_plans.pricing_plan_section')
                                @empty
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card text-center empty_featured_card">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <div>
                                                    <div class="empty-featured-portfolio">
                                                        <i class="fas fa-question"></i>
                                                    </div>
                                                    <h3 class="card-title mt-3">
                                                        {{ __('messages.subscription_year_plan_not_found') }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        {{--let makePaymentURL = "{{ route('purchase-subscription') }}";--}}
        {{--let subscribeText = "{{ __('messages.subscription_pricing_plans.choose_plan') }}";--}}
    </script>
{{--    <script src="{{ mix('assets/js/subscriptions/admin-free-subscription.js') }}"></script>--}}
@endsection
