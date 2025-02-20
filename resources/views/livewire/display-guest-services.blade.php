<div>
    @if($guestServices)
        <section id="services" class="py-12 lg:py-24"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
            <div class="container mx-auto px-4 max-w-7xl">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-4"
                    style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                    What we do
                </h2>
                <div class="w-full mb-12">
                    <div class="h-1 mx-auto w-24 rounded-full"
                         style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white)); filter: brightness(0.7);"></div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="group flex flex-col bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300">
                            <div class="flex-1 p-6">
                                @if($service->estimated_hours || $service->estimated_minutes)
                                    <div class="inline-flex items-center mb-4 px-3 py-1 rounded-full text-sm"
                                         style="background-color: color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 10%, white);
                                                color: {{$hero->gradientDegreeFirstColor}};">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <!-- Time display logic remains the same -->
                                        @if($service->estimated_hours !== null && $service->estimated_minutes !== null)
                                            @php
                                                $displayedValues = [];
                                                if($service->estimated_hours > 0) {
                                                    $displayedValues[] = $service->estimated_hours . ($service->estimated_hours == 1 ? 'h' : 'h');
                                                }
                                                if($service->estimated_minutes > 0) {
                                                    $displayedValues[] = $service->estimated_minutes . 'm';
                                                }
                                            @endphp
                                            {{ implode(' ', $displayedValues) }}
                                        @elseif($service->estimated_hours !== null)
                                            {{ $service->estimated_hours }}h
                                        @elseif($service->estimated_minutes !== null)
                                            {{ $service->estimated_minutes }}m
                                        @endif
                                    </div>
                                @endif

                                <h3 class="text-xl font-bold mb-3"
                                    style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                                    {{ ucwords($service->name) }}
                                </h3>

                                <p class="text-gray-800 mb-6 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($service->description, '200') }}
                                </p>

                                @if($service->price !== null)
                                    <div class="mt-auto">
                                        @if($flexible_pricing)
                                            <div class="inline-block text-sm font-semibold px-4 py-2 rounded-lg"
                                                 style="background-color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7); color: white;">
                                                Starting at ${{ number_format($service->price, 2) }}
                                            </div>
                                        @else
                                            <div class="text-xl font-bold"
                                                 style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                                                ${{ number_format($service->price, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            @if($service->price !== null)
                                <div class="p-6 pt-0">
                                    <button wire:click="bookService"
                                            class="w-full rounded-xl py-3 px-6 font-semibold transition-all duration-300
                                                   focus:outline-none focus:ring-2 focus:ring-offset-2"
                                            style="background-color: white;
                                                   border: 2px solid {{$hero->gradientDegreeFirstColor}};
                                                   --hover-bg: {{$hero->gradientDegreeFirstColor}};
                                                   color: {{$hero->gradientDegreeFirstColor}};"
                                            onmouseover="this.style.backgroundColor=this.style.getPropertyValue('--hover-bg'); this.style.color='white'"
                                            onmouseout="this.style.backgroundColor='white'; this.style.color=getComputedStyle(this).getPropertyValue('--hover-bg')">
                                        Book service
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $services->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </section>
    @endif
</div>
