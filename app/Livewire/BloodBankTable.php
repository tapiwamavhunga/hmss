<?php

namespace App\Livewire;

use App\Models\BloodBank;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BloodBankTable extends LivewireTableComponent
{
    use WithPagination;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = false;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'blood_banks.add-button';

    protected $model = BloodBank::class;

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
            ->setDefaultSort('blood_banks.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '2') {
                return [
                    'class' => 'text-center',
                    'width' => '8%',
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
            Column::make(__('messages.hospital_blood_bank.blood_group'), 'blood_group')
                ->view('blood_banks.columns.blood_group')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.hospital_blood_bank.remained_bags'), 'remained_bags')
                ->view('blood_banks.columns.remained_bags')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('blood_banks.action'),
        ];
    }

    public function builder(): Builder
    {
        return BloodBank::select('blood_banks.*');
    }
}
