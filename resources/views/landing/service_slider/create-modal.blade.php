<div class="modal fade" tabindex="-1" id="createServiceSliderModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{__('messages.service_slider.add_service_slider')}}</h3>

            </div>

            <div class="modal-body">
                {{ Form::open(['id' => 'serviceSliderForm', 'files' => true]) }}
                <div class="row">
                    <div class="alert alert-danger d-none hide" id="serviceSliderValidationErrorsBox"></div>
                    <div class="form-group col-sm-6">
                        <?php
                        $style = 'style=';
                        $background = 'background-image:';
                        ?>
                        <div class="row2">
                            <label class="form-label d-flex"
                                   for="about_us_image">
                                <span>{{__('messages.service_slider.service_slider_image')}}: </span>
                                <span class="required"></span>
                                <span data-bs-toggle="tooltip"
                                      id="planTooltip"
                                      data-placement="top"
                                      data-bs-original-title="{{ __('messages.new_change.best_resolution_image') }} 140x50">
                                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                </span>
                            </label>
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="exampleInputImage"
                                         style="background-image: url({{asset('web_front/images/doctors/doctor.png') }})"></div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                          data-placement="top"
                                          data-bs-original-title={{ __('messages.new_change.change_image') }}>
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        {{ Form::file('img_url',['class' =>'image-upload d-none','accept' => 'image/*','id' => 'createServiceImage']) }}
                                        <input type="hidden" name="avatar_remove">
                                    </label>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-text">{{__('messages.common.allow_img_text')}}</div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-primary m-0"
                        id="serviceSliderSaveBtn">{{__('messages.common.save')}}</button>
                <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                        data-bs-dismiss="modal">{{__('messages.common.cancel')}}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
