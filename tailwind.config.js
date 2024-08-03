import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    plugins: [
        require('@tailwindcss/typography'),
    ],
    content: [
        './src/**/*.{html,js}',
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
