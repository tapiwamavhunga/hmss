<?php

namespace App\Livewire;

use App\Models\PatientCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CaseTable extends LivewireTableComponent
{
    protected $model = PatientCase::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'patient_cases.add-button';

    public $FilterComponent = ['patient_cases.filter-button', PatientCase::FILTER_STATUS_ARR];

    public $statusFilter;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    // public function resetPage($pageName = 'page')
    // {
    //     $rowsPropertyData = $this->getRows()->toArray();
    //     $prevPageNum = $rowsPropertyData['current_page'] - 1;
    //     $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
    //     $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

    //     $this->setPage($pageNum, $pageName);
    // }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('patient_cases.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('fee')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('status')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function changeFilter($statusFilter)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $statusFilter;
        $this->setBuilder($this->builder());
    }

    public function placeholder()
    {
        return view('livewire.listing-skeleton');
    }

    public function columns(): array
    {
        if (! Auth::user()->hasRole('Patient')) {
            $this->showButtonOnHeader = true;
            $this->showFilterOnHeader = true;
            $actionButton = Column::make(__('messages.common.action'), 'id')
                ->view('patient_cases.action');
            $phone = Column::make(__('messages.user.phone'), 'patient.patientUser.phone')
                ->view('patient_cases.columns.phone')
                ->sortable()->searchable()->hideIf(1);
        } else {
            $this->showButtonOnHeader = false;
            $this->showFilterOnHeader = false;
            $actionButton = Column::make(__('messages.common.action'), 'id')
                ->view('patient_cases.action')
                ->hideIf(1);
            $phone = Column::make(__('messages.user.phone'), 'patient.patientUser.phone')
                ->view('patient_cases.columns.phone')
                ->sortable()->searchable();
        }

        return [
            Column::make('Id', 'id')
                ->hideIf('id')
                ->sortable(),
            Column::make(__('messages.operation_report.case_id'), 'case_id')
                ->view('patient_cases.columns.case_id')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.case.patient'), 'patient.patientUser.first_name')
                ->view('patient_cases.columns.patient_name')
                ->searchable()
                ->sortable(),
            Column::make('last_name','patient.patientUser.last_name')->searchable()->hideIf(1),
            Column::make('email', 'patient.patientUser.email')->searchable()->hideIf(1),
            Column::make(__('messages.case.doctor'), 'doctor.doctorUser.first_name')
                ->view('patient_cases.columns.doctor_name')
                ->searchable()
                ->sortable(),
            Column::make('last_name','doctor.doctorUser.last_name')->searchable()->hideIf(1),
            Column::make('email', 'doctor.doctorUser.email')->searchable()->hideIf(1),
            Column::make(__('messages.case.case_date'), 'date')
                ->view('patient_cases.columns.date')
                ->sortable(),
            $phone,
            Column::make(__('messages.case.fee'), 'fee')
                ->view('patient_cases.columns.fee')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('patient_cases.columns.status'),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        $query = PatientCase::select('patient_cases.*')->with('patient', 'doctor');
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 0) {
            } elseif ($this->statusFilter == 2) {
                $q->where('patient_cases.status', PatientCase::INACTIVE);
            } else {
                $q->where('patient_cases.status', $this->statusFilter);
            }
        });

        return $query;
    }
}
