<nav class="sticky top-0 z-50 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Left: Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('index') }}" class="flex items-center">
                    <img src="{{ asset('images/logo_text.png') }}" alt="Logo PLECO" class="h-8">
                </a>
            </div>

            <!-- Right: Navigation Links & CTA -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Home</a>
                <a href="#benefit" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Benefit</a>
                <a href="#tentang" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Tentang</a>
                <a href="#tim" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">Tim</a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-all rounded-lg shadow-sm">
                    Masuk
                </a>
            </div>

            <!-- Mobile Hamburger Menu Button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden md:hidden border-b border-gray-100 bg-white" id="mobile-menu">
        <div class="px-4 pt-2 pb-4 space-y-2">
            <a href="#home" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-blue-600">Home</a>
            <a href="#benefit" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-blue-600">Benefit</a>
            <a href="#tentang" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-blue-600">Tentang</a>
            <a href="#tim" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-blue-600">Tim</a>
            <div class="pt-2">
                <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                    Masuk
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.querySelector('.mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
                
                // Close menu when link is clicked
                menu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        menu.classList.add('hidden');
                    });
                });
            }
        });
    </script>
</nav>

