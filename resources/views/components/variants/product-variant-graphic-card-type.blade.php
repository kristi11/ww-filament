<div>
    @php
        $graphicCardTypeVariantExists = $this->product->variants->pluck('graphiccardtype')->filter()->isNotEmpty();
    @endphp

    @if($graphicCardTypeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Graphic Card Type</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->graphiccardtype }}</option>
            @endforeach
        </select>
    @endif
</div>
