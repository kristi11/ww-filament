<div>
    <div>
        @php
            $performanceVariantExists = $this->product->variants->pluck('performance')->filter()->isNotEmpty();
        @endphp

        @if($performanceVariantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
                <option value="" disabled selected>Performance</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->performance }}</option>
                @endforeach
            </select>
        @endif
    </div>

</div>
