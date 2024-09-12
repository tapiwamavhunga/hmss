<?php

namespace App\Livewire;

use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SidebarSettingTable extends LivewireTableComponent
{
    use WithPagination;

    public $showFilterOnHeader = true;

    public $FilterComponent = ['settings.module-filter-button', Module::FILTER_STATUS_ARR];

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

    protected $model = Module::class;

    public function changeFilter($statusFilter)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $statusFilter;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('modules.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            return [
                'class' => 'w-100',
            ];
        });
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name')) {
                return [
                    'class' => 'pt-5',
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
            Column::make(__('messages.user.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make('', 'id')->view('')
                ->hideIf(1),
            Column::make(__('messages.common.status'), 'is_active')
                ->view('settings.module-template.status'),
        ];
    }

    public function builder(): Builder
    {
        $query = Module::select('modules.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if ($this->statusFilter == 1) {
                $q->where('is_active', Module::ACTIVE);
            }
            if ($this->statusFilter == 2) {
                $q->where('is_active', Module::INACTIVE);
            }
        });

        return $query;
    }
}
