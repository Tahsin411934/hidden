<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#006172]">Categories</h1>
            <button onclick="openModal()" class="bg-[#006172] text-white px-4 py-2 rounded hover:bg-[#004d5a] transition-colors">
                Add New Category
            </button>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Categories Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#006172] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#006172]">{{ $category->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#006172]">{{ $category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="openModal({{ $category->id }}, '{{ $category->name }}')" 
                                        class="text-[#f8fafa] btn bg-[#004d5a] p-3 rounded hover:text-[#e6f14d] mr-3">Edit</button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#f8fafa] btn bg-red-600 p-3 rounded hover:text-[#e6f14d] mr-3" 
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="categoryForm" method="POST">
                    @csrf
                    <div id="formMethod"></div> <!-- For PUT method when editing -->
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 id="modalTitle" class="text-lg leading-6 font-medium text-[#006172] mb-4">Add New Category</h3>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-[#006172]">Category Name</label>
                            <input type="text" id="name" name="name" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#006172] focus:ring-[#006172]"
                                   required>
                            @error('name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#006172] text-base font-medium text-white hover:bg-[#004d5a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#006172] sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                        </button>
                        <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-[#006172] hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#006172] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function openModal(id = null, name = '') {
            const modal = document.getElementById('categoryModal');
            const form = document.getElementById('categoryForm');
            const methodInput = document.getElementById('formMethod');
            
            if (id) {
                document.getElementById('modalTitle').textContent = 'Edit Category';
                form.action = `/categories/${id}`;
                methodInput.innerHTML = '@method('PUT')';
                document.getElementById('name').value = name;
            } else {
                document.getElementById('modalTitle').textContent = 'Add New Category';
                form.action = '/categories';
                methodInput.innerHTML = '';
                document.getElementById('name').value = '';
            }
            
            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }
    </script>
</x-app-layout>