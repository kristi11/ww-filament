<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50'
    ]) }}
    x-data="{
        ripple: false,
        rippleX: 0,
        rippleY: 0,
        rippleAnimation: function(e) {
            this.ripple = false;
            this.rippleX = e.offsetX;
            this.rippleY = e.offsetY;
            this.$nextTick(() => {
                this.ripple = true;
            });
        }
    }"
    x-on:mousedown="rippleAnimation"
>
    <span class="relative z-10">{{ $slot }}</span>

    <!-- Ripple effect -->
    <span
        x-cloak
        x-show="ripple"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform scale-0 opacity-0"
        x-transition:enter-end="transform scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform scale-100 opacity-100"
        x-transition:leave-end="transform scale-0 opacity-0"
        class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
        :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
    ></span>

    <!-- Hover glow effect -->
    <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
</button>
