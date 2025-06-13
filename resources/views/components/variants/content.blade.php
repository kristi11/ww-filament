<div>
    @php
        use App\Models\ProductVariant;
        $variantAttributes = ProductVariant::getVariantAttributes();
    @endphp

    @foreach($variantAttributes as $attributeKey => $attributeLabel)
        @php
            $variantExists = $this->product->variants->pluck($attributeKey)->filter()->isNotEmpty();
        @endphp

        @if($variantExists)
            @if($attributeKey === 'color')
                <div x-data="{ open: false, selectedColor: null }" class="relative my-2">
                    <div @click="open = !open" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 bg-white cursor-pointer flex items-center justify-between">
                        <span>{{ $this->variant ? $this->product->variants->firstWhere('id', $this->variant)?->$attributeKey : $attributeLabel }}</span>
                        <div class="flex items-center">
                            @foreach($this->product->variants as $variant)
                                @if($variant->id == $this->variant)
                                    <span class="inline-block w-4 h-4 rounded-full border border-gray-300 mr-2" style="background-color: {{ strtolower($variant->$attributeKey) }};"></span>
                                @endif
                            @endforeach
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md py-1 text-base overflow-auto focus:outline-none sm:text-sm" style="max-height: 15rem;">
                        @foreach($this->product->variants as $variant)
                            <div wire:click="$set('variant', '{{ $variant->id }}')" @click="open = false" class="flex items-center justify-between px-3 py-2 cursor-pointer hover:bg-gray-100">
                                <span>{{ $variant->$attributeKey }}</span>
                                <span class="inline-block w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ strtolower($variant->$attributeKey) }};"></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
                    <option value="" disabled selected>{{ $attributeLabel }}</option>
                    @foreach($this->product->variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->$attributeKey }}</option>
                    @endforeach
                </select>
            @endif
        @endif
    @endforeach
</div>
