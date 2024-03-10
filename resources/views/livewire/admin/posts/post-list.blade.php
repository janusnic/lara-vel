<div>
     <x-slot name="header">
        <div class="flex justify-between px-6">
            <h2 class="px-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts management') }}
            </h2>
            <a href="{{route('admin.posts.create')}}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add new</a>
        </div>
    </x-slot>

        @livewire('tables.post-table')
    </div>

</div>
