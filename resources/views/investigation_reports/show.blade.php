@extends('layouts.app')
@section('title')
    {{ __('messages.investigation_report.investigation_report_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-7">
            <h1 class="mb-0">{{ __('messages.investigation_report.investigation_report_details') }}</h1>
            <div class="text-end mt-4 mt-md-0">
                {{-- <a href="{{url('investigation-reports/'.$investigationReport->id.'/edit')}}"
                   class="btn btn-primary me-2 me-2 me-2 edit-btn">{{ __('messages.common.edit') }}</a> --}}
                <a href="{{ route('investigation-reports.index') }}"
                    class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    @include('investigation_reports.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
