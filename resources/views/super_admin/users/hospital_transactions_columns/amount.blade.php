<div class="d-flex justify-content-end">
    @if(isset($row->transactionSubscription))
        <p class="mb-0">{{ getAdminCurrencyFormat($row->transactionSubscription->subscriptionPlan->currency,$row->amount) }}</p>
    @else
        <p class="mb-0">{{ '$'. number_format($row->amount,2)}}</p>
    @endif
</div>
