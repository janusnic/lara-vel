<?php

namespace App\Livewire\Tables;

use App\Models\Post;
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

class PostTable extends PowerGridComponent
{

    use WithExport;

    public bool $showFilters = true;
    
    // $canClickButton = true;

    #[On('bulkDelete.{tableName}')]
    public function bulkDelete(): void
    {
        if (count($this->checkboxValues) == 0) {
            return;
        } else {
            Post::destroy($this->checkboxValues);
        // $this->js('alert(window.pgBulkActions.get(\''.$this->tableName.'\'))');

        }
        
    }

    #[On('bulkRestore.{tableName}')]
    public function bulkRestore(): void
    {
        if (count($this->checkboxValues) !== 0) {
            Post::onlyTrashed()
                ->whereIn('id', $this->checkboxValues)->restore();
        }
        return;

    }
    // protected function getListeners()
    // {
    //     return array_merge(
    //         parent::getListeners(), [
    //             'bulkDelete',
    //         ]);
    // }
    
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
        return Post::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')

           
            ->add('status')
            ->add('created_at_formatted', fn (Post $model) => Carbon::createFromTimeStamp(strtotime($model->created_at))->diffForHumans());
            // Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
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
            Filter::inputText('title')->operators(['contains']),
            Filter::inputText('status')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Post $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800')
                ->route('admin.posts.edit', ['post' => $row->id]),
            
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
