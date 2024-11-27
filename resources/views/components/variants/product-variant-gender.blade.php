<div>
    @php
        $genderVariantExists = $this->product->variants->pluck('gender')->filter()->isNotEmpty();
    @endphp

    @if($genderVariantExists)
        <select wire:model="variant" class="block w-full rounded-lg border-0 py-1.5 p-3 pr-10 text-gray-800">
            <option value="" disabled selected>Gender</option>
            @foreach($this->product->variants as $variant)
                <option value="{{ $variant->id }}">{{ $variant->gender }}</option>
            @endforeach
        </select>
    @endif
</div>
