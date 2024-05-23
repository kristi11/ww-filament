<div>
    <!--Hero-->
    <livewire:guest-nav-links/>
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
                <p class="uppercase tracking-loose w-full">{{ $hero->thirdQuote }}</p>
                <h1 class="my-4 text-5xl font-bold leading-tight w-full">
                    {{ $hero->mainQuote }}
                </h1>
                <p class="leading-normal text-2xl mb-8 w-full">
                    {{ $hero->secondaryQuote }}
                </p>
                {{--                <button--}}
                {{--                    class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">--}}
                {{--                    Subscribe--}}
                {{--                </button>--}}
            </div>
            <!--Right Col-->
            <div class="w-full md:w-3/5 py-6 text-center hidden md:block">
                @if($hero->image !== null)
                    <img class="w-full md:w-4/5 z-50"
                         src=
                             "
                                {{ Storage::disk('hero')->url($hero->image) }}
                             "
                         alt="
                                {{config('app.name')}} hero image
                             "
                    />
                @else
                    <img class="w-full md:w-4/5 z-50"
                         src="{{ asset('default-heroImage.png') }}"
                         alt="{{config('app.name')}} hero image"
                    />
                @endif
            </div>
        </div>
    </div>
    {{--Enable waves only if user has chosen to--}}
    @if($hero['waves'] == 1)
        <livewire:waves/>
    @endif
</div>
