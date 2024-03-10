<?php

namespace App\Livewire\Admin\Tags;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\Admin\TagForm;
use Illuminate\Support\Collection;
use App\Models\{Tag};

#[Title('Edit Tag')]
#[Layout('layouts.admin')]
class EditTag extends Component
{
    public TagForm $form;

    public function mount(Tag $tag)
    {
        $this->form->setTag($tag);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/admin/tags');
    }

    public function render()
    {
        return view('livewire.admin.tags.edit-tag');
    }
}
