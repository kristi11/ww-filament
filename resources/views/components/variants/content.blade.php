<div>
    @php
        $colorVariantExists = $this->product->variants->pluck('color')->filter()->isNotEmpty();
        $materialVariantExists = $this->product->variants->pluck('material')->filter()->isNotEmpty();
        $sizeVariantExists = $this->product->variants->pluck('size')->filter()->isNotEmpty();
        $volumeVariantExists = $this->product->variants->pluck('enginevolume')->filter()->isNotEmpty();
        $capacityVariantExists = $this->product->variants->pluck('capacity')->filter()->isNotEmpty();
        $styleVariantExists = $this->product->variants->pluck('style')->filter()->isNotEmpty();
        $performanceVariantExists = $this->product->variants->pluck('performance')->filter()->isNotEmpty();
        $specsVariantExists = $this->product->variants->pluck('specs')->filter()->isNotEmpty();
        $flavorVariantExists = $this->product->variants->pluck('flavor')->filter()->isNotEmpty();
        $brandVariantExists = $this->product->variants->pluck('brand')->filter()->isNotEmpty();
        $processorTypeVariantExists = $this->product->variants->pluck('processortype')->filter()->isNotEmpty();
        $coreCountVariantExists = $this->product->variants->pluck('corecount')->filter()->isNotEmpty();
        $graphicCardTypeVariantExists = $this->product->variants->pluck('graphiccardtype')->filter()->isNotEmpty();
        $ageVariantExists = $this->product->variants->pluck('age')->filter()->isNotEmpty();
        $patternVariantExists = $this->product->variants->pluck('pattern')->filter()->isNotEmpty();
        $weightVariantExists = $this->product->variants->pluck('weight')->filter()->isNotEmpty();
        $lengthVariantExists = $this->product->variants->pluck('length')->filter()->isNotEmpty();
        $finishVariantExists = $this->product->variants->pluck('finish')->filter()->isNotEmpty();
        $genderVariantExists = $this->product->variants->pluck('gender')->filter()->isNotEmpty();
    @endphp

    @if($colorVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Color</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->color }}</option>
            @endforeach
        </select>
    @endif
    @if($materialVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Material</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->material }}</option>
            @endforeach
        </select>
    @endif
    @if($sizeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Size</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->size }}</option>
            @endforeach
        </select>
    @endif
    @if($volumeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Volume</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->enginevolume }}</option>
            @endforeach
        </select>
    @endif
    @if($capacityVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Capacity</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->capacity }}</option>
            @endforeach
        </select>
    @endif
    @if($styleVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Style</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->style }}</option>
            @endforeach
        </select>
    @endif
    @if($performanceVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Performance</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->performance }}</option>
            @endforeach
        </select>
    @endif
    @if($specsVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Technical specs</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->specs }}</option>
            @endforeach
        </select>
    @endif
    @if($flavorVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Flavor</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->flavor }}</option>
            @endforeach
        </select>
    @endif
    @if($brandVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Brand</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->brand }}</option>
            @endforeach
        </select>
    @endif
    @if($processorTypeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Processor Type</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->processortype }}</option>
            @endforeach
        </select>
    @endif
    @if($coreCountVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Core Count</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->corecount }}</option>
            @endforeach
        </select>
    @endif
    @if($graphicCardTypeVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Graphic Card Type</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->graphiccardtype }}</option>
            @endforeach
        </select>
    @endif
    @if($ageVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Age</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->age }}</option>
            @endforeach
        </select>
    @endif
    @if($patternVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Pattern</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->pattern }}</option>
            @endforeach
        </select>
    @endif
    @if($weightVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Weight</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->weight }}</option>
            @endforeach
        </select>
    @endif
    @if($lengthVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Length</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->length }}</option>
            @endforeach
        </select>
    @endif
    @if($finishVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Finish</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->finish }}</option>
            @endforeach
        </select>
    @endif
    @if($genderVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800 my-2">
            <option value="" disabled selected>Gender</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->gender }}</option>
            @endforeach
        </select>
    @endif
</div>
