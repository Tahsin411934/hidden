<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>YSDB Cards</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <style>
    @page {
      size: A4;
      margin: 0;
    }
    
    /* Common Styles */
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background: #f5f5f5;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .card-container {
      display: flex;
      flex-direction: column;
      gap: 30px;
      margin-bottom: 100px;
    }
    
    .download-buttons {
      position: fixed;
      bottom: 20px;
      right: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      z-index: 1000;
      background: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    
    .download-btn {
      padding: 10px 15px;
      background-color: #0f3d77;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      font-size: 14px;
      white-space: nowrap;
    }
    
    .download-btn:hover {
      background-color: #0c2f5a;
    }
    
    .btn-group {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }
    
    .btn-group-title {
      font-weight: bold;
      color: #0f3d77;
      text-align: center;
      margin-bottom: 5px;
    }
    
    /* Admit Card Styles */
    .admit-card-page {
      font-family: "Merriweather", serif;
      margin: 0 auto;
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
    
    /* Registration Card Styles */
    .registration-card-page {
      font-family: "Poppins", sans-serif;
      margin: 20px auto 0;
      padding: 0;
      background: #fff;
      position: relative;
      height: 297mm; /* A4 height */
      width: 210mm; /* A4 width */
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    
    .registration-card {
      border: 5px solid #0f3d77;
      padding: 15px;
      width: calc(100% - 30px);
      height: calc(100% - 30px);
      box-sizing: border-box;
      position: relative;
      overflow: hidden;
    }
    
    .header {
      text-align: center;
      border-bottom: 2px solid #0f3d77;
      padding-bottom: 10px;
      margin-bottom: 20px;
      position: relative;
    }
    
    .reg-logo {
      position: absolute;
      left: 10px;
      top: 35px;
    }
    
    .reg-logo img {
      height: 80px;
    }
    
    .header-text {}
    
    .institute-name {
      color: #0f3d77;
      font-weight: 700;
      font-size: 31px;
      margin: 0px 0;
      line-height: 1.2;
    }
    
    .govt-text {
      font-weight: 600;
      font-size: 16px;
      margin: 5px 0;
    }
    
    .reg-no {
      color: green;
      font-weight: 600;
      font-size: 16px;
      margin: 5px 0;
    }
    
    .website {
      color: #0f3d77;
      font-weight: 600;
      font-size: 16px;
      margin: 5px 0;
    }
    
    .card-title {
      background-color: #0f3d77;
      color: white;
      padding: 8px;
      text-align: center;
      font-weight: 700;
      font-size: 20px;
      margin: 15px 0;
      border-radius: 5px;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
    }
    
    .content {
      display: flex;
      margin-bottom: 20px;
    }
    
    .left-section {
      width: 65%;
      padding-right: 15px;
    }
    
    .right-section {
      width: 35%;
    }
    
    .reg-info-label {
      font-weight: 600;
      width: 150px;
      min-width: 150px;
    }
    
    .reg-info-colon {
      width: 10px;
    }
    
    .reg-info-value {
      flex-grow: 1;
      padding-left: 5px;
      min-height: 18px;
    }
    
    .photo-section {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      margin-bottom: 15px;
    }
    
    .reg-photo-box {
      width: 120px;
      height: 150px;
      border: 1px solid #aaa;
      margin: 0 auto;
      background: #f5f5f5;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    
    .reg-photo-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .photo-label {
      font-size: 12px;
      margin-top: 5px;
    }
    
    .reg-signature-box {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      height: 80px;
      margin-bottom: 5px;
    }
    
    .reg-signature-box img {
      height: 60px;
      max-width: 100%;
      object-fit: contain;
    }
    
    .signature-label {
      font-size: 12px;
      border-top: 1px solid #333;
      margin-top: 5px;
      padding-top: 3px;
      font-weight: 600;
    }
    
    .footer {
      margin-top: 30px;
      font-size: 12px;
      text-align: center;
      border-top: 2px solid #0f3d77;
      padding-top: 10px;
    }
    
    .reg-watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0.1;
      z-index: -1;
    }
    
    .reg-watermark img {
      width: 300px;
    }
    
    .barcode {
      text-align: center;
      margin-top: 10px;
      font-family: 'Libre Barcode 39', cursive;
      font-size: 30px;
    }
    
    .terms {
      font-size: 11px;
      margin-top: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      line-height: 1.4;
    }
    
    .terms-title {
      font-weight: 700;
      margin-bottom: 5px;
      text-decoration: underline;
      color: #0f3d77;
    }
    
    .terms ol {
      padding-left: 20px;
      margin: 5px 0;
    }
    
    .terms li {
      margin-bottom: 3px;
    }
    
    @media print {
      body {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        background: white;
      }
      
      .admit-label, .photo-box, .card-title, .reg-photo-box {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
      
      .download-buttons {
        display: none;
      }
      
      .container {
        padding: 0;
      }
      
      .card-container {
        gap: 0;
        margin-bottom: 0;
      }
      
      .registration-card-page {
        margin-top: 0;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card-container">
    <!-- Admit Card -->
    <div class="admit-card-page" id="admit-card">
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
    </div>

    <!-- Registration Card -->
    <div class="registration-card-page" id="registration-card">
      <div class="registration-card">
        <div class="reg-watermark">
          <img src="https://youthskill.com.bd/logo.png" alt="YSDB Watermark">
        </div>

        <div class="header">
          <div class="reg-logo">
            <img src="https://youthskill.com.bd/logo.png" alt="YSDB Logo">
          </div>
          <div class="header-text">
            <h1 class="institute-name">Youth Skill Development Bangladesh (YSDB)</h1>
            <p class="govt-text">Government of the People's Republic of Bangladesh</p>
            <p class="reg-no">Registration No: CH-16147/2025</p>
            <p class="website">www.youthskill.com.bd</p>
          </div>
        </div>

        <div class="card-title">STUDENT REGISTRATION CARD</div>

        <div class="content">
          <div class="left-section">
            <div class="info-row">
              <div class="reg-info-label">Registration Number</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->registration_no }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Roll Number</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->roll_no }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Full Name</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->name }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Father's Name</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->father_name }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Mother's Name</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->mother_name }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Date of Birth</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->dob }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Gender</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->gender }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">National ID</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->nid }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Address</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->address }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Contact Number</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->phone }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Email Address</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->email }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Course Name</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->course->name }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Branch Institute</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->branch->branch_name }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Session</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ $student->session }}</div>
            </div>
            <div class="info-row">
              <div class="reg-info-label">Registration Date</div>
              <div class="reg-info-colon">:</div>
              <div class="reg-info-value">{{ date('d F Y', strtotime($student->created_at)) }}</div>
            </div>
          </div>

          <div class="right-section">
            <div class="photo-section">
              <div class="reg-photo-box">
                @if(!empty($student->image))
                <img src="{{ asset('storage/' . str_replace('storage/', '', $student->image)) }}"
                  alt="Student Photo">
                @else
                <span>Student Photo</span>
                @endif
              </div>
              <div class="photo-label">3.5 cm × 4.5 cm</div>
            </div>

            <div class="reg-signature-box">
              @if(!empty($student->signature))
              <img src="{{ asset('storage/' . str_replace('storage/', '', $student->signature)) }}"
                alt="Student Signature">
              @endif
              <div class="signature-label">Student Signature</div>
            </div>

            <div class="reg-signature-box">
              @if(!empty($institute_head_signature))
              <img src="{{ asset('storage/' . str_replace('storage/', '', $institute_head_signature)) }}"
                alt="Authority Signature">
              @endif
              <div class="signature-label">Authorized Signature & Stamp</div>
            </div>

            <div class="barcode">
              *{{ $student->registration_no }}*
            </div>
          </div>
        </div>
        <div class="terms">
          <div class="terms-title">OFFICIAL POLICIES & REGULATIONS</div>
          <ol>
            <li>This registration card must be presented for all academic activities including examinations,
              practical tests, and certificate collection as per Bangladesh Technical Education Board
              (BTEB) guidelines.</li>
            <li>The card is non-transferable and any unauthorized use will result in disciplinary action
              under YSDB Academic Regulations 2025.</li>
            <li>Loss or damage of this card must be reported immediately to the institute authority with a
              written application and fee of ৳200 as per board policy.</li>
            <li>Students must maintain 75% attendance as per Bangladesh Education Policy to remain eligible
              for final examinations.</li>
            <li>All information must match with National ID Card/Birth Certificate. Discrepancies may result
              in cancellation of registration.</li>
            <li>Examination rules must be strictly followed. Any misconduct will lead to cancellation of
              candidature as per Bangladesh Public Examination Act.</li>
            <li>This card remains property of YSDB and must be surrendered upon request or
              completion/termination of the course.</li>
            <li>Certificate will only be issued after successful completion of all course requirements and
              clearance of all dues.</li>
          </ol>
        </div>
        <div class="footer">
          <div>© 2025 Youth Skill Development Bangladesh (YSDB). All Rights Reserved.</div>
          <div>For any queries, please contact: info@youthskill.com.bd | Phone: +880 XXXX-XXXXXX</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="download-buttons">
  <div class="btn-group">
    <div class="btn-group-title">Admit Card</div>
    <button class="download-btn" id="download-admit-pdf">Download PDF</button>
    <button class="download-btn" id="download-admit-image">Download Image</button>
  </div>
  
  <div class="btn-group">
    <div class="btn-group-title">Registration Card</div>
    <button class="download-btn" id="download-reg-pdf">Download PDF</button>
    <button class="download-btn" id="download-reg-image">Download Image</button>
  </div>
  
  
