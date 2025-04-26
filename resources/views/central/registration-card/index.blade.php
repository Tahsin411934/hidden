<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>YSDB Registration Card</title>
    <style>
    @page {
        size: A4;
        margin: 0;
    }

    body {
        font-family: "Poppins", sans-serif;
        margin-top: 13px;
        padding: 0;
        background: #fff;
        height: 297mm;
        /* A4 height */
        width: 210mm;
        /* A4 width */
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

    .logo {
        position: absolute;
        left: 10px;
        top: 35px;
    }

    .logo img {
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

    .info-row {
        display: flex;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .info-label {
        font-weight: 600;
        width: 150px;
        min-width: 150px;
    }

    .info-colon {
        width: 10px;
    }

    .info-value {
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

    .photo-box {
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

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-label {
        font-size: 12px;
        margin-top: 5px;
    }

    .signature-box {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        height: 80px;
        margin-bottom: 5px;
    }

    .signature-box img {
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

    .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0.1;
        z-index: -1;
    }

    .watermark img {
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
        }

        .card-title,
        .photo-box {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
    </style>
</head>

<body>

    <div class="registration-card">
        <div class="watermark">
            <img src="https://youthskill.com.bd/logo.png" alt="YSDB Watermark">
        </div>

        <div class="header">
            <div class="logo">
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
                    <div class="info-label">Registration Number</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->registration_no }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Roll Number</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->roll_no }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Full Name</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Father's Name</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->father_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Mother's Name</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->mother_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Date of Birth</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->dob }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Gender</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->gender }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">National ID</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->nid }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Address</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->address }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Contact Number</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->phone }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email Address</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Course Name</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->course->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Branch Institute</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->branch->branch_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Session</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ $student->session }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Registration Date</div>
                    <div class="info-colon">:</div>
                    <div class="info-value">{{ date('d F Y', strtotime($student->created_at)) }}</div>
                </div>

                
            </div>

            <div class="right-section">
                <div class="photo-section">
                    <div class="photo-box">
                        @if(!empty($student->image))
                        <img src="{{ asset('storage/' . str_replace('storage/', '', $student->image)) }}"
                            alt="Student Photo">
                        @else
                        <span>Student Photo</span>
                        @endif
                    </div>
                    <div class="photo-label">3.5 cm × 4.5 cm</div>
                </div>

                <div class="signature-box">
                    @if(!empty($student->signature))
                    <img src="{{ asset('storage/' . str_replace('storage/', '', $student->signature)) }}"
                        alt="Student Signature">
                    @endif
                    <div class="signature-label">Student Signature</div>
                </div>

                <div class="signature-box">
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