<div>
    <div>
        @php
            $volumeVariantExists = $this->product->variants->pluck('enginevolume')->filter()->isNotEmpty();
        @endphp

        @if($volumeVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Volume</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->enginevolume }}</option>
                @endforeach
            </select>
        @endif
    </div>

</div>
