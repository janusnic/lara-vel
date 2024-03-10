<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Livewire\Attributes\On;

final class ProductTable extends PowerGridComponent
{
    use WithExport;
    
    // $canClickButton = true;

    #[On('bulkDelete.{tableName}')]
    public function bulkDelete(): void
    {
        if (count($this->checkboxValues) == 0) {
            return;
        } else {
            Product::destroy($this->checkboxValues);
        // $this->js('alert(window.pgBulkActions.get(\''.$this->tableName.'\'))');

        }
        
    }

    #[On('bulkRestore.{tableName}')]
    public function bulkRestore(): void
    {
        if (count($this->checkboxValues) !== 0) {
            Product::onlyTrashed()
                ->whereIn('id', $this->checkboxValues)->restore();
        }
        return;

    }
    
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
            ->showSoftDeletes()
            ->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Product::query()->with('category');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')

            ->add('category', fn (Product $product) => $product->category->name)

            ->add('price')
            ->add('created_at_formatted', fn (Product $model) => Carbon::createFromTimeStamp(strtotime($model->created_at))->diffForHumans());
            // Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Category', 'category', 'category_id')
                ->sortable()
                ->searchable(),

            Column::make('Price', 'price')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('price')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $this->js('window.alert('.$rowId.')');
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('inline-flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800')
                ->route('admin.products.edit', ['product' => $row->id]),
            Button::add('delete')
                ->slot('Delete')
                ->class('inline-flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900')
                ->dispatch('delete', ['rowId' => $row->id]),
            
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */

    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot(__('Bulk delete (<span x-text="window.pgBulkActions.count(\''.$this->tableName.'\')"></span>)'))
                ->class('focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900')
                ->dispatch('bulkDelete.'.$this->tableName, []),
            Button::add('bulk-restore')
                ->slot(__('Bulk restore (<span x-text="window.pgBulkActions.count(\''.$this->tableName.'\')"></span>)'))
                ->class('focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900')
                ->dispatch('bulkRestore.'.$this->tableName, []),    
        ];
    }
}
