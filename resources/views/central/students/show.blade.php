<x-app-layout>

<div class="max-w-7xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">
    <!-- Header with gradient background -->
    <div class="bg-gradient-to-r from-[#006172] to-[#0096a0] py-4 px-8 text-white">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold tracking-wide">Student Profile Information</h2>
            <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium">{{ $students->registration_no }}</span>
        </div>
        <div class="flex items-center mt-2 text-white/90">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            <span class="text-sm">Last updated: {{ $students->updated_at->format('M d, Y') }}</span>
        </div>
    </div>

    <form id="studentForm" action="{{ route('students.update', $students->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Profile Image and Personal Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Image Card -->
                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 shadow-sm">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <div id="imagePreviewContainer">
                                @if ($students->image)
                                    <img id="imagePreview" src="{{ asset('storage/' . $students->image) }}" 
                                         class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div id="imagePreview" class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 border-4 border-white shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="image" class="hidden" id="imageUpload" accept="image/*">
                            <label for="imageUpload" class="absolute bottom-0 right-0 bg-[#006172] p-2 rounded-full text-white cursor-pointer hover:bg-[#004d5c] transition-all shadow-md hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </label>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $students->name }}</h3>
                        <p class="text-[#006172] font-medium">{{ $students->course->name ?? 'No Course' }}</p>
                    </div>
                </div>

                <!-- Quick Info Card -->
                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 shadow-sm">
                    <h4 class="font-semibold text-lg text-gray-700 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#006172]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                        </svg>
                        Academic Details
                    </h4>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs font-medium text-gray-500">Roll Number</p>
                            <input type="text" name="roll_no" value="{{ $students->roll_no }}" 
                                   class="w-full p-2 bg-transparent border-b border-gray-200 focus:border-[#006172] focus:ring-0 read-only:border-none" readonly>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Session</p>
                            <input type="text" name="session" value="{{ $students->session }}" 
                                   class="w-full p-2 bg-transparent border-b border-gray-200 focus:border-[#006172] focus:ring-0 read-only:border-none" readonly>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500">Status</p>
                            <div class="flex items-center">
                                <input type="text" name="status" value="{{ $students->status }}" 
                                       class="w-full p-2 bg-transparent border-b border-gray-200 focus:border-[#006172] focus:ring-0 read-only:border-none" readonly>
                                <span class="ml-2 px-2 py-1 text-xs rounded-full 
                                    {{ $students->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $students->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Form Fields -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information Card -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h4 class="font-semibold text-lg text-gray-700 mb-4 pb-2 border-b border-gray-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#006172]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Personal Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" value="{{ $students->name }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
                            <input type="text" name="father_name" value="{{ $students->father_name }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
                            <input type="text" name="mother_name" value="{{ $students->mother_name }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ $students->phone_number }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <input type="text" name="address" value="{{ $students->address }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                    </div>
                </div>

                <!-- Location Information Card -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h4 class="font-semibold text-lg text-gray-700 mb-4 pb-2 border-b border-gray-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#006172]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Location Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tana</label>
                            <input type="text" name="tana" value="{{ $students->tana }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Village</label>
                            <input type="text" name="vill" value="{{ $students->vill }}" 
                                   class="w-full p-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#006172]/50 focus:border-[#006172] read-only:bg-gray-50" readonly>
                        </div>
                    </div>
                </div>

                <!-- Documents Card -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h4 class="font-semibold text-lg text-gray-700 mb-4 pb-2 border-b border-gray-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#006172]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        Documents
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-[#006172] transition-colors">
                                <div id="signaturePreviewContainer">
                                    @if ($students->signature)
                                        <img id="signaturePreview" src="{{ asset('storage/' . $students->signature) }}" class="w-full h-32 object-contain mx-auto mb-2">
                                    @else
                                        <div id="signaturePreview" class="w-full h-32 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="signature" class="hidden" id="signatureUpload" accept="image/*">
                                <label for="signatureUpload" class="mt-2 cursor-pointer text-sm text-[#006172] hover:text-[#004d5c] font-medium hidden">
                                    <span class="underline">Upload new signature</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
            <button type="button" id="editBtn" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#006172] hover:bg-[#004d5c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#006172] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit Profile
            </button>
            <button type="submit" id="saveBtn" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const formInputs = document.querySelectorAll('#studentForm input:not([type="file"])');
    const fileInputs = document.querySelectorAll('#studentForm input[type="file"]');
    const fileUploadLabels = document.querySelectorAll('label[for="imageUpload"], label[for="signatureUpload"]');
    const imageUpload = document.getElementById('imageUpload');
    const signatureUpload = document.getElementById('signatureUpload');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const signaturePreviewContainer = document.getElementById('signaturePreviewContainer');

    // Edit button click handler
    editBtn.addEventListener('click', () => {
        // Enable all text inputs
        formInputs.forEach(input => {
            input.removeAttribute('readonly');
            input.classList.remove('bg-gray-50', 'read-only:bg-gray-50');
            input.classList.add('bg-white');
        });
        
        // Show file inputs
        fileUploadLabels.forEach(label => {
            label.classList.remove('hidden');
        });
        
        // Show edit icon on profile image
        document.querySelector('label[for="imageUpload"]').classList.remove('hidden');
        
        // Toggle buttons
        editBtn.classList.add('hidden');
        saveBtn.classList.remove('hidden');
    });

    // Image preview for profile image
    imageUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Remove the existing preview (whether it's an image or div)
                const existingPreview = document.getElementById('imagePreview');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                // Create new image element
                const img = document.createElement('img');
                img.id = 'imagePreview';
                img.src = event.target.result;
                img.className = 'w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg';
                
                // Insert the new image
                imagePreviewContainer.innerHTML = '';
                imagePreviewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    // Image preview for signature
    signatureUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // Remove the existing preview (whether it's an image or div)
                const existingPreview = document.getElementById('signaturePreview');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                // Create new image element
                const img = document.createElement('img');
                img.id = 'signaturePreview';
                img.src = event.target.result;
                img.className = 'w-full h-32 object-contain mx-auto mb-2';
                
                // Insert the new image
                signaturePreviewContainer.innerHTML = '';
                signaturePreviewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
</x-app-layout>