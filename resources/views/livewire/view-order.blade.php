<div class="bg-gray-50">
    <livewire:guest-links/>
    @guest
        <livewire:shop-guest-nav/>
    @endguest
    @auth
        <livewire:shop-auth-nav/>
    @endauth
    <div class="flex justify-center">
        <div class="grid grid-cols-2 m-20 w-full max-w-3xl gap-4">
            <div class="bg-white col-span-2 rounded-lg p-6">
                <h1 class="font-black text-xl">Your order #{{ $this->order->id }}</h1>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Product</th>
                            <th class="text-left">Quantity</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="items-center">
                    @foreach($this->order->items as $item)
                        <tr>
                            <td>
                                {{ $item->name }} <br>
                                {{ $item->description }}
                            </td>
                            <td>{{ $item->quantity }} </td>
                            <td class="text-right">{{$item->amount_total}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        @if($this->order->amount_shipping->isPositive())
                            <tr>
                                <td colspan="2" class="text-right font-medium">Shipping</td>
                                <td class="text-right font-medium">{{ $this->order->amount_shipping }}</td>
                            </tr>
                        @endif
                        @if($this->order->amount_discount->isPositive())
                            <tr>
                                <td colspan="2" class="text-right font-medium">Discount</td>
                                <td class="text-right font-medium">{{ $this->order->amount_discount }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="text-right font-medium">Tax</td>
                            <td class="text-right font-medium">{{ $this->order->amount_tax }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right font-medium">Subtotal</td>
                            <td class="text-right font-medium">{{ $this->order->amount_subtotal }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right font-medium">Total</td>
                            <td class="text-right font-medium">{{ $this->order->amount_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="bg-white col-span-1 rounded-lg p-6">
                <h1 class="font-black text-xl">Billing information</h1>
                @foreach($this->order->billing_address->filter() as $value)
                    {{ $value }} <br>
                @endforeach
            </div>
            <div class="bg-white col-span-1 rounded-lg p-6">
                <h1 class="font-black text-xl">Shipping information</h1>
                @foreach($this->order->shipping_address->filter() as $value)
                    {{ $value }} <br>
                @endforeach
            </div>
        </div>
    </div>
    <livewire:guest-footer/>
</div>
