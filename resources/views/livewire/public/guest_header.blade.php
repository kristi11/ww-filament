@if($publicHero)
    <div>
        <head>
            <livewire:guest-links/>
            <style>
                html {
                    scroll-behavior: smooth;
                    scroll-padding: 10rem;
                }

                .gradient {
                    background: linear-gradient(
                        {{ $hero->gradientDegree.'deg' }},
                        {{ $hero->gradientDegreeFirstColor }} {{ $hero->gradientDegreeStart.'%' }},
                        {{ $hero->gradientDegreeSecondColor }} {{ $hero->gradientDegreeEnd.'%' }}
                    );
                }
            </style>
            <title>
                {{ config('app.name') }}
            </title>
        </head>
        <livewire:guest-hero/>
    </div>
@endif
