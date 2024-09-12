<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MedicineCategoryTable extends LivewireTableComponent
{
    protected $model = Category::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $buttonComponent = 'categories.add-button';

    public $FilterComponent = ['categories.filter-button', Category::STATUS_ARR];

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
            ->setDefaultSort('categories.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                    'style' => 'padding-right:20px !important',
                ];
            }
            return [
                'class' => 'w-100',
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
        return [
            Column::make(__('messages.medicine.name'), 'name')
                ->view('categories.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.is_active'), 'is_active')
                ->view('categories.columns.is_active'),
            Column::make(__('messages.common.action'), 'id')
                ->view('categories.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Category $query */
        $query = Category::select('categories.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 2) {
            } else {
                $q->where('is_active', $this->statusFilter);
            }
        });

        return $query;
    }

    public function changeStatus($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category->is_active == Category::ACTIVE) {
            $category->is_active = Category::INACTIVE;
        } else {
            $category->is_active = Category::ACTIVE;
        }
        $category->save();

        $this->dispatchBrowserEvent('success', 'Status updated successfully.');
    }
}
