<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{
    public ?Role $role;

    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|array')]
    public array $permissions = [];
    
    // public array $allPermissions = [];
    
    public function setRole(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->permissions = $role->permissions()->pluck('id')->toArray();
        // dd($this->permissions);
    }
 
    public function store() 
    {
        $validated = $this->validate();
        
        // dd($validated);
       
        Role::create($this->all());
    }

    public function update()
    {
        $validated = $this->validate();

        // dd(array_intersect($this->role->permissions->pluck('id')->toArray(), $this->permissions));

        $this->role->update(
            $this->all()
        );
        
        // foreach($this->permissions as $permission) {
        //     if(! $this->role->hasPermissionTo($permission)){
        //         $this->role->givePermissionTo($permission);    
        //     }
        // }
        $this->role->permissions()->sync($this->permissions);
    }
}
