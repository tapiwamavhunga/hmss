@if (getLoggedInUser()->hasRole('Pharmacist'))
    <a href="{{ route('employee.prescriptions.excel') }}"
       class="btn btn-primary" data-turbo="false">{{ __('messages.common.export_to_excel') }}</a>
@endif
