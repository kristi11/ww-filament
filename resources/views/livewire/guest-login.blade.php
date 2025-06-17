<div>
    @if($credentials)
        <section id="login" class="py-8 px-4 lg:p-20"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
            <x-animated-background>
                <div class="container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg shadow-lg"
                     style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 1%, white))">
                @guest()
                    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center"
                        style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                        <x-animated-text text="Login as" animation="wave" duration="800" />
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto w-64 rounded-full"
                             style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white)); filter: brightness(0.7);"></div>
                    </div>

                    <div class="bg-white gap-0.5 grid grid-cols-1 lg:px-15 m-6 md:gap-10 md:grid-cols-3 md:p-0 md:shadow-none md:w-4/5 p-6 rounded-lg shadow-lg w-full">
                        <a href="{{$customerPanelUrl}}" target="_blank"
                           style="color: {{$hero->gradientDegreeFirstColor}}; border-color: {{$hero->gradientDegreeFirstColor}}"
                           class="bg-white border-2 font-bold hover:bg-white lg:mx-0 mx-auto my-6 px-8 py-4 text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                           x-data="{
                                ripple: false,
                                rippleX: 0,
                                rippleY: 0,
                                rippleAnimation: function(e) {
                                    this.ripple = false;
                                    this.rippleX = e.offsetX;
                                    this.rippleY = e.offsetY;
                                    this.$nextTick(() => {
                                        this.ripple = true;
                                    });
                                }
                            }"
                            x-on:mousedown="rippleAnimation"
                        >
                            <span class="relative z-10">Customer</span>

                            <!-- Ripple effect -->
                            <span
                                x-cloak
                                x-show="ripple"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="transform scale-0 opacity-0"
                                x-transition:enter-end="transform scale-100 opacity-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="transform scale-100 opacity-100"
                                x-transition:leave-end="transform scale-0 opacity-0"
                                class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                            ></span>

                            <!-- Hover glow effect -->
                            <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                        </a>
                        <a href="{{$teamPanelUrl}}" target="_blank"
                           style="color: {{$hero->gradientDegreeFirstColor}}; border-color: {{$hero->gradientDegreeFirstColor}}"
                           class="bg-white border-2 font-bold hover:bg-white lg:mx-0 mx-auto my-6 px-8 py-4 text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                           x-data="{
                                ripple: false,
                                rippleX: 0,
                                rippleY: 0,
                                rippleAnimation: function(e) {
                                    this.ripple = false;
                                    this.rippleX = e.offsetX;
                                    this.rippleY = e.offsetY;
                                    this.$nextTick(() => {
                                        this.ripple = true;
                                    });
                                }
                            }"
                            x-on:mousedown="rippleAnimation"
                        >
                            <span class="relative z-10">Team Member</span>

                            <!-- Ripple effect -->
                            <span
                                x-cloak
                                x-show="ripple"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="transform scale-0 opacity-0"
                                x-transition:enter-end="transform scale-100 opacity-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="transform scale-100 opacity-100"
                                x-transition:leave-end="transform scale-0 opacity-0"
                                class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                            ></span>

                            <!-- Hover glow effect -->
                            <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                        </a>
                        <a href="{{$adminPanelUrl}}" target="_blank"
                           style="color: {{$hero->gradientDegreeFirstColor}}; border-color: {{$hero->gradientDegreeFirstColor}}"
                           class="bg-white border-2 font-bold hover:bg-white lg:mx-0 mx-auto my-6 px-8 py-4 text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                           x-data="{
                                ripple: false,
                                rippleX: 0,
                                rippleY: 0,
                                rippleAnimation: function(e) {
                                    this.ripple = false;
                                    this.rippleX = e.offsetX;
                                    this.rippleY = e.offsetY;
                                    this.$nextTick(() => {
                                        this.ripple = true;
                                    });
                                }
                            }"
                            x-on:mousedown="rippleAnimation"
                        >
                            <span class="relative z-10">Super Admin</span>

                            <!-- Ripple effect -->
                            <span
                                x-cloak
                                x-show="ripple"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="transform scale-0 opacity-0"
                                x-transition:enter-end="transform scale-100 opacity-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="transform scale-100 opacity-100"
                                x-transition:leave-end="transform scale-0 opacity-0"
                                class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                            ></span>

                            <!-- Hover glow effect -->
                            <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                        </a>
                    </div>
                @endguest
                    @auth()
                        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center"
                            style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.7);">
                            <x-animated-text text="Go to Dashboard" animation="typewriter" duration="1200" />
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
                                        class="bg-white mx-auto font-bold my-6 py-4 px-8 shadow-lg w-full text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                                        x-data="{
                                            ripple: false,
                                            rippleX: 0,
                                            rippleY: 0,
                                            rippleAnimation: function(e) {
                                                this.ripple = false;
                                                this.rippleX = e.offsetX;
                                                this.rippleY = e.offsetY;
                                                this.$nextTick(() => {
                                                    this.ripple = true;
                                                });
                                            }
                                        }"
                                        x-on:mousedown="rippleAnimation"
                                >
                                    <span class="relative z-10">Admin Dashboard</span>

                                    <!-- Ripple effect -->
                                    <span
                                        x-cloak
                                        x-show="ripple"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="transform scale-0 opacity-0"
                                        x-transition:enter-end="transform scale-100 opacity-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform scale-100 opacity-100"
                                        x-transition:leave-end="transform scale-0 opacity-0"
                                        class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                        :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                                    ></span>

                                    <!-- Hover glow effect -->
                                    <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                                </button>

                                <button wire:click="loginAsTeam"
                                        style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                        class="bg-white mx-auto font-bold my-6 py-4 px-8 shadow-lg w-full text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                                        x-data="{
                                            ripple: false,
                                            rippleX: 0,
                                            rippleY: 0,
                                            rippleAnimation: function(e) {
                                                this.ripple = false;
                                                this.rippleX = e.offsetX;
                                                this.rippleY = e.offsetY;
                                                this.$nextTick(() => {
                                                    this.ripple = true;
                                                });
                                            }
                                        }"
                                        x-on:mousedown="rippleAnimation"
                                >
                                    <span class="relative z-10">Team Dashboard</span>

                                    <!-- Ripple effect -->
                                    <span
                                        x-cloak
                                        x-show="ripple"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="transform scale-0 opacity-0"
                                        x-transition:enter-end="transform scale-100 opacity-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform scale-100 opacity-100"
                                        x-transition:leave-end="transform scale-0 opacity-0"
                                        class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                        :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                                    ></span>

                                    <!-- Hover glow effect -->
                                    <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                                </button>

                                <button wire:click="loginAsCustomer"
                                        style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                        class="bg-white mx-auto font-bold my-6 py-4 px-8 shadow-lg w-full text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                                        x-data="{
                                            ripple: false,
                                            rippleX: 0,
                                            rippleY: 0,
                                            rippleAnimation: function(e) {
                                                this.ripple = false;
                                                this.rippleX = e.offsetX;
                                                this.rippleY = e.offsetY;
                                                this.$nextTick(() => {
                                                    this.ripple = true;
                                                });
                                            }
                                        }"
                                        x-on:mousedown="rippleAnimation"
                                >
                                    <span class="relative z-10">Customer Dashboard</span>

                                    <!-- Ripple effect -->
                                    <span
                                        x-cloak
                                        x-show="ripple"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="transform scale-0 opacity-0"
                                        x-transition:enter-end="transform scale-100 opacity-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform scale-100 opacity-100"
                                        x-transition:leave-end="transform scale-0 opacity-0"
                                        class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                        :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                                    ></span>

                                    <!-- Hover glow effect -->
                                    <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                                </button>
                            @elseif($userRoles->contains('panel_user'))
                                <!-- For single button (centered) -->
                                <div class="md:col-span-3 flex justify-center w-full">
                                    <button wire:click="loginAsCustomer"
                                            style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                            class="bg-white mx-auto font-bold my-6 py-4 px-8 shadow-lg text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                                            x-data="{
                                                ripple: false,
                                                rippleX: 0,
                                                rippleY: 0,
                                                rippleAnimation: function(e) {
                                                    this.ripple = false;
                                                    this.rippleX = e.offsetX;
                                                    this.rippleY = e.offsetY;
                                                    this.$nextTick(() => {
                                                        this.ripple = true;
                                                    });
                                                }
                                            }"
                                            x-on:mousedown="rippleAnimation"
                                    >
                                        <span class="relative z-10">Dashboard</span>

                                        <!-- Ripple effect -->
                                        <span
                                            x-cloak
                                            x-show="ripple"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="transform scale-0 opacity-0"
                                            x-transition:enter-end="transform scale-100 opacity-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="transform scale-100 opacity-100"
                                            x-transition:leave-end="transform scale-0 opacity-0"
                                            class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                            :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                                        ></span>

                                        <!-- Hover glow effect -->
                                        <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                                    </button>
                                </div>
                            @elseif($userRoles->contains('team_user'))
                                <div class="md:col-span-3 flex justify-center w-full">
                                    <button wire:click="loginAsTeam"
                                            style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                            class="bg-white mx-auto font-bold my-6 py-4 px-8 shadow-lg text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                                            x-data="{
                                                ripple: false,
                                                rippleX: 0,
                                                rippleY: 0,
                                                rippleAnimation: function(e) {
                                                    this.ripple = false;
                                                    this.rippleX = e.offsetX;
                                                    this.rippleY = e.offsetY;
                                                    this.$nextTick(() => {
                                                        this.ripple = true;
                                                    });
                                                }
                                            }"
                                            x-on:mousedown="rippleAnimation"
                                    >
                                        <span class="relative z-10">Dashboard</span>

                                        <!-- Ripple effect -->
                                        <span
                                            x-cloak
                                            x-show="ripple"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="transform scale-0 opacity-0"
                                            x-transition:enter-end="transform scale-100 opacity-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="transform scale-100 opacity-100"
                                            x-transition:leave-end="transform scale-0 opacity-0"
                                            class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                            :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                                        ></span>

                                        <!-- Hover glow effect -->
                                        <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                                    </button>
                                </div>
                            @else
                                <div class="md:col-span-3 flex justify-center w-full">
                                    <button wire:click="loginAsSuperAdmin"
                                            style="color: {{$hero->gradientDegreeFirstColor}}; border: 2px solid;"
                                            class="bg-white mx-auto font-bold my-6 py-4 px-8 shadow-lg text-center relative overflow-hidden group rounded-full transition-all duration-300 ease-in-out transform hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-opacity-50"
                                            x-data="{
                                                ripple: false,
                                                rippleX: 0,
                                                rippleY: 0,
                                                rippleAnimation: function(e) {
                                                    this.ripple = false;
                                                    this.rippleX = e.offsetX;
                                                    this.rippleY = e.offsetY;
                                                    this.$nextTick(() => {
                                                        this.ripple = true;
                                                    });
                                                }
                                            }"
                                            x-on:mousedown="rippleAnimation"
                                    >
                                        <span class="relative z-10">Dashboard</span>

                                        <!-- Ripple effect -->
                                        <span
                                            x-cloak
                                            x-show="ripple"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="transform scale-0 opacity-0"
                                            x-transition:enter-end="transform scale-100 opacity-100"
                                            x-transition:leave="transition ease-in duration-100"
                                            x-transition:leave-start="transform scale-100 opacity-100"
                                            x-transition:leave-end="transform scale-0 opacity-0"
                                            class="absolute bg-white bg-opacity-30 rounded-full pointer-events-none"
                                            :style="`left: ${rippleX}px; top: ${rippleY}px; width: 300px; height: 300px; margin-left: -150px; margin-top: -150px;`"
                                        ></span>

                                        <!-- Hover glow effect -->
                                        <span class="absolute inset-0 w-full h-full bg-white bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 ease-out rounded-full"></span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endauth
                </div>
            </x-animated-background>
        </section>
    @endif
</div>