</div>

<script>
  // Admit Card Download Functions
  document.getElementById('download-admit-pdf').addEventListener('click', function() {
    const element = document.getElementById('admit-card');
    const opt = {
      margin: 0,
      filename: 'YSDB_Admit_Card.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
  });

  document.getElementById('download-admit-image').addEventListener('click', function() {
    const element = document.getElementById('admit-card');
    
    html2canvas(element, {
      scale: 2,
      logging: false,
      useCORS: true,
      allowTaint: true
    }).then(function(canvas) {
      const link = document.createElement('a');
      link.download = 'YSDB_Admit_Card.jpeg';
      link.href = canvas.toDataURL('image/jpeg', 1.0);
      link.click();
    });
  });

  // Registration Card Download Functions
  document.getElementById('download-reg-pdf').addEventListener('click', function() {
    const element = document.getElementById('registration-card');
    const opt = {
      margin: 0,
      filename: 'YSDB_Registration_Card.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
  });

  document.getElementById('download-reg-image').addEventListener('click', function() {
    const element = document.getElementById('registration-card');
    
    html2canvas(element, {
      scale: 2,
      logging: false,
      useCORS: true,
      allowTaint: true
    }).then(function(canvas) {
      const link = document.createElement('a');
      link.download = 'YSDB_Registration_Card.jpeg';
      link.href = canvas.toDataURL('image/jpeg', 1.0);
      link.click();
    });
  });

  // Both Cards Download Functions
  document.getElementById('download-both-pdf').addEventListener('click', function() {
    const elements = [document.getElementById('admit-card'), document.getElementById('registration-card')];
    const opt = {
      margin: 0,
      filename: 'YSDB_Cards.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    const worker = html2pdf().set(opt);
    
    elements.forEach((element, index) => {
      if (index === 0) {
        worker.from(element);
      } else {
        worker.get('pdf').then((pdf) => {
          pdf.addPage();
        });
        worker.from(element, { pagesplit: true });
      }
    });
    
    worker.save();
  });

  document.getElementById('download-both-image').addEventListener('click', function() {
    const elements = [document.getElementById('admit-card'), document.getElementById('registration-card')];
    const promises = [];
    
    elements.forEach(element => {
      promises.push(html2canvas(element, {
        scale: 2,
        logging: false,
        useCORS: true,
        allowTaint: true
      }));
    });
    
    Promise.all(promises).then((canvases) => {
      // Create a new canvas to combine both images vertically
      const combinedCanvas = document.createElement('canvas');
      const totalHeight = canvases[0].height + canvases[1].height;
      const maxWidth = Math.max(canvases[0].width, canvases[1].width);
      
      combinedCanvas.width = maxWidth;
      combinedCanvas.height = totalHeight;
      
      const ctx = combinedCanvas.getContext('2d');
      ctx.drawImage(canvases[0], 0, 0);
      ctx.drawImage(canvases[1], 0, canvases[0].height);
      
      const link = document.createElement('a');
      link.download = 'YSDB_Both_Cards.jpeg';
      link.href = combinedCanvas.toDataURL('image/jpeg', 1.0);
      link.click();
    });
  });
</script>

</body>
</html>