<div>
    @if($publicHero)
    <!--Hero-->
    <livewire:guest-nav-links/>
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class=
                     "flex flex-col
                      w-full
{{--                       lg:w-2/5--}}
                        justify-center
                         items-start
                          text-center
{{--                           lg:text-left--}}
                           ">
                <p class="lg:text-3xl text-xl tracking-loose uppercase w-full antialiased drop-shadow-xl">{{ $hero->thirdQuote }}</p>
                <h1 class="
                decoration-4 tracking-normal antialiased drop-shadow-xl font-black leading-tight text-8xl w-full indent-px my-12
                ">
                    {{ $hero->mainQuote }}
                </h1>
                <p class="leading-normal lg:text-5xl md:text-4xl text-3xl w-full antialiased drop-shadow-xl mb-12">
                    {{ $hero->secondaryQuote }}
                </p>
                {{--                <button--}}
                {{--                    class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">--}}
                {{--                    Subscribe--}}
                {{--                </button>--}}
            </div>
{{--            <!--Right Col-->--}}
{{--            <div class="w-full lg:w-3/5 py-6 text-center hidden lg:block">--}}
{{--                @if($hero->image !== null)--}}
{{--                    <img class="mb-12 w-full z-50"--}}
{{--                         src=--}}
{{--                             "--}}
{{--                                {{ Storage::disk('hero')->url($hero->image) }}--}}
{{--                             "--}}
{{--                         alt="--}}
{{--                                {{config('app.name')}} hero image--}}
{{--                             "--}}
{{--                    />--}}
{{--                @else--}}
{{--                    <img class="mb-12 w-full z-50"--}}
{{--                         src="{{ asset('default-heroImage.png') }}"--}}
{{--                         alt="{{config('app.name')}} hero image"--}}
{{--                    />--}}
{{--                @endif--}}
{{--            </div>--}}
        </div>
    </div>
    {{--Enable waves only if user has chosen to--}}
    @if($hero['waves'] == 1)
        <livewire:waves/>
    @endif
    @endif
</div>
