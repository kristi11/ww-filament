<div>
    @php
        $coreCountVariantExists = $this->product->variants->pluck('corecount')->filter()->isNotEmpty();
    @endphp

    @if($coreCountVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Core Count</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->corecount }}</option>
            @endforeach
        </select>
    @endif
</div>
