<?php

namespace App\Livewire;

use App\Models\EmployeePayroll;
use App\Models\Pharmacist;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PharmacistPayrollTable extends LivewireTableComponent
{
    public $pharmacist;

    protected $model = EmployeePayroll::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    // public function resetPage($pageName = 'page')
    // {
    //     $rowsPropertyData = $this->getRows()->toArray();
    //     $prevPageNum = $rowsPropertyData['current_page'] - 1;
    //     $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
    //     $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

    //     $this->setPage($pageNum, $pageName);
    // }

    public function mount(string $pharmacist): void
    {
        $this->$pharmacist = $pharmacist;
        $this->setDefaultSort('created_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('employee_payrolls.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('basic_salary')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('allowance')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('deductions')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('net_salary')) {
                return [
                    'class' => 'price-column',
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
        return [
            Column::make('id', 'id')
                ->hideIf('id'),
            Column::make(__('messages.employee_payroll.payroll_id'), 'payroll_id')
                ->searchable()
                ->view('pharmacists.columns.detail.payroll_id')
                ->sortable(),
            Column::make(__('messages.employee_payroll.month'), 'month')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.year'), 'year')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.employee_payroll.basic_salary'), 'basic_salary')
                ->searchable()
                ->view('pharmacists.columns.detail.basic_salary')
                ->sortable(),
            Column::make(__('messages.employee_payroll.allowance'), 'allowance')
                ->view('pharmacists.columns.detail.allowance')
                ->sortable(),
            Column::make(__('messages.employee_payroll.deductions'), 'deductions')
                ->view('pharmacists.columns.detail.deductions')
                ->sortable(),
            Column::make(__('messages.employee_payroll.net_salary'), 'net_salary')
                ->view('pharmacists.columns.detail.net_salary')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('pharmacists.columns.detail.status')
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        //        /** @var EmployeePayroll $query */
        //        $query = EmployeePayroll::where('owner_id', $this->pharmacist)
        //            ->where('owner_type', 'App\Models\Pharmacist');

        $query = EmployeePayroll::whereHasMorph(
            'owner', [
                Pharmacist::class,
            ], function ($q, $type) {
                if (in_array($type, EmployeePayroll::PYAYROLLUSERS)) {
                    $q->whereHas('user', function (Builder $qr) {
                        return $qr;
                    });
                }
            })->where('owner_id', $this->pharmacist)->with('owner.user')->select('employee_payrolls.*');

        return $query;
    }
}
