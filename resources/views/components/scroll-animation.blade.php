<div
    x-data="{
        isVisible: false,
        animationType: '{{ $animation ?? 'fade' }}',
        direction: '{{ $direction ?? 'up' }}',
        delay: {{ $delay ?? 0 }},
        duration: {{ $duration ?? 500 }},
        threshold: {{ $threshold ?? 0.1 }}
    }"
    x-init="
        observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        isVisible = true;
                    }, delay);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: threshold });

        observer.observe($el);
    "
    {{ $attributes->class([
        'transition-all ease-out',
        'duration-300' => $duration == 300,
        'duration-500' => $duration == 500,
        'duration-700' => $duration == 700,
        'duration-1000' => $duration == 1000,
    ]) }}
    :class="{
        'opacity-0 translate-y-8': animationType == 'fade' && direction == 'up' && !isVisible,
        'opacity-0 -translate-y-8': animationType == 'fade' && direction == 'down' && !isVisible,
        'opacity-0 translate-x-8': animationType == 'fade' && direction == 'left' && !isVisible,
        'opacity-0 -translate-x-8': animationType == 'fade' && direction == 'right' && !isVisible,
        'opacity-0 scale-95': animationType == 'zoom' && !isVisible,
        'opacity-100 translate-y-0 translate-x-0 scale-100': isVisible
    }"
>
    {{ $slot }}
</div>
