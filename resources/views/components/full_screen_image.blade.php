<div>
    <div class="relative min-h-screen overflow-hidden" style="background-image: url('{{ $hero && $hero->image ? Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($hero->image) : 'https://via.placeholder.com/1920x1080' }}'); background-size: cover; background-position: center;">
        <!-- Background gradient (slightly darker) -->
        <div class="absolute inset-0 bg-gray-900 bg-opacity-80"></div>

        <!-- Navigation at the top -->
        <div class="relative z-20">
            <livewire:guest-nav-links />
        </div>

        <!-- Main hero content -->
        <div class="relative z-10 min-h-[calc(100vh-80px)] flex items-center px-4 sm:px-6 lg:px-8">
            <div class="
                container
                mx-auto
                flex-wrap
                flex-col
                md:flex-row
                items-center
                lg:grid
                {{ $hero && $hero->image ? 'lg:grid-cols-2' : 'lg:grid-cols-1' }}
                place-items-center
                min-h-full
            ">
                <!--(Text) -->
                <div class="
                    flex flex-col
                    lg:col-span-2
                    justify-center
                    items-center
                    {{ $hero && $hero->image ? 'lg:items-start' : 'items-center' }}
                    text-center
                    {{ $hero && $hero->image ? 'lg:text-left' : 'text-center' }}
                    space-y-6
                    text-white
                    max-w-full sm:max-w-md md:max-w-lg lg:max-w-3xl
                ">
                    <livewire:animation.hero-third-quote-animation />
                    <livewire:animation.hero-main-quote-animation no-quotes="true" />
                    <livewire:animation.hero-secondary-quote-animation />
                </div>
            </div>
        </div>

        <!-- Waves at the bottom -->
        @if($hero && $hero->waves == 1)
            <div class="absolute bottom-0 w-full">
                <livewire:waves />
            </div>
        @endif
    </div>
</div>
