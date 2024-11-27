<div>
    @php
        $finishVariantExists = $this->product->variants->pluck('finish')->filter()->isNotEmpty();
    @endphp

    @if($finishVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Finish</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->finish }}</option>
            @endforeach
        </select>
    @endif
</div>
