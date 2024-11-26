<div>
    @php
        $colorVariantExists = $this->product->variants->pluck('color')->filter()->isNotEmpty();
    @endphp

    @if($colorVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Color</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->color }}</option>
            @endforeach
        </select>
    @endif
</div>
