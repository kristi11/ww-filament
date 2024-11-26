<div>
    @php
        $processorTypeVariantExists = $this->product->variants->pluck('processortype')->filter()->isNotEmpty();
    @endphp

    @if($processorTypeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Processor Type</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->processortype }}</option>
            @endforeach
        </select>
    @endif
</div>
