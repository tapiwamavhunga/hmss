<div class="d-flex align-items-center">
    <a href="{{route('subscriptions.list.show', $row->id)}}" title="Show"
        class="btn px-1 text-info fs-3" data-bs-toggle="tooltip">
         <i class="fas fa-eye"></i>
     </a>

     <a href="{{route('subscriptions.list.edit', $row->id)}}" title="<?php echo __('messages.common.edit') ?>"
        class="btn px-1 text-primary fs-3">
         <i class="fa-solid fa-pen-to-square"></i>
     </a>

</div>
