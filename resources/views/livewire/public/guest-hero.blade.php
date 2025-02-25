<div>
    @php
        $hero = \App\Models\Hero::first(); // Fetch the hero model
    @endphp

    @if($publicHero && $hero) <!-- Ensure $publicHero is true and $hero exists -->
    @if($hero->full_screen_image == 1)
        <x-full_screen_image :hero="$hero" />
    @else
        <x-gradient_background :hero="$hero" />
    @endif
    @endif
</div>
