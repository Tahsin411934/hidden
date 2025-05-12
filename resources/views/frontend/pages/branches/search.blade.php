<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Filter Section with Colorful Header -->
        <div class="bg-gradient-to-r from-[#003E59] to-[#F37021] rounded-lg shadow-md p-1 mb-6">
            <div class="bg-white rounded-lg p-5">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-[#003E59]">Branch Locator</h2>
                        <p class="text-xs text-gray-600 mt-1">Find branches by division and district</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 flex-1">
                        <!-- Division Filter -->
                        <div>
                            <label class="block text-xs font-medium text-[#003E59] mb-1">Division</label>
                            <select id="divisionFilter"
                                class="w-full rounded border border-[#003E59]/30 focus:border-[#003E59] focus:ring-[#003E59] py-1.5 px-3 text-xs h-9">
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District Filter -->
                        <div>
                            <label class="block text-xs font-medium text-[#003E59] mb-1">District</label>
                            <select id="districtFilter"
                                class="w-full rounded border border-[#003E59]/30 focus:border-[#003E59] focus:ring-[#003E59] py-1.5 px-3 text-xs h-9"
                                disabled>
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <!-- Reset Button -->
                        <div class="flex items-end">
                            <button id="resetFilters"
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-bold rounded shadow-sm text-white bg-[#F37021] hover:bg-[#E0651C] focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-[#F37021] h-9 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branches Cards Container -->
        <div id="branchesContainer">
            <!-- Initial State Message -->
            <div id="selectBothMessage" class="bg-white rounded-lg shadow-md border border-[#003E59]/20 p-6 text-center">
                <div class="w-16 h-16 mx-auto bg-[#003E59]/10 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#003E59]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="mt-4 text-sm font-bold text-[#003E59]">Select Division and District</h3>
                <p class="mt-2 text-xs text-gray-600">Please select both division and district to view branch details</p>
                <div class="mt-4 h-1 w-16 mx-auto bg-gradient-to-r from-[#003E59] to-[#F37021] rounded-full"></div>
            </div>

            <!-- No Results Message -->
            <div id="noResultsMessage" class="bg-white rounded-lg shadow-md border border-[#F37021]/20 p-6 text-center hidden">
                <div class="w-16 h-16 mx-auto bg-[#F37021]/10 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#F37021]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-sm font-bold text-[#F37021]">No Branches Found</h3>
                <p class="mt-2 text-xs text-gray-600">No branches match the selected criteria</p>
                <div class="mt-4 h-1 w-16 mx-auto bg-gradient-to-r from-[#F37021] to-[#003E59] rounded-full"></div>
            </div>

            <!-- Branches Grid - Single Column -->
            <div id="branchesGrid" class="hidden grid grid-cols-1 gap-5">
                @foreach($branches as $branch)
                <div class="branch-card bg-white rounded-lg shadow-md overflow-hidden border border-[#003E59]/20 hover:shadow-lg transition-all duration-300 group"
                    data-division="{{ $branch->division_id }}" data-district="{{ $branch->district_id }}">
                    <!-- Branch Header with Gradient Border -->
                    <div class="border-b border-[#003E59]/10 p-5 pb-4 bg-gradient-to-r from-white to-[#003E59]/5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-bold text-[#003E59] group-hover:text-[#F37021] transition-colors truncate">
                                        {{ $branch->branch_name }}
                                    </h3>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-[#F37021]/10 text-[#F37021] border border-[#F37021]/20">
                                        Branch #{{ $branch->id }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Contact Button -->
                            <a href="tel:{{ $branch->phone }}" class="inline-flex items-center justify-center px-3 py-1.5 border border-transparent text-xs font-bold rounded shadow-sm text-white bg-[#F37021] hover:bg-[#E0651C] whitespace-nowrap transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Call Now
                            </a>
                        </div>
                    </div>
                    
                    <!-- Branch Details - Colorful Grid -->
                    <div class="p-5 pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                            <!-- Location -->
                            <div class="flex items-start p-3 bg-[#003E59]/5 rounded-lg">
                                <div class="w-8 h-8 bg-[#003E59]/10 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#003E59]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#003E59] text-xs uppercase tracking-wider mb-1">Location</p>
                                    <p class="text-gray-800">{{ $branch->division_name }}, {{ $branch->district_name }}</p>
                                    <p class="text-gray-600 text-xs mt-1">{{ $branch->address }}</p>
                                </div>
                            </div>
                            
                            <!-- Contact Info -->
                            <div class="flex items-start p-3 bg-[#F37021]/5 rounded-lg">
                                <div class="w-8 h-8 bg-[#F37021]/10 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#F37021]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#F37021] text-xs uppercase tracking-wider mb-1">Contact</p>
                                    <p class="text-gray-800">{{ $branch->phone }}</p>
                                    @if($branch->email)
                                    <p class="text-gray-600 text-xs mt-1">{{ $branch->email }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Regional Director -->
                            @if($branch->regional_director)
                            <div class="flex items-start p-3 bg-[#003E59]/5 rounded-lg">
                                <div class="w-8 h-8 bg-[#003E59]/10 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#003E59]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#003E59] text-xs uppercase tracking-wider mb-1">Director</p>
                                    <p class="text-gray-800">{{ $branch->regional_director }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Established Date -->
                            <div class="flex items-start p-3 bg-[#F37021]/5 rounded-lg">
                                <div class="w-8 h-8 bg-[#F37021]/10 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#F37021]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#F37021] text-xs uppercase tracking-wider mb-1">Established</p>
                                    <p class="text-gray-800">{{ $branch->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const divisionFilter = document.getElementById('divisionFilter');
        const districtFilter = document.getElementById('districtFilter');
        const resetFilters = document.getElementById('resetFilters');
        const branchCards = document.querySelectorAll('.branch-card');
        const selectBothMessage = document.getElementById('selectBothMessage');
        const noResultsMessage = document.getElementById('noResultsMessage');
        const branchesGrid = document.getElementById('branchesGrid');

        // Division filter change event
        divisionFilter.addEventListener('change', function() {
            const divisionId = this.value;
            
            // Reset district filter
            districtFilter.innerHTML = '<option value="">Select District</option>';
            districtFilter.disabled = !divisionId;

            if (divisionId) {
                // Show loading in district dropdown
                districtFilter.innerHTML = '<option value="">Loading...</option>';

                // Fetch districts for the selected division
                fetch(`/get-districts/${divisionId}`)
                    .then(response => response.json())
                    .then(data => {
                        districtFilter.innerHTML = '<option value="">Select District</option>';
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtFilter.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading districts:', error);
                        districtFilter.innerHTML = '<option value="">Error loading</option>';
                    });
            }

            checkFilters();
        });

        // District filter change event
        districtFilter.addEventListener('change', checkFilters);

        // Reset filters event
        resetFilters.addEventListener('click', function() {
            divisionFilter.value = '';
            districtFilter.innerHTML = '<option value="">Select District</option>';
            districtFilter.disabled = true;
            
            // Reset to initial state
            hideAllBranches();
            noResultsMessage.classList.add('hidden');
            selectBothMessage.classList.remove('hidden');
            branchesGrid.classList.add('hidden');
        });

        // Check filters and show appropriate content
        function checkFilters() {
            const divisionId = divisionFilter.value;
            const districtId = districtFilter.value;
            let hasVisibleCards = false;

            // Hide all messages initially
            selectBothMessage.classList.add('hidden');
            noResultsMessage.classList.add('hidden');
            branchesGrid.classList.add('hidden');

            // If both filters are selected, show matching branches
            if (divisionId && districtId) {
                branchCards.forEach(card => {
                    const matchesDivision = card.dataset.division === divisionId;
                    const matchesDistrict = card.dataset.district === districtId;

                    if (matchesDivision && matchesDistrict) {
                        card.style.display = '';
                        hasVisibleCards = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (hasVisibleCards) {
                    branchesGrid.classList.remove('hidden');
                } else {
                    noResultsMessage.classList.remove('hidden');
                }
            } 
            // If only one filter is selected, show instruction message
            else if (divisionId || districtId) {
                selectBothMessage.classList.remove('hidden');
                selectBothMessage.querySelector('h3').textContent = 'Please select both Division and District';
                selectBothMessage.querySelector('p').textContent = 'You need to select both filters to view branches';
            }
            // If no filters are selected, show initial instruction
            else {
                selectBothMessage.classList.remove('hidden');
                selectBothMessage.querySelector('h3').textContent = 'Select Division and District';
                selectBothMessage.querySelector('p').textContent = 'Please select both division and district to view branch details';
            }
        }

        // Helper function to hide all branch cards
        function hideAllBranches() {
            branchCards.forEach(card => {
                card.style.display = 'none';
            });
        }
    });
    </script>
</x-guest-layout>