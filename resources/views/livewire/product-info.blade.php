<div class="bg-gray-50">
    <livewire:guest-links/>
    @guest
        <livewire:shop-guest-nav/>
    @endguest
    @auth
        <livewire:shop-auth-nav/>
    @endauth
<livewire:guest-notificaiton/>
    <div class="grid grid:cols-1 lg:grid-cols-2 gap-10 justify-center mx-4 my-20 md:m-10 lg:m-20 bg-gray-50">
        @if($this->product->image !== null)
            <div class="space-y-4" x-data="{ image: '{{Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($this->product->image[0])}}'}">
                <div class="bg-white p-6 rounded shadow">
                    <img x-bind:src="image" alt="{{ $this->product->name }}"/>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    @foreach($this->product->image as $image)
                        <div class="bg-white p-2 rounded shadow">
                            <img class="cursor-pointer" src="{{ Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($image) }}" @click="image = '{{ Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($image) }}'" alt="{{ $this->product->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <img class="rounded-lg" alt="Product image" src="https://placehold.co/600x400?text=Add+image"/>
        @endif
        <div>
            <h1 class="text-3xl font-medium">{{ $this->product->name }}</h1>
            <div class="text-xl text-gray-500"> {{$this->product->price }}</div>
            <div class="mt-4"> {!! $this->product->description !!}</div>
            <div class="mt-4 space-y-4">

                <x-variants.productVariant-size/>
                <x-variants.product-variant-color/>
                <x-variants.product-variant-material/>
                <x-variants.product-variant-volume/>
                <x-variants.product-variant-capacity/>
                <x-variants.product-variant-style/>
                <x-variants.product-variant-performance/>
                <x-variants.product-variant-specs/>
                <x-variants.product-variant-flavor/>
                <x-variants.product-variant-brand/>
                <x-variants.product-variant-processor-type/>
                <x-variants.product-variant-core-count/>
                <x-variants.product-variant-graphic-card-type/>

                @error('variant')
                    <div class="text-red-600">{{ $message }}</div>
                @enderror
                @guest
                    <x-filament::button wire:click="customerLogin" wire:navigate class="uppercase">Login to Add to cart</x-filament::button>
                @endguest
                @auth
                    <x-filament::button wire:click="addToCart" wire:navigate class="uppercase" >Add to cart</x-filament::button>
                @endauth
            </div>
        </div>
    </div>
    <livewire:guest-footer/>
</div>
