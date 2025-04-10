import preset from './vendor/filament/support/tailwind.config.preset'
import typography from '@tailwindcss/typography';

export default {
    presets: [preset],
    theme: {
        extend: {
            content: [
                './src/**/*.{html,js}',
                './app/Filament/**/*.php',
                './resources/views/**/*.blade.php',
                './vendor/filament/**/*.blade.php',
                './vendor/cmsmaxinc/filament-system-versions/resources/**/*.blade.php',
            ],
        },
    },
    variants: {
        extend: {
            transform: ['hover', 'focus'],
        },
    },
    plugins: [
        typography,
    ],
}
