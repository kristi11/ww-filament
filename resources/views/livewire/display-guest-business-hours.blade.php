<div>
    @php use Carbon\Carbon; @endphp
    @if($guestHours)
        <section id="hours" class="py-8 lg:p-20"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
            <div class="container pb-12 pt-4 rounded-lg shadow-lg"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center"
                    style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                    Hours
                </h2>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto w-64 rounded-full"
                         style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white)); filter: brightness(0.7);"></div>
                </div>
                <div class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4">
                    <div class="flex flex-col w-5/6 lg:w-1/3 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10">
                        <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                            <div class="w-full p-8 text-3xl font-bold text-center"
                                 style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                                When are we open
                            </div>
                            <div class="h-1 w-full rounded-t"
                                 style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white)); filter: brightness(0.7);"></div>
                            <ul class="w-full text-center text-base font-bold">
                                @if($always_open)
                                    <li class="border-b py-4"
                                        style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7); border-color: {{$hero->gradientDegreeFirstColor}}">
                                        {{__('We are always open')}}
                                    </li>
                                @else
                                    @forelse($hours as $hour)
                                        <li class="border-b py-4"
                                            style="border-color: {{$hero->gradientDegreeFirstColor}}">
                                        <span style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                                            {{ ucwords($hour->day) }}
                                        </span>
                                            @if($hour->open)
                                                <p class="text-green-700">Open</p>
                                                <span style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                                                from
                                                <span class="font-semibold">
                                                    {{Carbon::parse($hour->open_from)->format('g:i A')}}
                                                </span>
                                                to
                                                <span class="font-semibold">
                                                    {{Carbon::parse($hour->open_until)->format('g:i A')}}
                                                </span>
                                            </span>
                                            @else
                                                <p class="text-red-800">Closed</p>
                                            @endif
                                        </li>
                                    @empty
                                        <li style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                                            {{__('This business has not set their business hours yet.')}}
                                        </li>
                                    @endforelse
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
