<div>
    @if($guestServices)
    <section id="service" class="bg-white border-b py-8 lg:p-20">
        <div class="{{ $background->servicesBackgroundColor }} container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg shadow-lg">
            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Services
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            @foreach($services as $service)
                <div id="services" class="w-full lg:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg p-2 border-b">
                        <a href="#" class="flex flex-wrap no-underline hover:no-underline">
                            <p class="border-b md:text-sm pb-2 px-6 text-gray-600 text-xs w-full">
                                @if($service->estimated_hours !== null && $service->estimated_minutes !== null)
                                    {{ 'This service takes about ' }}
                                    @php
                                        $displayedValues = [];
                                        if($service->estimated_hours > 0) {
                                            $displayedValues[] = $service->estimated_hours . ($service->estimated_hours == 1 ? ' hour' : ' hours');
                                        }
                                        if($service->estimated_minutes > 0) {
                                            $displayedValues[] = $service->estimated_minutes . ' minute' . ($service->estimated_minutes == 1 ? '' : 's');
                                        }
                                    @endphp

                                    @if(count($displayedValues) > 1)
                                        {{ implode(' and ', $displayedValues) }}
                                    @else
                                        {{ $displayedValues[0] }}
                                    @endif

                                @elseif($service->estimated_hours !== null)
                                    {{ 'This service takes about '.$service->estimated_hours.' hour'.($service->estimated_hours == 1 ? '' : 's') }}
                                @elseif($service->estimated_minutes !== null)
                                    {{ 'This service takes about '.$service->estimated_minutes.' minute'.($service->estimated_minutes == 1 ? '' : 's') }}
                                @endif
                            </p>
                            <div class="w-full font-bold text-xl text-gray-800 px-6 pt-2">
                                {{ ucwords($service->name) }}
                            </div>
                            <p class="text-gray-800 text-base px-6 mb-5">
                                {{ \Illuminate\Support\Str::limit( $service->description, '200') }}
                            </p>
                            <p class="text-white text-base px-3 mb-5">
                            @if($service->price !== null)
                                @if($flexible_pricing)
                                    <p class="bg-gray-800 border-solid font-bold p-2 rounded-lg text-sm text-white">{{ 'Price starts at $'.$service->price }}</p>
                                @else
                                    <p class="bg-gray-800 border-solid font-bold p-2 rounded-lg text-sm text-white">{{ 'Price: $'.$service->price }}</p>
                                @endif
                            @endif
                        </a>
                    </div>
                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-center">
                            <button wire:click="bookService"
                                    class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Book service
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $services->links(data: ['scrollTo' => false]) }}
        </div>
    </section>
    @endif

</div>
