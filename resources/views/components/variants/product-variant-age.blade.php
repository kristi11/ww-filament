<div>
    @php
        $ageVariantExists = $this->product->variants->pluck('age')->filter()->isNotEmpty();
    @endphp

    @if($ageVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Age</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->age }}</option>
            @endforeach
        </select>
    @endif
</div>
