{{-- resources/views/admin/brands/edit.blade.php --}}
<x-admin-layout>

    <x-slot name="header">
      <div class="flex justify-between">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Edit Brand') }}
          </h2>
          <a href="{{route('admin.brands.index')}}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">All brands</a>
      </div>
    </x-slot>

<div class="py-12">
  <div class="grid grid-cols-1 gap-6">
  @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><span class="font-medium">Danger alert!</span> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
    @method("PUT")
    @csrf
                
        <label class="block">
        <span class="text-gray-700">Brand name</span>
        <input
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            placeholder="Enter brand name" 
            name="name" value="{{ old('name', $brand->name) }}" class="@error('name') is-invalid @enderror }}"
        />
        @error('name')
	    	 <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">{{ $message }}</div>
	    @enderror
        </label>
        
        <label class="block">
        <span class="text-gray-700">Brand details</span>
        <textarea
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('description') is-invalid @enderror"
            rows="3"
            name="description"
        >{{old('description', $brand->description)}}</textarea>
        @error('description')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">{{ $message }}</div>
        @enderror
        </label>
        <div class="block">
        <div class="mt-2">
            <div>
            
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>

            </div>
        </div>
        </div>
    </form>
  </div>
</div>

</x-admin-layout>