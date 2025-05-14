<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notice Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Title Section -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $notice->title }}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Posted on {{ $notice->created_at->format('M d, Y h:i A') }}
                        </p>
                    </div>

                    <!-- Body Content -->
                    <div class="notice-body mb-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        {!! $notice->body !!}
                    </div>

                    <!-- PDF Viewer Section -->
                    @if($notice->pdf_path)
                        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">PDF Attachment</h3>
                            <div class="flex flex-col space-y-4">
                                <!-- PDF Viewer -->
                                <div class="w-full h-[600px] bg-gray-100 dark:bg-gray-900 rounded-lg overflow-hidden">
                                    <iframe 
                                        src="{{ Storage::url($notice->pdf_path) }}#toolbar=0&view=fitH" 
                                        class="w-full h-full" 
                                        frameborder="0"
                                    >
                                        Your browser does not support PDFs. 
                                        <a href="{{ Storage::url($notice->pdf_path) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                            Download the PDF instead.
                                        </a>
                                    </iframe>
                                </div>
                                
                                <!-- Download Button -->
                                <div class="flex justify-end">
                                    <a 
                                        href="{{ Storage::url($notice->pdf_path) }}" 
                                        download
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a 
                            href="/recent/notice" 
                            class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            Back to Notices
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* Notice body styling */
        .notice-body {
            color: #1a202c;
            font-size: 1rem;
            line-height: 1.6;
        }
        
        .notice-body p {
            margin-bottom: 1rem;
        }
        
        /* Table styling */
        .notice-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            border: 1px solid #d1d5db;
        }
        
        .notice-body table th,
        .notice-body table td {
            border: 1px solid #d1d5db;
            padding: 0.75rem;
        }
        
        /* Dark mode styles */
        .dark .notice-body {
            color: #f3f4f6;
        }
        
        .dark .notice-body table {
            border-color: #4b5563;
        }
        
        .dark .notice-body table th,
        .dark .notice-body table td {
            border-color: #4b5563;
        }
    </style>
    @endpush
    </x-guest-layout>