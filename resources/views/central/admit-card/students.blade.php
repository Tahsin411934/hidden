<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h2 class="text-2xl font-bold">Admit card Management</h2>
                        <div class="flex space-x-4 w-full sm:w-auto">
                            <!-- Print All Button -->
                            <button id="print-all-btn"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center w-full sm:w-auto justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                </svg>
                                Print All
                            </button>
                            <!-- Refresh Button -->
                            <button id="refresh-btn"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 flex items-center w-full sm:w-auto justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                        clip-rule="evenodd" />
                                </svg>
                                Refresh
                            </button>
                        </div>
                    </div>

                    <!-- Filters Row -->
                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <!-- Branch Filter -->
                        <div class="w-full md:w-1/3">
                            <label for="branch-filter" class="block text-sm font-medium text-gray-700 mb-1">Branch</label>
                            <select id="branch-filter"
                                class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-blue-500">
                                <option value="">All Branches</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Course Filter -->
                        <div class="w-full md:w-1/3">
                            <label for="course-filter" class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                            <select id="course-filter"
                                class="block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-blue-500">
                                <option value="">All Courses</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Search Bar -->
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input id="search-input" type="text"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="Search by name, roll, registration, etc...">
                            </div>
                        </div>
                    </div>

                    @if($students->isEmpty())
                    <p class="text-gray-500">No students found.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="students-table-body">
                                @foreach($students as $student)
                                <tr id="student-row-{{ $student->id }}" data-branch="{{ $student->branc_code }}"
                                    data-course="{{ $student->course_id }}" 
                                    data-search="{{ strtolower($student->name) }} {{ strtolower($student->roll_no) }} {{ strtolower($student->registration_no) }} {{ strtolower($student->course->name) }} {{ strtolower($student->status) }} {{ strtolower($student->branch->branch_name) }}">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->roll_no }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->registration_no }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->course->name }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full 
                                            {{ $student->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                               ($student->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $student->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $student->branc_code }}- {{ $student->branch->branch_name }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2 flex-wrap">
                                            <button onclick="printAdmitCard({{ $student->id }})"
                                                class="px-3 py-1 bg-[#006172] rounded-lg text-white text-sm hover:bg-[#004d5a] transition-colors">
                                                Print Admit Card
                                            </button>
                                            <button onclick="printRegistrationCard({{ $student->id }})"
                                                class="px-3 py-1 bg-[#006172] rounded-lg text-white text-sm hover:bg-[#004d5a] transition-colors">
                                                Print Registration Card
                                            </button>
                                            
                                            <a href="/admit-card-pdf/{{ $student->id }}" target="_blank" 
                                               class="px-3 py-1 bg-[#006172] rounded-lg text-white text-sm hover:bg-[#004d5a] transition-colors inline-flex items-center">
                                                See details
                                            </a>
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
    // Print All functionality
    document.getElementById('print-all-btn').addEventListener('click', function() {
        const btn = this;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Preparing to print...
        `;
        btn.disabled = true;

        // Get all visible student IDs
        const visibleStudentIds = [];
        document.querySelectorAll('#students-table-body tr').forEach(row => {
            if (row.style.display !== 'none') {
                const id = row.id.replace('student-row-', '');
                visibleStudentIds.push(id);
            }
        });

        if (visibleStudentIds.length === 0) {
            alert('No students to print!');
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            return;
        }

        // Print each admit card one by one with a delay
        let currentIndex = 0;
        const printNextAdmitCard = () => {
            if (currentIndex >= visibleStudentIds.length) {
                btn.innerHTML = originalHtml;
                btn.disabled = false;
                return;
            }

            const studentId = visibleStudentIds[currentIndex];
            btn.innerHTML = `Printing ${currentIndex + 1} of ${visibleStudentIds.length}...`;

            // Create a form dynamically
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admit-print.page", ["id" => ":id"]) }}'.replace(':id', studentId);
            form.target = '_blank';

            // Add CSRF token
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            // Add to body and submit
            document.body.appendChild(form);
            form.submit();

            // Remove the form after submission
            setTimeout(() => {
                document.body.removeChild(form);
                currentIndex++;
                setTimeout(printNextAdmitCard, 1000); // Delay between prints (1 second)
            }, 500);
        };

        // Start printing process
        printNextAdmitCard();
    });

    // Refresh button functionality
    document.getElementById('refresh-btn').addEventListener('click', function() {
        // Show loading state
        const btn = this;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Refreshing...
            `;
        btn.disabled = true;

        // Reload the page after a short delay to show the loading state
        setTimeout(() => {
            window.location.reload();
        }, 500);
    });

    // Search functionality
    document.getElementById('search-input').addEventListener('input', function() {
        applyFilters();
    });

    // Filter functionality
    function applyFilters() {
        const searchTerm = document.getElementById('search-input').value.toLowerCase();
        const selectedBranch = document.getElementById('branch-filter').value;
        const selectedCourse = document.getElementById('course-filter').value;

        const allRows = document.querySelectorAll('#students-table-body tr');
        let hasVisibleRows = false;

        allRows.forEach(row => {
            const rowBranch = row.getAttribute('data-branch');
            const rowCourse = row.getAttribute('data-course');
            const rowSearchText = row.getAttribute('data-search');

            const branchMatch = !selectedBranch || rowBranch === selectedBranch;
            const courseMatch = !selectedCourse || rowCourse === selectedCourse;
            const searchMatch = !searchTerm || rowSearchText.includes(searchTerm);

            if (branchMatch && courseMatch && searchMatch) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Check if any rows are visible
        const noResultsRow = document.querySelector('#students-table-body tr.no-results');
        if (hasVisibleRows) {
            if (noResultsRow) {
                noResultsRow.remove();
            }
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

    // Add event listeners to all filters
    document.getElementById('branch-filter').addEventListener('change', applyFilters);
    document.getElementById('course-filter').addEventListener('change', applyFilters);

    // Initialize filters
    applyFilters();

    function printAdmitCard(studentId) {
        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admit-print.page", ["id" => ":id"]) }}'.replace(':id', studentId);
        form.target = '_blank';

        // Add CSRF token
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        // Add to body and submit
        document.body.appendChild(form);
        form.submit();

        // Remove the form after submission
        setTimeout(() => document.body.removeChild(form), 1000);
    }
    function printRegistrationCard(studentId) {
        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("registration-print.page", ["id" => ":id"]) }}'.replace(':id', studentId);
        form.target = '_blank';

        // Add CSRF token
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        // Add to body and submit
        document.body.appendChild(form);
        form.submit();

        // Remove the form after submission
        setTimeout(() => document.body.removeChild(form), 1000);
    }
    </script>
</x-app-layout>