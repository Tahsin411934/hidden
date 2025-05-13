<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class=" mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Student Result Portal
                </h1>
                <p class="mt-3 text-xl text-gray-500">
                    Search for student results by roll and registration number
                </p>
            </div>

            <!-- Search Form -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
                
                <div class="px-6 py-5">
                    <form method="POST" action="{{ route('result') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="roll_no" class="block text-sm font-medium text-gray-700">
                                    Roll Number
                                </label>
                                <input type="text" id="roll_no" name="roll_no" 
                                       value="{{ old('roll_no', $roll_no ?? '') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 border">
                            </div>
                            <div>
                                <label for="registration_no" class="block text-sm font-medium text-gray-700">
                                    Registration Number
                                </label>
                                <input type="text" id="registration_no" name="registration_no" 
                                       value="{{ old('registration_no', $registration_no ?? '') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3 border">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex justify-center rounded-md border border-transparent bg-[#006172] py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Search Result
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Section -->
            @if(request()->isMethod('post'))
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    @if($student)
                        <!-- Student Info Header -->
                        <div class="bg-gradient-to-r from-[#003E59] to-[#28708f] px-6 py-4">
                            <h3 class="text-lg font-medium text-white">
                                Student Result Details
                            </h3>
                        </div>

                        <!-- Student Information -->
                        <div class="px-6 py-5">
                            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                <!-- Personal Info -->
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Name</span>
                                            <span class="text-sm text-gray-900">{{ $student->name }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Roll No</span>
                                            <span class="text-sm text-gray-900">{{ $student->roll_no }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Reg No</span>
                                            <span class="text-sm text-gray-900">{{ $student->registration_no }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Father's Name</span>
                                            <span class="text-sm text-gray-900">{{ $student->father_name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Mother's Name</span>
                                            <span class="text-sm text-gray-900">{{ $student->mother_name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Academic Info -->
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Academic Information</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Course</span>
                                            <span class="text-sm text-gray-900">{{ $student->course->name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Branch</span>
                                            <span class="text-sm text-gray-900">{{ $student->branch->branch_name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Session</span>
                                            <span class="text-sm text-gray-900">{{ $student->session ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="w-32 flex-shrink-0 text-sm font-medium text-gray-500">Phone</span>
                                            <span class="text-sm text-gray-900">{{ $student->phone_number ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Marks Section -->
                            <div class="mt-8">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Academic Performance</h4>
                                
                                @if($student->marks->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Academic</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Written</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Practical</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Viva</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GPA</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($student->marks as $mark)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->academic_assessment ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->written ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->practical ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->viva ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->total_obtain_marks ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->grade ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $mark->gpa ?? 'N/A' }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    No marks records found for this student.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="bg-red-50 border-l-4 border-red-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        No student found with the provided Roll Number and Registration Number.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>