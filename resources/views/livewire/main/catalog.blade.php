<div>
<x-slot name="header">
    <div class="w-full text-center">
        <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
            Welcome to <span class="text-yellow-500">Shop</span> <span class="text-gray-900"></span>
        </h1>
        <p class="text-gray-500 text-lg mt-1">Best Shop in the universe</p>
    </div>
</x-slot>

<main class="container mx-auto px-5 flex flex-grow">
  <div class="mb-10">
    <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">Catalog</h2>
    <div class="w-full mb-5">
      <div class="grid grid-cols-3 gap-10 gap-y-32 w-full">
        @forelse ($products as $product)
            <div class="md:col-span-1 col-span-3">
                <div class="relative w-full mb-3 h-62 lg:mb-0">
                    <div class="absolute top-0 right-0 flex flex-col p-3">
                        <span class="text-red-800 cursor-pointer hover:text-red-500"><x-main.like /></span>
                    </div>
                    <div class="absolute top-0 left-0 flex flex-col p-3">
                        <span class="text-red-800 cursor-pointer hover:text-red-500"><x-main.badge :status="$product->status" /></span>
                    </div>
                    <img src="{{ asset(Storage::url($product->cover)) }}" alt="{{ $product->name }}" class="object-cover h-48 w-96 rounded">
                </div>
                <div class="flex-auto p-2 justify-evenly">
                  <div class="flex flex-wrap ">
                    <div class="flex items-center justify-between w-full min-w-0 ">
                        <a href="#">
                        <h2 class="mr-auto text-lg cursor-pointer hover:text-gray-900 font-semibold">{{ \Illuminate\Support\Str::limit($product->name, 17, $end='...') }}
                        </h2>
                        </a>
                        <div class="mt-1 text-xl font-semibold">${{ $product->price }}</div>
                  </div>
                </div>

                <div class="mt-4">
                    @if (\Cart::getContent()->where('id', $product->id)->count())
                        <a href="{{ route('shopping.cart') }}">
                        <button class="inline-flex items-center px-4 py-2 bg-red-700 hover:bg-blue-900 rounded-md">
                            <x-main.in-cart />
                            <span class="text-white">In Cart</span>
                            </button>
                        </a>
                    @else
                        <button wire:click="addToCart({{ $product->id }})" class="inline-flex items-center px-4 py-2 bg-[#6875F5] hover:bg-blue-900 rounded-md">
                            <x-main.add-to-cart />
                            <span class="text-white">Add to Cart</span>
                        </button>
                    @endif

                </div>

                </div>
            </div>
        @empty
            <h4 class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">No products yet.</h4>
        @endforelse

        @if ($this->paginator->hasMorePages())
            <div x-intersect="$wire.loadMore" class="h-12 -translate-y-44"></div>
        @endif

        @if ($this->paginator->hasMorePages())
            <button wire:click="loadMore">Load more</button>
        @endif
      </div>
    </div>
  </div>
</main>

<x-slot name="footer"><x-main.footer /></x-slot>

</div>
