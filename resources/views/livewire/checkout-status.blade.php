<div class="bg-gray-50">
    <livewire:guest-links/>
    @guest
        <livewire:shop-guest-nav/>
    @endguest
    @auth
        <livewire:shop-auth-nav/>
    @endauth
    <div class="bg-white max-w-xl rounded shadow mt-20 p-5 mx-auto my-64">
    @if($this->order)
        Thank your order (#{{$this->order->id}})
    @else
        <p wire:poll>
            Waiting for payment confirmation. Please standby ...
        </p>
    @endif
    </div>
    <livewire:guest-footer/>
</div>
