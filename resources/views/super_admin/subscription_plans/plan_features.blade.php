<div class="separator my-5"></div>

<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h4 class="mt-2">{{ __('messages.subscription_plans.plan_features') }}</h4>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <label class="form-check form-switch form-check-custom form-check-solid float-end">
            <input class="form-check-input cursor-pointer" type="checkbox" name="select_all" id="selectAllPlanFeatures" value="0"/>
            <span class="form-check-label">{{ __('messages.subscription_plans.select_all') }}</span>
        </label>
    </div>
</div>

<div class="separator my-5"></div>

<div class="row">
    @foreach($planFeatures as $planFeature)
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12 mb-5">
            <label class="form-check form-switch form-check-custom">
                <input class="form-check-input feature {{ $planFeature->name == "SMS / Mail" ? 'sms-limit' : '' }}"
                       type="checkbox" name="plan_feature[]"
                       value="{{ $planFeature->id }}"
                        {{ isset($subscriptionPlanFeatures) && in_array($planFeature->id, $subscriptionPlanFeatures) ? 'checked' : '' }}/>
                <span class="form-check-label">{{ $planFeature->name }}</span>&nbsp;&nbsp;
                @if($planFeature->submenu != 0)
                    <span data-bs-toggle="tooltip"
                          id="planTooltip"
                          data-placement="top"
                          data-bs-original-title="{{ __('messages.subscription_plans.default_plan_text_one') }}
                          {{ $planFeature->submenu }} {{ __('messages.subscription_plans.default_plan_text_two') }}">
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                    </span>
                @endif
            </label>
        </div>
    @endforeach
</div>
