<div>
    <head>
        <style>
            .gradient {
                background: {{ $hero->gradientType }}(
                {{ $hero->gradientDegree.'deg' }},
                {{ $hero->gradientDegreeFirstColor }} {{ $hero->gradientDegreeStart.'%' }},{{ $hero->gradientDegreeSecondColor }} {{ $hero->gradientDegreeEnd.'%' }}
                );
            }
        </style>
        <title>
            {{ config('app.name') }}
        </title>
    </head>
    <livewire:guest-hero/>
</div>
