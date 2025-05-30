<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 py-6 px-12 rounded-lg shadow-lg bg-gray-100 border border-blue-200">
        <h1 class="text-2xl font-bold mb-6 text-center">Create New Course</h1>
        <form id="courseForm" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Course Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 p-2 rounded" style="border-color: #006172;" required>
                <span id="name_error" class="text-red-500 text-xs mt-1"></span>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Course Code (Optional)</label>
                <input type="text" name="code" id="code" class="w-full border border-gray-300 p-2 rounded" style="border-color: #006172;">
                <span id="code_error" class="text-red-500 text-xs mt-1"></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Course Image</label>
                <input type="file" name="image" id="image" class="w-full border border-gray-300 p-2 rounded" style="border-color: #006172;" accept="image/*">
                <span id="image_error" class="text-red-500 text-xs mt-1"></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="w-full border border-gray-300 p-2 rounded" style="border-color: #006172;" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span id="category_id_error" class="text-red-500 text-xs mt-1"></span>
            </div>
            
            <button type="button" onclick="submitCourseForm()" class="w-full bg-[#006172] text-white p-2 rounded hover:bg-[#004d5a]">
                Create Course
            </button>
        </form>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function clearErrors() {
        document.querySelectorAll('[id$="_error"]').forEach(el => {
            el.textContent = '';
        });
    }

    function resetForm() {
        document.getElementById('courseForm').reset();
    }

    function submitCourseForm() {
        clearErrors();
        
        const formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('code', document.getElementById('code').value);
        formData.append('category_id', document.getElementById('category_id').value);
        
        const imageInput = document.getElementById('image');
        if (imageInput.files[0]) {
            formData.append('image', imageInput.files[0]);
        }

        axios.post("{{ route('courses.store') }}", formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Course created successfully!',
                    customClass: {
                        confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                    }
                }).then(() => {
                    resetForm();
                });
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                    for (const [field, messages] of Object.entries(errors)) {
                        const errorElement = document.getElementById(`${field}_error`);
                        if (errorElement) {
                            errorElement.textContent = messages[0];
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Something went wrong!',
                        customClass: {
                            confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                        }
                    });
                }
            });
    }
</script>