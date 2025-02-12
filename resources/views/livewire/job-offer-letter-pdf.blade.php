<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Offer Letter - {{ $candidateName }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        .header, .footer {
            text-align: center;
        }

        .header img {
            max-height: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #4CAF50;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .content {
            margin-top: 30px;
            line-height: 1.6;
        }

        .content p {
            font-size: 14px;
            margin: 10px 0;
        }

        .highlight {
            font-weight: bold;
            color: #4CAF50;
        }

        .signature {
            margin-top: 50px;
            text-align: left;
        }

        .signature p {
            border-top: 1px solid #ddd;
            display: inline-block;
            padding-top: 10px;
            margin-top: 50px;
            width: 200px;
            font-size: 14px;
            color: #333;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .additional-terms {
            margin-top: 20px;
            
            padding: 15px;
            border-left: 4px solid #4CAF50;
            font-style: italic;
            font-size: 13px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .header h1 {
                font-size: 20px;
            }

            .header p, .footer {
                font-size: 12px;
            }

            .content p {
                font-size: 12px;
            }

            .signature p {
                font-size: 12px;
            }

            .additional-terms {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            @if($logo)
            <img src="{{ $logo }}" alt="Company Logo">
            @endif
            <h1>{{ $companyName }}</h1>
            <p>{{ $companyAddress }}</p>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p><strong>Date:</strong> {{ now()->format('Y-m-d') }}</p>
            <p><strong>To:</strong> {{ $candidateName }}</p>
            <p>{{ $candidateAddress }}</p>

            <p>Dear <strong>{{ $candidateName }}</strong>,</p>

            <p>We are excited to offer you the position of <span class="highlight">{{ $jobTitle }}</span> at <span class="highlight">{{ $companyName }}</span>. Your start date will be <span class="highlight">{{ $startDate }}</span>, with an annual salary of <span class="highlight">{{ $salary }}</span>.</p>

            @if($additionalTerms)
                <div class="additional-terms">
                    <p><strong>Additional Terms:</strong> {!! nl2br(e($additionalTerms)) !!}</p>
                </div>
            @endif

            <p>Please sign and return this letter by <span class="highlight">[Insert Deadline Date]</span> to confirm your acceptance of this offer.</p>

            <p>We are thrilled to have you join our team and are confident that you will make a valuable contribution to our organization!</p>

            <p>Sincerely,</p>
            <div class="signature">
                @if($signature)
                    <img src="{{ $signature }}" alt="Signature" style="max-height: 50px;">
                @endif
                <p>{{ $authorizedPerson }}</p>
                <p>Authorized Representative</p>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
