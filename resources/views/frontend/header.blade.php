
    <style>
        [x-cloak] { display: none !important; }
        
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
        
        /* Login dropdown styling */
        .login-dropdown {
            transition: opacity 0.01s, transform 0.2s;
        }
    </style>

    <nav class="bg-white shadow-lg" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left side - Logo and Name -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-16 rounded-full bg-white">
                            <img src="logo.png" alt="Logo" class="rounded-full">
                        </div>
                        <span class="ml-2 text-2xl font-bold text-[#045E7B]">YSDB</span>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-[#F37021] px-3 py-2 text-base font-medium transition-colors duration-300">Home</a>
                    
                    <!-- Branches Dropdown -->
                    <div class="relative" x-data="{ loginOpen: false, loginTimeout: null }">
                        <button 
                            @mouseenter="clearTimeout(loginTimeout); loginOpen = true" 
                            @mouseleave="loginTimeout = setTimeout(() => { loginOpen = false }, 1000)"
                            class="text-gray-700  hover:bg-[#F37021] hover:text-white rounded px-3 py-2 text-base font-medium transition-colors duration-300">
                           Branches
                        </button>
                        <div 
                            @mouseenter="clearTimeout(loginTimeout); loginOpen = true" 
                            @mouseleave="loginTimeout = setTimeout(() => { loginOpen = false }, 2000)"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-10 login-dropdown"
                            x-show="loginOpen"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95">
                            <a href="/branch/search" class="block px-4 py-2 text-base text-gray-700 hover:bg-[#F37021] hover:text-white transition-colors duration-200">Search a Branch</a>
                           
                        </div>
                    </div>
                    
                    <a href="#" class="text-gray-700 hover:text-[#F37021] px-3 py-2 text-base font-medium transition-colors duration-300">Result</a>
                    <a href="#" class="text-gray-700 hover:text-[#F37021] px-3 py-2 text-base font-medium transition-colors duration-300">Gallery</a>
                    <a href="#" class="text-gray-700 hover:text-[#F37021] px-3 py-2 text-base font-medium transition-colors duration-300">Notice</a>
                    <a href="#" class="text-gray-700 hover:text-[#F37021] px-3 py-2 text-base font-medium transition-colors duration-300">About Us</a>
                    <a href="#" class="text-gray-700 hover:text-[#F37021] px-3 py-2 text-base font-medium transition-colors duration-300">Contact Us</a>
                    
                    <!-- Login Dropdown -->
                    <div class="relative" x-data="{ loginOpen: false, loginTimeout: null }">
                        <button 
                            @mouseenter="clearTimeout(loginTimeout); loginOpen = true" 
                            @mouseleave="loginTimeout = setTimeout(() => { loginOpen = false }, 2000)"
                            class="text-gray-700 border border-[#F37021] hover:bg-[#F37021] hover:text-white rounded px-3 py-2 text-base font-medium transition-colors duration-300">
                            Login
                        </button>
                        <div 
                            @mouseenter="clearTimeout(loginTimeout); loginOpen = true" 
                            @mouseleave="loginTimeout = setTimeout(() => { loginOpen = false }, 2000)"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-10 login-dropdown"
                            x-show="loginOpen"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95">
                            <a href="/branch/dashboard" class="block px-4 py-2 text-base text-gray-700 hover:bg-[#F37021] hover:text-white transition-colors duration-200">Branch Login</a>
                            <a href="/login" class="block px-4 py-2 text-base text-gray-700 hover:bg-[#F37021] hover:text-white transition-colors duration-200">Central Login</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-[#F37021] hover:bg-gray-100 focus:outline-none transition-colors duration-300">
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
        <div class="md:hidden fixed inset-0 z-50" x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-50" @click="mobileMenuOpen = false"></div>
            
            <!-- Menu container -->
            <div class="relative flex flex-col w-80 max-w-full h-full bg-white shadow-xl ml-auto transform transition-all duration-300"
                 :class="mobileMenuOpen ? 'translate-x-0' : 'translate-x-full'">
                 
                <!-- Close button -->
                <div class="absolute top-0 right-0 -mr-14 p-1">
                    <button @click="mobileMenuOpen = false" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600">
                        <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Menu content -->
                <div class="flex-1 px-4 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center justify-start mb-6">
                        <div class="w-12 rounded-full bg-white">
                            <img src="logo.png" alt="Logo" class="rounded-full">
                        </div>
                        <span class="ml-2 text-2xl font-bold text-[#045E7B]">YSDB</span>
                    </div>
                    
                    <nav class="mt-6 space-y-1">
                        <a href="#" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                            <span class="truncate">Home</span>
                        </a>
                        
                        <!-- Branches Dropdown Mobile -->
                        <div class="mobile-menu-item" x-data="{ branchesOpen: false }">
                            <button @click="branchesOpen = !branchesOpen" class="w-full flex justify-between items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                                <span class="truncate">Branches</span>
                                <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': branchesOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="mobile-submenu" x-show="branchesOpen" x-collapse>
                                <a href="#" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#F37021] hover:bg-gray-50">Branch 1</a>
                                <a href="#" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#F37021] hover:bg-gray-50">Branch 2</a>
                                <a href="#" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#F37021] hover:bg-gray-50">Branch 3</a>
                            </div>
                        </div>
                        
                        <a href="#" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                            <span class="truncate">Result</span>
                        </a>
                        
                        <a href="#" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                            <span class="truncate">Gallery</span>
                        </a>
                        
                        <a href="#" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                            <span class="truncate">Notice</span>
                        </a>
                        
                        <a href="#" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                            <span class="truncate">About Us</span>
                        </a>
                        
                        <a href="#" class="mobile-menu-item group flex items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                            <span class="truncate">Contact Us</span>
                        </a>
                        
                        <!-- Login Dropdown Mobile -->
                        <div class="mobile-menu-item" x-data="{ loginOpen: false, loginTimeout: null }">
                            <button 
                                @click="loginOpen = !loginOpen"
                                @mouseenter="clearTimeout(loginTimeout); loginOpen = true" 
                                class="w-full flex justify-between items-center px-3 py-3 rounded-md text-base font-medium text-gray-700">
                                <span class="truncate">Login</span>
                                <svg class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': loginOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div 
                                @mouseenter="clearTimeout(loginTimeout); loginOpen = true" 
                                @mouseleave="loginTimeout = setTimeout(() => { loginOpen = false }, 2000)"
                                class="mobile-submenu pl-4" 
                                x-show="loginOpen" 
                                x-collapse
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95">
                                <a href="/branch/dashboard" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#F37021] hover:bg-gray-50">Branch Login</a>
                                <a href="/login" class="block pl-6 pr-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#F37021] hover:bg-gray-50">Central Login</a>
                            </div>
                        </div>
                    </nav>
                </div>
                
                <!-- Footer area (optional) -->
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
