<div>
    @if($publicHero && $hero) <!-- Ensure $publicHero is true and $hero exists -->
    @if($hero->full_screen_image == 1)
        <x-full_screen_image/>
    @else
        <x-gradient_background/>
    @endif
    @endif
</div>
