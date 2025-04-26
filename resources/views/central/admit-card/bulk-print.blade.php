<!DOCTYPE html>
<html>
<head>
    <title>Bulk Admit Cards</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .admit-card {
            margin-bottom: 20px;
            border: 1px solid #000;
            padding: 20px;
        }
    </style>
</head>
<body>
    @foreach($students as $student)
        <div class="admit-card">
            <h2>Admit Card for {{ $student->name }}</h2>
            <!-- Your admit card design here -->
            <p>Roll No: {{ $student->roll_no }}</p>
            <p>Registration No: {{ $student->registration_no }}</p>
            <p>Course: {{ $student->course->name }}</p>
            <p>Branch: {{ $student->branch->branch_name }}</p>
            <!-- Add more details as needed -->
        </div>
        
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
    
    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>