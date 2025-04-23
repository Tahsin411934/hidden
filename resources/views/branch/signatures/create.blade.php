@extends('branch.layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto mt-12 py-6 px-12 rounded-lg shadow-lg bg-gray-100 border border-blue-200">
        <h1 class="text-2xl font-bold mb-6 text-center">Administration Signature</h1>
        
        <!-- Signature Display/Upload Area -->
        <div class="flex flex-col items-center space-y-4">
            <!-- Preview Container -->
            <div id="signaturePreview" class="w-64 h-32 border-2 {{ $existingSignature ? 'border-solid border-blue-200' : 'border-dashed border-gray-300' }} rounded-lg flex items-center justify-center mb-4">
                @if($existingSignature)
                    <img src="{{ asset('storage/'.$existingSignature->signature_image_path) }}" alt="Admin Signature" class="max-h-full max-w-full object-contain">
                @else
                    <span class="text-gray-500">No signature found</span>
                @endif
            </div>
            
            <!-- Upload Form -->
            <form id="signatureForm" class="w-full space-y-4" enctype="multipart/form-data">
                @csrf
                
               
                
                <div>
                    <label for="signature" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $existingSignature ? 'Update Signature Image' : 'Upload Signature Image' }}
                    </label>
                    <input type="file" name="signature" id="signature" accept="image/jpeg,image/png,image/jpg,image/gif" class="w-full p-2 rounded border border-gray-300">
                    <span id="signature_error" class="text-red-500 text-xs mt-1"></span>
                    <p class="text-xs text-gray-500 mt-1">Allowed formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                </div>
                
                <button type="button" onclick="submitSignatureForm()" class="w-full bg-[#006172] text-white p-2 rounded hover:bg-[#004d5a]">
                    <span id="submitText">{{ $existingSignature ? 'Update Signature' : 'Upload Signature' }}</span>
                    <span id="loadingSpinner" class="hidden animate-spin">⏳</span>
                </button>
            </form>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // DOM Elements
    const signatureForm = document.getElementById('signatureForm');
    const signatureInput = document.getElementById('signature');
    const signaturePreview = document.getElementById('signaturePreview');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    // Preview image when file is selected
    signatureInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            updatePreview(URL.createObjectURL(this.files[0]));
        }
    });
    
    // Update preview container
    function updatePreview(imageUrl) {
        signaturePreview.innerHTML = '';
        signaturePreview.classList.remove('border-dashed', 'border-gray-300');
        signaturePreview.classList.add('border-solid', 'border-blue-200');
        
        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = 'Signature Preview';
        img.className = 'max-h-full max-w-full object-contain';
        signaturePreview.appendChild(img);
    }
    
    // Reset form completely
    function resetForm() {
        // Clear file input
        signatureInput.value = '';
        
        // Reset preview
        signaturePreview.innerHTML = '<span class="text-gray-500">No signature found</span>';
        signaturePreview.classList.remove('border-solid', 'border-blue-200');
        signaturePreview.classList.add('border-dashed', 'border-gray-300');
        
        // Clear errors
        document.getElementById('signature_error').textContent = '';
    }
    
    // Submit the form
    function submitSignatureForm() {
        if (!signatureInput.files[0]) {
            Swal.fire({
                icon: 'error',
                title: 'No File Selected',
                text: 'Please select a signature image to upload',
                customClass: {
                    confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                }
            });
            return;
        }
        
        // Show loading state
        submitText.classList.add('hidden');
        loadingSpinner.classList.remove('hidden');
        
        const formData = new FormData(signatureForm);
        
        axios.post("{{ route('branchsignatures.store') }}", formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.data.message,
                customClass: {
                    confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                }
            }).then(() => {
                // Update the UI to show it's now an update operation
                submitText.textContent = 'Update Signature';
                
                // Update preview with the new uploaded image
                updatePreview(response.data.signature_url);
                
                // Reset form (keeps the preview of the newly uploaded image)
                signatureInput.value = '';
            });
        })
        .catch(error => {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                
                if (errors.signature) {
                    document.getElementById('signature_error').textContent = errors.signature[0];
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please correct the errors in the form',
                    customClass: {
                        confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                    }
                });
                
                // Reset preview if validation fails
                resetForm();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Upload Failed',
                    text: error.response?.data?.message || 'An unexpected error occurred. Please try again.',
                    customClass: {
                        confirmButton: 'bg-blue-800 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300'
                    }
                });
                
                // Reset preview if other error occurs
                resetForm();
            }
        })
        .finally(() => {
            // Reset loading state
            submitText.classList.remove('hidden');
            loadingSpinner.classList.add('hidden');
        });
    }
</script>
@endsection