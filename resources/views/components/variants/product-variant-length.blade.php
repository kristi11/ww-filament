<div>
    @php
        $lengthVariantExists = $this->product->variants->pluck('length')->filter()->isNotEmpty();
    @endphp

    @if($lengthVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Length</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->length }}</option>
            @endforeach
        </select>
    @endif
</div>
