<x-guest-layout>
    <section class="bg-white text-gray-800 w-[85%] mt-1 mx-auto font-sans">
    <div class="container flex flex-col-reverse lg:flex-row items-center lg:py-18 justify-between gap-8 px-6 py-5 mx-auto">
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
</x-guest-layout>