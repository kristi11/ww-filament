<div>
    <div>
        @php
            $specsVariantExists = $this->product->variants->pluck('specs')->filter()->isNotEmpty();
        @endphp

        @if($specsVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Technical specs</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->specs }}</option>
                @endforeach
            </select>
        @endif
    </div>

</div>
