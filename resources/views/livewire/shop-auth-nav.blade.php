<div>
    <nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4" aria-label="penguin ui menu">
        <!-- Brand Logo -->
        <a href="{{route('shop')}}" wire:navigate class="flex items-center px-2 text-2xl font-bold text-neutral-900 dark:text-white">
            <img src="{{ asset('favicon.svg') }}" alt="brand logo" class="w-10 px-1" />
            <span>Shop</span>
        </a>
        <!-- Desktop Menu -->
        <ul class="hidden items-center gap-4 sm:flex z-50">
            <li><a href="#products" class="font-bold text-black underline-offset-2 hover:text-black focus:outline-none focus:underline dark:text-white dark:hover:text-white" aria-current="page">Products</a></li>
            <<livewire:navigation-cart/>
            <!-- User Pic -->
            <li x-data="{ userDropDownIsOpen: false, openWithKeyboard: false }" @keydown.esc.window="userDropDownIsOpen = false, openWithKeyboard = false" class="relative flex items-center">
                <button @click="userDropDownIsOpen = ! userDropDownIsOpen" :aria-expanded="userDropDownIsOpen" @keydown.space.prevent="openWithKeyboard = true" @keydown.enter.prevent="openWithKeyboard = true" @keydown.down.prevent="openWithKeyboard = true" class="rounded-full focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:focus-visible:outline-white" aria-controls="userMenu">
                    <img src="https://ui-avatars.com/api/?name={{auth()->user()->name}}" alt="User Profile" class="size-10 rounded-full object-cover" />
                </button>
                <!-- User Dropdown -->
                <ul x-cloak x-show="userDropDownIsOpen || openWithKeyboard" x-transition.opacity x-trap="openWithKeyboard" @click.outside="userDropDownIsOpen = false, openWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" id="userMenu" class="absolute right-0 top-12 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 py-1.5 dark:border-neutral-700 dark:bg-neutral-900">
                    <li class="border-b border-neutral-300 dark:border-neutral-700">
                        <div class="flex flex-col px-4 py-2">
                            <span class="text-sm font-medium text-neutral-900 dark:text-white">{{ auth()->user()->name }}</span>
                            <p class="text-xs text-neutral-600 dark:text-neutral-300">{{ auth()->user()->email }}</p>
                        </div>
                    </li>
                    <li><a href="{{$customerPanelUrl}}" class="block bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/10 focus-visible:text-neutral-900 focus-visible:outline-none dark:bg-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-50/5 dark:hover:text-white dark:focus-visible:bg-neutral-50/10 dark:focus-visible:text-white">Dashboard</a></li>
                </ul>
            </li>
        </ul>
        <!-- Mobile Menu Button -->
        <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" type="button" class="flex text-neutral-600 dark:text-neutral-300 sm:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
            <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Mobile Menu -->
        <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-50 flex flex-col rounded-b-md border-b border-neutral-300 bg-neutral-50 px-8 pb-6 pt-10 dark:border-neutral-700 dark:bg-neutral-900 sm:hidden">
            <li class="mb-4 border-none">
                <div class="flex items-center gap-2 py-2">
                    <img src="https://ui-avatars.com/api/?name={{auth()->user()->name}}" alt="User Profile" class="size-12 rounded-full object-cover"  />
                    <div>
                        <span class="font-medium text-neutral-900 dark:text-white">{{ auth()->user()->name }}</span>
                        <p class="text-sm text-neutral-600 dark:text-neutral-300">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </li>
            <li class="p-2"><a href="#products" class="w-full text-lg font-bold text-black focus:underline dark:text-white" aria-current="page">Products</a></li>
            <livewire:mobile-navigation-cart/>
            <hr role="none" class="my-2 border-outline dark:border-neutral-700">
            <li class="p-2"><a href="{{$customerPanelUrl}}" class="w-full text-neutral-600 focus:underline dark:text-neutral-300">Dashboard</a></li>
        </ul>
    </nav>
</div>
