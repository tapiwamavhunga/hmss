<div id="add_currency_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.currency.new_currency') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addCurrencyForm']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('name', __('messages.currency.currency_name'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('currency_name', '', ['id'=>'currencyName','class' => 'form-control','required', 'placeholder' => __('messages.currency.currency_name')]) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('icon', __('messages.currency.currency_icon'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('currency_icon', '', ['id'=>'currencyCode','class' => 'form-control','required', 'placeholder' => __('messages.currency.currency_icon')]) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('code', __('messages.currency.currency_code'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('currency_code', '', ['id'=>'currencyIcon','class' => 'form-control','required', 'placeholder' => __('messages.currency.currency_code')]) }}
                    </div>
                </div>
                <div class="text-muted mb-3">
                    {{ __('messages.document.notes') }}
                    : {{ __('messages.currency.add_currency_code_as_per_three_letter_iso_code') }}.<a
                            href="//stripe.com/docs/currencies"
                            target="_blank">{{ __('messages.currency.you_can_find_out_here') }}.</a>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'currencySave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" aria-label="Close" class="btn btn-secondary"
                            data-bs-dismiss="modal">{!! __('messages.common.cancel') !!}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
