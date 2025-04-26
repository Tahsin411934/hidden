<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Panding Student Management</h2>
                        @if(!$students->isEmpty())
                        <button onclick="verifyAllStudents()" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Verify All Unverified Students
                        </button>
                        @endif
                    </div>

                    <!-- Filters Row -->
                    <div class="flex flex-wrap justify-between gap-4 mb-6">
                        <!-- Branch Filter -->
                         <div class="flex flex-wrap gap-4 mb-6">

                        <div class="relative w-full md:w-auto">
                            <label for="branch-filter" class="block text-sm font-medium text-gray-700 mb-1">Branch</label>
                            <select id="branch-filter" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-blue-500">
                                <option value="">All Branches</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Course Filter -->
                        <div class="relative w-full md:w-auto">
                            <label for="course-filter" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                            <select id="course-filter" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-blue-500">
                                <option value="">All Courses</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        </div>
                        <div class="flex ">
                            <!-- Refresh Button -->
                            <button id="refresh-btn" class="px-4  text-gray-700 rounded hover:bg-gray-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                                Refresh
                            </button>
                        </div>
                    </div>

                    @if($students->isEmpty())
                    <p class="text-gray-500">No students found.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table  class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">Name</th>
                                     <th class="px-6 py-3 text-left">Course</th>
                                     <th class="px-6 py-3 text-left">Branch</th>
                                    <th class="px-6 py-3 text-left">Contact</th>
                                    <th class="px-6 py-3 text-left">session</th>
                                   
                                    <th class="px-6 py-3 text-left">Status</th>
                                    
                                    <th class="px-6 py-3 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="students-table-body">
                                @foreach($students as $student)
                                <tr id="student-row-{{ $student->id }}" 
                                    data-branch="{{ $student->branc_code }}"
                                    data-course="{{ $student->course_id }}">
                                    <td class="px-6 py-4">{{ $student->name }}</td>
                                     <td class="px-6 py-4">{{ $student->course->name }}</td>
                                     <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $student->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                               ($student->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $student->branc_code }} - {{ $student->branch->branch_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $student->phone_number }}</td>
                                    <td class="px-6 py-4">{{ $student->session }}</td>
                                    
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $student->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                               ($student->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $student->status }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('show.student', $student->id) }}"
                                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Profile
                                            </a>
                                            @if($student->status !== 'verified')
                                            <button onclick="verifyStudent({{ $student->id }}, this)"
                                                class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">
                                                Verify
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function verifyStudent(studentId, buttonElement) {
            if (confirm('Are you sure you want to verify this student?')) {
                const originalText = buttonElement.textContent;
                buttonElement.textContent = 'Verifying...';
                buttonElement.disabled = true;
                buttonElement.classList.remove('bg-green-500', 'hover:bg-green-600');
                buttonElement.classList.add('bg-gray-400');

                axios.post(`/students/${studentId}/verify`)
                    .then(response => {
                        const row = document.getElementById(`student-row-${studentId}`);
                        if (row) {
                            row.style.transition = 'opacity 0.3s';
                            row.style.opacity = '0';
                            setTimeout(() => {
                                row.remove();
                                if (document.querySelectorAll('#students-table-body tr').length === 0) {
                                    document.querySelector('#students-table-body').innerHTML = `
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                                No students found.
                                            </td>
                                        </tr>
                                    `;
                                }
                            }, 300);
                        }
                        showNotification(response.data.message, 'green');
                    })
                    .catch(error => {
                        buttonElement.textContent = originalText;
                        buttonElement.disabled = false;
                        buttonElement.classList.add('bg-green-500', 'hover:bg-green-600');
                        buttonElement.classList.remove('bg-gray-400');
                        const errorMsg = error.response?.data?.message || 'Error verifying student';
                        showNotification(errorMsg, 'red');
                    });
            }
        }

        function verifyAllStudents() {
            if (!confirm('Are you sure you want to verify ALL unverified students?')) return;

            const verifyAllBtn = document.querySelector('button[onclick="verifyAllStudents()"]');
            const originalText = verifyAllBtn.textContent;
            verifyAllBtn.textContent = 'Verifying All...';
            verifyAllBtn.disabled = true;
            verifyAllBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            verifyAllBtn.classList.add('bg-gray-400');

            axios.post('/students/verify-all')
                .then(response => {
                    const unverifiedRows = document.querySelectorAll('#students-table-body tr');
                    unverifiedRows.forEach(row => {
                        row.style.transition = 'opacity 0.3s';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 300);
                    });

                    setTimeout(() => {
                        if (document.querySelectorAll('#students-table-body tr').length === 0) {
                            document.querySelector('#students-table-body').innerHTML = `
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No students found.
                                    </td>
                                </tr>
                            `;
                        }
                    }, 350);

                    showNotification(response.data.message, 'green');
                })
                .catch(error => {
                    const errorMsg = error.response?.data?.message || 'Error verifying all students';
                    showNotification(errorMsg, 'red');
                })
                .finally(() => {
                    verifyAllBtn.textContent = originalText;
                    verifyAllBtn.disabled = false;
                    verifyAllBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                    verifyAllBtn.classList.remove('bg-gray-400');
                });
        }

        function showNotification(message, color) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-4 py-2 rounded shadow-lg text-white ${color === 'green' ? 'bg-green-500' : 'bg-red-500'}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        document.getElementById('refresh-btn').addEventListener('click', function() {
            const btn = this;
            btn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Refreshing...
            `;
            btn.disabled = true;
            setTimeout(() => window.location.reload(), 500);
        });

        function applyFilters() {
            const selectedBranch = document.getElementById('branch-filter').value;
            const selectedCourse = document.getElementById('course-filter').value;

            const allRows = document.querySelectorAll('#students-table-body tr');
            let hasVisibleRows = false;

            allRows.forEach(row => {
                const rowBranch = row.getAttribute('data-branch');
                const rowCourse = row.getAttribute('data-course');

                const branchMatch = !selectedBranch || rowBranch === selectedBranch;
                const courseMatch = !selectedCourse || rowCourse === selectedCourse;

                if (branchMatch && courseMatch) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            const noResultsRow = document.querySelector('#students-table-body tr.no-results');
            if (hasVisibleRows) {
                if (noResultsRow) noResultsRow.remove();
            } else {
                if (!noResultsRow) {
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results';
                    noResultsRow.innerHTML = `
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No students match the selected filters.
                        </td>
                    `;
                    document.getElementById('students-table-body').appendChild(noResultsRow);
                }
            }
        }

        document.getElementById('branch-filter').addEventListener('change', applyFilters);
        document.getElementById('course-filter').addEventListener('change', applyFilters);

        applyFilters();
    </script>
</x-app-layout>
