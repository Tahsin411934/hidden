<!-- courses/index.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">All Courses</h1>
            <a href="{{ route('courses.create') }}" class="bg-[#006172] text-white px-4 py-2 rounded hover:bg-[#004d5a]">
                Create New Course
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($course->image)
                                <img src="{{ asset('storage/'.$course->image) }}" alt="{{ $course->name }}" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $course->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->code ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->category->name ?? 'Uncategorized' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openEditModal({{ $course->id }}, '{{ $course->name }}', '{{ $course->code }}', {{ $course->category_id ?? 'null' }}, '{{ $course->image }}')" 
                                    class="text-[#f8fafa] btn bg-[#004d5a] p-3 rounded hover:text-[#e6f14d] mr-3">Edit</button>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete(this.form)" class="text-[#f8fafa] btn bg-red-600 p-3 rounded hover:text-[#e6f14d] mr-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div id="editModal" class="fixed z-10 inset-0 mt-7 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Course</h3>
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="modal_course_id">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Course Name</label>
                            <input type="text" name="name" id="modal_name" class="w-full border border-gray-300 p-2 rounded" required>
                            @error('name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Course Code (Optional)</label>
                            <input type="text" name="code" id="modal_code" class="w-full border border-gray-300 p-2 rounded">
                            @error('code')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="modal_category_id" class="w-full border border-gray-300 p-2 rounded" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Course Image</label>
                            <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded" accept="image/*">
                            @error('image')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                            <div id="currentImageContainer" class="mt-2"></div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#006172] text-base font-medium text-white hover:bg-[#004d5a] focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Update
                            </button>
                            <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Open edit modal with course data
        function openEditModal(id, name, code, categoryId, image) {
            document.getElementById('modal_course_id').value = id;
            document.getElementById('modal_name').value = name;
            document.getElementById('modal_code').value = code || '';
            document.getElementById('modal_category_id').value = categoryId || '';
            
            // Set form action
            document.getElementById('editForm').action = `/courses/${id}`;
            
            // Show current image if exists
            const imageContainer = document.getElementById('currentImageContainer');
            imageContainer.innerHTML = '';
            if (image) {
                const img = document.createElement('img');
                img.src = `/storage/${image}`;
                img.alt = name;
                img.className = 'h-20 w-20 object-cover rounded';
                imageContainer.appendChild(img);
                imageContainer.innerHTML += '<p class="text-xs text-gray-500 mt-1">Current Image</p>';
            }
            
            // Show modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        // Close edit modal
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Confirm delete
        function confirmDelete(form) {
            if (confirm('Are you sure you want to delete this course?')) {
                form.submit();
            }
        }

        // Show validation errors in modal if any
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                @if(old('id'))
                    openEditModal(
                        {{ old('id') }}, 
                        '{{ old('name') }}', 
                        '{{ old('code') }}', 
                        {{ old('category_id') ?? 'null' }}, 
                        '{{ old('image') }}'
                    );
                @endif
            });
        @endif
    </script>
</x-app-layout>