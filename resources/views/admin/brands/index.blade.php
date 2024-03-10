<x-admin-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="px-4 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Brands management') }}
            </h2>
            <a href="{{route('admin.brands.create')}}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add new</a>
        </div>
    </x-slot>


{{-- Current UNIX-time: {{ time() }}<br> --}}
{{-- Count brands: {{count($brands)}}<br> --}}

@isset($categories)
    categories is defined and is not null...
@endisset

@isset($categories)
    @if (count($categories) === 1)
        I have one record!
    @elseif (count($categories) > 1)
        I have multiple records!
    @else
        I don't have any records!
    @endif
@endisset
{{-- @php
    dump($brands)
@endphp --}}

{{-- {!! $html !!} --}}
{{-- Comments --}}

{{--

    Block comments

    --}}

    {{-- @{{ name }} --}}

{{-- @if(count($brands) > 0)
    brands
@else
    <p>No brands yet</p>
@endif

@unless(!count($brands) > 0)
    Test text
@endunless

@empty($brands)
    <p>No brands yet</p>
@endempty

@isset($brands)
    brands
@endisset 


@foreach ($categories as $category)
    @if ($loop->first)
        This is the first iteration.
    @endif
     @if ($loop->last)
        This is the last iteration.
    @endif
    <p>This is category {{ $category->name }} with id: {{ $category->id }}</p>
@endforeach


Пропустити поточну ітерацію або завершити цикл за допомогою директив @continue і @break:
@foreach ($categories as $category)
    @if ($loop->first)
        @continue
    @endif
     <li>{{ $category->name }}</li>
    @if ($category->id == 2)
        @break
    @endif
@endforeach
Ви також можете включити умову продовження або завершення в оголошення директиви:
@foreach ($categories as $category)
    @continue($category->id == 1)
    <li>{{ $category->name }}</li>
    @break($category->id == 2)
@endforeach

властивості, за допомогою яких ви можете перевіряти парні та непарні ітерації.
@foreach ($users as $user)
	@foreach ($user->posts as $post)
    	@if ($loop->even)
        	This is an even iteration
    	@elseif ($loop->odd)
        	This is an odd iteration
    	@endif
	@endforeach
@endforeach
even перевірить, чи поточна ітерація є парною, а odd - чи є поточна ітерація непарною.



--}}
{{-- 

<div>
    @foreach ($brands as $brand)
        {{ $brand->name }} <br />
    @endforeach
</div>


@if ($brands->count())
    @foreach ($brands as $brand)
    	<tr>
        	<td>{{ $brand->name }}</td>
    	</tr>
	@endforeach
@else
	<tr><td colspan="...">No brands yet.</td></tr>
@endif

@forelse($brands as $brand)
	<tr>
    	<td>{{ $brand->name }}</td>
	</tr>
@empty
	<tr><td colspan="...">No brands yet.</td></tr>
@endforelse --}}

   

<table class="table-auto w-full border-collapse border border-slate-300">
   <thead>
      <tr class="bg-sidebar text-white">
         <th>Id</th>
         <th>Brand Name</th>
         
         <th>Created</th>
         <th>Actions</th> 
      </tr>
   </thead>

   <tbody>
      @foreach($brands as $brand)
         <tr class="odd:bg-blue-100">
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
            
            <td>{{ $brand->created_at->diffForHumans() }}</td>
            <td>
            <div class="inline-flex">
            <a type="button" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900" href="{{route('admin.brands.edit', $brand->id)}}">Edit</a>
            <form method="POST" class="inline-form" action="{{ route('admin.brands.destroy', $brand->id) }}">
            @csrf  @method('DELETE') 
            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">delete</button>
            </form>
            </div>
            </td>
         </tr>
      @endforeach
   </tbody>
</table>
   {{ $brands->links() }}

</x-admin-layout>





