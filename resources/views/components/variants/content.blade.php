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
            <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
                <option value="" disabled selected>{{ $attributeLabel }}</option>
                @foreach($this->product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->$attributeKey }}</option>
                @endforeach
            </select>
        @endif
    @endforeach
</div>

{{--The old method was including the database table columns manually. The above method is much more dynamic and will automatically include all columns in the database table besides the id, product_id, created_at and updated_at columns. I'm keeping the code below just as a temporary safety measure just in case ive made a mistake--}}
{{--    @php--}}
{{--        $variantAttributes = [--}}
{{--            'color' => 'color',--}}
{{--            'material' => 'Material',--}}
{{--            'size' => 'Size',--}}
{{--            'enginevolume' => 'Volume',--}}
{{--            'capacity' => 'Capacity',--}}
{{--            'style' => 'Style',--}}
{{--            'performance' => 'Performance',--}}
{{--            'specs' => 'Technical specs',--}}
{{--            'flavor' => 'Flavor',--}}
{{--            'brand' => 'Brand',--}}
{{--            'processortype' => 'Processor Type',--}}
{{--            'corecount' => 'Core Count',--}}
{{--            'graphiccardtype' => 'Graphic Card Type',--}}
{{--            'age' => 'Age',--}}
{{--            'pattern' => 'Pattern',--}}
{{--            'weight' => 'Weight',--}}
{{--            'length' => 'Length',--}}
{{--            'finish' => 'Finish',--}}
{{--            'gender' => 'Gender',--}}
{{--        ];--}}
{{--    @endphp--}}
