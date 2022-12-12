<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersDatatable extends DataTableComponent
{
    protected $model = User::class;


    public string $tableName = 'Users';

    public $columnSearch = [
        'names' => null,
    ];


    public function configure(): void
    {
        $this->setPrimaryKey('id')
//            ->setPerPageAccepted([10, 25, 50, 100])
//            ->setPerPage(10)
//            ->setSortingStatus(true)
//            ->setSortingPillsStatus(false)
////            ->setPageName('Users')
//            ->setPaginationVisibilityStatus(true)
//            ->setPaginationStatus(true)
//            ->setDefaultSort('id', 'desc')
//            ->setQueryStringStatus(false)
            ->setThAttributes(function (Column $column) {
                if ($column->isField('id')) {
                    return [
                        'class' => '!w-[5%]',
                    ];
                } elseif ($column->isField('name')) {
                    return [
                        'class' => '!w-[20%] text-center',
                    ];
                } elseif ($column->isField('email')) {
                    return [
                        'class' => '!w-[20%] !text-center',
                    ];
                } elseif ($column->isField('email_verified_at')) {
                    return [
                        'class' => '!w-[15%] text-center',
                    ];
                }
                elseif ($column->isField('created_at')) {
                    return [
                        'class' => '!w-[15%]',
                    ];
                } elseif ($column->isField('updated_at')) {
                    return [
                        'class' => '!w-[15%]',
                    ];
                } elseif ($column->getTitle() === 'Action') {
                    return [
                        'class' => '!w-[5%] text-center',
                    ];
                }

                return [];
            })
            ->setThSortButtonAttributes(function (Column $column) {
                if ($column->isField('email_verified_at') || $column->isField('created_at') || $column->isField('updated_at') ) {
                    return [
                        'class' => 'mx-auto',
                    ];
                }
                return [];
            })
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
//                if($columnIndex === 3 ){
//                    if($row->email_verified_at !== null){
//                        return [
//                            'class' => '!bg-green-800',
//                        ];
//                    }
//
//                }
                if ($columnIndex === 3 || $columnIndex === 4 || $columnIndex === 5) {
                    return [
                        'class' => 'text-center',
                    ];
                }


                return [];
            })
            ->setUseHeaderAsFooterEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0')
                ->html(),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable()
                ->format( fn($value, $row, Column $column) => '<div class="flex flex-row justify-start items-center"> <img src="' . $row->profile_photo_url . '" alt="' . $row->name . '" class="flex rounded-full h-8 w-8 object-cover mr-2"><span class="flex">' . $row->name . '</span> </div>'
                )->html(),
            Column::make("Email", "email")
                ->searchable()
                ->sortable(),

//            Column::make('Verified', 'email_verified_at')
//                ->searchable()
//                ->sortable()
//                ->hideIf(request() === null)
//                ->format( fn($value, $row, Column $column) => '
//
//                <div class="inline-flex flex-row justify-start items-center text-xs py-1 px-3  pr-4  pl-3 bg-green-800 rounded-2xl gray-100 ">
//                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex mr-2 w-6 h-6">
//                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
//                    </svg>
//                    <span class="flex">Verified</span>
//                </div>
//
//                '
//                )->html(),

            Column::make('Verified', 'email_verified_at')
                ->searchable()
                ->sortable()
//                ->hideIf($row->email_verified_at === null)
                ->format( fn($value, $row, Column $column) =>($row->email_verified_at ===null) ? '

                <div class="inline-flex flex-row justify-start items-center text-xs py-1 px-2  pr-3  pl-2 bg-red-800 rounded-2xl gray-100 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex mr-2 w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="flex">Not Verified</span>
                </div>
                ' :
                    '

                <div class="inline-flex flex-row justify-start items-center text-xs py-1 px-2  pr-3  pl-2 bg-green-800 rounded-2xl gray-100 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex mr-2 w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="flex">Verified</span>
                </div>
                '
                )->html(),

            Column::make("Created at", "created_at")
                ->format(fn($value, $row, Column $column) => $row->created_at->diffForHumans())
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->format(fn($value, $row, Column $column) => $row->created_at->diffForHumans())
                ->sortable(),

            Column::make('Action', 'ID')
                ->format(  fn($value, $row, Column $column) => '<div class="flex flex-row space-x-2"><span class="flex w-full"><svg  wire:click.prevent="$emit(`show`,[`update`,' . $row . '])" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer mx-auto w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg></span>
                                                        <span class="flex w-full"><svg  wire:click.prevent="$emit(`show`,[`delete`,' . $row . '])" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer mx-auto text-red-500 w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg></span>
                                                        </div>
                                                        '
                )->html(),

        ];
    }

}
