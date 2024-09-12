@php($modules = App\Models\Module::cacheFor(now()->addDays())->toBase()->get())

@role('Admin')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('dashboard*') ? 'active' : '' }}"
            href="{{ route('dashboard') }}">{{ __('messages.dashboard.dashboard') }}</a>
    </li>
@endrole

@role('Admin')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('users*', 'accountants*', 'lab-technicians*', 'nurses*', 'pharmacists*', 'receptionists*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('users*') ? 'active' : '' }}"
            href="{{ route('users.index') }}">{{ __('messages.users') }}</a>
    </li>
@endrole


{{-- Subscription Transaction Sub Menu --}}
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('my-transactions*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('my-transactions*') ? 'active' : '' }}"
        href="{{ route('subscriptions.plans.transactions.index') }}">{{ __('messages.subscription_plans.transactions') }}</a>
</li>

@role('Admin')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('subscription-plans*') && !Request::is('choose-payment-type*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('subscription-plans*') || Request::is('choose-payment-type*') ? 'active' : '' }}"
            href="{{ route('subscription.pricing.plans.index') }}">{{ __('messages.subscription_plans.subscription_plans') }}</a>
    </li>
@endrole


@role('Admin|Doctor|Receptionist|Nurse')
    @module('IPD Patients', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('ipds*', 'opds*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('ipds*') ? 'active' : '' }}"
                href="{{ route('ipd.patient.index') }}">{{ __('messages.ipd_patients') }}</a>
        </li>
    @endmodule
    @module('OPD Patients', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('ipds*', 'opds*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('opds*') ? 'active' : '' }}"
                href="{{ route('opd.patient.index') }}">{{ __('messages.opd_patients') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin')
    @module('Vaccinated Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('vaccinated-patients*', 'vaccinations*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('vaccinated-patients*') ? 'active' : '' }}"
                href="{{ route('vaccinated-patients.index') }}">{{ __('messages.vaccinated_patients') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Vaccinations', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('vaccinated-patients*', 'vaccinations*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('vaccinations*') ? 'active' : '' }}"
                href="{{ route('vaccinations.index') }}">{{ __('messages.vaccinations') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Accountant')
    @module('Accounts', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('accounts*') ? 'active' : '' }}"
                href="{{ route('accounts.index') }}">{{ __('messages.accounts') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Accountant')
    @module('Employee Payrolls', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee-payrolls*') ? 'active' : '' }}"
                href="{{ route('employee-payrolls.index') }}">{{ __('messages.employee_payrolls') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Accountant')
    @module('Invoices', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('invoices*') ? 'active' : '' }}"
                href="{{ route('invoices.index') }}">{{ __('messages.invoices') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Accountant')
    @module('Payments', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('payments*') ? 'active' : '' }}"
                href="{{ route('payments.index') }}">{{ __('messages.payments') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Payment Reports', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('payment-reports*') ? 'active' : '' }}"
                href="{{ route('payment.reports') }}">{{ __('messages.payment.payment_reports') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Advance Payments', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('advanced-payments*') ? 'active' : '' }}"
                href="{{ route('advanced-payments.index') }}">{{ __('messages.advanced_payments') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Accountant|Receptionist')
    @module('Bills', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('bills*') ? 'active' : '' }}"
                href="{{ route('bills.index') }}">{{ __('messages.bills') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Advance Payments', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accounts*', 'employee-payrolls*', 'invoices*', 'payments*', 'payment-reports*', 'advanced-payments*', 'bills*', 'manual-billing-payments*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('manual-billing-payments*') ? 'active' : '' }}"
                href="{{ route('manual.billing.payment') }}">{{ __('messages.manual_billing_payments') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Nurse')
    @module('Bed Types', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('bed-types*', 'beds*', 'bed-assigns*', 'bulk-beds*', 'bed-status') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('bed-types*') ? 'active' : '' }}"
                href="{{ route('bed-types.index') }}">{{ __('messages.bed_types') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Nurse')
    @module('Beds', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('bed-types*', 'beds*', 'bed-assigns*', 'bulk-beds', 'bed-status') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('beds*') || Request::is('bulk-beds') ? 'active' : '' }}"
                href="{{ route('beds.index') }}">{{ __('messages.beds') }}</a>
        </li>
    @endmodule
@endrole
@role('Nurse|Doctor')
    @module('Bed Assigns', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient-cases*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-cases*') ? 'active' : '' }}"
                href="{{ route('bed-assigns.index') }}">
                {{ __('messages.bed_assigns') }}
            </a>
        </li>
    @endmodule
@endrole
@role('Admin|Nurse|Doctor')
    @module('Bed Assigns', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('bed-types*', 'beds*', 'bed-assigns*', 'bulk-beds', 'bed-status') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('bed-assigns*') ? 'active' : '' }}" href="{{ route('bed-assigns.index') }}">
                {{ __('messages.bed_assigns') }}
            </a>
        </li>
    @endmodule
    @module('Bed Assigns', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('bed-types*', 'beds*', 'bed-assigns*', 'bulk-beds', 'bed-status') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('bed-status*') ? 'active' : '' }}" href="{{ route('bed-status') }}">
                {{ __('messages.bed_status.bed_status') }}
            </a>
        </li>
    @endmodule
@endrole

@role('Admin|Lab Technician')
    @module('Blood Banks', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('blood-banks*', 'blood-donors*', 'blood-donations*', 'blood-issues*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('blood-banks*') ? 'active' : '' }}"
                href="{{ route('blood-banks.index') }}">{{ __('messages.blood_banks') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Lab Technician')
    @module('Blood Donors', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('blood-banks*', 'blood-donors*', 'blood-donations*', 'blood-issues*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('blood-donors*') ? 'active' : '' }}"
                href="{{ route('blood-donors.index') }}">{{ __('messages.blood_donors') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Lab Technician')
    @module('Blood Donations', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('blood-banks*', 'blood-donors*', 'blood-donations*', 'blood-issues*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('blood-donations*') ? 'active' : '' }}"
                href="{{ route('blood-donations.index') }}">{{ __('messages.blood_donations') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Lab Technician')
    @module('Blood Issues', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('blood-banks*', 'blood-donors*', 'blood-donations*', 'blood-issues*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('blood-issues*') ? 'active' : '' }}"
                href="{{ route('blood-issues.index') }}">{{ __('messages.blood_issues') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patients*') ? 'active' : '' }}"
                href="{{ route('patients.index') }}">{{ __('messages.patients') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist|Case Manager')
    @module('Cases', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-cases*') ? 'active' : '' }}"
                href="{{ route('patient-cases.index') }}">{{ __('messages.cases') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Case Handlers', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('case-handlers*') ? 'active' : '' }}"
                href="{{ route('case-handlers.index') }}">{{ __('messages.case_handlers') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist|Case Manager')
    @module('Patient Admissions', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-admissions*') ? 'active' : '' }}"
                href="{{ route('patient-admissions.index') }}">{{ __('messages.patient_admissions') }}</a>
        </li>
    @endmodule
@endrole
@role('Doctor')
    @module('Patient Admissions', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-admissions*') ? 'active' : '' }}"
                href="{{ route('patient-admissions.index') }}">{{ __('messages.patient_admissions') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-smart-card-templates*') ? 'active' : '' }}"
                href="{{ route('patient-smart-card-templates.index') }}">{{ __('messages.lunch_break.smart_patient_card_template') }}</a>
        </li>
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('generate-patient-smart-cards*') ? 'active' : '' }}"
                href="{{ route('smart-patient-cards.index') }}">{{ __('messages.lunch_break.generate_smart_patient_cards') }}</a>
        </li>
    @endmodule
@endrole


@role('Case Manager|Pharmacist|Lab Technician')

    @module('Doctors', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/doctor*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/doctor*') ? 'active' : '' }}"
                href="{{ url('employee/doctor') }}">{{ __('messages.doctors') }}</a>
        </li>
    @endmodule
    <!--</div>-->
@endrole

@role('Pharmacist')
    @module('Prescriptions', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/prescriptions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/prescriptions*') ? 'active' : '' }}"
                href="{{ url('employee/prescriptions') }}">{{ __('messages.prescriptions') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Doctor|Patient')
    @module('Documents', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('documents*', 'document-types*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('documents*') ? 'active' : '' }}"
                href="{{ route('documents.index') }}">{{ __('messages.documents') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Document Types', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('documents*', 'document-types*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('document-types*') ? 'active' : '' }}"
                href="{{ route('document-types.index') }}">{{ __('messages.document_types') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Insurances', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('insurances*', 'packages*', 'services*', 'ambulances*', 'ambulance-calls*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('insurances*') ? 'active' : '' }}"
                href="{{ route('insurances.index') }}">{{ __('messages.insurances') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Packages', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('insurances*', 'packages*', 'services*', 'ambulances*', 'ambulance-calls*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('packages*') ? 'active' : '' }}"
                href="{{ route('packages.index') }}">{{ __('messages.packages') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist|Accountant')
    @module('Services', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('insurances*', 'packages*', 'services*', 'ambulances*', 'ambulance-calls*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('services*') ? 'active' : '' }}"
                href="{{ route('services.index') }}">{{ __('messages.services') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist|Case Manager')
    @module('Ambulances', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('insurances*', 'packages*', 'services*', 'ambulances*', 'ambulance-calls*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('ambulances*') ? 'active' : '' }}"
                href="{{ route('ambulances.index') }}">{{ __('messages.ambulances') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist|Case Manager')
    @module('Ambulances Calls', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('insurances*', 'packages*', 'services*', 'ambulances*', 'ambulance-calls*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('ambulance-calls*') ? 'active' : '' }}"
                href="{{ route('ambulance-calls.index') }}">{{ __('messages.ambulance_calls') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')

    @role('Admin|Receptionist')
        @module('Doctors', $modules)
            <li
                class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors*', 'doctor-departments*', 'schedules*', 'holidays*', 'breaks*') ? 'd-none' : '' }}">
                <a class="nav-link p-0 {{ Request::is('doctors*') ? 'active' : '' }}"
                    href="{{ route('doctors.index') }}">{{ __('messages.doctors') }}</a>
            </li>
        @endmodule
    @endrole
    @role('Admin')
        @module('Doctor Departments', $modules)
            <?php
            $style = 'style=';
            $background = 'white-space:';
            ?>

            <li
                class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors*', 'doctor-departments*', 'schedules*', 'holidays*', 'breaks*') ? 'd-none' : '' }}">
                <a class="nav-link p-0 {{ Request::is('doctor-departments*') ? 'active' : '' }}"
                    href="{{ route('doctor-departments.index') }}"><span class="menu-title"
                        {{ $style }}"{{ $background }} nowrap">{{ __('messages.doctor_departments') }}</span></a>
            </li>
        @endmodule
    @endrole
    @role('Admin')
        @module('Schedules', $modules)
            <li
                class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors*', 'doctor-departments*', 'schedules*', 'holidays*', 'breaks*') ? 'd-none' : '' }}">
                <a class="nav-link p-0 {{ Request::is('schedules*') ? 'active' : '' }}"
                    href="{{ route('schedules.index') }}">{{ __('messages.schedules') }}</a>
            </li>
        @endmodule
    @endrole
    @role('Admin|Doctor')
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors*', 'doctor-departments*', 'schedules*', 'holidays*', 'breaks*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('holidays*') ? 'active' : '' }}"
                href="{{ route('holidays.index') }}">{{ __('messages.holiday.doctor_holiday') }}</a>
        </li>
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('doctors*', 'doctor-departments*', 'schedules*', 'holidays*', 'breaks*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('breaks*') ? 'active' : '' }}"
                href="{{ route('breaks.index') }}">{{ __('messages.lunch_break.lunch_breaks') }}</a>
        </li>
    @endrole
    @role('Admin')
        @module('Prescriptions', $modules)
            <li
                class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('prescriptions*', 'prescription-medicine-show*') ? 'd-none' : '' }}">
                <a class="nav-link p-0 {{ Request::is('prescriptions*', 'prescription-medicine-show*') ? 'active' : '' }}"
                    href="{{ route('prescriptions.index') }}">{{ __('messages.prescriptions') }}</a>
            </li>
        @endmodule
    @endrole

@endrole

@role('Admin')
    @module('Accountants', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('accountants*', 'users*', 'lab-technicians*', 'nurses*', 'pharmacists*', 'receptionists*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('accountants*') ? 'active' : '' }}"
                href="{{ route('accountants.index') }}">{{ __('messages.accountants') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin')
    @module('Nurses', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('nurses*', 'users*', 'accountants*', 'lab-technicians*', 'pharmacists*', 'receptionists*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('nurses*') ? 'active' : '' }}"
                href="{{ route('nurses.index') }}">{{ __('messages.nurses') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin')
    @module('Receptionists', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('receptionists*', 'users*', 'accountants*', 'lab-technicians*', 'nurses*', 'pharmacists*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('receptionists*') ? 'active' : '' }}"
                href="{{ route('receptionists.index') }}">{{ __('messages.receptionists') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin')
    @module('Lab Technicians', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('lab-technicians*', 'users*', 'accountants*', 'nurses*', 'pharmacists*', 'receptionists*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('lab-technicians*') ? 'active' : '' }}"
                href="{{ route('lab-technicians.index') }}">{{ __('messages.lab_technicians') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin')
    @module('Pharmacists', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('pharmacists*', 'users*', 'accountants*', 'lab-technicians*', 'nurses*', 'receptionists*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('pharmacists*') ? 'active' : '' }}"
                href="{{ route('pharmacists.index') }}">{{ __('messages.pharmacists') }}</a>
        </li>
    @endmodule
@endrole
@role('Patient')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patient/dashboard*') ? 'active' : '' }}"
            href="{{ route('patient.dashboard') }}">{{ __('messages.dashboard.dashboard') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-cases*', 'case-handlers*', 'patient-admissions*', 'patient-smart-card-templates*', 'generate-patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patients*') ? 'active' : '' }}"
            href="#">{{ __('messages.patients') }}</a>
    </li>
@endrole
@module('Appointments', $modules)
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('appointments*', 'appointment-calendars', 'appointments-transaction*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('appointments*', 'appointment-calendars') && !Request::is('appointments-transaction*') ? 'active' : '' }}"
            href="{{ route('appointments.index') }}">{{ __('messages.appointments') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('appointments*', 'appointment-calendars', 'appointments-transaction*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('appointments-transaction*') ? 'active' : '' }}"
            href="{{ route('appointments-transaction.index') }}">
            {{ __('messages.common.appointment_transaction') }}
        </a>
    </li>
@endmodule
{{-- @role('Patient')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient-smart-cards*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('patient-smart-cards*') ? 'active' : '' }}"
            href="{{ route('patient-smart-cards.index') }}">{{ __('messages.lunch_break.patient_smart_cards') }}</a>
    </li>
@endrole --}}

@role('Admin|Doctor|Patient')
    @module('Birth Reports', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('birth-reports*', 'death-reports*', 'investigation-reports*', 'operation-reports*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('birth-reports*') ? 'active' : '' }}"
                href="{{ route('birth-reports.index') }}">{{ __('messages.birth_reports') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Doctor|Patient')
    @module('Death Reports', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('birth-reports*', 'death-reports*', 'investigation-reports*', 'operation-reports*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('death-reports*') ? 'active' : '' }}"
                href="{{ route('death-reports.index') }}">{{ __('messages.death_reports') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Doctor|Patient')
    @module('Investigation Reports', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('birth-reports*', 'death-reports*', 'investigation-reports*', 'operation-reports*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('investigation-reports*') ? 'active' : '' }}"
                href="{{ route('investigation-reports.index') }}">{{ __('messages.investigation_reports') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Doctor|Patient')
    @module('Operation Reports', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('birth-reports*', 'death-reports*', 'investigation-reports*', 'operation-reports*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('operation-reports*') ? 'active' : '' }}"
                href="{{ route('operation-reports.index') }}">{{ __('messages.operation_reports') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Pharmacist|Lab Technician')
    @module('Medicine Categories', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is(
                'categories*',
                'brands*',
                'medicines*',
                'medicine-purchase*',
                'medicine-bills*',
                'used-medicine*',
                'used-medicine*',
            )
                ? 'd-none'
                : '' }}">
            <a class="nav-link p-0 {{ Request::is('categories*') ? 'active' : '' }}"
                href="{{ route('categories.index') }}">{{ __('messages.medicine_categories') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Pharmacist|Lab Technician')
    @module('Medicine Brands', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('categories*', 'brands*', 'medicines*', 'medicine-purchase*', 'used-medicine*', 'medicine-bills*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('brands*') ? 'active' : '' }}"
                href="{{ route('brands.index') }}">{{ __('messages.medicine_brands') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Pharmacist|Lab Technician')
    @module('Medicines', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('categories*', 'brands*', 'medicines*', 'medicine-purchase*', 'used-medicine*', 'medicine-bills*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('medicines*') ? 'active' : '' }}"
                href="{{ route('medicines.index') }}">{{ __('messages.medicines') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Pharmacist|Lab Technician')
    @module('Medicines', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('categories*', 'brands*', 'medicines*', 'medicine-purchase*', 'used-medicine*', 'medicine-bills*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('medicine-purchase*') ? 'active' : '' }}"
                href="{{ route('medicine-purchase.index') }}">{{ __('messages.purchase_medicine.purchase_medicine') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Pharmacist|Lab Technician')
    @module('Medicines', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('categories*', 'brands*', 'medicines*', 'medicine-purchase*', 'used-medicine*', 'medicine-bills*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('used-medicine*') ? 'active' : '' }}"
                href="{{ route('used-medicine.index') }}">{{ __('messages.used_medicine.used_medicine') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Pharmacist|Lab Technician')
    @module('Medicines', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('categories*', 'brands*', 'medicines*', 'medicine-purchase*', 'used-medicine*', 'medicine-bills*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('medicine-bills*') ? 'active' : '' }}"
                href="{{ route('medicine-bills.index') }}">{{ __('messages.medicine_bills.medicine_bills') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Radiology Categories', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('radiology-categories*', 'radiology-tests*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('radiology-categories*') ? 'active' : '' }}"
                href="{{ route('radiology.category.index') }}">{{ __('messages.radiology_category.radiology_categories') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist|Pharmacist|Lab Technician')
    @module('Radiology Tests', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('radiology-categories*', 'radiology-tests*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('radiology-tests*') ? 'active' : '' }}"
                href="{{ route('radiology.test.index') }}">{{ __('messages.radiology_tests') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Pathology Categories', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('pathology-categories*', 'pathology-tests*', 'pathology-units*', 'pathology-parameters*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('pathology-categories*') ? 'active' : '' }}"
                href="{{ route('pathology.category.index') }}">{{ __('messages.pathology_category.pathology_categories') }}</a>
        </li>
    @endmodule
    {{-- @module('Pathology Unit',$modules) --}}
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('pathology-categories*', 'pathology-tests*', 'pathology-units*', 'pathology-parameters*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('pathology-units*') ? 'active' : '' }}"
            href="{{ route('pathology.unit.index') }}">{{ __('messages.new_change.pathology_unit') }}</a>
    </li>
    {{-- @endmodule --}}
    {{-- @module('Pathology Parameter',$modules) --}}
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('pathology-categories*', 'pathology-tests*', 'pathology-units*', 'pathology-parameters*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('pathology-parameters*') ? 'active' : '' }}"
            href="{{ route('pathology.parameter.index') }}">{{ __('messages.new_change.pathology_parameter') }}</a>
    </li>
    {{-- @endmodule --}}
@endrole
@role('Admin|Receptionist|Pharmacist|Lab Technician')
    @module('Pathology Tests', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('pathology-categories*', 'pathology-tests*', 'pathology-units*', 'pathology-parameters*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('pathology-tests*') ? 'active' : '' }}"
                href="{{ route('pathology.test.index') }}">{{ __('messages.pathology_tests') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Doctor|Receptionist|Lab Technician')
    @module('Diagnosis Categories', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('diagnosis-categories*', 'patient-diagnosis-test*', 'patient-diagnosis-report*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-diagnosis-report*') ? 'active' : '' }}"
                href="{{ route('patient.diagnosis.report') }}">{{ __('messages.ipd_diagnosis') }}</a>
        </li>
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('diagnosis-categories*', 'patient-diagnosis-test*', 'patient-diagnosis-report*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('diagnosis-categories*') ? 'active' : '' }}"
                href="{{ route('diagnosis.category.index') }}">{{ __('messages.diagnosis_category.diagnosis_categories') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Doctor|Receptionist|Lab Technician')
    @module('Diagnosis Tests', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('diagnosis-categories*', 'patient-diagnosis-test*', 'patient-diagnosis-report*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient-diagnosis-test*') ? 'active' : '' }}"
                href="{{ route('patient.diagnosis.test.index') }}">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Doctor|Accountant|Case Manager|Receptionist|Pharmacist')
    @module('SMS', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sms*', 'mail*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('sms*') ? 'active' : '' }}"
                href="{{ route('sms.index') }}">{{ __('messages.sms.sms') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Case Manager|Receptionist')
    @module('Mail', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('sms*', 'mail*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('mail*') ? 'active' : '' }}"
                href="{{ route('mail') }}">{{ __('messages.mail') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Accountant')
    @module('Income', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('incomes*', 'expenses*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('incomes*') ? 'active' : '' }}"
                href="{{ route('incomes.index') }}">{{ __('messages.incomes.incomes') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Accountant')
    @module('Expense', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('incomes*', 'expenses*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('expenses*') ? 'active' : '' }}"
                href="{{ route('expenses.index') }}">{{ __('messages.expenses') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin')
    @module('Items Categories', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('item-categories*', 'items*', 'item-stocks*', 'issued-items*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('item-categories*') ? 'active' : '' }}"
                href="{{ route('item-categories.index') }}">{{ __('messages.items_categories') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Items', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('item-categories*', 'items*', 'item-stocks*', 'issued-items*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('items*') ? 'active' : '' }}"
                href="{{ route('items.index') }}">{{ __('messages.items') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Item Stocks', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('item-categories*', 'items*', 'item-stocks*', 'issued-items*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('item-stocks*') ? 'active' : '' }}"
                href="{{ route('item.stock.index') }}">{{ __('messages.items_stocks') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin')
    @module('Issued Items', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('item-categories*', 'items*', 'item-stocks*', 'issued-items*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('issued-items*') ? 'active' : '' }}"
                href="{{ route('issued.item.index') }}">{{ __('messages.issued_items') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Charge Categories', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('charge-categories*', 'charges*', 'doctor-opd-charges*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('charge-categories*') ? 'active' : '' }}"
                href="{{ route('charge-categories.index') }}">{{ __('messages.charge_categories') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Charges', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('charge-categories*', 'charges*', 'doctor-opd-charges*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('charges*') ? 'active' : '' }}"
                href="{{ route('charges.index') }}">{{ __('messages.charges') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Doctor OPD Charges', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('charge-categories*', 'charges*', 'doctor-opd-charges*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('doctor-opd-charges*') ? 'active' : '' }}"
                href="{{ route('doctor-opd-charges.index') }}">{{ __('messages.doctor_opd_charges') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Call Logs', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('call-logs*', 'visitor*', 'receives*', 'dispatches*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('call-logs*') ? 'active' : '' }}"
                href="{{ route('call_logs.index') }}">{{ __('messages.call_logs') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Visitors', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('call-logs*', 'visitor*', 'receives*', 'dispatches*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('visitor*') ? 'active' : '' }}"
                href="{{ route('visitors.index') }}">{{ __('messages.visitors') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Postal Receive', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('call-logs*', 'visitor*', 'receives*', 'dispatches*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('receives*') ? 'active' : '' }}"
                href="{{ route('receives.index') }}">{{ __('messages.postal_receive') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Postal Dispatch', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('call-logs*', 'visitor*', 'receives*', 'dispatches*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('dispatches*') ? 'active' : '' }}"
                href="{{ route('dispatches.index') }}">{{ __('messages.postal_dispatch') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Doctor|Patient')
    @module('Live Consultations', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('live-consultation*', 'live-meeting*', 'connect-google-calendar*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('live-consultation*') ? 'active' : '' }}"
                href="{{ route('live.consultation.index') }}">{{ __('messages.live_consultations') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Doctor|Accountant|Case Manager|Receptionist|Pharmacist|Lab Technician|Nurse')
    @module('Live Meetings', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('live-consultation*', 'live-meeting*', 'connect-google-calendar*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('live-meeting*') ? 'active' : '' }}"
                href="{{ route('live.meeting.index') }}">{{ __('messages.live_meetings') }}</a>
        </li>
    @endmodule
@endrole

@role('Doctor')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('live-consultation*', 'live-meeting*', 'connect-google-calendar*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('connect-google-calendar*') ? 'active' : '' }}"
            href="{{ route('connect-google-calendar.index') }}">{{ __('messages.google_meet.connect_google_meet') }}</a>
    </li>
@endrole

@php($sectionName = Request::get('section') === null && !Request::is('currency-settings*', 'hospital-schedules', 'payment-gateway*', 'custom-fields*') ? 'general' : Request::get('section'))

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('currency-settings*', 'settings*', 'payment-gateway*', 'hospital-schedules', 'custom-fields*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ isset($sectionName) && $sectionName == 'general' ? 'active' : '' }}"
        href="{{ route('settings.edit', ['section' => 'general']) }}">{{ __('messages.general') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('currency-settings*', 'settings*', 'payment-gateway*', 'hospital-schedules', 'custom-fields*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('hospital-schedules*') ? 'active' : '' }}"
        href="{{ route('hospital-schedules.index') }}">{{ __('messages.hospital_schedules') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('currency-settings*', 'settings*', 'payment-gateway*', 'hospital-schedules', 'custom-fields*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ isset($sectionName) && $sectionName == 'sidebar-setting' ? 'active' : '' }}"
        href="{{ route('settings.edit', ['section' => 'sidebar-setting']) }}">{{ __('messages.sidebar_setting') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('currency-settings*', 'settings*', 'payment-gateway*', 'hospital-schedules', 'custom-fields*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('payment-gateway*') ? 'active' : '' }}"
        href="{{ route('payment-gateway.index') }}">{{ __('messages.setting.payment_gateway') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('currency-settings*', 'settings*', 'payment-gateway*', 'hospital-schedules', 'custom-fields*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('currency-settings*') ? 'active' : '' }}"
        href="{{ route('currency-settings.index') }}">{{ __('messages.currency.currencies') }}</a>
</li>

<li
    class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ Request::is('currency-settings*', 'settings*', 'payment-gateway*', 'hospital-schedules', 'custom-fields*') ? '' : 'd-none' }}">
    <a class="nav-link p-0 {{ Request::is('custom-fields*') ? 'active' : '' }}"
        href="{{ route('custom-fields.index') }}">{{ __('messages.custom_field.custom_field') }}</a>
</li>

@role('Admin')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('front-settings*', 'notice-boards*', 'testimonials*', 'front-cms-services*', 'terms-and-conditions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('front-settings*') ? 'active' : '' }}"
            href="{{ route('front.settings.index') }}">{{ __('messages.cms') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('front-settings*', 'notice-boards*', 'testimonials*', 'front-cms-services*', 'terms-and-conditions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('front-cms-services*') ? 'active' : '' }}"
            href="{{ route('front.cms.services.index') }}">{{ __('messages.front_cms_services') }}</a>
    </li>
@endrole
@role('Admin|Receptionist')
    @module('Notice Boards', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('front-settings*', 'notice-boards*', 'testimonials*', 'front-cms-services*', 'terms-and-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('notice-boards*') ? 'active' : '' }}"
                href="{{ url('notice-boards') }}">{{ __('messages.notice_boards') }}</a>
        </li>
    @endmodule
@endrole
@role('Admin|Receptionist')
    @module('Testimonial', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('front-settings*', 'notice-boards*', 'testimonials*', 'front-cms-services*', 'terms-and-conditions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('testimonials*') ? 'active' : '' }}"
                href="{{ route('testimonials.index') }}">{{ __('messages.testimonials') }}</a>
        </li>
    @endmodule
@endrole

@role('Admin|Receptionist')
    @module('Enquires', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('enquiries*', 'enquiry*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('enquiries*') || Request::is('enquiry*') ? 'active' : '' }}"
                href="{{ route('enquiries') }}">{{ __('messages.enquiries') }}</a>
        </li>
    @endmodule
@endrole

@role('Doctor')

    @module('Doctors', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/doctor*', 'doctors*', 'holidays*', 'breaks*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/doctor*', 'doctors*') ? 'active' : '' }}"
                href="{{ url('employee/doctor') }}">{{ __('messages.doctors') }}</a>
        </li>
    @endmodule
    @module('Schedules', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('schedules*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('schedules*') ? 'active' : '' }}"
                href="{{ route('schedules.edit', getDoctorSchedule()) }}">{{ __('messages.schedules') }}</a>
        </li>
    @endmodule
    @module('Prescriptions', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('prescriptions*', 'prescription-medicine-show*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('prescriptions*', 'prescription-medicine-show*') ? 'active' : '' }}"
                href="{{ route('prescriptions.index') }}">{{ __('messages.prescriptions') }}</a>
        </li>
    @endmodule
    @module('Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patients*', 'patient-admissions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patients*') ? 'active' : '' }}"
                href="{{ route('patients.index') }}">{{ __('messages.patients') }}</a>
        </li>
    @endmodule

@endrole

@role('Doctor|Accountant|Case Manager|Receptionist|Pharmacist|Lab Technician|Nurse|Patient')
    @module('Notice Boards', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/notice-board*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/notice-board*') ? 'active' : '' }}"
                href="{{ url('employee/notice-board') }}">{{ __('messages.notice_boards') }}</a>
        </li>
    @endmodule
@endrole

@role('Accountant|Case Manager|Receptionist|Pharmacist|Nurse')
    @module('My Payrolls', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/payroll*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/payroll*') ? 'active' : '' }}"
                href="{{ route('payroll') }}">{{ __('messages.my_payrolls') }}</a>
        </li>
    @endmodule
@endrole

@role('Doctor|Lab Technician')
    @module('My Payrolls', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/payroll*', 'employee-payrolls*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/payroll*', 'employee-payrolls*') ? 'active' : '' }}"
                href="{{ route('payroll') }}">{{ __('messages.my_payrolls') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')
    @module('Patient Cases', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/my-cases*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient/my-cases*') ? 'active' : '' }}"
                href="{{ url('patient/my-cases') }}">{{ __('messages.patients_cases') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')
    @module('Patient Admissions', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/patient-admissions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/patient-admissions*') ? 'active' : '' }}"
                href="{{ url('employee/patient-admissions') }}">{{ __('messages.patient_admissions') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')
    @module('Prescriptions', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/my-prescriptions*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient/my-prescriptions*') ? 'active' : '' }}"
                href="{{ route('prescriptions.list') }}">{{ __('messages.prescriptions') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')
    @module('Vaccinated Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/my-vaccinated*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient/my-vaccinated*') ? 'active' : '' }}"
                href="{{ route('patient.vaccinated') }}">{{ __('messages.vaccinated_patients') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')

    @module('IPD Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/my-ipds*', 'opds*', 'patient/my-opds*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('patient/my-ipds*') ? 'active' : '' }}"
                href="{{ route('patient.ipd') }}">{{ __('messages.ipd_patients') }}</a>
        </li>
    @endmodule
    @module('OPD Patients', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('patient/my-ipds*', 'opds*', 'patient/my-opds*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('opds*', 'patient/my-opds*') ? 'active' : '' }}"
                href="{{ route('patient.opd') }}">{{ __('messages.opd_patients') }}</a>
        </li>
    @endmodule

@endrole

@role('Patient')
    @module('Diagnosis Tests', $modules)
        <li
            class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/patient-diagnosis-test*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/patient-diagnosis-test*') ? 'active' : '' }}"
                href="{{ url('employee/patient-diagnosis-test') }}">{{ __('messages.patient_diagnosis_test.diagnosis_test') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')
    @module('Invoices', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/invoices*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/invoices*') ? 'active' : '' }}"
                href="{{ url('employee/invoices') }}">{{ __('messages.invoices') }}</a>
        </li>
    @endmodule
@endrole

@role('Patient')
    @module('Bills', $modules)
        <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('employee/bills*') ? 'd-none' : '' }}">
            <a class="nav-link p-0 {{ Request::is('employee/bills*') ? 'active' : '' }}"
                href="{{ url('employee/bills') }}">{{ __('messages.bills') }}</a>
        </li>
    @endmodule
@endrole


@role('Super Admin')
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/dashboard*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/dashboard*') ? 'active' : '' }}"
            href="{{ route('super.admin.dashboard') }}">{{ __('messages.dashboard.dashboard') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/hospital-type*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/hospital-type*') ? 'active' : '' }}"
            href="{{ route('super.admin.hospitals.type.index') }}">{{ __('messages.hospitals_type') }}</a>
    </li>

    {{-- <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Route::is('super.admin.hospitals.index','hospital.create','hospital.edit')) ? 'd-none' : '' }}"> --}}
    {{--    <a class="nav-link p-0 {{ Route::is('super.admin.hospitals.index','hospital.create','hospital.edit') ? 'active' : ''  }}"       href="{{ route('admins.index') }}">{{ __('messages.admins') }}</a> --}}
    {{-- </li> --}}

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/admins*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/admins*') ? 'active' : '' }}"
            href="{{ route('admins.index') }}">{{ __('messages.admins') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/hospitals*', 'super-admin/hospital/*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/hospitals*', 'super-admin/hospital/*') ? 'active' : '' }}"
            href="{{ route('super.admin.hospitals.index') }}">{{ __('messages.hospitals') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/subscription-plans*', 'super-admin/transactions*', 'super-admin/subscriptions-hospitals*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/subscription-plans*') ? 'active' : '' }}"
            href="{{ route('super.admin.subscription.plans.index') }}">{{ __('messages.subscription_plans.subscription_plans') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/subscription-plans*', 'super-admin/transactions*', 'super-admin/subscriptions-hospitals*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/transactions*') ? 'active' : '' }}"
            href="{{ route('subscriptions.transactions.index') }}">{{ __('messages.subscription_plans.transactions') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/subscription-plans*', 'super-admin/transactions*', 'super-admin/subscriptions-hospitals*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/subscriptions-hospitals*') ? 'active' : '' }}"
            href="{{ route('subscriptions.list.index') }}">{{ __('messages.subscription.subscriptions') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/section-one*') ? 'active' : '' }}"
            href="{{ route('super.admin.section.one') }}">{{ __('messages.landing_cms.section_one') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/section-two*') ? 'active' : '' }}"
            href="{{ route('super.admin.section.two') }}">{{ __('messages.landing_cms.section_two') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/section-three*') ? 'active' : '' }}"
            href="{{ route('super.admin.section.three') }}">{{ __('messages.landing_cms.section_three') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/section-four*') ? 'active' : '' }}"
            href="{{ route('super.admin.section.four') }}">{{ __('messages.landing_cms.section_four') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/section-five*') ? 'active' : '' }}"
            href="{{ route('super.admin.section.five') }}">{{ __('messages.landing_cms.section_five') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/about-us*') ? 'active' : '' }}"
            href="{{ route('super.admin.about.us') }}">{{ __('messages.landing_cms.about_us') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/service-slider*') ? 'active' : '' }}"
            href="{{ route('service-slider.index') }}">{{ __('messages.web_home.services') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/faqs*') ? 'active' : '' }}"
            href="{{ route('faqs.index') }}">{{ __('messages.faq') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/section-one*', 'super-admin/section-two*', 'super-admin/section-three*', 'super-admin/section-four*', 'super-admin/section-five*', 'super-admin/about-us*', 'super-admin/service-slider*', 'super-admin/faqs*', 'super-admin/admin-testimonial*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/admin-testimonial') ? 'active' : '' }}"
            href="{{ route('admin-testimonial.index') }}">{{ __('messages.testimonials') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/general-settings*', 'super-admin/footer-settings*', 'super-admin/super-admin-currency-settings*', 'super-admin/payment-gateway*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/general-settings*') ? 'active' : '' }}"
            href="{{ route('super.admin.settings.edit') }}">{{ __('messages.settings') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/general-settings*', 'super-admin/footer-settings*', 'super-admin/super-admin-currency-settings*', 'super-admin/payment-gateway') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/footer-settings*') ? 'active' : '' }}"
            href="{{ route('super.admin.footer.settings.edit') }}">{{ __('messages.footer_setting.footer_settings') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/general-settings*', 'super-admin/super-admin-currency-settings*', 'super-admin/footer-settings*', 'super-admin/payment-gateway*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/super-admin-currency-settings*') ? 'active' : '' }}"
            href="{{ route('super-admin-currency-settings.index') }}">{{ __('messages.currency.currencies') }}</a>
    </li>
    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/general-settings*', 'super-admin/super-admin-currency-settings*', 'super-admin/footer-settings*', 'super-admin/payment-gateway*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/payment-gateway') ? 'active' : '' }}"
            href="{{ route('super-admin-payment-gateway.edit') }}">{{ __('messages.setting.payment_gateway') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/subscriber*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/subscriber*') ? 'active' : '' }}"
            href="{{ route('super.admin.subscribe.index') }}">{{ __('messages.subscribe.subscribers') }}</a>
    </li>

    <li
        class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('super-admin/enquiries*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('super-admin/enquiries*') ? 'active' : '' }}"
            href="{{ route('super.admin.enquiry.index') }}">{{ __('messages.enquiries') }}</a>
    </li>
@endrole
