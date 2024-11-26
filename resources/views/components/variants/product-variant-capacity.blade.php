<div>
    <div>
        @php
            $capacityVariantExists = $this->product->variants->pluck('capacity')->filter()->isNotEmpty();
        @endphp

        @if($capacityVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Capacity</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->capacity }}</option>
                @endforeach
            </select>
        @endif
    </div>

</div>
