<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\UserForm;

use Illuminate\Support\Collection;
use App\Models\{User};
use Spatie\Permission\Models\Role;

#[Title('Edit User')]
class EditUser extends Component
{
    // public Array $users;
    public Array $roles;
    
    public UserForm $form;

    public function mount(User $user)
    {
        $this->form->setUser($user);

        $this->roles = Role::all('id', 'name')->toArray();
        // $this->users = User::all('id', 'name')->toArray();
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/admin/users');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }
}
