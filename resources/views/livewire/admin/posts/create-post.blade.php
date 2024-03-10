<div>

  <x-slot name="header">
        <div class="flex justify-between px-6">
            <h2 class="px-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Post') }}
            </h2>
            <a href="{{route('admin.posts.index')}}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">All posts</a>
        </div>
  </x-slot>

  <div class="flex flex-col min-w-0 flex-1 overflow-hidden">

    <form method="POST" wire:submit="save">
      <div>
          <x-admin.form.input hint="Write post title here..." wire:model.blur="form.title" />
          <div>@error('form.title') {{ $message }} @enderror</div>
      </div>
      <div class="mt-4">
          <x-admin.form.textarea hint="Write post content here..." wire:model.blur="form.content" />
          <div>@error('form.content') {{ $message }} @enderror</div>
      </div>
      <div class="mt-4">
            <x-input label="Published date" hint="Enter a date and time" type="date" wire:model="form.is_published" />
        </div>
      <div class="mt-4">

            <x-select.native label="Select One User"
                 hint="You can choose whoever you want"
                 wire:model="form.user_id"
                 :options="$users"  
                 select="label:name|value:id"
                />
        </div>
        
      <div class="mt-4">
            <h4>Post status</h4>
            <div class="inline-flex space-x-4">
                @foreach($postStatus as $key => $value)
                    <x-admin.form.radio 
                    :label="$key" 
                    :value="$value" 
                    wire:model="form.status">
                    </x-admin.form.radio>
                @endforeach
            </div>
      </div>

      <div class="mt-4">
            <x-select.styled 
            wire:model="form.tags" 
            :options="$tags" 
            select="label:name|value:id"
            multiple />
      </div>
       
      <div class="flex items-center justify-center w-full mt-4">
            
        <label for="dropzone-file" class="flex items-center justify-between w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            
          <div class="flex-col flex-1 items-center pt-5 pb-6">
            @if ($form->cover)
              <img src="{{ $form->cover->temporaryUrl() }}" class="object-cover h-48 w-96">
            @endif        
          </div>
          <div class="flex-col flex-1 items-center  pt-5 pb-6">
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
          </div>
            
          <input id="dropzone-file" type="file" class="hidden"  wire:model="form.cover" />
        </label>

      </div>


      <div class="mt-4">
          <x-button>Create New</x-button>
      </div>
        
    </form>
  </div>


   {{-- <form wire:submit="save">
    <input type="text" wire:model="title">
    <div>@error('title') {{ $message }} @enderror</div>
 
    <textarea wire:model="content"></textarea>
    <div>@error('content') {{ $message }} @enderror</div>
 
    <button type="submit">Save</button>
  </form> 


  	<input type="text" wire:model="form.title">
	<div>@error('form.title') {{ $message }} @enderror</div>
 
	<textarea wire:model="form.content"></textarea>
	<div>@error('form.content') {{ $message }} @enderror</div>
 
	<button type="submit">Save</button>
</form>
--}}


</div>



