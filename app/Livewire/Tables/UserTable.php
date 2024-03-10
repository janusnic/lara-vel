<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
// use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Livewire\Attributes\On;

final class UserTable extends PowerGridComponent
{
    public string $sortField = 'users.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()
                ->showToggleColumns()
                ->showSoftDeletes()
                ->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return User::query();
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        User::query()->where('id', $id)->update([
            $field => $value,
        ]);

        $this->skipRender();
    }

    #[On('userDelete')]
    public function userDelete(): void
    {
        // dd($this->checkboxValues);
        User::destroy($this->checkboxValues);
        // $this->dispatch('openModal', 'delete-user', [
        //     'userIds' => $this->checkboxValues,
        //     'confirmationTitle' => 'Delete user',
        //     'confirmationDescription' => 'Are you sure you want to delete this user?',
        // ]);
    }

    public function header(): array
    {
        return [
            Button::add('user-delete')
                ->slot(__('User delete'))
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('userDelete', []),
        ];
    }


    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('active')
            ->addColumn('created_at_formatted', fn (User $model) => 
            Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('ID'))
                ->field('id', 'users.id')
                ->searchable()
                ->sortable(),
            
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email;', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Active', 'active')
                ->toggleable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::boolean('active'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $this->js('window.alert('.$rowId.')');
    }

    public function actions(User $row): array
    {
        return [
            Button::make('edit', '<i class="fas fa-edit"></i>') 
                ->class('inline-flex focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800')
                ->route('admin.users.edit', ['user' => $row->id])
                ->tooltip('Edit Record'),
            Button::make('delete', '<i class="fas fa-trash"></i>')
                    ->class('inline-flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900')
                    
                    ->dispatch('delete', ['rowId' => $row->id])
                    ->tooltip('Delete Record')
            
        ];
    }

    public function actionRules(): array
    {
        $user = auth()->user();
        $can_delete = $user->hasAnyRole(['admin']);

        return [
            // Hide button when user don't have delete permission
            Rule::button('delete')
            ->when(fn($can_delete) => (bool) !$can_delete)
            ->hide(),
                
            // Set red background on rows for dishes which are not free and are out-of-stock 
            // Rule::rows()
            //     ->when(function ($dish) { 
            //         return $dish->price > 0 && $dish->in_stock == false;
            //     })
            //     ->setAttribute('class', 'bg-red-200'),
        ];
    }

}
