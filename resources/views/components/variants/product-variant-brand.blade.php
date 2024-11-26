<div>
        @php
            $brandVariantExists = $this->product->variants->pluck('brand')->filter()->isNotEmpty();
        @endphp

        @if($brandVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Brand</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->brand }}</option>
                @endforeach
            </select>
        @endif
</div>
