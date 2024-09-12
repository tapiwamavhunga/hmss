@if ($row->is_completed == 0)
<div class="badge bg-light-warning">
    {{__('messages.appointment.pending')}}
</div>
@endif
@if ($row->is_completed == 1)
    <div class="badge bg-light-success">
        {{ __('messages.common.confirm') }}
    </div>
@endif
@if($row->is_completed == 3)
<div class="badge bg-light-danger">
    {{__('messages.common.canceled')}}
</div>
@endif
