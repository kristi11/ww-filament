<div>
    @php
        $weightVariantExists = $this->product->variants->pluck('weight')->filter()->isNotEmpty();
    @endphp

    @if($weightVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Weight</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->weight }}</option>
            @endforeach
        </select>
    @endif
</div>
