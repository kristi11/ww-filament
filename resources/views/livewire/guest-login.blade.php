<div>
    @if($credentials)
        <section id="login" class="py-8 lg:p-20"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
            <div class="container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg shadow-lg"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 1%, white))">
                @guest()
                    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center"
                        style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                        Login as
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto w-64 rounded-full"
                             style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white)); filter: brightness(0.7);"></div>
                    </div>

                    <div class="bg-white gap-0.5 grid grid-cols-1 lg:px-15 m-6 md:gap-10 md:grid-cols-3 md:p-0 md:shadow-none md:w-4/5 p-6 rounded-lg shadow-lg w-full">
                        <a href="{{$customerPanelUrl}}" target="_blank"
                           style="color: {{$hero->gradientDegreeFirstColor}}; border-color: {{$hero->gradientDegreeFirstColor}}"
                           class="bg-white border-2 focus:outline-none focus:shadow-outline font-bold hover:bg-white lg:mx-0 mx-auto my-6 px-8 py-4 rounded-full transform transition duration-300 ease-in-out text-center">
                            Customer
                        </a>
                        <a href="{{$teamPanelUrl}}" target="_blank"
                           style="color: {{$hero->gradientDegreeFirstColor}}; border-color: {{$hero->gradientDegreeFirstColor}}"
                           class="bg-white border-2 focus:outline-none focus:shadow-outline font-bold hover:bg-white lg:mx-0 mx-auto my-6 px-8 py-4 rounded-full transform transition duration-300 ease-in-out text-center">
                            Team Member
                        </a>
                        <a href="{{$adminPanelUrl}}" target="_blank"
                           style="color: {{$hero->gradientDegreeFirstColor}}; border-color: {{$hero->gradientDegreeFirstColor}}"
                           class="bg-white border-2 focus:outline-none focus:shadow-outline font-bold hover:bg-white lg:mx-0 mx-auto my-6 px-8 py-4 rounded-full transform transition duration-300 ease-in-out text-center">
                            Super Admin
                        </a>
                    </div>
                @endguest
                    @auth()
                        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center"
                            style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                            Go to Dashboard
                        </h2>
                        <div class="w-full mb-4">
                            <div class="h-1 mx-auto w-64 rounded-full"
                                 style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white));"></div>
                        </div>

                        <!-- For multiple buttons (admin) -->
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3 w-4/5 mx-auto place-items-center">
                            @php
                                $userRoles = Auth::user()->roles->pluck('name');
                                $hasMultipleRoles = $userRoles->count() > 1;
                            @endphp

                            @if($hasMultipleRoles || $userRoles->contains('super_admin'))
                                <button wire:click="loginAsSuperAdmin"
                                        style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                        class="bg-white mx-auto font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out w-full text-center">
                                    Admin Dashboard
                                </button>

                                <button wire:click="loginAsTeam"
                                        style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                        class="bg-white mx-auto font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out w-full text-center">
                                    Team Dashboard
                                </button>

                                <button wire:click="loginAsCustomer"
                                        style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                        class="bg-white mx-auto font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out w-full text-center">
                                    Customer Dashboard
                                </button>
                            @elseif($userRoles->contains('panel_user'))
                                <!-- For single button (centered) -->
                                <div class="md:col-span-3 flex justify-center w-full">
                                    <button wire:click="loginAsCustomer"
                                            style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                            class="bg-white mx-auto font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        Dashboard
                                    </button>
                                </div>
                            @elseif($userRoles->contains('team_user'))
                                <div class="md:col-span-3 flex justify-center w-full">
                                    <button wire:click="loginAsTeam"
                                            style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                            class="bg-white mx-auto font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        Dashboard
                                    </button>
                                </div>
                            @else
                                <div class="md:col-span-3 flex justify-center w-full">
                                    <button wire:click="loginAsSuperAdmin"
                                            style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                            class="bg-white mx-auto font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        Dashboard
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endauth
            </div>
        </section>
    @endif
</div>
