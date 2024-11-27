<div>
    @php
        $patternVariantExists = $this->product->variants->pluck('pattern')->filter()->isNotEmpty();
    @endphp

    @if($patternVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Pattern</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->pattern }}</option>
            @endforeach
        </select>
    @endif
</div>
