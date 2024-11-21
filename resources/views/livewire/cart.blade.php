<div class="bg-gray-50">
    <livewire:guest-links/>
    @guest
        <livewire:shop-guest-nav/>
    @endguest
    @auth
        <livewire:shop-auth-nav/>
    @endauth
    <div
        class="w-full font-bold mt-8 text-3xl text-black text-center uppercase sm:pl-4">Shopping cart</div>
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
                                            <div x-data="{ isNegativePressed: false }">
                                            <button
                                                :class="isNegativePressed ? 'bg-gray-100' : 'text-black'"
                                                @mousedown="isNegativePressed = true"
                                                @mouseup="isNegativePressed = false"
                                                @mouseleave="isNegativePressed = false"
                                                @touchstart="isNegativePressed = true"
                                                @touchend="isNegativePressed = false"
                                                wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)
                                            class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 124 124">
                                                    <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                            </div>
                                            <div class="px-4">
                                                {{ $item->quantity }}
                                            </div>
                                            <div  x-data="{ isPressed: false }">
                                            <button
                                                :class="isPressed ? 'bg-gray-100' : 'text-black'"
                                                @mousedown="isPressed = true"
                                                @mouseup="isPressed = false"
                                                @mouseleave="isPressed = false"
                                                @touchstart="isPressed = true"
                                                @touchend="isPressed = false"
                                                wire:click="increment({{ $item->id }})"  class="flex items-center px-2.5 py-1.5 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current" viewBox="0 0 42 42">
                                                    <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                                                </svg>
                                            </button>
                                            </div>
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
                    <div class="sm:col-span-1">
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
            @endauth
    </div>
    <livewire:guest-footer/>
</div>
