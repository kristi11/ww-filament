@component('mail::message')

{{--    {{ dd($order) }}--}}

    Hey {{ $order->user->name }},

Thank you for your order. You can find all the details below.<br>
Please note that you must be logged in to view the order.

@component('mail::table')
    | Item                         | Price              | Quantity           | Tax           | Total   |
    | :--------------------------- | ------------------:| ------------------:| -------------:| -------:|
    @foreach($order->items as $item)
    | **{{ $item->name }}** <br>{{ $item->description }} | {{ $item->price }} | {{ $item->quantity }} | {{ $item->amount_tax }} | {{ $item->amount_total }} |
    @endforeach
    @if($order->amount_shipping->isPositive())
    |||| **Shipping** | {{ $order->amount_shipping }} |
    @endif
    @if($order->amount_discount->isPositive())
     |||| **Discount** | {{ $order->amount_discount }} |
    @endif
    @if($order->amount_tax->isPositive())
    |||| **Tax** | {{ $order->amount_tax }} |
    @endif
    |||| **Subtotal** | {{ $order->amount_subtotal }} |
    |||| **Total** | {{ $order->amount_total }} |
@endcomponent
    @component('mail::button', ['url' => route('view-order', $order->id), 'color' => 'success'])
        View Order
    @endcomponent
@endcomponent
