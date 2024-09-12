<div class="row">
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('patient_id', __('messages.prescription.patient').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span class="fs-5 text-gray-800">{{$prescription->patient->user->full_name}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('doctor_id', __('messages.case.doctor').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span class="fs-5 text-gray-800">{{$prescription->doctor->user->full_name}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('food_allergies', __('messages.prescription.food_allergies').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{ ($prescription->food_allergies != "") ? $prescription->food_allergies : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('tendency_bleed', __('messages.prescription.tendency_bleed').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->tendency_bleed != "") ? $prescription->tendency_bleed : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('heart_disease', __('messages.prescription.heart_disease').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->heart_disease != "") ? $prescription->heart_disease : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('high_blood_pressure', __('messages.prescription.high_blood_pressure').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->high_blood_pressure != "") ? $prescription->high_blood_pressure : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('diabetic', __('messages.prescription.diabetic').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->diabetic != "") ? $prescription->diabetic : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('surgery', __('messages.prescription.surgery').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->surgery != "") ? $prescription->surgery : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('accident', __('messages.prescription.accident').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->accident != "") ? $prescription->accident : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('others', __('messages.prescription.others').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->others != "") ? $prescription->others : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('medical_history', __('messages.new_change.added_at').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{ ($prescription->medical_history != "") ? \Carbon\Carbon::parse($prescription->medical_history)->translatedFormat('jS M, Y') : __('messages.common.n/a')}}</span>
            </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('current_medication', __('messages.prescription.current_medication').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{ ($prescription->current_medication != "") ? $prescription->current_medication : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('female_pregnancy', __('messages.prescription.female_pregnancy').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{ ($prescription->female_pregnancy != "") ? $prescription->female_pregnancy : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('breast_feeding', __('messages.prescription.breast_feeding').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->breast_feeding != "") ? $prescription->breast_feeding : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('health_insurance', __('messages.prescription.health_insurance').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->health_insurance != "") ? $prescription->health_insurance : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('low_income', __('messages.prescription.low_income').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->low_income != "") ? $prescription->low_income : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('reference', __('messages.prescription.reference').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span
                class="fs-5 text-gray-800">{{($prescription->reference != "") ? $prescription->reference : __('messages.common.n/a')}}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <p class="m-0">
                        <span
                                class="badge bg-light-{{!empty($prescription->status == 1) ? 'success' : 'danger'}}">{{($prescription->status == 1) ? __('messages.filter.active') : __('messages.filter.deactive') }}</span>
        </p>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('created_on', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span class="fs-5 text-gray-800" data-toggle="tooltip" data-placement="right"
              title="{{ date('jS M, Y', strtotime($prescription->created_at)) }}">{{ $prescription->created_at->diffForHumans() }}</span>
    </div>
    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
        {{ Form::label('last_updated', __('messages.common.last_updated').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
        <span class="fs-5 text-gray-800" data-toggle="tooltip" data-placement="right"
              title="{{ date('jS M, Y', strtotime($prescription->updated_at)) }}">{{ $prescription->updated_at->diffForHumans() }}</span>
    </div>
</div>
