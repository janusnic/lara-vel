<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\Admin\CategoryForm;
use Livewire\WithFileUploads;

#[Title('Create Category')]
class CreateCategory extends Component
{
    use WithFileUploads;

    public CategoryForm $form;
    
    public bool $success = false;
 
    public function save()
    {
        $this->form->store(); 
        $this->success = true;
 
        return $this->redirect('/admin/categories');
    }
 
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.create-category');
    }
}


