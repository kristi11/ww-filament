import preset from './vendor/filament/support/tailwind.config.preset'

module.exports = {
    theme: {
        extend: {
            animation: {
                text: 'text 5s ease infinite',
            },
            content: [
                './src/**/*.{html,js}',
                './app/Filament/**/*.php',
                './resources/views/**/*.blade.php',
                './vendor/filament/**/*.blade.php',
            ],
            keyframes: {
                text: {
                    '0%, 100%': {
                        'background-size': '200% 200%',
                        'background-position': 'left center',
                    },
                    '50%': {
                        'background-size': '200% 200%',
                        'background-position': 'right center',
                    },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
