<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentTable extends LivewireTableComponent
{
    use WithPagination;

    protected $model = Appointment::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'appointments.add-button';

    protected $FilterComponent = ['appointments.filter-button', Appointment::STATUS_ARR];

    public $dateFilter;

    public $statusFilter;

    protected $startDate = '';

    protected $endDate = '';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage', 'changeDateFilter'];

    // public function resetPage($pageName = 'page')
    // {
    //     $rowsPropertyData = $this->getRows()->toArray();
    //     $prevPageNum = $rowsPropertyData['current_page'] - 1;
    //     $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
    //     $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

    //     $this->setPage($pageNum, $pageName);
    // }

    public function changeDateFilter($dateFilter)
    {
        $this->resetPage($this->getComputedPageName());
        $this->startDate = $dateFilter[0];
        $this->endDate = $dateFilter[1];
        $this->setBuilder($this->builder());
    }

    public function changeFilter($statusFilter)
    {
        $this->resetPage($this->getComputedPageName());
        $this->startDate = $statusFilter[0];
        $this->endDate = $statusFilter[1];
        $this->statusFilter = $statusFilter[2];
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setDefaultSort('appointments.created_at', 'desc');
        $this->setQueryStringStatus(false);
        $this->setPrimaryKey('id');
        $this->setQueryStringStatus(false);
    }

    public function placeholder()
    {
        return view('livewire.skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.case.patient'), 'patient.patientUser.email')
                ->hideIf('patient.patientUser.email')
                ->searchable(),
            Column::make(__('messages.case.patient'), 'doctor.doctorUser.email')
                ->hideIf('doctor.doctorUser.email')
                ->searchable(),
            Column::make(__('messages.case.patient'), 'patient.patientUser.first_name')
                ->view('appointments.columns.patient_name')
                ->searchable(
                    // function (Builder $query, $direction) {
                    //     return $query->whereHas('patient.user', function (Builder $q) use ($direction) {
                    //         $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                    //     });
                    // }
                )
                ->sortable(
                    function (Builder $query, $direction) {
                        return $query->orderBy(User::select('first_name')->whereColumn('id', 'patient.user_id'), $direction);
                    }
                ),
            Column::make('last_name', 'patient.patientUser.last_name')->searchable() ->hideIf(1),
            Column::make('email', 'patient.patientUser.email')->searchable()->hideIf(1),
            Column::make(__('messages.case.doctor'), 'doctor.doctorUser.first_name')
                ->view('appointments.columns.doctor_name')
                ->sortable(
                    function (Builder $query, $direction) {
                        return $query->orderBy(User::select('first_name')->whereColumn('id', 'doctor.user_id'), $direction);
                    }
                )
                ->searchable(
                    // function (Builder $query, $direction) {
                    //     return $query->whereHas('doctor.user', function (Builder $q) use ($direction) {
                    //         $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                    //     });
                    // }
                ),
            Column::make('last_name', 'doctor.doctorUser.last_name')->searchable()->hideIf(1),
            Column::make('email', 'doctor.doctorUser.email')->searchable()->hideIf(1),
            Column::make(__('messages.appointment.doctor_department'), 'doctor.department.title')
                ->view('appointments.columns.department')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.case.patient'), 'patient_id')->hideIf(1),
            Column::make(__('messages.case.doctor'), 'doctor_id')->hideIf(1),
            Column::make(__('messages.appointment.date'), 'opd_date')
                ->view('appointments.columns.date')
                ->sortable(),
            Column::make('Problem', 'id')
                ->hideIf('id'),
            Column::make(__('messages.common.status'), 'is_completed')
                ->view('appointments.columns.status'),
            Column::make(__('messages.common.action'), 'id')
                ->view('appointments.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Appointment::select('appointments.*')->with(['patient','patient.user','doctor','doctor.user','department']);

                    /** @var Appointment $query */
        if (! getLoggedinDoctor()) {
            if (getLoggedinPatient()) {
                //                $query = Appointment::query()->select('appointments.*')->with('patient', 'doctor', 'department');
                $patient = Auth::user();
                $query->whereHas('patient', function (Builder $query) use ($patient) {
                    $query->where('user_id', '=', $patient->id);
                });
            }
        } else {
            $doctorId = Doctor::where('user_id', getLoggedInUserId())->first();
            $query = $query->where('doctor_id', $doctorId->id);
        }

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('is_completed', $this->statusFilter);
            }
        });
        $query->when(isset($this->startDate) && $this->endDate, function (Builder $q) {
            $q->whereBetween('opd_date', [$this->startDate, $this->endDate]);
        });

        return $query;
    }
}
