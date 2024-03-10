<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Roles List')]
#[Layout('layouts.admin')]
class RoleList extends Component
{
    public function render()
    {
        return view('livewire.admin.roles.role-list');
    }
}
