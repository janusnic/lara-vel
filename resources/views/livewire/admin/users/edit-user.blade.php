<div>
    <x-slot name="header">
        <div class="flex justify-between px-6">
            <h1 class="text-3xl text-black pb-6">Edit User</h1> 
        </div>
    </x-slot>

    <x-errors title="Ops! There are :count validation errors:" color="orange" />

    <form wire:submit="save">
        <div>
            <x-input label="Name *" hint="Insert category name" wire:model.blur="form.name" />
        </div>

        <div class="mt-4">
            <x-select.styled 
            wire:model="form.roles" 
            :options="$roles" 
            select="label:name|value:id"
            multiple />
        </div>

        <div class="mt-4">
            <x-button text="Update user" type="submit" color="blue" />
        </div>
        
    </form>
</div>
