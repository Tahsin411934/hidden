<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#006172]">Dashboard Overview</h1>
            <p class="text-sm text-gray-500">As of {{ now()->format('F j, Y') }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Students -->
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#006172]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Students</p>
                        <p class="text-2xl font-bold text-[#006172]">{{ number_format($studentStats['total']) }}</p>
                    </div>
                    <div class="bg-[#006172]/10 p-3 rounded-full">
                        <svg class="w-6 h-6 text-[#006172]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Students -->
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Active Students</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($studentStats['active']) }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Students -->
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-[#F37529]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pending Students</p>
                        <p class="text-2xl font-bold text-[#F37529]">{{ number_format($studentStats['pending']) }}</p>
                    </div>
                    <div class="bg-[#F37529]/10 p-3 rounded-full">
                        <svg class="w-6 h-6 text-[#F37529]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Students -->
            <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-indigo-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Completed Students</p>
                        <p class="text-2xl font-bold text-indigo-600">{{ number_format($studentStats['completed']) }}</p>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Recent Pending Students -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-[#006172] to-[#004955]">
                    <h3 class="text-lg font-semibold text-white">Recent Pending Students</h3>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-white/20 text-white">
                            {{ $studentStats['pending'] }} Pending
                        </span>
                        <a href="{{ route('students.index') }}" class="px-3 py-1 text-sm font-medium rounded-md text-[#006172] bg-white hover:bg-gray-100">
                            View All
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Reg No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Branch</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Course</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentPendingStudents as $student)
                            <tr class="hover:bg-gray-50/50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $student->registration_no }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $student->branch->branch_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $student->course->name ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No pending students found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Branch Distribution -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-[#F37529] to-[#e05e1a]">
                    <h3 class="text-lg font-semibold text-white">Active Students by Branch</h3>
                </div>
                <div class="p-6">
                    @if($branches->isEmpty())
                        <p class="text-gray-500 text-center py-4">No branch data available</p>
                    @else
                        @php
                            $maxStudents = max($branches->pluck('students_count')->toArray());
                            $colors = ['bg-[#006172]', 'bg-[#F37529]', 'bg-[#00A0B0]', 'bg-[#6A4A3C]', 'bg-[#CC333F]'];
                        @endphp
                        
                        <div class="space-y-4">
                            @foreach($branches as $index => $branch)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-medium text-gray-700">{{ $branch->branch_name }}</span>
                                    <span class="text-gray-500">{{ $branch->students_count }} students</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div 
                                        class="h-3 rounded-full {{ $colors[$index % count($colors)] }}"
                                        style="width: {{ $maxStudents > 0 ? ($branch->students_count / $maxStudents) * 100 : 0 }}%"
                                        title="{{ $branch->students_count }} students">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>0</span>
                                <span>{{ ceil($maxStudents / 2) }}</span>
                                <span>{{ $maxStudents }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Courses -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-[#006172] to-[#004955]">
                    <h3 class="text-lg font-semibold text-white">Top Courses (Active Students)</h3>
                    <a href="{{ route('courses.index') }}" class="px-3 py-1 text-sm font-medium rounded-md text-[#006172] bg-white hover:bg-gray-100">
                        View All
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Course</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Students</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider w-1/3">% of Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($topCourses as $course)
                            <tr class="hover:bg-gray-50/50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $course->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $course->students_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-xs font-medium text-gray-500 mr-2">{{ round($totalStudents > 0 ? ($course->students_count / $totalStudents) * 100 : 0, 1) }}%</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-[#F37529] h-2.5 rounded-full" style="width: {{ $totalStudents > 0 ? ($course->students_count / $totalStudents) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Performers -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-[#F37529] to-[#e05e1a]">
                    <h3 class="text-lg font-semibold text-white">Top Performers</h3>
                    <a href="{{ route('marks.index') }}" class="px-3 py-1 text-sm font-medium rounded-md text-[#F37529] bg-white hover:bg-gray-100">
                        View All
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#F37529] uppercase tracking-wider">Student</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#F37529] uppercase tracking-wider">Branch</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#F37529] uppercase tracking-wider">Avg Score</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($topPerformers as $student)
                            <tr class="hover:bg-gray-50/50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $student->branch->branch_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#F37529]/10 text-[#F37529]">
                                        {{ round($student->marks_avg_total_obtain_marks, 2) }}%
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Notices -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-[#006172] to-[#004955]">
                <h3 class="text-lg font-semibold text-white">Recent Notices</h3>
                <a href="{{ route('notices.create') }}" class="px-3 py-1 text-sm font-medium rounded-md text-[#006172] bg-white hover:bg-gray-100">
                    Add New
                </a>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($recentNotices as $notice)
                <a href="{{ route('notices.show', $notice->id) }}" class="block hover:bg-gray-50/50 transition duration-150 ease-in-out">
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-medium text-gray-900">{{ $notice->title }}</h4>
                            <span class="text-xs text-gray-500">{{ $notice->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-600">{{ Str::limit($notice->content, 150) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>