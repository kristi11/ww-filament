<div class="bg-gray-50">
    <livewire:guest-links/>
    @guest
        <livewire:shop-guest-nav/>
    @endguest
    @auth
        <livewire:shop-auth-nav/>
    @endauth
    <div class="sm:flex sm:justify-center sm:w-full sm:px-4">
            @guest
                <div class="bg-white sm:shadow-lg sm:rounded-lg p-6 col-span-full flex justify-center items-center text-center my-20">
                    <p>Please  <button class="cursor-pointer whitespace-nowrap rounded-md bg-sky-500 px-4 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-sky-500 dark:text-white dark:focus-visible:outline-sky-500 my-2 underline" wire:click="customerRegistration">Register</button> or <button class="underline" wire:click="customerLogin">Login</button> to continue</p>
                </div>
            @endguest
            @auth()
                <div class="sm:grid sm:grid-cols-4 gap-4">
                    <div class="sm:col-span-3">
                        <div class="bg-white text-black sm:border-2 grid grid-cols-4 my-16 p-4 place-items-center sm:rounded-lg items-center">
                            @if(count($this->items) > 0)
                                @foreach($this->items as $item)
                                    <div class="col-span-1 p-3">
                                        {{$item->product->name}}
                                        <div class="w-full flex">
                                            <p
                                                class="flex text-gray-800 text-xs pr-0.5">
                                                {{$item->variant->size}}
                                            </p>
                                            <p
                                                class="flex text-gray-800 text-xs pl-0.5">
                                                {{$item->variant->color}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-span-1 p-3">
                                        <div class="flex">
                                            <button wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)
                                            class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                                    <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                            <div class="px-4">
                                                {{ $item->quantity }}
                                            </div>
                                            <button wire:click="increment({{ $item->id }})"  class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                                    <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-span-1 p-3">
                                        <h4 class="text-base font-bold text-gray-800">{{$item->subtotal}}</h4>
                                    </div>
                                    <div class="col-span-1 p-3">
                                        <button wire:click="delete({{$item->id}})" title="Delete item" class="items-center text-xs text-gray-600 hover:text-red-600">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach
                                @else
                                <div class="col-span-4 items-center place-items-center">
                                    <div class="col-span-full py-1">Cart is empty</div>
                                    <div class="col-span-full">
                                        <button wire:click="shop" class="cursor-pointer whitespace-nowrap rounded-md bg-sky-500 px-4 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-sky-500 dark:text-white dark:focus-visible:outline-sky-500 w-full my-2" wire:click="checkout">Go to shop</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="bg-white  sm:border-2 my-16 p-4 place-items-center sm:rounded-lg items-center">
                            <div class="sm:col-span-1 text-center w-full">
                                <h4 class="items-center sm:col-span-1 text-center w-full text-base font-bold">
                                    {{__('Total ')}}{{ $this->cart->total }}
                                </h4>
                            </div>
                            <div class="border-b-4 my-4 w-full"></div>
                            <div class="w-full">
                            @if(count($this->items) > 0)
                                <button class="cursor-pointer whitespace-nowrap rounded-md bg-sky-500 px-4 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-sky-500 dark:text-white dark:focus-visible:outline-sky-500 w-full my-2" wire:click="checkout">Check out</button>
                                <!-- secondary Outline Button -->
                                <button wire:click="shop" class="cursor-pointer bg-transparent rounded-md border border-neutral-800 px-4 py-2 text-sm font-medium tracking-wide text-neutral-800 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-neutral-300 dark:text-neutral-300 dark:focus-visible:outline-neutral-300 w-full my-2">Continue shopping</button>
                            @endif
                            </div>

                        </div>

                    </div>
                </div>

{{--                    <div class="font-sans mx-auto bg-white py-4">--}}

{{--                        <div class="grid md:grid-cols-3 gap-4">--}}
{{--                            <div class="md:col-span-2 bg-gray-100 p-4 rounded-md">--}}
{{--                                <h2 class="text-2xl font-bold text-gray-800">Cart</h2>--}}
{{--                                <hr class="border-gray-300 mt-4 mb-8" />--}}
{{--                                @if(count($this->items) > 0)--}}
{{--                                    @foreach($this->items as $item)--}}
{{--                                <div class="my-4">--}}
{{--                                    <div class="grid grid-cols-3 items-center gap-4">--}}
{{--                                        <div class="col-span-2 flex items-center gap-4">--}}
{{--                                            <div class="w-24 shrink-0 rounded-md">--}}
{{--                                                @if($item->product->image)--}}
{{--                                                    <img alt="Product image" src="{{ Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($product->image[0]) }}" class="w-full h-full object-contain rounded-md"/>--}}
{{--                                                @else--}}
{{--                                                    <img alt="Product image" src="https://placehold.co/600x400?text=No+product+image" class="w-full h-full object-contain rounded-md"/>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                            <div>--}}
{{--                                                <h3 class="text-base font-bold text-gray-800">{{$item->product->name}}</h3>--}}
{{--                                                <button wire:click="delete({{$item->id}})" class="text-xs text-red-600">Remove</button>--}}

