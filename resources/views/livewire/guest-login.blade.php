<div>
    @if($credentials)
        <section id="login" class="bg-white border-b py-8 lg:p-20">
            <div
                class="{{ $background->loginBackgroundColor }} container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg shadow-lg">
                @guest()
                    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Login as
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <div
                        class="bg-white gap-0.5 grid grid-cols-1 lg:px-15 m-6 md:{{ $background->loginBackgroundColor }} md:gap-10 md:grid-cols-3 md:p-0 md:shadow-none md:w-4/5 p-6 rounded-lg shadow-lg w-full">
                        <button wire:click="loginAsCustomer"
                                class="bg-white border-2 border-black focus:outline-none focus:shadow-outline font-bold hover:bg-sky-50 hover:scale-105 lg:mx-0 mx-auto my-6 px-8 py-4 rounded-full text-black">
                            Customer
                        </button>
                        <button wire:click="loginAsTeam"
                                class="bg-white border-2 border-black focus:outline-none focus:shadow-outline font-bold hover:bg-sky-50 hover:scale-105 lg:mx-0 mx-auto my-6 px-8 py-4 rounded-full text-black">
                            Team Member
                        </button>
                        <button wire:click="loginAsSuperAdmin"
                                class="bg-white border-2 border-black focus:outline-none focus:shadow-outline font-bold hover:bg-sky-50 hover:scale-105 lg:mx-0 mx-auto my-6 px-8 py-4 rounded-full text-black">
                            Super Admin
                        </button>
                    </div>
                @endguest
                @auth()
                    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Go to Dashboard
                    </h2>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>
                    <div class="gap-0.5 grid grid-cols-1 md:gap-10 md:grid-cols-1">
                        @php
                            $userRoles = Auth::user()->roles->pluck('name'); // Retrieve role names of the authenticated user.
                        @endphp

                        @if($userRoles->contains('panel_user'))
                            <button wire:click="loginAsCustomer"
                                    class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Dashboard
                            </button>
                        @elseif($userRoles->contains('team_user'))
                            <button wire:click="loginAsTeam"
                                    class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Dashboard
                            </button>
                        @else
                            <button wire:click="loginAsSuperAdmin"
                                    class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Dashboard
                            </button>
                        @endif
                    </div>
                @endauth

            </div>
        </section>
    @endif
</div>
