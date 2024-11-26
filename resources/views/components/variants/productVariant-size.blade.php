<div>
    @php
        $sizeVariantExists = $this->product->variants->pluck('size')->filter()->isNotEmpty();
    @endphp

    @if($sizeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Size</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->size }}</option>
            @endforeach
        </select>
    @endif
</div>
