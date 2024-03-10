<div>
{{-- resources/views/livewire/main/blog-page.blade.php --}}
<x-slot name="header">
    <div class="w-full text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
            Welcome to <span class="text-yellow-500">Blog</span> <span class="text-gray-900"> News</span>
        </h1>
        <p class="text-gray-500 text-lg mt-1">Best Blog in the universe</p>
        
    </div>
</x-slot>

<div class="px-3 py-6 lg:px-7">
    <div class="flex items-center justify-between border-b border-gray-100">
        <div class="text-gray-600">
            @if ($this->activeTag || $search)
                <button class="mr-3 text-xs gray-500" wire:click="clearFilters()">X</button>
            @endif
            @if ($this->activeTag)
                <x-main.posts.badge wire:navigate href="{{ route('posts.index', ['tag' => $this->activeTag->slug]) }}"
                    :textColor="$this->activeTag->text_color" :bgColor="$this->activeTag->bg_color">
                    {{ $this->activeTag->name }}
                </x-main.posts.badge>
            @endif
            @if ($search)
                <span class="ml-2">
                    Blog containing : <strong>{{ $search }}</strong>
                </span>
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <x-checkbox wire:model.live="popular" />
            <x-label> Popular </x-label>
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                wire:click="setSort('desc')"> Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4 "
                wire:click="setSort('asc')"> Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-main.posts.post-item wire:key="{{ $post->id }}" :post="$post" />
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>

    <x-slot name="footer">
        <x-main.footer />
    </x-slot>
</div>
