<?php

namespace App\Http\Livewire\Admin\Menu;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\MenuLevel;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class MenuLevelTable extends DataTableComponent
{
    protected $model = MenuLevel::class;



    public string $tableName = 'level-menus';

    public $columnSearch = [
        'names' => null,
    ];




    public function configure(): void
    {
        $this->setPrimaryKey('id')
             ->setPerPageAccepted([10, 25, 50, 100])
           ->setPerPage(10)
            ->setSortingStatus(true)
            ->setSortingPillsStatus(false)
            ->setPageName('menu-levels')
            ->setPaginationVisibilityStatus(true)
            ->setPaginationStatus(true)
            ->setDefaultSort('id', 'desc')
            ->setQueryStringStatus(false)
        -> setUseHeaderAsFooterEnabled();
    }




    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable(),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make('Edit')
                ->label(
                    fn($row, Column $column) => 'Edit'
                ),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')
                ->location(fn($row) => route('admin.menu', $row)),
            Column::make('Name')
                ->format(
                    fn($value, $row, Column $column) => '<svg wire:click.prevent="$emit(`editMenuLevel`,'.$row.')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer w-5 h-5">
                                                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>'
                )
                ->html(),

        ];
    }
}
