<?php

namespace App\Livewire;

use App\Models\Insurance;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InsuranceTable extends LivewireTableComponent
{
    public $showButtonOnHeader = true;

    public $showFilterOnHeader = true;

    public $paginationIsEnabled = true;

    public $buttonComponent = 'insurances.add-button';

    protected $model = Insurance::class;

    public $FilterComponent = ['insurances.filter-button', Insurance::FILTER_STATUS_ARRAY];

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
            ->setDefaultSort('insurances.created_at', 'desc')
            ->setQueryStringStatus(false)
            ->setSortingPillsStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('service_tax')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('hospital_rate')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('total')) {
                return [
                    'class' => 'price-column',
                ];
            }
            if ($column->isField('status')) {
                return [
                    'class' => 'text-center',
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
            Column::make(__('messages.insurance.insurance'), 'name')
                ->view('insurances.columns.name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.insurance.insurance_no'), 'insurance_no')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.insurance.insurance_code'), 'insurance_code')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.insurance.service_tax'), 'service_tax')
                ->view('insurances.columns.service_tax')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.insurance.hospital_rate'), 'hospital_rate')
                ->view('insurances.columns.hospital_rate')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.total'), 'total')
                ->view('insurances.columns.total')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->view('insurances.columns.status'),
            Column::make(__('messages.common.action'), 'id')
                ->view('insurances.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Insurance::select('insurances.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('status', Insurance::ACTIVE);
            }
            if ($this->statusFilter == 2) {
                $q->where('status', Insurance::INACTIVE);
            }
        });

        return $query;
    }
}
