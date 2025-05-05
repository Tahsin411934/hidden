<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Information Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-[#006172]">Add Marks for {{ $student->name }}</h2>
                    <a href="{{ route('students.show', $student->id) }}" class="text-[#006172] hover:text-[#004d5a] font-medium">
                        ← Back to Profile
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-semibold text-lg mb-2 text-[#006172]">Student Details</h3>
                        <p class="text-gray-700"><span class="font-medium">Name:</span> {{ $student->name }}</p>
                        <p class="text-gray-700"><span class="font-medium">Roll:</span> {{ $student->roll_no }}</p>
                        <p class="text-gray-700"><span class="font-medium">Registration:</span> {{ $student->registration_no }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-semibold text-lg mb-2 text-[#006172]">Academic Information</h3>
                        <p class="text-gray-700"><span class="font-medium">Session:</span> {{ $student->session ?? 'N/A' }} - {{ $student->year ?? 'N/A' }}</p>
                        <p class="text-gray-700"><span class="font-medium">Course:</span> {{ $student->course->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded">
                        {!! session('error') !!}
                    </div>
                @endif
            <!-- Marks Entry Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <form method="POST" action="{{ route('marks.store') }}" id="marksForm">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="course_id" value="{{ $student->course->id }}">

                    <!-- Course Display -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
                        <div class="mt-1 p-2 w-full border border-gray-200 bg-gray-50 rounded-md text-gray-700">
                            {{ $student->course->code }} - {{ $student->course->name }}
                        </div>
                    </div>

                    <!-- Evaluation Table -->
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[#006172] text-white">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Component</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Total Marks</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Obtained Marks</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Percentage</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Academic Assessment -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">Academic Assessment</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500">300</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <input type="number" name="academic_assessment" id="academic" class="mark-input w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-[#006172] focus:border-[#006172]" min="0" max="300" step="0.01" value="{{ old('academic_assessment', 0) }}" required>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                        <span id="academic_percent" class="percentage">0%</span>
                                    </td>
                                </tr>
                                
                                <!-- Written Exam -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">Written Exam</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500">50</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <input type="number" name="written" id="written" class="mark-input w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-[#006172] focus:border-[#006172]" min="0" max="50" step="0.01" value="{{ old('written', 0) }}" required>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                        <span id="written_percent" class="percentage">0%</span>
                                    </td>
                                </tr>
                                
                                <!-- Practical -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">Practical</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500">40</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <input type="number" name="practical" id="practical" class="mark-input w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-[#006172] focus:border-[#006172]" min="0" max="40" step="0.01" value="{{ old('practical', 0) }}" required>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                        <span id="practical_percent" class="percentage">0%</span>
                                    </td>
                                </tr>
                                
                                <!-- Viva -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">Viva</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500">10</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <input type="number" name="viva" id="viva" class="mark-input w-full px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-[#006172] focus:border-[#006172]" min="0" max="10" step="0.01" value="{{ old('viva', 0) }}" required>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                        <span id="viva_percent" class="percentage">0%</span>
                                    </td>
                                </tr>
                                
                                <!-- Totals -->
                                <tr class="bg-gray-100 font-semibold">
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-900">Total</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">400</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="w-full px-2 py-1 bg-gray-200 rounded text-gray-800" id="total_marks_display">0.00</div>
                                        <input type="hidden" id="total_marks" name="total_marks" value="0">
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-800">
                                        <span id="total_percent">0%</span>
                                    </td>
                                </tr>
                                
                                <!-- Final Grade & GPA -->
                                <tr class="bg-[#f0f9fa]">
                                    <td class="px-4 py-3 whitespace-nowrap font-bold text-[#006172]" colspan="2">Final Grade</td>
                                    <td class="px-4 py-3 whitespace-nowrap" colspan="2">
                                        <div class="w-full px-2 py-1 bg-white border border-[#006172] rounded text-center font-bold text-[#006172]" id="grade_display">-</div>
                                        <input type="hidden" id="grade" name="grade" value="">
                                    </td>
                                </tr>
                                <tr class="bg-[#f0f9fa]">
                                    <td class="px-4 py-3 whitespace-nowrap font-bold text-[#006172]" colspan="2">GPA</td>
                                    <td class="px-4 py-3 whitespace-nowrap" colspan="2">
                                        <div class="w-full px-2 py-1 bg-white border border-[#006172] rounded text-center font-bold text-[#006172]" id="gpa_display">-</div>
                                        <input type="hidden" id="gpa" name="gpa" value="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-[#006172] border border-transparent rounded-md font-medium text-white hover:bg-[#004d5a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#006172] transition">
                            Save Marks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const markInputs = document.querySelectorAll('.mark-input');
            
            markInputs.forEach(input => {
                input.addEventListener('input', calculateResults);
                input.addEventListener('change', calculateResults);
            });
            
            calculateResults();
            
            function calculateResults() {
                const academic = parseFloat(document.getElementById('academic').value) || 0;
                const written = parseFloat(document.getElementById('written').value) || 0;
                const practical = parseFloat(document.getElementById('practical').value) || 0;
                const viva = parseFloat(document.getElementById('viva').value) || 0;
                
                const academicPercent = (academic / 300) * 100;
                const writtenPercent = (written / 50) * 100;
                const practicalPercent = (practical / 40) * 100;
                const vivaPercent = (viva / 10) * 100;
                
                document.getElementById('academic_percent').textContent = academicPercent.toFixed(2) + '%';
                document.getElementById('written_percent').textContent = writtenPercent.toFixed(2) + '%';
                document.getElementById('practical_percent').textContent = practicalPercent.toFixed(2) + '%';
                document.getElementById('viva_percent').textContent = vivaPercent.toFixed(2) + '%';
                
                const totalMarks = academic + written + practical + viva;
                const totalPercent = (totalMarks / 400) * 100;
                
                document.getElementById('total_marks_display').textContent = totalMarks.toFixed(2);
                document.getElementById('total_marks').value = totalMarks.toFixed(2);
                document.getElementById('total_percent').textContent = totalPercent.toFixed(2) + '%';
                
                const { grade, gpa } = calculateGradeAndGPA(totalPercent);
                
                document.getElementById('grade_display').textContent = grade;
                document.getElementById('grade').value = grade;
                document.getElementById('gpa_display').textContent = gpa;
                document.getElementById('gpa').value = gpa;
            }
            
            function calculateGradeAndGPA(percentage) {
                let grade, gpa;
                
                if (percentage >= 80) {
                    grade = 'A+';
                    gpa = '5.00';
                } else if (percentage >= 70) {
                    grade = 'A';
                    gpa = '4.00';
                } else if (percentage >= 60) {
                    grade = 'A-';
                    gpa = '3.50';
                } else if (percentage >= 50) {
                    grade = 'B';
                    gpa = '3.00';
                } else if (percentage >= 40) {
                    grade = 'B';
                    gpa = '2.00';
                } else if (percentage >= 33) {
                    grade = 'B-';
                    gpa = '1.00';
                } else {
                    grade = 'F';
                    gpa = '0.00';
                }
                
                return { grade, gpa };
            }
        });
    </script>
</x-app-layout>