<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('item_category_id', __('messages.item_stock.item_category').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('item_category_id', $itemCategories, null, ['id' => 'stockItemCategory','class' => 'form-select stockCategory','required','placeholder' => __('messages.item.select_item_category'), 'data-control' => 'select2']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('item_id', __('messages.item_stock.item').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::select('item_id', [null], null, ['id' => 'stockItems','class' => 'form-select stockItems', 'required', 'disabled', 'placeholder' => 'Select Item']) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('supplier_name', __('messages.item_stock.supplier_name').':', ['class' => 'form-label']) }}
            {{ Form::text('supplier_name', null, ['id'=>'supplierName','class' => 'form-control', 'placeholder' => __('messages.item_stock.supplier_name')]) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('store_name', __('messages.item_stock.store_name').':', ['class' => 'form-label']) }}
            {{ Form::text('store_name', null, ['id'=>'storeName','class' => 'form-control', 'placeholder' => __('messages.item_stock.store_name')]) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('quantity', __('messages.item_stock.quantity').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('quantity', null, ['id'=>'quantity','class' => 'form-control','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '4','minlength' => '1', 'placeholder' => __('messages.item_stock.quantity')]) }}
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('purchase_price', __('messages.item_stock.purchase_price').':', ['class' => 'form-label']) }}
            <span class="required"></span>
            {{ Form::text('purchase_price', null, ['id'=>'purchasePrice','class' => 'form-control price-input','required', 'onkeyup' => 'if (parseInt(this.value.replace(/[^\d.]/g, "")) > 100000) this.value = this.value.slice(0, -1)','minlength' => '1', 'placeholder' => __('messages.item_stock.purchase_price')]) }}
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group mb-5">
            {{ Form::label('description', __('messages.item_stock.description').(':'), ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('messages.item_stock.description')]) }}
        </div>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-6 col-6">
        <div class="form-group mb-5">
            {{ Form::label('attachment', __('messages.document.attachment').':', ['class' => 'fs-5 fw-bold mb-2 d-block']) }}
            <div class="image-input image-input-outline">
                <?php
                $style = 'style';
                $background = 'background-image:';
                ?>
                <div class="image-picker">
                    <div class="image previewImage" id="previewImage"
                    {{$style}}="{{$background}} url('{{ asset('assets/img/default_image.jpg')}}')">
                </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top"
                          data-bs-original-title={{ __('messages.document.change_attachment') }}>
                        <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="stockAttachment" name="attachment"
                                   class="image-upload d-none stockAttachments"
                                   accept=".png, .jpg, .jpeg, .gif, .webp"/>
                            <input type="hidden" name="avatar_remove"/>
                        </label>
                    </span>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary', 'id' => 'btnSave']) }}
        <a href="{!! route('item.stock.index') !!}"
           class="btn btn-secondary ms-2">{!! __('messages.common.cancel') !!}</a>
    </div>
</div>