{{--                                                <div class="flex gap-4 mt-4">--}}
{{--                                                    <div class="relative group">--}}
{{--                                                        <button type="button"--}}
{{--                                                                class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">--}}
{{--                                                            {{$item->variant->size}}--}}
{{--                                                        </button>--}}

{{--                                                        --}}{{--                                                        <ul class='group-hover:block hidden absolute rounded-md min-w-[80px] shadow-lg bg-white z-[1000]'>--}}
{{--                                                        --}}{{--                                                            <li class='py-2 px-4 hover:bg-gray-100 text-gray-800 text-xs cursor-pointer'>SM</li>--}}
{{--                                                        --}}{{--                                                            <li class='py-2 px-4 hover:bg-gray-100 text-gray-800 text-xs cursor-pointer'>MD</li>--}}
{{--                                                        --}}{{--                                                            <li class='py-2 px-4 hover:bg-gray-100 text-gray-800 text-xs cursor-pointer'>XL</li>--}}
{{--                                                        --}}{{--                                                            <li class='py-2 px-4 hover:bg-gray-100 text-gray-800 text-xs cursor-pointer'>XXL</li>--}}
{{--                                                        --}}{{--                                                        </ul>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="relative group">--}}
{{--                                                        <button type="button"--}}
{{--                                                                class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">--}}
{{--                                                            {{$item->variant->color}}--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}

{{--                                                    <div>--}}
{{--                                                        <div class="flex">--}}
{{--                                                        <button wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)--}}
{{--                                                                class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">--}}
{{--                                                                <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                            <div class="px-4">--}}
{{--                                                                {{ $item->quantity }}--}}
{{--                                                            </div>--}}
{{--                                                            <button wire:click="increment({{ $item->id }})"  class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">--}}
{{--                                                                <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>--}}
{{--                                                            </svg>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}

{{--                                                        <button >--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}

{{--                                                        <button >--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />--}}
{{--                                                            </svg>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="ml-auto">--}}
{{--                                            <h4 class="text-base font-bold text-gray-800">{{$item->subtotal}}</h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </div>--}}


{{--                            <div class="bg-gray-100 rounded-md p-4 md:sticky top-0">--}}

{{--                                <ul class="text-gray-800 mt-8 space-y-4">--}}
{{--                                    <li class="flex flex-wrap gap-4 text-base font-bold">Total <span class="ml-auto">{{ $this->cart->total }}</span></li>--}}
{{--                                </ul>--}}

{{--                                <div class="mt-8 space-y-2">--}}
{{--                                    <button wire:click="checkout" class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-blue-600 hover:bg-blue-700 text-white rounded-md">Checkout</button>--}}
{{--                                    <button wire:click="shop" class="text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-transparent text-gray-800 border border-gray-300 rounded-md">Continue Shopping  </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                <div class="bg-white shadow-lg rounded-lg p-6 col-span-full lg:col-span-3">--}}
{{--                    @if(count($this->items) > 0)--}}
{{--                        <table class="w-full">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="text-left">Product</th>--}}
{{--                                    <th class="text-left">Price</th>--}}
{{--                                    <th class="text-left">Color</th>--}}
{{--                                    <th class="text-left">Size</th>--}}
{{--                                    <th class="text-left">Quantity</th>--}}
{{--                                    <th class="text-right">Total</th>--}}
{{--                                    <th>&nbsp;</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody class="items-center">--}}
{{--                                @foreach($this->items as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $item->product->name }} </td>--}}
{{--                                        <td>{{ $item->product->price }} </td>--}}
{{--                                        <td>{{ $item->variant->color }}</td>--}}
{{--                                        <td>{{ $item->variant->size }}</td>--}}
{{--                                        <td class="flex items-center">--}}
{{--                                            <button wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)>--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                            <div>--}}
{{--                                                {{ $item->quantity }}--}}
{{--                                            </div>--}}
{{--                                            <button wire:click="increment({{ $item->id }})">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">{{$item->subtotal}}</td>--}}
{{--                                        <td class="pl-2">--}}
{{--                                            <button wire:click="delete({{$item->id}})">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                                <tr>--}}
{{--                                    <td colspan="5" class="text-right font-medium">Total</td>--}}
{{--                                    <td class="text-right font-medium">{{ $this->cart->total }}</td>--}}
{{--                                    <td></td>--}}
{{--                                </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
{{--                    @else--}}
{{--                        <div class="grid grid-cols-1 items-center place-items-center">--}}
{{--                            <div class="col-span-1 py-1">Cart is empty</div>--}}
{{--                            <div class="col-span-1">--}}
{{--                                <x-filament::button wire:click="shop">Go to shop</x-filament::button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                    @if(count($this->items) > 0)--}}
{{--                <div class="bg-white shadow-lg rounded-lg p-6 col-span-full lg:col-span-1 flex justify-center items-center text-center">--}}
{{--                    <x-filament::button class="w-full justify-center" wire:click="checkout">Check out</x-filament::button>--}}
{{--                </div>--}}
{{--                    @else--}}
{{--                        <div class="bg-white shadow-lg rounded-lg p-6 col-span-1 flex justify-center items-center text-center">--}}
{{--                            Add items to cart to checkout--}}
{{--                        </div>--}}
{{--                    @endif--}}
            @endauth
    </div>
    <livewire:guest-footer/>
</div>
