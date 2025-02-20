<div>
    @if($email)
        @if($hero['waves'] == 1)
            <livewire:email-waves/>
        @endif
        <section id="cta" class="container mx-auto text-center py-6 mb-12 rounded-lg">
            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center"
                style="color: color-mix(in srgb, white 97%, {{$hero->gradientDegreeFirstColor}});">
                {{ __("Reach out") }}
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto w-1/6 rounded-full"
                     style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white)); filter: brightness(0.7);"></div>
            </div>
            <h3 class="my-4 text-3xl leading-tight pb-4"
                style="color: color-mix(in srgb, white 97%, {{$hero->gradientDegreeFirstColor}});">
                {{ __("Have a question? Contact us!") }}
            </h3>
            <div class="inline-block">
                <livewire:secure-mailto
                    email="{{$email}}"
                    :attributes="[
                        'class' => 'bg-white border-2 font-bold rounded-full px-8 py-4 transition duration-300 ease-in-out hover:scale-105',
                        'style' => 'color: ' . $hero->gradientDegreeFirstColor . '; filter: brightness(0.7); border-color: ' . $hero->gradientDegreeFirstColor
                    ]"
                />
            </div>
        </section>
    @endif
</div>
