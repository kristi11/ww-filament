<div>
    <div>
        @php
            $flavorVariantExists = $this->product->variants->pluck('flavor')->filter()->isNotEmpty();
        @endphp

        @if($flavorVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Flavor</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->flavor }}</option>
                @endforeach
            </select>
        @endif
    </div>

</div>
