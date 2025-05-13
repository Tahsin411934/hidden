<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notices') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Create Notice Button -->
            <div class="mb-6">
                <a href="{{ route('notices.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Create New Notice') }}
                </a>
            </div>

            <!-- Notices List -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($notices->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">No notices found.</p>
                    @else
                        <div class="space-y-8">
                            @foreach($notices as $notice)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $notice->title }}</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $notice->created_at->format('M d, Y h:i A') }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('notices.edit', $notice->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                Edit
                                            </a>
                                            <form action="{{ route('notices.destroy', $notice->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this notice?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Notice Body with proper table styling -->
                                    <div class="mt-4 notice-content">
                                        {!! $notice->body !!}
                                    </div>

                                    <!-- PDF Attachment -->
                                    @if($notice->pdf_path)
                                        <div class="mt-4">
                                            <a href="{{ Storage::url($notice->pdf_path) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                View PDF Attachment
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $notices->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        /* Notice content styling */
        .notice-content {
            color: #1a202c;
            font-size: 1rem;
            line-height: 1.5;
        }
        
        /* Table styling with visible borders */
        .notice-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            border: 1px solid #d1d5db;
        }
        .notice-content table th,
        .notice-content table td {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
        }
        .notice-content figure.table {
            margin: 1rem 0;
            overflow-x: auto;
        }
        
        /* Dark mode styles */
        .dark .notice-content {
            color: #f3f4f6;
        }
        .dark .notice-content table {
            border-color: #4b5563;
        }
        .dark .notice-content table th,
        .dark .notice-content table td {
            border-color: #4b5563;
        }
    </style>
    @endpush
</x-app-layout>