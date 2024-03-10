<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Traits\RoleOrPermission;

#[Layout('layouts.admin')]
class UsersList extends Component
{
    use RoleOrPermission;
    
    public function __construct()
    {
      $this->handlePermission('admin|manager');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.users.users-list');
    }
}
