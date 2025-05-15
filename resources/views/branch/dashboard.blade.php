@extends('branch.layouts.app', ['title' => 'Branch Dashboard'])

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Branch Dashboard</h1>
            <p class="text-gray-600 mt-1">Welcome back, {{ $branch['name'] ?? 'Branch' }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-4">
            <!-- Date Display -->
            <div class="bg-white rounded-lg shadow px-4 py-3 text-center border border-gray-100">
                <div class="text-sm font-medium text-gray-500">Today's Date</div>
                <div class="text-lg font-semibold text-[#10526F]" id="current-date"></div>
            </div>
            <!-- Time Display -->
            <div class="bg-white rounded-lg shadow px-4 py-3 text-center border border-gray-100">
                <div class="text-sm font-medium text-gray-500">Current Time</div>
                <div class="text-lg font-semibold text-[#10526F]" id="current-time"></div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Students -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#10526F] hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Students</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $students }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Active and completed</p>
                </div>
                <div class="bg-[#10526F]/10 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#10526F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Students -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Active Students</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActive }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Currently enrolled</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#F37021] hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pending Approvals</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPending }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Require action</p>
                </div>
                <div class="bg-[#F37021]/10 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#F37021]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#582aa3] hover:shadow-lg transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Graduate</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPgraduate }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Require action</p>
                </div>
                <div class="bg-[#F37021]/10 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#F37021]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pending Approvals Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Pending Approvals</h3>
                <span class="px-3 py-1 rounded-full bg-[#F37021]/10 text-[#F37021] text-sm font-medium">
                    {{ $totalPending }} pending
                </span>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($pandingstudents as $student)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#F37021]/10 flex items-center justify-center text-[#F37021] font-bold">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">{{ $student->name }}</h4>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-500">{{ $student->course->name ?? 'N/A' }}</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-xs text-gray-500">{{ $student->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <button class="text-[#10526F] hover:text-[#F37021] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No pending approvals</h3>
                    <p class="mt-1 text-sm text-gray-500">All applications are processed</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Active Students Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Recent Active Students</h3>
                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                    {{ $totalActive }} active
                </span>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($activestudents as $student)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#10526F]/10 flex items-center justify-center text-[#10526F] font-bold">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">{{ $student->name }}</h4>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-500">{{ $student->course->name ?? 'N/A' }}</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span class="text-xs text-gray-500">Active since {{ $student->updated_at->format('M d') }}</span>
                                </div>
                            </div>
                        </div>
                        <button class="text-[#10526F] hover:text-[#F37021] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No active students</h3>
                    <p class="mt-1 text-sm text-gray-500">Currently no students are active</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    // Update current date and time
    function updateDateTime() {
        const now = new Date();
        
        // Format date (Weekday, Month Day, Year)
        const dateOptions = { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString(undefined, dateOptions);
        
        // Format time (HH:MM:SS AM/PM)
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        document.getElementById('current-time').textContent = now.toLocaleTimeString(undefined, timeOptions);
    }
    
    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>

<style>
    /* Smooth transitions for hover effects */
    .transition-colors {
        transition-property: background-color, border-color, color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
    
    /* Card shadow effects */
    .shadow-md {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .shadow-lg {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    /* Custom border colors */
    .border-t-4 {
        border-top-width: 4px;
    }
</style>
@endsection