<div>
<x-slot name="header">
    <div class="w-full text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
            Welcome to <span class="text-yellow-500">Shopaholic</span> <span class="text-gray-900"> News</span>
        </h1>
        <p class="text-gray-500 text-lg mt-1">Best Blog in the universe</p>
        
    </div>
</x-slot>

    
<div class="mb-10">
    <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">Latest Posts</h2>
    <div class="w-full mb-5">
        <div class="grid grid-cols-3 gap-10 gap-y-32 w-full">
            @foreach ($latestPosts as $post)
                <x-main.posts.post-card :post="$post" class="col-span-3 md:col-span-1" />
            @endforeach
        </div>
    </div>
        
    <a class="px-3 py-2 text-lg text-white bg-gray-800 rounded mt-5 inline-block" href="/blog">More Posts</a>
</div>

    <x-slot name="footer">
        <x-main.footer />
    </x-slot>
</div>
