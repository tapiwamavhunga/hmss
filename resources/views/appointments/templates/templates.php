<script id="appointmentActionTemplate" type="text/x-jsrender">
 {{if isDoctor}}
<!--   <a href="{{:url}}" title="--><?php //echo __('messages.common.edit')?><!--" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">-->
<!--        <span class="svg-icon svg-icon-3">-->
<!--            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
<!--            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />-->
<!--            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />-->
<!--            </svg>-->
<!--        </span>-->
<!--    </a>-->
 {{/if}}
<!--   <a href="{{:viewUrl}}" title="--><?php //echo __('messages.common.view')?><!--" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">-->
<!--    <span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
<!--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
<!--        <rect x="0" y="0" width="24" height="24"/>-->
<!--        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>-->
<!--        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>-->
<!--    </g>-->
<!--</svg></span>-->
<!--</a>-->

   <a title="<?php echo __('messages.common.delete') ?>" data-id={{:id}}" class="delete-btn btn px-2 text-danger fs-3 ps-0">
        <i class="fa-solid fa-trash"></i>
    </a>



</script>

<script id="appointmentStatusTemplate" type="text/x-jsrender">
    <label class="form-check form-check-custom form-check-solid d-block">
	    <input data-id="{{:id}}" class="form-check-input switch-input status" type="checkbox" value="0" {{:checked}} id="customControlAutosizing{{:id}}" />
    </label>

</script>
