<div>
    @if($footer)
        <footer class="{{ $background->footerBackgroundColor }} z-50">
            <div class="container mx-auto px-4 py-12 md:py-16">
                <!-- Main footer content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                    <!-- Brand column -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-2">
                        <a class="inline-block no-underline hover:no-underline font-extrabold text-2xl lg:text-3xl transition duration-300 ease-in-out hover:scale-105 mb-6"
                           style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                            {{ config('app.name') }}
                        </a>
                        <p class="text-gray-600 font-medium mt-4 max-w-md">
                            Empowering your business with modern solutions and exceptional service.
                        </p>
                    </div>

                    <!-- Links column -->
                    <div class="col-span-1">
                        <livewire:footer-links/>
                    </div>

                    <!-- Legal column -->
                    <div class="col-span-1">
                        <livewire:footer-legal/>
                    </div>

                    <!-- Company column -->
                    <div class="col-span-1">
                        <livewire:footer-company/>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-8"></div>

                <!-- Bottom footer -->
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <!-- Copyright -->
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-500 font-medium">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </p>
                    </div>

                    <!-- Social links -->
                    <div class="flex space-x-6">
                        <livewire:footer-socials :icons="true"/>
                    </div>
                </div>
            </div>
        </footer>
    @endif
</div>
