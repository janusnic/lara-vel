<?php

namespace App\Livewire\Admin\Products;

// use Livewire\Component;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn, ButtonGroupColumn, LinkColumn, ComponentColumn, ImageColumn};
// use Rappasoft\LaravelLivewireTables\Views\Link;

use Rappasoft\LaravelLivewireTables\Views\Filters\{DateFilter, MultiSelectFilter, SelectFilter};

class ProductsTable extends DataTableComponent
{
    protected $model = Product::class;

    public array $products = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['products.id as id']
            ->setReorderEnabled()
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setFilterLayoutSlideDown()
            ->setRememberColumnSelectionDisabled()
            ->setSecondaryHeaderTrAttributes(function($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function(Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }
                return ['default' => true];
            })
            ->setFooterTrAttributes(function($rows) {
                return ['class' => 'bg-gray-100'];

            })
            ->setFooterTdAttributes(function(Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }
                return ['default' => true];
            })
            ->setUseHeaderAsFooterEnabled()
            ->setHideBulkActionsWhenEmptyEnabled());
        // ->setBulkActionsEnabled(['exportSelected' => 'Export',])
        // ->setBulkActionsEnabled()
        // ->setSelectAllEnabled()
        // ->setBulkActionsStatus(true)
        // ->setBulkActionsTdCheckboxAttributes([
        //     'class' => 'bg-green-500',
        //     'default' => false    
        // ])
        // );
    }

    // public function bulkActions(): array
    // {
    //     return [
    //         'exportSelected' => 'Export',
    //     ];
    // }

    public function deleteItem($id)
    {
        // dd($id);
        $product = Product::find($id);
        $product->delete();
    }

    public function getTableRowUrl($row): string
    {
        return route('admin.products.edit', $row->id);
    }


    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name')
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
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('admin.products.edit', $row->id))
                        ->attributes(function($row) {
                            return [
                                'class' => 'text-green-500 hover:text-green-300 px-1 py-0.5'
                            ];
                        }),
                        LinkColumn::make('Delete')
                        // ->hideIf(! auth()->user()->isAdmin())
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

    public function builder(): Builder
    {
        return Product::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('products.name', 'like', '%' . $name . '%'))

            ->when($this->columnSearch['price'] ?? null, fn ($query, $price) => $query->where('products.price', 'like', '%' . $price . '%'));

    }
 

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
        ];

    }

 

    public function activate()
    {
        Product::whereIn('id', $this->getSelected())->update(['active' => true]);
        $this->clearSelected();
    }

    public function deactivate()
    {
        Product::whereIn('id', $this->getSelected())->update(['active' => false]);
        $this->clearSelected();
    }

 

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Product::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }
}
