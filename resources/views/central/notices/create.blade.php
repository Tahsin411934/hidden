<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">Add New Notice</h2>

        <form id="noticeForm" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                <input type="text" id="title" name="title"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white"
                    required>
                <p id="title_error" class="text-red-500 text-sm mt-1"></p>
            </div>

            <!-- Body (CKEditor) -->
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Body</label>
                <textarea id="body" name="body" class="ckeditor"></textarea>
                <p id="body_error" class="text-red-500 text-sm mt-1"></p>
            </div>

            <!-- PDF Upload -->
            <div class="mb-4">
                <label for="pdf" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">PDF (optional)</label>
                <input id="pdf" name="pdf" type="file" accept=".pdf"
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-indigo-50 file:text-indigo-700
                    hover:file:bg-indigo-100
                    dark:file:bg-gray-700 dark:file:text-gray-200
                    dark:hover:file:bg-gray-600">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max file size: 2MB</p>
                <p id="pdf_error" class="text-red-500 text-sm mt-1"></p>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit Notice
                </button>
            </div>
        </form>
    </div>

    <!-- CKEditor Script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let ckeditorInstance;
        ClassicEditor
            .create(document.querySelector('#body'))
            .then(editor => {
                ckeditorInstance = editor;
            })
            .catch(error => {
                console.error('CKEditor init error:', error);
            });

        document.getElementById('noticeForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Clear all previous errors
            ['title', 'body', 'pdf'].forEach(id => {
                const el = document.getElementById(id + '_error');
                if (el) el.textContent = '';
            });

            const form = e.target;
            const formData = new FormData(form);
            formData.set('body', ckeditorInstance.getData());

            axios.post("{{ route('notices.store') }}", formData)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Notice created successfully!',
                        customClass: {
                            confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                        }
                    }).then(() => {
                        form.reset();
                        ckeditorInstance.setData('');
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
        });
    </script>
</x-app-layout>
