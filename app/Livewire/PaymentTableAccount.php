<?php

namespace App\Livewire;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PaymentTableAccount extends LivewireTableComponent
{
    public $showButtonOnHeader = false;

    public $showFilterOnHeader = false;

    public $accountId;

    protected $model = Payment::class;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    // public function resetPage($pageName = 'page')
    // {
    //     $rowsPropertyData = $this->getRows()->toArray();
    //     $prevPageNum = $rowsPropertyData['current_page'] - 1;
    //     $prevPageNum = $prevPageNum > 0 ? $prevPageNum : 1;
    //     $pageNum = count($rowsPropertyData['data']) > 0 ? $rowsPropertyData['current_page'] : $prevPageNum;

    //     $this->setPage($pageNum, $pageName);
    // }

    public function mount(int $accountId)
    {
        $this->accountId = $accountId;
        $this->setDefaultSort('payments.created_at', 'desc');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setQueryStringStatus(false)
            ->setThAttributes(function (Column $column) {
                if ($column->isField('amount')) {
                    return [
                        'class' => 'price-column',
                        'style' => 'padding-right:25px !important',
                    ];
                }

                return [];
            });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '4') {
                return [
                    'width' => '12%',
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
            Column::make(__('messages.account.account'), 'account_id')->hideIf(1),
            Column::make(__('messages.payment.payment_date'), 'payment_date')
                ->view('payments.columns.payment_date')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.description'), 'description')
                ->view('payments.columns.description')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.pay_to'), 'pay_to')
                ->view('payments.columns.pay_to')
                ->sortable()->searchable(),
            Column::make(__('messages.payment.amount'), 'amount')
                ->view('payments.columns.amount')
                ->sortable()->searchable(),
        ];
    }

    public function builder(): Builder
    {
        $query = Payment::with('account')->select('payments.*')->where('account_id', $this->accountId);

        return $query;
    }
}
