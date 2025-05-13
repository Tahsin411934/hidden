<x-guest-layout>
    <section class="bg-gray-100 text-gray-800  font-sans">
    <div class="container w-[85%] mt-1  flex flex-col-reverse lg:flex-row items-center lg:py-18 justify-between gap-8 px-6 py-5 mx-auto">
        <!-- Text Content -->
        <div class="flex flex-col justify-center text-center lg:text-left lg:max-w-xl">
            <h1 class="text-2xl md:text-[35px] font-bold text-[#045E7B] leading-tight tracking-tight">
                Youth Skill Development Bangladesh
            </h1>
            <h2 class="text-base text-[#F37021] md:text-lg font-medium mt-3 tracking-normal">
                Approved by the Government of the People's Republic of Bangladesh
            </h2>

            <p class="text-gray-700 text-base md:text-lg mt-6 mb-4 leading-relaxed">
                Offers hands-on training in <span class="font-bold text-gray-800">Computer, ICT, Mobile Servicing, Tailoring</span> & more — with certified, job-ready programs to build a skilled and self-reliant Bangladesh.
            </p>

            <blockquote class="text-gray-600 text-base md:text-lg mb-6 italic leading-relaxed">
                "Skills are the foundation of progress — <span class="font-medium not-italic">YSDB</span> builds that foundation."
            </blockquote>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:justify-start sm:items-center gap-4 mt-2">
                <a href="#" class="px-6 py-2.5 text-base font-medium rounded bg-[#045E7B] text-white hover:bg-[#03485f] transition duration-300">
                    Apply For a Branch
                </a>
                <a href="#" class="px-6 py-2.5 text-base font-medium border rounded border-gray-300 hover:bg-gray-50 transition duration-300 text-gray-700">
                    Learn More
                </a>
            </div>
        </div>

        <!-- Image Content -->
        <div class="flex justify-center items-center">
            <img src="assets/svg/Business_SVG.svg" alt="Skill Training Illustration" 
                 class="object-contain h-72 sm:h-80 lg:h-96 xl:h-[28rem]">
        </div>
    </div>
</section>
    <section>
        @include('frontend.components.courses')
    </section>
    <section>
        @include('frontend.components.successStudent')
    </section>
    <section>
        <div class="bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    <!-- Students Enrolled -->
                    <div class="p-6 rounded-lg bg-gray-200 border border-gray-300">
                        <div class="flex justify-center">
                            <i class="fas fa-users text-4xl text-blue-500 mb-4"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800">29.3K</h3>
                        <p class="mt-2 text-lg text-gray-600">STUDENTS ENROLLED</p>
                    </div>

                    <!-- Classes Completed -->
                    <div class="p-6 rounded-lg bg-gray-200 border border-gray-300">
                        <div class="flex justify-center">
                            <i class="fas fa-graduation-cap text-4xl text-blue-500 mb-4"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800">32.4K</h3>
                        <p class="mt-2 text-lg text-gray-600">CLASSES COMPLETED</p>
                    </div>

                    <!-- Satisfaction Rate -->
                    <div class="p-6 rounded-lg bg-gray-200 border border-gray-300">
                        <div class="flex justify-center">
                            <i class="fas fa-smile text-4xl text-blue-500 mb-4"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800">90%</h3>
                        <p class="mt-2 text-lg text-gray-600">SATISFACTION RATE</p>
                    </div>

                    <!-- Top Instructors -->
                    <div class="p-6 rounded-lg bg-gray-200 border border-gray-300">
                        <div class="flex justify-center">
                            <i class="fas fa-chalkboard-teacher text-4xl text-blue-500 mb-4"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800">190+</h3>
                        <p class="mt-2 text-lg text-gray-600">TOP INSTRUCTORS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Our Training Programs</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                Explore our hands-on training sessions and student achievements
            </p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Gallery Item 1 -->
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                     alt="Computer Training" 
                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold">Computer Training</h3>
                        <p class="mt-1 text-gray-200">Basic to advanced computer skills development</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1517430816045-df4b7de11d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                     alt="Mobile Servicing" 
                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold">Mobile Servicing</h3>
                        <p class="mt-1 text-gray-200">Hands-on mobile repair and maintenance training</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                     alt="Tailoring Class" 
                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold">Tailoring Class</h3>
                        <p class="mt-1 text-gray-200">Professional garment design and sewing techniques</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                     alt="Student Workshop" 
                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold">Student Workshop</h3>
                        <p class="mt-1 text-gray-200">Collaborative learning environment</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 5 -->
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                     alt="ICT Training" 
                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold">ICT Training</h3>
                        <p class="mt-1 text-gray-200">Information and communication technology skills</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 6 -->
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" 
                     alt="Graduation Ceremony" 
                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                    <div class="text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold">Graduation Ceremony</h3>
                        <p class="mt-1 text-gray-200">Celebrating our students' achievements</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- View More Button -->
        <div class="text-center mt-12">
            <button class="px-6 py-3 bg-[#045E7B] text-white font-medium rounded-md hover:bg-[#03485f] transition duration-300 inline-flex items-center">
                View Full Gallery
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</section>
</x-guest-layout>