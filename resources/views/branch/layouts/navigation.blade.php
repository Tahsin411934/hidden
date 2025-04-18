<nav x-data="{ open: false }" class="bg-[#006172] border-b border-gray-100 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Section - Logo and Main Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-white hover:text-[#F37021] transition-colors duration-200" />
                        <span class="ml-2 text-3xl font-bold text-white hidden md:block">YSDB</span>
                    </a>
                </div>

                <!-- Navigation Links -->
               
            </div>

            <!-- Center Section - Dashboard Title -->
            <div class="hidden lg:block">
                <h1 class="text-xl font-bold text-white tracking-tight">Branch Name: {{ $branch->branch_name}}({{ $branch->id}})</h1>
            </div>

            <!-- Right Section - User Controls -->
            <div class="flex items-center space-x-4">
                <!-- Notification Bell -->
                <button class="p-1 rounded-full text-white hover:text-[#F37021] hover:bg-[#004d5a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F37021] transition-colors duration-200">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </button>

                <!-- User Dropdown -->
                <div class="relative ml-3">
                    <button id="dropdownUserButton" data-dropdown-toggle="dropdownUser" class="flex items-center text-white hover:text-[#F37021] focus:outline-none transition-colors duration-200 group" type="button">
                        <!-- User Avatar -->
                        <div class="h-8 w-8 rounded-full bg-[#F37021] flex items-center justify-center text-white font-medium group-hover:bg-white group-hover:text-[#F37021] transition-colors duration-200">
                            {{ strtoupper(substr( $branch->login_username , 0, 1)) }}
                        </div>
                        <!-- User Name (hidden on mobile) -->
                        <span class="ml-2 hidden md:block">{{ $branch->login_username }}</span>
                        <!-- Dropdown Chevron -->
                        <svg class="ml-1 h-4 w-4 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownUser" class="hidden z-50 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                        <div class="py-3 px-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $branch->login_username }}</div>
                            <div class="truncate">{{ $branch->branch_name }}</div>
                        </div>
                       
                        <div class="py-1">
                        <form method="POST" action="{{ route('branches.logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[#F37021] hover:bg-[#004d5a] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#F37021] transition-colors duration-200">
                        <span class="sr-only">{{ __('Open main menu') }}</span>
                        <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" :class="{'hidden': !open, 'block': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="md:hidden bg-[#006172] shadow-xl">
       
        <!-- Mobile User Menu -->
        <div class="pt-4 pb-3 border-t border-[#004d5a]">
            <div class="flex items-center px-5">
                <div class="h-10 w-10 rounded-full bg-[#F37021] flex items-center justify-center text-white font-medium">
                    {{ strtoupper(substr($branch->login_username , 0, 1)) }}
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-white">{{ $branch->login_username }}</div>
                    <div class="text-sm font-medium text-gray-300">{{ $branch->branch_name }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                

                <!-- Authentication -->
                <form method="POST" action="{{ route('branches.logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
            </div>
        </div>
    </div>
</nav>