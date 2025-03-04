<div>
    <div>
        @php
            $styleVariantExists = $this->product->variants->pluck('style')->filter()->isNotEmpty();
        @endphp

        @if($styleVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Style</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->style }}</option>
                @endforeach
            </select>
        @endif
    </div>

</div>
