<style>
    [x-cloak] { display: none !important; }
    
    /* Active nav link */
    .active-nav-link {
        color: #F37021;
        font-weight: 600;
    }
    
    /* Mobile menu styling */
    .mobile-menu-item {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .mobile-menu-item:hover {
        border-left-color: #F37021;
        background-color: rgba(243, 112, 33, 0.05);
    }
    
    .mobile-submenu {
        transition: max-height 0.3s ease-out;
        overflow: hidden;
    }
    
    /* Dropdown styling */
    .nav-dropdown {
        position: absolute;
        right: 0;
        z-index: 50;
        margin-top: 0.5rem;
        width: 12rem;
        background-color: white;
        border-radius: 0.375rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transform-origin: top right;
    }
    
    .dropdown-item {
        display: block;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        color: #4b5563;
        transition: all 0.2s ease;
    }
    
    .dropdown-item:hover {
        background-color: #F37021;
        color: white;
    }
    
    /* Smooth transitions */
    .dropdown-enter-active, .dropdown-leave-active {
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    
    .dropdown-enter-from, .dropdown-leave-to {
        opacity: 0;
        transform: translateY(-10px);
    }
    
    /* Login button */
    .login-btn {
        border: 2px solid #F37021;
        transition: all 0.3s ease;
    }
    
    .login-btn:hover {
        background-color: #F37021;
        color: white;
    }
    
    /* Mobile menu overlay */
    .mobile-menu-overlay {
        z-index: 40;
    }
    
    /* Mobile menu container */
    .mobile-menu-container {
        z-index: 50;
    }
    
    /* Nav link hover */
    .nav-link {
        color: #4b5563;
        transition: all 0.2s ease;
    }
    
    .nav-link:hover {
        color: #F37021;
    }
    
    /* Dropdown group */
    .dropdown-group:hover .nav-dropdown {
        display: block;
    }
</style>

<nav class="bg-white shadow-lg relative z-30" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side - Logo and Name -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white overflow-hidden border-2 border-[#045E7B]">
                        <img src="logo.png" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="ml-2 text-2xl font-bold text-[#045E7B]">YSDB</span>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-4">
                <a href="/" class="nav-link px-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname === '/' }">Home</a>
                
                <!-- Branches Dropdown -->
                <div class="relative dropdown-group" x-data="{ branchesOpen: false }">
                    <button 
                        @mouseenter="branchesOpen = true"
                        @mouseleave="if (!$event.relatedTarget?.closest('.nav-dropdown')) { branchesOpen = false }"
                        class="nav-link px-3 py-2 rounded-md text-base font-medium flex items-center"
                        :class="{ 'active-nav-link': window.location.pathname.startsWith('/branch') }">
                        Branches
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div 
                        x-show="branchesOpen"
                        @mouseenter="branchesOpen = true"
                        @mouseleave="branchesOpen = false"
                        x-transition:enter="dropdown-enter-active"
                        x-transition:enter-start="dropdown-enter-from"
                        x-transition:enter-end="dropdown-enter-to"
                        x-transition:leave="dropdown-leave-active"
                        x-transition:leave-start="dropdown-leave-from"
                        x-transition:leave-end="dropdown-leave-to"
                        class="nav-dropdown"
                        x-cloak>
                        <a href="/branch/search" class="dropdown-item">Search a Branch</a>
                        <a href="/branch/locations" class="dropdown-item">Our Locations</a>
                    </div>
                </div>
                
                <a href="/students/result" class="nav-link px-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/students/result') }">Result</a>
                <a href="/gallery" class="nav-link px-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/gallery') }">Gallery</a>
                <a href="/notice" class="nav-link px-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/notice') }">Notice</a>
                <a href="/about-us" class="nav-link px-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/about-us') }">About Us</a>
                
                <!-- Login Dropdown -->
                <div class="relative dropdown-group" x-data="{ loginOpen: false }">
                    <button 
                        @mouseenter="loginOpen = true"
                        @mouseleave="if (!$event.relatedTarget?.closest('.nav-dropdown')) { loginOpen = false }"
                        class="login-btn px-4 py-2 rounded-md text-base font-medium text-gray-700 flex items-center">
                        Login
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div 
                        x-show="loginOpen"
                        @mouseenter="loginOpen = true"
                        @mouseleave="loginOpen = false"
                        x-transition:enter="dropdown-enter-active"
                        x-transition:enter-start="dropdown-enter-from"
                        x-transition:enter-end="dropdown-enter-to"
                        x-transition:leave="dropdown-leave-active"
                        x-transition:leave-start="dropdown-leave-from"
                        x-transition:leave-end="dropdown-leave-to"
                        class="nav-dropdown"
                        x-cloak>
                        <a href="/branch/dashboard" class="dropdown-item">Branch Login</a>
                        <a href="/login" class="dropdown-item">Central Login</a>
                        <div class="border-t border-gray-200 my-1"></div>
                       
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen" 
                    type="button" 
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-[#F37021] hover:bg-gray-100 focus:outline-none transition-colors duration-300"
                    aria-label="Toggle menu">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg class="block h-8 w-8" x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Close icon -->
                    <svg class="block h-8 w-8" x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div 
        class="md:hidden fixed inset-0 z-40" 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak>
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 mobile-menu-overlay" @click="mobileMenuOpen = false"></div>
        
        <!-- Menu container -->
        <div class="relative flex flex-col w-80 max-w-full h-full bg-white shadow-xl ml-auto mobile-menu-container transform transition-all duration-300"
            :class="mobileMenuOpen ? 'translate-x-0' : 'translate-x-full'">
            
            <!-- Close button -->
            <div class="absolute top-0 right-0 -mr-14 p-1">
                <button 
                    @click="mobileMenuOpen = false" 
                    class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                    aria-label="Close menu">
                    <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Menu content -->
            <div class="flex-1 px-4 pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center justify-start mb-6">
                    <div class="w-10 h-10 rounded-full bg-white overflow-hidden border-2 border-[#045E7B]">
                        <img src="logo.png" alt="Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="ml-2 text-2xl font-bold text-[#045E7B]">YSDB</span>
                </div>
                
                <nav class="mt-6 space-y-1">
                    <a href="/" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname === '/' }">
                        <span class="truncate">Home</span>
                    </a>
                    
                    <!-- Branches Dropdown Mobile -->
                    <div class="mobile-menu-item" x-data="{ branchesOpen: false }">
                        <button 
                            @click="branchesOpen = !branchesOpen" 
                            class="w-full flex justify-between items-center px-3 py-3 rounded-md text-base font-medium"
                            :class="{ 'active-nav-link': window.location.pathname.startsWith('/branch') }">
                            <span class="truncate">Branches</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': branchesOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="mobile-submenu" x-show="branchesOpen" x-collapse>
                            <a href="/branch/search" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname === '/branch/search' }">Search a Branch</a>
                            <a href="/branch/locations" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname === '/branch/locations' }">Our Locations</a>
                        </div>
                    </div>
                    
                    <a href="/students/result" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/students/result') }">
                        <span class="truncate">Result</span>
                    </a>
                    
                    <a href="/gallery" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/gallery') }">
                        <span class="truncate">Gallery</span>
                    </a>
                    
                    <a href="/notice" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/notice') }">
                        <span class="truncate">Notice</span>
                    </a>
                    
                    <a href="/about-us" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium" :class="{ 'active-nav-link': window.location.pathname.startsWith('/about-us') }">
                        <span class="truncate">About Us</span>
                    </a>
                    
                    <!-- Login Dropdown Mobile -->
                    <div class="mobile-menu-item" x-data="{ loginOpen: false }">
                        <button 
                            @click="loginOpen = !loginOpen"
                            class="w-full flex justify-between items-center px-3 py-3 rounded-md text-base font-medium">
                            <span class="truncate">Login</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': loginOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div 
                            class="mobile-submenu pl-4" 
                            x-show="loginOpen" 
                            x-collapse
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95">
                            <a href="/branch/dashboard" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium">Branch Login</a>
                            <a href="/login" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium">Central Login</a>
                            <div class="border-t border-gray-200 my-1"></div>
                            
                        </div>
                    </div>
                </nav>
            </div>
            
            <!-- Footer area -->
            <div class="px-4 py-4 border-t border-gray-200">
                <div class="text-center text-sm text-gray-500">
                    © 2023 YSDB. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Alpine JS -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>