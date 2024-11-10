<div>
    <nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between bg-neutral-50 border-b border-neutral-300 px-6 py-4 dark:border-neutral-700 dark:bg-neutral-900" aria-label="penguin ui menu">
        <!-- Brand Logo -->
        <a href="{{route('shop')}}" wire:navigate class="flex items-center px-2 text-2xl font-bold text-neutral-900 dark:text-white">
            <img src="{{ asset('favicon.svg') }}" alt="brand logo" class="w-10 px-1" />
            <span>Shop</span>
        </a>
        <!-- Desktop Menu -->
        <ul class="hidden items-center gap-4 md:flex">
            <li><a href="#products" class="font-bold text-black underline-offset-2 hover:text-black focus:outline-none focus:underline dark:text-white dark:hover:text-white" aria-current="page">Products</a></li>
            <li><a href="{{$customerPanelUrl}}" class="font-bold text-black underline-offset-2 hover:text-black focus:outline-none focus:underline dark:text-white dark:hover:text-white" aria-current="page">Log In</a></li>
            <livewire:navigation-cart/>
        </ul>
        <!-- Mobile Menu Button -->
        <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" type="button" class="flex text-neutral-600 dark:text-neutral-300 md:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
            <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Mobile Menu -->
        <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-neutral-300 rounded-b-md border-b border-neutral-300 bg-neutral-50 px-6 pb-6 pt-20 dark:divide-neutral-700 dark:border-neutral-700 dark:bg-neutral-900 md:hidden">
            <li class="py-4"><a href="#products" class="w-full text-lg font-bold text-black focus:underline dark:text-white" aria-current="page">Products</a></li>
            <li class="py-4"><a href="{{$customerPanelUrl}}" class="w-full text-lg font-bold text-black focus:underline dark:text-white" aria-current="page">Log In</a></li>
            <livewire:mobile-navigation-cart/>
        </ul>
    </nav>
</div>
