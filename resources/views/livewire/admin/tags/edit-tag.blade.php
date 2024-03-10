<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Edit Tag</h1> 
        </div>
    </x-slot>

    <x-errors title="Ops! There are :count validation errors:" color="orange" />

    <form wire:submit="save">
        <div>
            <x-input label="Name *" hint="Insert category name" wire:model.blur="form.name" />
        </div>
         
        <div class="mt-4">
            <x-color label="Text Color"
         hint="Select your favorite color or insert a hexadecimal value." wire:model.blur="form.text_color" />
           
        </div>

        <div class="mt-4">
            <x-color label="Background Color" :colors="['#1e40af', '#ef4444', '#991b1b', '#a8f312', '#fdad41', '#a230a3', '#6b21a8', '#166534', '#3f6212']"
         hint="Select your favorite color or insert a hexadecimal value." wire:model.blur="form.bg_color" />
           
        </div>
        

        <div class="mt-4">
            <x-button text="Update tag" type="submit" color="blue" />
        </div>
        
    </form>
</div>

