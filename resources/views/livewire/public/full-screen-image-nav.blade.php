<div>
    <nav id="header" class="fixed w-full z-30 top-0 bg-transparent transition-all duration-300">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-3 px-4">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a class="font-bold text-2xl lg:text-3xl bg-gradient-to-r from-[{{$hero->gradientDegreeFirstColor}}] to-[{{$hero->gradientDegreeSecondColor}}] bg-clip-text text-transparent hover:opacity-80 transition-opacity" href="#">
                    {{ config('app.name') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="block lg:hidden relative z-50">
                <button id="nav-toggle"
                        type="button"
                        aria-expanded="false"
                        class="p-3 rounded-lg hover:bg-white/10 transition-colors focus:outline-none focus:ring-2 focus:ring-white touch-manipulation">
                    <svg id="nav-toggle-icon" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div id="nav-content"
                 class="w-full lg:flex lg:items-center lg:w-auto mt-2 lg:mt-0 absolute lg:relative top-full left-0 z-40 hidden transition-all duration-300 ease-in-out">
                <ul class="lg:flex justify-end flex-1 items-center gap-2 p-4 lg:p-0 bg-transparent lg:bg-transparent transition-all duration-300 ease-in-out">
                    @if($services)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-white hover:bg-white/10 hover:text-gray-300 transition-colors" href="#services">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Services
                            </a>
                        </li>
                    @endif
                    @if($hours)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-white hover:bg-white/10 hover:text-gray-300 transition-colors" href="#hours">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Hours
                            </a>
                        </li>
                    @endif
                    @if($shop)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-white hover:bg-white/10 hover:text-gray-300 transition-colors" href="#shop">
                                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Shop
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a class="flex items-center gap-3 px-4 py-3 lg:py-2 rounded-lg text-white hover:bg-white/10 hover:text-gray-300 transition-colors" href="#cta">
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
        const header = document.getElementById('header');
        const navToggleIcon = document.getElementById('nav-toggle-icon');
        const navLinks = document.querySelectorAll('#nav-content a'); // Now include all links
        const navUl = document.querySelector('#nav-content ul');

        // Function to update menu styles based on scroll position
        function updateMenuStyles() {
            if (window.scrollY > 50) { // Adjust threshold as needed
                // Update header
                header.classList.remove('bg-transparent');
                header.classList.add('bg-white/70', 'shadow-sm');
                // Update mobile menu background (ul inside #nav-content)
                navUl.classList.remove('bg-transparent');
                navUl.classList.add('bg-white/70', 'shadow-sm');
                // Update toggle icon
                navToggleIcon.classList.remove('text-white');
                navToggleIcon.classList.add('text-gray-900');
                // Update all links
                navLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:bg-white/10', 'hover:text-gray-300');
                    link.classList.add('text-gray-900', 'hover:bg-gray-100', 'hover:text-gray-700');
                });
            } else {
                // Revert header
                header.classList.remove('bg-white/70', 'shadow-sm');
                header.classList.add('bg-transparent');
                // Revert mobile menu background (ul inside #nav-content)
                navUl.classList.remove('bg-white/70', 'shadow-sm');
                navUl.classList.add('bg-transparent');
                // Revert toggle icon
                navToggleIcon.classList.remove('text-gray-900');
                navToggleIcon.classList.add('text-white');
                // Revert all links
                navLinks.forEach(link => {
                    link.classList.remove('text-gray-900', 'hover:bg-gray-100', 'hover:text-gray-700');
                    link.classList.add('text-white', 'hover:bg-white/10', 'hover:text-gray-300');
                });
            }
        }

        // Scroll event listener
        window.addEventListener('scroll', updateMenuStyles);

        if (navToggle && navContent) {
            // Add transition classes
            navContent.classList.add('transition-all', 'duration-300', 'ease-in-out');
            navUl.classList.add('transition-all', 'duration-300', 'ease-in-out');

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
                    // Ensure styles are updated when menu is expanded
                    updateMenuStyles();
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

        // Initial call to set styles based on current scroll position
        updateMenuStyles();
    });
</script>
