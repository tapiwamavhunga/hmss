<?php

namespace App\Livewire;

use App\Models\PatientDiagnosisTest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PatientDiagnosisTestTable extends LivewireTableComponent
{
    use WithPagination;

    protected $model = PatientDiagnosisTest::class;

    public $showFilterOnHeader = false;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'patient_diagnosis_test.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

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
            ->setDefaultSort('patient_diagnosis_tests.created_at', 'desc')
            ->setQueryStringStatus(false)
            ->setThAttributes(function (Column $column) {
                if ($column->isField('id')) {
                    return [
                        'class' => 'text-center',
                        'style' => 'padding-right:20px !important',
                    ];
                }
                return [
                    'class' => 'text-nowrap',
                ];
            });
            $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                if ($columnIndex == '6') {
                    return [
                        'class' => 'text-center',
                        'style' => 'padding-right:20px !important',
                    ];
                }

                return [];
            });
    }

    public function placeholder()
    {
        return view('livewire.listing-skeleton');
    }

    public function columns(): array
    {
        if (! getLoggedinPatient()) {
            $this->showButtonOnHeader = true;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_diagnosis_test.templates.action-button');
        } else {
            $this->showButtonOnHeader = false;
            $actionButton = Column::make(__('messages.patient_diagnosis_test.action'),
                'id')->view('patient_diagnosis_test.templates.action-button')->hideIf(1);
        }

        return [
            Column::make(__('messages.patient_diagnosis_test.report_number'),
                'report_number')->view('patient_diagnosis_test.templates.columns.report')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_diagnosis_test.patient'),
                'patient.patientUser.first_name')->view('patient_diagnosis_test.templates.columns.patient')
                ->sortable()->searchable(),
            Column::make('email','patient.patientUser.email')->searchable()->hideIf(1),
            Column::make('last_name','patient.patientUser.last_name')->searchable()->hideIf(1),
            Column::make(__('messages.patient_diagnosis_test.doctor'),
                'doctor.doctorUser.first_name')->view('patient_diagnosis_test.templates.columns.doctor')
                ->sortable()->searchable(),
            Column::make(__('messages.patient_diagnosis_test.doctor'),
                'doctor_id')->hideIf(1),
            Column::make('email','doctor.doctorUser.email')->searchable()->hideIf(1),
            Column::make('last_name','doctor.doctorUser.last_name')->searchable()->hideIf(1),
            Column::make(__('messages.patient_diagnosis_test.diagnosis_category'),
                'category.name')->view('patient_diagnosis_test.templates.columns.diagnosys_category')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.created_at'),
                'created_at')->view('patient_diagnosis_test.templates.columns.created_at')->sortable(),
            $actionButton,
        ];
    }

    public function builder(): Builder
    {
        $query = PatientDiagnosisTest::whereHas('patient.patientUser')->whereHas('doctor.doctorUser')->with('patient.patientUser','doctor.doctorUser','category')->select('patient_diagnosis_tests.*');

        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
