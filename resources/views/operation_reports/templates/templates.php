<script id="operationReportActionTemplate" type="text/x-jsrender">
 
<!--<a href="{{:viewUrl}}" title="--><?php //echo __('messages.common.view')?><!--" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">-->
<!--    <span class="svg-icon svg-icon-1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
<!--    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
<!--        <rect x="0" y="0" width="24" height="24"/>-->
<!--        <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>-->
<!--        <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>-->
<!--    </g>-->
<!--</svg></span>-->
<!--</a>-->
 

<a href="javascript:void(0)" title="<?php echo __('messages.common.edit') ?>" data-id="{{:id}}" class="btn px-2 text-primary fs-3 py-2  edit-btn">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="#" title="<?php echo __('messages.common.delete') ?>" data-id="{{:id}}" class="btn delete-btn px-2 text-danger pe-0 py-2">
            <i class="fa-solid fa-trash"></i>
            </a>


</script>
