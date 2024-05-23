@props([
   'parentEntryWrapper',
   'href',
   'id' => null,
   'extraAttributes' => [],
   'entry' => null,
   'gallery' => null,
   'title' => null,
   'description' => null,
   'descPosition' => null,
   'type' => null,
   'effect' => null,
   'width' => null,
   'height' => null,
   'zoomable' => null,
   'draggable' => null,
   'sizes' => null,
   'srtSet' => null,
])
@php
    if ($entry) {
        $id = $entry->getId();
        $extraAttributes = $entry->getExtraAttributes();
        $parentEntryWrapper = $entry->parentEntryWrapper;
        $href = $entry->getHref();
        $gallery = $entry->getSlideGallery();
        $title = $entry->getSlideTitle();
        $description = $entry->getSlideDescription();
        $descPosition = $entry->getSlideDescPosition();
        $type = $entry->getSlideType();
        $effect = $entry->getSlideEffect();
        $width = $entry->getSlideWidth();
        $height = $entry->getSlideHeight();
        $zoomable = $entry->getSlideZoomable();
        $draggable = $entry->getSlideDraggable();
    }
@endphp

<x-dynamic-component :component="$parentEntryWrapper" :entry="$entry">
    <a
            {{
                $attributes
                    ->merge([
                        'id' => $id,
                    ], escape: false)
                    ->merge($extraAttributes, escape: false)
            }}
            class="glightbox"
            href="{{ $href }}"
            data-gallery="{{ $gallery }}"
            data-title="{{ $title }}"
            data-description="{{ $description }}"
            data-desc-position="{{ $descPosition }}"
            data-type="{{ $type }}"
            data-effect="{{ $effect }}"
            data-width="{{ $width }}"
            data-height="{{ $height }}"
            data-zoomable="{{ $zoomable }}"
            data-draggable="{{ $draggable }}"
            data-sizes="{{ $sizes }}"
            data-srcset="{{ $srtSet }}"
    >
        {{ $slot }}
    </a>
</x-dynamic-component>

@pushonce('scripts')
    <script type="module">
      const lightbox = GLightbox(@json(config('filament-lightbox')));
    </script>
@endpushonce
