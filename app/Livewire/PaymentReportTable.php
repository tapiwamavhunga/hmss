<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PaymentReportTable extends LivewireTableComponent
{
    use WithPagination;

    protected $model = Payment::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'payment_reports.add-button';

    public $FilterComponent = ['payment_reports.filter-button', Account::ACCOUNT_TYPES];

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

    public function changeFilter($statusFilter)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $statusFilter;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('payments.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('amount')) {
                return [
                    'class' => 'price-column',
                    'style' => 'padding-right:25px !important',
                ];
            }
            if ($column->isField('type')) {
                return [
                    'class' => 'price-sec-column',
                ];
            }

            return [];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '4') {
                return [
                    'width' => '20%',
                ];
            }
            if ($columnIndex == '5') {
                return [
                    'width' => '15%',
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
            Column::make(__('messages.payment.payment_date'), 'payment_date')
                ->view('payment_reports.columns.payment_date')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.account'), 'account.name')
                ->view('payment_reports.columns.account')
                ->sortable()->searchable(),
            Column::make(__('messages.account.account'), 'account_id')->hideIf(1),
            Column::make(__('messages.payment.pay_to'), 'pay_to')
                ->view('payment_reports.columns.pay_to')
                ->sortable()->searchable(),
            Column::make(__('messages.account.type'), 'accounts.type')
                ->view('payment_reports.columns.type')
                ->sortable(),
            Column::make(__('messages.payment.amount'), 'amount')
                ->view('payment_reports.columns.amount')
                ->sortable()->searchable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Payment::with('accounts')->select('payments.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            $q->whereHas('accounts', function (Builder $query) {
                if ($this->statusFilter == 1) {
                    $query->where('type', Account::DEBIT);
                }
                if ($this->statusFilter == 2) {
                    $query->where('type', Account::CREDIT);
                }
                if ($this->statusFilter == 0) {
                }
            });
        });

        return $query;
    }
}
