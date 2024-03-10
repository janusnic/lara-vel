<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\User;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required|min:5')]
    public $name = '';
    
    #[Validate('required|array')]
    public array $roles = [];
    
    public function setUser(User $user)
    {
        // dd($user);
        $this->user = $user;
        $this->name = $user->name;
        // $this->permissions = $user->role->permissions()->pluck('id')->toArray();
        $this->roles = $user->roles()->pluck('id')->toArray();
        // dd($this->permissions);
    }
 
    public function store() 
    {
        $validated = $this->validate();
        
        // dd($validated);
       
        User::create($this->all());
    }

    public function update()
    {
        $validated = $this->validate();

        // dd(array_intersect($this->role->permissions->pluck('id')->toArray(), $this->permissions));

        $this->user->update(
            $this->all()
        );
        
        // foreach($this->permissions as $permission) {
        //     if(! $this->role->hasPermissionTo($permission)){
        //         $this->role->givePermissionTo($permission);    
        //     }
        // }
        $this->user->roles()->sync($this->roles);
    }
}
