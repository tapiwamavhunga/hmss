<?php

namespace App\Livewire;

use App\Models\AdvancedPayment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AdvancedPaymentTable extends LivewireTableComponent
{
    use WithPagination;

    protected $model = AdvancedPayment::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'advanced_payments.add-button';

    public $showFilterOnHeader = false;

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
            ->setDefaultSort('advanced_payments.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('amount')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('id')) {
                return [
                    'style' => 'text-align:center',
                ];
            }

            return [];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '5') {
                return [
                    'width' => '15%',
                    'style' => 'text-align:center',
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
            Column::make('Id', 'id')
                ->hideIf(1),
            Column::make(__('messages.advanced_payment.receipt_no'), 'receipt_no')
                ->view('advanced_payments.columns.receipt_no')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.advanced_payment.patient'), 'patient.patientUser.first_name')
                ->view('advanced_payments.columns.patient')
                ->searchable()
                ->sortable(),
            Column::make('last_name', 'patient.patientUser.last_name')->searchable()->hideIf(1),
            Column::make(__('messages.advanced_payment.date'), 'date')
                ->view('advanced_payments.columns.date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.advanced_payment.amount'), 'amount')
                ->view('advanced_payments.columns.advanced_payment_amount')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('advanced_payments.action'),
        ];
    }

    public function builder(): Builder
    {

        $query = AdvancedPayment::whereHas('patient.patientUser')->with('patient.patientUser')->select('advanced_payments.*');

        return $query;
    }
}
