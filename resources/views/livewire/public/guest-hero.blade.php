<div>
    @if($publicHero)
    <!--Hero-->
    <livewire:guest-nav-links/>
        <div class="pt-24">
            <div class="
                container
                min-h-96
                px-3
                mx-auto
                flex-wrap
                flex-col
                md:flex-row
                items-center
                lg:grid
                {{ $hero->image ? 'lg:grid-cols-2' : 'lg:grid-cols-1' }}
                place-items-center
            ">
                <!--Left Col-->
                <div class=
                         "flex flex-col
                            lg:col-span-1
                            justify-center
                             items-start
                              text-center
                               ">
                    <livewire:animation.hero-third-quote-animation/>
                    <livewire:animation.hero-main-quote-animation/>
                    <livewire:animation.hero-secondary-quote-animation/>
                </div>
                <!--Right Col-->
                <div class="lg:col-span-1 lg:w-5/6 py-6 text-center hidden lg:block">
                    @if($hero->image)
                        <img class="mb-12 w-full z-50 rounded-lg"
                             src="{{ Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($hero->image) }}"
                             alt="{{config('app.name')}} hero image"
                        />
                    @endif
                </div>
            </div>
        </div>
{{--        <div class="pt-24">--}}
{{--            <div class="container min-h-96 px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">--}}
{{--                <!--Left Col-->--}}
{{--                <div class=--}}
{{--                         "flex flex-col--}}
{{--                          w-full--}}
{{--                            justify-center--}}
{{--                             items-start--}}
{{--                              text-center--}}
{{--                               ">--}}
{{--                    <livewire:animation.hero-third-quote-animation/>--}}
{{--                    <livewire:animation.hero-main-quote-animation/>--}}
{{--                    <livewire:animation.hero-secondary-quote-animation/>--}}
{{--                </div>--}}
{{--                <!--Right Col-->--}}
{{--                <div class="w-full lg:w-3/5 py-6 text-center hidden lg:block">--}}
{{--                    @if($hero->image !== null)--}}
{{--                        <img class="mb-12 w-full z-50"--}}
{{--                             src="{{ Storage::url($hero->image) }}"--}}
{{--                             alt="{{config('app.name')}} hero image"--}}
{{--                        />--}}
{{--                    @else--}}
{{--                        <img class="mb-12 w-full z-50"--}}
{{--                             src="{{ asset('default-heroImage.png') }}"--}}
{{--                             alt="{{config('app.name')}} hero image"--}}
{{--                        />--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    {{--Enable waves only if user has chosen to--}}
    @if($hero['waves'] == 1)
        <livewire:waves/>
    @endif
    @endif
</div>
