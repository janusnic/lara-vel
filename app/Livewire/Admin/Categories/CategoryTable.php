<?php

namespace App\Livewire\Admin\Categories;

// use Livewire\Component;
use App\Livewire\Table;
use App\Models\Category;
use App\Livewire\Column;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable extends Table
{
    public string $searchQuery = '';
    
    public function query() : Builder
    {
        return Category::query()
        ->when($this->searchQuery !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->searchQuery .'%'));
    }

    public function updating($key): void
    {
        if ($key === 'searchQuery') {
            $this->resetPage();
        }
    }

    public function columns() : array
    {
        return [
            Column::make('name', 'Name'),
            Column::make('status', 'Status')->component('columns.status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff'),
            
        ];
    }

    public $route_edit = 'categories.edit';
    

    public function deleteItem($id)
    {
        $category = Category::find($id);
 
        $category->delete();
    }

    public function forceDeleteItem(int $id){
        $product = Product::find($id);
 
        $product->forceDelete();
    }

    public function restoreItem(int $id){
        $product = Product::withTrashed()->where('id', $id)->restore();
    }
    
}
