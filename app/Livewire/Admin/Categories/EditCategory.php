<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\Admin\CategoryForm;
use Livewire\WithFileUploads;
use App\Models\Category;

#[Title('Edit Category')]
class EditCategory extends Component
{
    use WithFileUploads;

    public CategoryForm $form;

    public function mount(Category $category)
    {
        $this->form->setCategory($category);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/admin/categories');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.edit-category');
    }
}
