@extends('branch.layouts.app', ['title' => 'Branch Dashboard'])
@section('content')
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Pending Student Management</h2>
                    </div>

                    @if($students->isEmpty())
                    <p class="text-gray-500">No students found.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table id="example" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">Name</th>
                                    <th class="px-6 py-3 text-left">Roll</th>
                                    <th class="px-6 py-3 text-left">Registration</th>
                                    <th class="px-6 py-3 text-left">Course</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-left">Branch</th>
                                    <th class="px-6 py-3 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="students-table-body">
                                @foreach($students as $student)
                                <tr id="student-row-{{ $student->id }}">
                                    <td class="px-6 py-4">{{ $student->name }}</td>
                                    <td class="px-6 py-4">{{ $student->roll_no }}</td>
                                    <td class="px-6 py-4">{{ $student->registration_no }}</td>
                                    <td class="px-6 py-4">{{ $student->course->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $student->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                               ($student->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $student->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            {{ $student->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                               ($student->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $student->branc_code }} - {{ $student->branch->branch_name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('students.show', $student->id) }}"
                                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Profile
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
    </script>
@endsection