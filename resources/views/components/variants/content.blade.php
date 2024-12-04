<div>
    @php
        $variantAttributes = [
            'color' => 'Color',
            'material' => 'Material',
            'size' => 'Size',
            'enginevolume' => 'Volume',
            'capacity' => 'Capacity',
            'style' => 'Style',
            'performance' => 'Performance',
            'specs' => 'Technical specs',
            'flavor' => 'Flavor',
            'brand' => 'Brand',
            'processortype' => 'Processor Type',
            'corecount' => 'Core Count',
            'graphiccardtype' => 'Graphic Card Type',
            'age' => 'Age',
            'pattern' => 'Pattern',
            'weight' => 'Weight',
            'length' => 'Length',
            'finish' => 'Finish',
            'gender' => 'Gender'
        ];
    @endphp

    @foreach($variantAttributes as $attributeKey => $attributeLabel)
        @php $variantExists = $this->product->variants->pluck($attributeKey)->filter()->isNotEmpty(); @endphp
        @if($variantExists)
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
                <option value="" disabled selected>{{ $attributeLabel }}</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->$attributeKey }}</option>
                @endforeach
            </select>
        @endif
    @endforeach
</div>
