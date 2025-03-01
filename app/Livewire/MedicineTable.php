<?php

namespace App\Livewire;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MedicineTable extends LivewireTableComponent
{
    protected $model = Medicine::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'medicines.add-button';

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
            ->setDefaultSort('medicines.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('selling_price') || $column->isField('buying_price')) {
                return [
                    'class' => 'pt-5',
                ];
            }
            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('buying_price')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('selling_price')) {
                return [
                    'class' => 'price-column',
                ];
            }

            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                ];
            }

            if ($column->isField('available_quantity')) {
                return [
                    'class' => 'd-flex justify-content-center',
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
            Column::make(__('messages.medicine.medicine'), 'name')
                ->view('medicines.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.brand'), 'brand.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.item.available_quantity'), 'available_quantity')
                ->view('medicines.columns.avalable_quantity')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.selling_price'), 'selling_price')
                ->view('medicines.columns.selling_price')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.buying_price'), 'buying_price')
                ->view('medicines.columns.buying_price')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('medicines.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var Medicine $query */
        return Medicine::with('category', 'brand')->select('medicines.*');
    }
}
