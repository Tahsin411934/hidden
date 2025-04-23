<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>YSDB Admit Card</title>
  <style>
    @page {
      size: A4;
      margin: 0;
    }
    body {
      font-family: "Merriweather", serif;
      margin-top: 10px;
      padding: 0;
      background: #fff;
      position: relative;
      height: 136.5mm; /* Half of A4 height */
      width: 210mm; /* A4 width */
      overflow: hidden;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    .admit-card {
      border: 4px solid #0f3d77;
      padding: 5px;
      width: 100%;
      height: 100%;
      box-sizing: border-box;
      position: relative;
      overflow: hidden;
    }
    .border-1{
      border: 2px solid #0f3d77;
      height: calc(100% - 10px);
    }
    .center {
      text-align: center;
      padding-top: 10px;
    }
    .blue-text {
      color: #0f3d77;
      font-weight: bold;
      font-size: 33px;
      margin: 0px;
      font-family: "Poppins", sans-serif;
      line-height: 1.2;
    }
    .sub-title {
      font-weight: 600;
      margin: 0px;
      font-size: 18px;
    }
    .branch-text{
      font-weight: 600;
      margin-top: 5px;
      font-size: 18px;
    }
    .green-text {
      color: green;
      font-weight: bold;
      margin: 0px;
      font-size: 19px;
    }
    .red-text {
      color: red;
      font-weight: bold;
      margin: 0px;
      font-size: 18px;
    }
    .admit-label {
      font-family: "Poppins", sans-serif;
      display: inline-block;
      background: #0f3d77 !important;
      color: white !important;
      padding: 0px 10px;
      font-weight: bold;
      margin-top: 5px;
      border-radius: 35px;
      font-size: 16px;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    .row {
      display: flex;
      margin-top: 15px;
      padding: 0px 15px;
    }
    .col-left {
      width: 58%;
    }
    .col-right {
      width: 40%;
    }
    .info-row {
      display: flex;
      margin-bottom: 8px;
      font-size: 13px;
    }
    .info-label-left {
      font-weight: bold;
      width: 110px;
    }
    .info-label-right {
      font-weight: bold;
      width: 140px;
    }
    .info-colon {
      width: 10px;
      text-align: center;
    }
    .info-value {
      margin-left: 5px;
      flex-grow: 1;
      /* border-bottom: 1px dotted #000; */
      min-height: 15px;
    }
    .photo-box {
      width: 90px;
      height: 110px;
      border: 1px solid #aaa;
      margin-left: auto;
      background: #eee;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      color: #666;
      margin-bottom: 25px;
      margin-right: 20px;
      margin-top: -20px;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
      overflow: hidden;
    }
    .photo-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .signature-section {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
      padding: 0 15px;
      font-size: 12px;
    }
    .signature-box {
      width: 30%;
      text-align: center;
    }
    .signature-img {
      height: 40px;
   
      object-fit: contain;
    }
    .signature-line {
      border-top: 1px solid #000;
     
      font-weight: bold;
    
    }
    .watermark {
      position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0.1;
      z-index: -1;
    }
    .watermark img {
      width: 200px;
      height: auto;
    }
    .logo{
      position: absolute;
      top: 60px;
      left: 15px;
    }
    .logo img {
      width: 110px;
      height: auto;
    }
    
    @media print {
      body {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
      .admit-label, .photo-box {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
    }
  </style>
</head>
<body>

<div class="admit-card">
  <div class="border-1">
    <div class="watermark">
      <img src="https://youthskill.com.bd/logo.png" alt="YSDB Logo">
    </div>
    <div class="logo">
      <img src="https://youthskill.com.bd/logo.png" alt="YSDB Logo">
    </div>
  
    <div class="center">
      <h1 class="blue-text">Youth Skill Development Bangladesh (YSDB)</h1>
     
      <div>
        <p class="sub-title">Government of the People's Republic of Bangladesh</p>
        <p class="green-text">Registration No: CH-16147/2025</p>
        <p class="red-text">www.youthskill.com.bd</p>
        <div class="admit-label">Admit Card</div>
      </div>
      <p class="branch-text">Name of Branch Institute: {{ $student->branch->branch_name }}</p>
    </div>

    <div class="row">
      <div class="col-left">
        <div class="info-row">
          <div class="info-label-left">Registration No</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->registration_no }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Roll No</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->roll_no }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Full Name</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->name }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Father's Name</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->father_name }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Mother's Name</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->mother_name }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Address</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->address }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Name of Course</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->course->name }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-left">Session</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $student->session }}</div>
        </div>
      </div>
      <div class="col-right">
        <div class="photo-box">
          @if(!empty($student->image))
            <img src="{{ asset('storage/' . str_replace('storage/', '', $student->image)) }}" alt="Student Photo">
          @else
            <span>Photo</span>
          @endif
        </div>
        @php
          date_default_timezone_set('Asia/Dhaka');
          $currentDateTime = date('d F Y');
        @endphp
        <div class="info-row">
          <div class="info-label-right">Date of Issue</div>
          <div class="info-colon">:</div>
          <div class="info-value">{{ $currentDateTime }}</div>
        </div>
        <div class="info-row">
          <div class="info-label-right">Date of Examination</div>
          <div class="info-colon">:</div>
          <div class="info-value">30 June 2025</div>
        </div>
      </div>
    </div>

    <div class="signature-section">
      <div class="signature-box">
        @if(!empty($student->signature))
          <img class="signature-img" src="{{ asset('storage/' . str_replace('storage/', '', $student->signature)) }}" alt="Signature">
        @endif
        <div class="signature-line">Signature of Candidate</div>
      </div>
      <div class="signature-box">
        @if(!empty($institute_head_signature))
          <img class="signature-img" src="{{ asset('storage/' . str_replace('storage/', '', $institute_head_signature)) }}" alt="Head Signature">
        @endif
        <div class="signature-line">Head of Institute</div>
      </div>
      <div class="signature-box">
        @if(!empty($exam_controller_signature))
          <img class="signature-img" src="{{ asset('storage/' . str_replace('storage/', '', $exam_controller_signature)) }}" alt="Controller Signature">
        @endif
        <div class="signature-line">Controller of Exam</div>
      </div>
    </div>
  </div>
</div>

<script>
// Auto print and close
window.onload = function() {
    setTimeout(function() {
        window.focus();
        window.print();
        
        // Attempt to close after printing
        setTimeout(function() {
            window.close();
        }, 500);
    }, 500);
};

// Fallback for browsers that block window.close()
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        window.close();
    }
});
</script>
</body>
</html>