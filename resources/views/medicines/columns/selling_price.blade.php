<div class="d-flex justify-content-end">
@if($row->selling_price)
        <p class="cur-margin"> {{getCurrencyFormat($row->selling_price)}}
@else
        {{__('messages.common.n/a')}}
@endif
</div>
