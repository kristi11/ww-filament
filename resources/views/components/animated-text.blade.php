<div
    x-data="{
        text: '{{ $text }}',
        animationType: '{{ $animation ?? 'fade' }}',
        delay: {{ $delay ?? 0 }},
        duration: {{ $duration ?? 500 }},
        isVisible: false,
        letters: [],
        init() {
            // Split text into letters or words
            if ('{{ $splitBy ?? 'letter' }}' === 'letter') {
                this.letters = this.text.split('');
            } else {
                this.letters = this.text.split(' ').map(word => word + ' ');
            }

            // Set initial visibility
            this.isVisible = {{ $initiallyVisible ?? 'false' }};

            // Start animation if auto-animate is enabled
            if ({{ $autoAnimate ?? 'true' }}) {
                this.animate();
            }
        },
        animate() {
            this.isVisible = true;
        }
    }"
    {{ $attributes->merge(['class' => 'inline-block']) }}
>
    <template x-if="animationType === 'fade'">
        <div class="flex flex-wrap">
            <template x-for="(letter, index) in letters" :key="index">
                <span
                    x-text="letter"
                    :style="`transition-delay: ${delay + (index * 30)}ms; transition-duration: ${duration}ms;`"
                    :class="{
                        'opacity-0 transform translate-y-4': !isVisible,
                        'opacity-100 transform translate-y-0': isVisible,
                        'transition-all ease-out': true
                    }"
                ></span>
            </template>
        </div>
    </template>

    <template x-if="animationType === 'wave'">
        <div class="flex flex-wrap">
            <template x-for="(letter, index) in letters" :key="index">
                <span
                    x-text="letter"
                    :style="`transition-delay: ${delay + (index * 50)}ms; transition-duration: ${duration}ms;`"
                    :class="{
                        'opacity-0 transform -translate-y-4': !isVisible,
                        'opacity-100 transform translate-y-0': isVisible,
                        'transition-all ease-out': true
                    }"
                ></span>
            </template>
        </div>
    </template>

    <template x-if="animationType === 'typewriter'">
        <div class="relative">
            <div class="flex flex-wrap">
                <template x-for="(letter, index) in letters" :key="index">
                    <span
                        x-text="letter"
                        x-show="isVisible && index <= (letters.length * (Date.now() - delay) / duration)"
                        x-transition:enter="transition-opacity ease-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                    ></span>
                </template>
            </div>
            <span
                class="absolute right-0 top-0 h-full w-0.5 bg-current animate-blink"
                x-show="isVisible && (Date.now() - delay) / duration < letters.length"
            ></span>
        </div>
    </template>
</div>

<style>
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    .animate-blink {
        animation: blink 0.7s infinite;
    }
</style>
