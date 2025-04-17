<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Student Management</h2>
                        @if(!$students->isEmpty())
                        <button onclick="verifyAllStudents()" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Verify All Unverified Students
                        </button>
                        @endif
                    </div>

                    @if($students->isEmpty())
                    <p class="text-gray-500">No students found.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table id="example" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">Name</th>
                                    <th class="px-6 py-3 text-left">Parents</th>
                                    <th class="px-6 py-3 text-left">Contact</th>
                                    <th class="px-6 py-3 text-left">Course</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="students-table-body">
                                @foreach($students as $student)
                                <tr id="student-row-{{ $student->id }}">
                                    <td class="px-6 py-4">{{ $student->name }}</td>
                                    <td class="px-6 py-4">
                                        <div>Father: {{ $student->father_name }}</div>
                                        <div>Mother: {{ $student->mother_name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>{{ $student->phone_number }}</div>
                                        <div class="text-sm text-gray-500">address: {{ $student->address }}</div>
                                    </td>
                                    <td class="px-6 py-4">{{ $student->name_of_course }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $student->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                               ($student->status === 'active' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $student->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <!-- Profile Button -->
                                            <a href="{{ route('students.show', $student->id) }}"
                                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Profile
                                            </a>

                                            <!-- Verify Button -->
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function verifyStudent(studentId, buttonElement) {
            if (confirm('Are you sure you want to verify this student?')) {
                // Show loading state
                const originalText = buttonElement.textContent;
                buttonElement.textContent = 'Verifying...';
                buttonElement.disabled = true;
                buttonElement.classList.remove('bg-green-500', 'hover:bg-green-600');
                buttonElement.classList.add('bg-gray-400');

                axios.post(`/students/${studentId}/verify`)
                    .then(response => {
                        // Remove the entire row
                        const row = document.getElementById(`student-row-${studentId}`);
                        if (row) {
                            row.style.transition = 'opacity 0.3s';
                            row.style.opacity = '0';
                            
                            // Wait for transition to complete before removing
                            setTimeout(() => {
                                row.remove();
                                
                                // Check if table is empty now
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
                        
                        // Show success notification
                        showNotification(response.data.message, 'green');
                    })
                    .catch(error => {
                        // Restore button state
                        buttonElement.textContent = originalText;
                        buttonElement.disabled = false;
                        buttonElement.classList.add('bg-green-500', 'hover:bg-green-600');
                        buttonElement.classList.remove('bg-gray-400');
                        
                        // Show error notification
                        const errorMsg = error.response?.data?.message || 'Error verifying student';
                        showNotification(errorMsg, 'red');
                    });
            }
        }

        function verifyAllStudents() {
            if (!confirm('Are you sure you want to verify ALL unverified students?')) {
                return;
            }

            const verifyAllBtn = document.querySelector('button[onclick="verifyAllStudents()"]');
            const originalText = verifyAllBtn.textContent;
            verifyAllBtn.textContent = 'Verifying All...';
            verifyAllBtn.disabled = true;
            verifyAllBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            verifyAllBtn.classList.add('bg-gray-400');

            axios.post('/students/verify-all')
                .then(response => {
                    // Remove all unverified student rows
                    const unverifiedRows = document.querySelectorAll('#students-table-body tr');
                    unverifiedRows.forEach(row => {
                        row.style.transition = 'opacity 0.3s';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 300);
                    });

                    // Check if table is empty now
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
            notification.className = `fixed top-4 right-4 px-4 py-2 rounded shadow-lg text-white ${
                color === 'green' ? 'bg-green-500' : 'bg-red-500'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }
    </script>
</x-app-layout>