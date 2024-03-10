<div>
<x-slot name="header">
    <div class="w-full text-center px-6">
        <h1 class="text-2xl md:text-3xl font-bold text-center lg:text-5xl text-gray-700">
            Your <span class="text-yellow-500">Shoping cart</span> <span class="text-gray-900"></span>
        </h1>
        <p class="text-gray-500 text-lg mt-1">Best Shop in the universe</p>
    </div>
</x-slot>

<div class="antialiased">
  <div class="mx-4 py-4">
    
    <div class="flex justify-center py-4 my-6">
      <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
        <div class="flex-1">
          <table class="w-full text-sm lg:text-base" cellspacing="0">
            <thead>
              <tr class="h-12 uppercase">
                <th class="hidden md:table-cell"></th>
                <th class="text-left">Product</th>
                <th class="lg:text-right text-left pl-5 lg:pl-0">
                  <span class="lg:hidden" title="Quantity">Qtd</span>
                  <span class="hidden lg:inline">Quantity</span>
                </th>
                <th class="hidden text-right md:table-cell">Unit price</th>
                <th class="text-right">Total price</th>
                <th class="text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                <tr>
                    <td class="hidden pb-4 md:table-cell">
                      <a href="#">
                        <img src="{{ asset(Storage::url($item['attributes']['image'])) }}" class="w-20 rounded" alt="Thumbnail">
                      </a>
                    </td>
                    <td>
                        <a href="#">
                          <p class="mb-2 md:ml-4">{{ $item['name'] }}</p>
                        </a>
                      </td>
                      <td class="justify-center md:justify-end md:flex mt-6">
                        <div class="w-20 h-10">
                            <div class="relative flex flex-row w-full h-8">
                        <livewire:main.cart-update :item="$item" :key="$item['id']" />
                    </div>
                </div>
                      </td>
                      <td class="hidden text-right md:table-cell">
                        <span class="text-sm lg:text-base font-medium">
                          {{ number_format($item['price'], 2) }}€
                        </span>
                      </td>
                      <td class="text-right">
                        <span class="text-sm lg:text-base font-medium">
                            {{ number_format($item['price']*$item['quantity'], 2) }}€
                        </span>
                      </td>
                      <td class="text-right">
                          <button class="mr-2 mt-1 lg:mt-2" wire:click.prevent="remove('{{ $item['id'] }}')">
                            <x-main.trash-alt />
                          </button>
                      </td>
                    </tr>
                @empty
                    <h4>Not items yet</h4>
                @endforelse
            </tbody>
          </table>
          <hr class="pb-6 mt-6">
          <div class="my-4 mt-6 -mx-2 lg:flex">
            <div class="lg:px-2 lg:w-1/2">
              <div class="p-4 bg-gray-100 rounded-full">
                <h1 class="ml-2 font-bold uppercase">Instruction for seller</h1>
              </div>
              
              <div class="p-4">
                <p class="mb-4 italic">If you have some information for the seller you can leave them in the box below</p>
                <textarea class="w-full h-24 p-2 bg-gray-100 rounded"></textarea>
              </div>
            </div>
            <div class="lg:px-2 lg:w-1/2">
              <div class="p-4 bg-gray-100 rounded-full">
                <h1 class="ml-2 font-bold uppercase">Order Details</h1>
              </div>
              <div class="p-4">
                <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
                  <div class="flex justify-between border-b">
                    <div class="lg:px-4 lg:py-1 text-lg lg:text-xl font-bold text-center text-gray-800">
                      Subtotal
                    </div>
                    <div class="lg:px-4 lg:py-1 lg:text-lg font-bold text-center text-gray-900">
                      {{ \Cart::getSubTotal() }}€
                    </div>
                  </div>
                    
                    <div class="flex justify-between pt-4 border-b">
                      <div class="lg:px-4 lg:py-1 text-lg lg:text-xl font-bold text-center text-gray-800">
                        Tax
                      </div>
                      <div class="lg:px-4 lg:py-1 lg:text-lg font-bold text-center text-gray-900">
                      {{ round(\Cart::getSubTotal() * $tax, 2) }}€
                      </div>
                    </div>
                    <div class="flex justify-between pt-4 border-b">
                      <div class="lg:px-4 lg:py-1 text-lg lg:text-xl font-bold text-center text-gray-800">
                        Total
                      </div>
                      <div class="lg:px-4 lg:py-1 lg:text-lg font-bold text-center text-gray-900">
                      {{ round(\Cart::getSubTotal() *(1 + $tax), 2) }}€
                      </div>
                    </div>
                  <a href="{{ route('checkout.index') }}">
                    <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-[#6875F5] rounded-md shadow item-center hover:bg-indigo-700 focus:shadow-outline focus:outline-none">
                        <x-main.credit-card />
                      <span class="ml-2 mt-5px">Procceed to checkout</span>
                    </button>
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<x-slot name="footer"><x-main.footer /></x-slot>
</div>
