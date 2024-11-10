<div class="bg-gray-50">
    <livewire:guest-links/>
    @guest
        <livewire:shop-guest-nav/>
    @endguest
    @auth
        <livewire:shop-auth-nav/>
    @endauth
    <div class="flex justify-center w-full">
        <div class="grid grid-cols-4 my-36 gap-4 w-full max-w-4xl }}">
            @guest
                <div class="bg-white shadow-lg rounded-lg p-6 col-span-full flex justify-center items-center text-center">
                    <p>Please <x-filament::button class="underline" wire:click="customerRegistration">Register</x-filament::button> or <button class="underline" wire:click="customerLogin">Login</button> to continue</p>
                </div>
            @endguest
            @auth()
                <div class="bg-white shadow-lg rounded-lg p-6 col-span-3">
                    @if(count($this->items) > 0)
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left">Product</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Color</th>
                                    <th class="text-left">Size</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-right">Total</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody class="items-center">
                                @foreach($this->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }} </td>
                                        <td>{{ $item->product->price }} </td>
                                        <td>{{ $item->variant->color }}</td>
                                        <td>{{ $item->variant->size }}</td>
                                        <td class="flex items-center">
                                            <button wire:click="decrement({{ $item->id }})" @disabled($item->quantity == 1)>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                </svg>
                                            </button>
                                            <div>
                                                {{ $item->quantity }}
                                            </div>
                                            <button wire:click="increment({{ $item->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>
                                        </td>
                                        <td class="text-right">{{$item->subtotal}}</td>
                                        <td class="pl-2">
                                            <button wire:click="delete({{$item->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right font-medium">Total</td>
                                    <td class="text-right font-medium">{{ $this->cart->total }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <div class="grid grid-cols-1 items-center place-items-center">
                            <div class="col-span-1 py-1">Cart is empty</div>
                            <div class="col-span-1">
                                <x-filament::button wire:click="shop">Go to shop</x-filament::button>
                            </div>
                        </div>
                    @endif
                </div>
                    @if(count($this->items) > 0)
                <div class="bg-white shadow-lg rounded-lg p-6 col-span-1 flex justify-center items-center text-center">
                    <x-filament::button class="w-full justify-center" wire:click="checkout">Check out</x-filament::button>
                </div>
                    @else
                        <div class="bg-white shadow-lg rounded-lg p-6 col-span-1 flex justify-center items-center text-center">
                            Add items to cart to checkout
                        </div>
                    @endif
            @endauth
        </div>
    </div>
    <livewire:guest-footer/>
</div>
