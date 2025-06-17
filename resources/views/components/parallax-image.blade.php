<div
    x-data="{
        parallaxEffect: function() {
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY;
                const element = this.$el.querySelector('.parallax-element');
                if (element) {
                    const speed = {{ $speed ?? 0.15 }};
                    const yPos = -(scrollY * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                }
            });
        }
    }"
    x-init="parallaxEffect()"
    class="relative overflow-hidden {{ $class ?? '' }}"
    style="height: {{ $height ?? '400px' }};"
>
    <div
        class="parallax-element absolute inset-0 w-full h-full transition-transform duration-100 ease-linear"
        style="transform: translateY(0); height: calc(100% + 100px); top: -50px;"
    >
        <img
            src="{{ $image }}"
            alt="{{ $alt ?? 'Parallax image' }}"
            class="w-full h-full object-cover"
        >

        <!-- Optional overlay -->
        @if(isset($overlay) && $overlay)
        <div class="absolute inset-0 bg-black opacity-{{ $overlayOpacity ?? '30' }}"></div>
        @endif
    </div>

    <!-- Content -->
    @if(isset($slot) && !empty($slot->toHtml()))
    <div class="absolute inset-0 flex items-center justify-center z-10">
        <div class="text-white">
            {{ $slot }}
        </div>
    </div>
    @endif
</div>
