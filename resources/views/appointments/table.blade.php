<div class="table-responsive">
    <table class="table table-striped border-bottom-0" id="appointmentsTbl">
        <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Doctor'))
                <th></th>
            @endif
            <th>{{ __('messages.case.patient') }}</th>
            <th>{{ __('messages.case.doctor') }}</th>
            <th>{{ __('messages.appointment.doctor_department') }}</th>
            <th>{{ __('messages.appointment.date') }}</th>
            <th>{{ __('messages.common.action') }}</th>
        </tr>
        </thead>
        <tbody class="text-gray-600 fw-bold">
        </tbody>
    </table>
</div>
