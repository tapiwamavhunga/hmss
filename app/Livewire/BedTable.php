<?php

namespace App\Livewire;

use App\Models\Bed;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BedTable extends LivewireTableComponent
{
    use WithPagination;

    protected $model = Bed::class;

    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'beds.component.add';

    public $FilterComponent = ['beds.filter-button', Bed::FILTER_INCOME_HEAD];

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
            ->setDefaultSort('beds.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('charge')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('is_available')) {
                return [
                    'class' => 'price-sec-column',
                ];
            }

            return [];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '3') {
                return [
                    'style' => 'text-align:right',
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
            Column::make(__('messages.bed.bed_id'), 'bed_id')
                ->view('beds.component.bed_id')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.bed_assign.bed'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.bed.bed_type'), 'bed_type')
                ->view('beds.component.bed_type')
                ->sortable()
                ->searchable(
                    // function ($query, $search) {
                    // $query->whereHas('bedType', function ($query) use ($search) {
                    //     $query->where('title', 'like', '%'.$search.'%');
                    // });}
                ),
            Column::make(__('messages.bed.charge'), 'charge')
                ->view('beds.component.bed_charge')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.bed.available'), 'is_available')
                ->view('beds.component.is_available')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')
                ->view('beds.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Bed::with('bedType')->select('beds.*');

        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('is_available', Bed::AVAILABLE);
            }
            if ($this->statusFilter == 2) {
                $q->where('is_available', Bed::NOTAVAILABLE);
            }
        });

        return $query;
    }
}
