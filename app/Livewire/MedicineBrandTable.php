<?php

namespace App\Livewire;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MedicineBrandTable extends LivewireTableComponent
{
    protected $model = Brand::class;

    public $showButtonOnHeader = true;

    public $buttonComponent = 'brands.add-button';

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
            ->setDefaultSort('brands.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                    'style' => 'padding-right:20px !important',
                ];
            }
            return [
                'class' => 'w-50',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('id')) {
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
        return [
            Column::make(__('messages.medicine.brand'), 'name')
                ->view('brands.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.email'), 'email')
                ->view('brands.columns.email')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.user.phone'), 'phone')
                ->view('brands.columns.phone')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('brands.action'),
        ];
    }

    public function builder(): Builder
    {
        return Brand::select('brands.*');
    }
}
