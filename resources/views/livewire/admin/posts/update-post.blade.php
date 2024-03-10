<div>
    <x-slot name="header">
        <div class="flex justify-between px-6">
            <h1 class="text-3xl text-black pb-6">Edit Post</h1> 
            <div class="flex">
                
            </div>
        </div>
    </x-slot>

    @php
    $config1 = ['altFormat' => 'm/d/Y'];

    @endphp

    <x-errors title="Ops! There are :count validation errors:" color="orange" />

    <form method="POST" wire:submit="save">
        <div>
            <x-input label="Title *" hint="Insert post title" wire:model.blur="form.title" />
        </div>
        
        <div class="mt-4">
            <x-textarea label="Content *" wire:model.blur="form.content" />
        </div>
        
        <div class="mt-4">
            <h4>Post status</h4>
            <div class="inline-flex space-x-4">
                @foreach($postStatus as $key => $value)
                    <x-radio label="{{$key}}" value="{{$value}}" wire:model="form.status" />
                @endforeach
            </div>
        </div>

        <div class="mt-4">
        <x-mary-datetime label="Published date: {{$form->is_published}}" wire:model="form.is_published" icon="o-calendar" />
            {{-- <x-input label="Published date: {{$form->is_published}}" hint="Enter a date and time for your party booking" type="date" wire:model="form.is_published" /> --}}
        </div>

        <div class="mt-4">
            <x-select.styled 
            wire:model="form.tags" 
            :options="$tags" 
            select="label:name|value:id"
            multiple />
        </div>

        <div class="mt-4">

            <x-select.native label="Select One User"
                 hint="You can choose whoever you want"
                 wire:model="form.user_id"
                 :options="$users"  
                 select="label:name|value:id"
                />
        </div>

        <div class="flex items-center justify-center w-full mt-4">
            
            <label for="dropzone-file" class="flex items-center justify-between w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            
                <div class="flex-col flex-1 items-center pt-5 pb-6">
                <span class="inline-flex items-baseline">
                    @if ($form->oldCover)
                        <img src="{{ asset(Storage::url($form->oldCover)) }}" class="object-cover h-64">
                    @endif
                    {{----}} 
                    @if ($form->cover)
                    <img src="{{ $form->cover->temporaryUrl() }}" class="object-cover h-64 overflow-hidden"> 
                    @endif
                </span>     
                </div>
                <div class="flex-col flex-1 items-center  pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
            
                <input id="dropzone-file" type="file" class="hidden"   wire:model="form.cover" />
            </label>

        </div>


        <div class="mt-4">
            <x-button text="Update Post" type="submit" color="blue" />
        </div>
        
    </form>
</div>