<div>
    <!--Footer-->
    @if($footer)
        <footer class="{{ $background->footerBackgroundColor }}">
            <div class="container mx-auto px-8">
                <div class="w-full flex flex-col md:flex-row py-6">
                    <div class="flex-1 mb-6 text-black">
                        <a class="text-pink-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
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
