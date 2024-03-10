<?php

namespace App\Livewire\Admin\Tags;

use App\Models\Tag;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn, ButtonGroupColumn, LinkColumn, ComponentColumn};


class TagTable extends DataTableComponent
{
    protected $model = Tag::class;
    public array $tags = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setAdditionalSelects(['tags.id as id'])
        ;
    }

    public function deleteItem($id)
    {
        $tag = Tag::find($id);
 
        $tag->delete();
    }


    public function getTableRowUrl($row): string
    {
        return route('tags.edit', $row->id);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),

            
            ButtonGroupColumn::make('Actions')
                    ->attributes(function($row) {
                        return [
                            'class' => 'space-x-2',
                        ];
                    })
                    ->buttons([
                        LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit ')
                            ->location(fn($row) => route('tags.edit', $row->id))
                            ->attributes(function($row) {
                                return [
                                    'class' => 'underline text-blue-500 hover:no-underline',
                                ];
                            }),
                        
                        LinkColumn::make('Delete')
                            ->title(fn($row) => 'Delete ')
                            ->location(fn($row) => url('#!'))
                            ->attributes(function($row) {
                                return [
                                    'class' => 'underline text-red-500 hover:no-underline',
                                    "wire:click"=>"deleteItem($row->id)"
                                ];
                            }),

                    ]),
        ];

    }
}
