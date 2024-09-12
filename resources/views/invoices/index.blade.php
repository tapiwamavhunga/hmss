@extends('layouts.app')
@section('title')
    {{ __('messages.invoice.invoices') }}
@endsection
@section('content')
    @include('flash::message')
    <div class="container-fluid">
        {{Form::hidden('invoiceUrl',route('invoices.index'),['id'=>'indexInvoiceUrl'])}}
        {{Form::hidden('patientUrl',url('patients'),['id'=>'indexPatientUrl'])}}
        {{ Form::hidden('invoiceLang', __('messages.delete.invoice'), ['id' => 'invoiceLang']) }}
        <div class="d-flex flex-column">

            <livewire:invoice-table lazy/>
        </div>
    </div>
@endsection
@section('page_scripts')
    {{-- assets/js/moment.min.js --}}
@endsection
@section('scripts')
    {{-- assets/js/custom/input_price_format.js --}}
    {{-- assets/js/invoices/invoice.js --}}

@endsection
