<div>
    <nav id="header" class="fixed w-full z-30 top-0 backdrop-blur-sm bg-white/70 shadow-sm">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-3 px-4">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a class="font-bold text-2xl lg:text-3xl bg-gradient-to-r from-blue-500 to-blue-900 bg-clip-text text-transparent hover:opacity-80 transition-opacity" href="#">
                    {{ config('app.name') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="block lg:hidden relative z-50">
                <button id="nav-toggle"
                        type="button"
                        aria-expanded="false"
                        class="p-3 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 touch-manipulation">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div id="nav-content"
                 class="w-full lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent absolute lg:relative top-full left-0 z-40">
                <ul class="lg:flex justify-end flex-1 items-center gap-2 p-4 lg:p-0 shadow-lg lg:shadow-none bg-white lg:bg-transparent">
                    @if($services)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors" href="#services">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Services
                            </a>
                        </li>
                    @endif
                    @if($hours)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors" href="#hours">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Hours
                            </a>
                        </li>
                    @endif
                    @if($shop)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors" href="#shop">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Shop
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors" href="#cta">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Contact
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.getElementById('nav-toggle');
        const navContent = document.getElementById('nav-content');

        if (navToggle && navContent) {
            // Add transition classes
            navContent.classList.add('transition-all', 'duration-300', 'ease-in-out');

            navToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Toggle the menu
                navContent.classList.toggle('hidden');

                // Toggle aria-expanded
                const isExpanded = !navContent.classList.contains('hidden');
                navToggle.setAttribute('aria-expanded', isExpanded);

                // Toggle hamburger icon to X
                const icon = this.querySelector('svg');
                if (isExpanded) {
                    icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                `;
                } else {
                    icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                `;
                }
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!navContent.contains(e.target) && !navToggle.contains(e.target)) {
                    navContent.classList.add('hidden');
                    navToggle.setAttribute('aria-expanded', 'false');

                    // Reset hamburger icon
                    const icon = navToggle.querySelector('svg');
                    icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                `;
                }
            });
        }
    });
</script>
