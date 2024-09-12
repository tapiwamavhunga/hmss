<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('doctor_name', __('messages.case.doctor').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{$schedule->doctor->doctorUser->full_name}}</span>
            </div>
            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('per_patient_time', __('messages.schedule.per_patient_time').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800">{{ date('H:i', strtotime($schedule->per_patient_time))}}</span>
            </div>
            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('created_on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800" data-toggle="tooltip" data-placement="right"
                      title="{{ date('jS M, Y', strtotime($schedule->created_at)) }}">{{ $schedule->created_at->diffForHumans() }}</span>
            </div>
            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                {{ Form::label('last_updated', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
                <span class="fs-5 text-gray-800" data-toggle="tooltip" data-placement="right"
                      title="{{ date('jS M, Y', strtotime($schedule->updated_at)) }}">{{ $schedule->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <h1>{{ __('messages.schedule_label') }}</h1>
    <div class="table table-responsive">
        <table id="accountInvoice" class="table table-striped mt-5">
            <thead>
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th>{{ __('messages.schedule.available_on') }}</th>
                <th>{{ __('messages.schedule.available_from') }}</th>
                <th>{{ __('messages.schedule.available_to') }}</th>
            </tr>
            </thead>
            <tbody class="fw-bold">
            @forelse($scheduleDays as $scheduleDay)
                <tr>
                    <td>{{__('messages.schedule_weekday.'. $scheduleDay->available_on) }}</td>
                    <td>{{ date('H:i A', strtotime($scheduleDay->available_from)) }}</td>
                    <td>{{ date('H:i A', strtotime($scheduleDay->available_to)) }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="3">{{__('messages.common.no_data_available')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

