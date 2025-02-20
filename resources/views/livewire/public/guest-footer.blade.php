<div>
    @if($footer)
        <footer class="{{ $background->footerBackgroundColor }} sticky bottom-0 z-50">
            <div class="container mx-auto px-8">
                <div class="w-full flex flex-col md:flex-row py-6">
                    <div class="flex-1 mb-6">
                        <a class="no-underline hover:no-underline font-bold text-2xl lg:text-4xl transition duration-300 ease-in-out hover:scale-105"
                           style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                            {{ config('app.name') }}
                        </a>
                    </div>
                    <div class="flex-1">
                        <livewire:footer-links/>
                    </div>
                    <div class="flex-1">
                        <livewire:footer-legal/>
                    </div>
                    <div class="flex-1">
                        <livewire:footer-socials/>
                    </div>
                    <div class="flex-1">
                        <livewire:footer-company/>
                    </div>
                </div>
            </div>
        </footer>
    @endif
</div>
