<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{
    activeTab: '{{ $categories->first()->id }}',
    transitioning: false,
    changeTab(tabId) {
        this.transitioning = true;
        setTimeout(() => {
            this.activeTab = tabId;
            setTimeout(() => this.transitioning = false, 150);
        }, 150);
    }
}">
    <div class="pb-12">
        <h1 class="text-center font-bold text-3xl text-[#006172]">Our Popular Courses</h1>
        <p class="text-center lg:w-[40%] mx-auto text-[#778e92]">Our course curriculum is structured with well timed
            courses, which will prepare you to work globally.</p>
    </div>

    <!-- Tab Navigation -->
    <div class="border-b border-gray-200 mb-8">
        <nav class="-mb-px flex space-x-8 overflow-x-auto pb-2 scrollbar-hide" aria-label="Tabs">
            @foreach($categories as $category)
            <button @click="changeTab('{{ $category->id }}')" :class="{ 
                    'border-[#006172] text-[#006172]': activeTab === '{{ $category->id }}' && !transitioning,
                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== '{{ $category->id }}' || transitioning
                }"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm focus:outline-none transition-all duration-300 ease-in-out"
                :disabled="transitioning">
                {{ $category->name }}
            </button>
            @endforeach
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="py-2 relative min-h-[400px]">
        @foreach($categories as $category)
        <div x-show="activeTab === '{{ $category->id }}'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" class="absolute inset-0">
            @if($category->courses->isEmpty())
            <div class="text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No courses available</h3>
                <p class="mt-1 text-sm text-gray-500">We don't have any courses in this category yet.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($category->courses->take(3) as $course)
                <div
                    class="bg-white rounded-xl shadow-sm overflow-hidden  transition-all duration-300 border border-gray-300 flex flex-col h-full">
                    <!-- Course Image -->
                    <div class="h-48 bg-[#006172] bg-opacity-10 flex items-center justify-center overflow-hidden">
                        @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#006172] opacity-30" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        @endif
                    </div>

                    <!-- Course Content -->
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex-grow">

                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $course->name }}</h3>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('courses.show', $course) }}"
                                    class="inline-flex items-center text-[#006172] hover:text-[#004956] font-medium transition-colors duration-200">
                                    View details
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                                <span class="text-sm text-gray-500">
                                    Added {{ $course->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
        
    </div>
    </div>
    <div class="text-center -mt-12">
        <a href="#"
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#006172] hover:bg-[#004956] transition-colors duration-300">
            View all Courses
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</section>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

[x-cloak] {
    display: none !important;
}
</style>