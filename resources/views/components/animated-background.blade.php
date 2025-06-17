<div {{ $attributes->merge(['class' => 'relative overflow-hidden']) }}>
    <!-- Animated background elements -->
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <!-- Floating circles -->
        <div
            x-data="{
                circles: [
                    { size: 'w-24 h-24', x: '10%', y: '20%', duration: '20s', delay: '0s', opacity: 'opacity-5' },
                    { size: 'w-32 h-32', x: '70%', y: '60%', duration: '25s', delay: '2s', opacity: 'opacity-5' },
                    { size: 'w-16 h-16', x: '30%', y: '70%', duration: '18s', delay: '5s', opacity: 'opacity-5' },
                    { size: 'w-40 h-40', x: '80%', y: '15%', duration: '22s', delay: '7s', opacity: 'opacity-5' },
                    { size: 'w-20 h-20', x: '40%', y: '30%', duration: '15s', delay: '3s', opacity: 'opacity-5' }
                ]
            }"
            class="absolute inset-0"
        >
            <template x-for="(circle, index) in circles" :key="index">
                <div
                    :class="`absolute rounded-full ${circle.size} ${circle.opacity}`"
                    :style="`
                        left: ${circle.x};
                        top: ${circle.y};
                        background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
                        animation: float-${index} ${circle.duration} ease-in-out infinite alternate;
                        animation-delay: ${circle.delay};
                    `"
                ></div>
            </template>
        </div>

        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white/10"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10">
        {{ $slot }}
    </div>

    <style>
        @keyframes float-0 {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(20px, 20px) rotate(5deg); }
        }

        @keyframes float-1 {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-20px, 15px) rotate(-5deg); }
        }

        @keyframes float-2 {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(15px, -15px) rotate(3deg); }
        }

        @keyframes float-3 {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-15px, -10px) rotate(-3deg); }
        }

        @keyframes float-4 {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(10px, 10px) rotate(2deg); }
        }
    </style>
</div>
