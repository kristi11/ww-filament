<div>
    @if($publicHero)
        <div class="relative min-h-screen overflow-hidden">
            <!-- Background gradient -->
            <div class="absolute inset-0 gradient opacity-5"></div>

            <!-- Navigation at the top -->
            <div class="relative z-20">
                <livewire:guest-nav-links/>
            </div>

            <!-- Main hero content -->
            <div class="relative z-10 min-h-[calc(100vh-80px)] flex items-center">
                <div class="
                container
                px-4
                mx-auto
                flex-wrap
                flex-col
                md:flex-row
                items-center
                lg:grid
                {{ $hero->image ? 'lg:grid-cols-2' : 'lg:grid-cols-1' }}
                place-items-center
            ">
                    <!-- Left Col -->
                    <div class="
                    flex flex-col
                    lg:col-span-1
                    justify-center
                    items-center
                    {{ $hero->image ? 'lg:items-start' : 'items-center' }}
                    text-center
                    {{ $hero->image ? 'lg:text-left' : 'text-center' }}
                    space-y-6
                ">
                        <livewire:animation.hero-third-quote-animation/>
                        <livewire:animation.hero-main-quote-animation/>
                        <livewire:animation.hero-secondary-quote-animation/>
                    </div>

                    <!-- Right Col -->
                    @if($hero->image)
                        <div class="lg:col-span-1 lg:w-5/6 py-6 text-center hidden lg:block">
                            <div class="relative rounded-2xl overflow-hidden">
                                <img
                                    class="w-full z-50 rounded-lg object-cover transform transition-transform duration-500 hover:scale-[1.02]"
                                    src="{{ Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($hero->image) }}"
                                    alt="{{config('app.name')}} hero image"
                                />
                                <div class="absolute inset-0 gradient opacity-10"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Waves at the bottom -->
            @if($hero['waves'] == 1)
                <div class="absolute bottom-0 w-full">
                    <livewire:waves/>
                </div>
            @endif
        </div>
    @endif
</div>
