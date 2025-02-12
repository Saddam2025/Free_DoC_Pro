<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $recipientName }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            
        }

        .certificate-container {
            width: 100%;
            height: 100%;
            padding: 20px;
           
            border-radius: 10px;
            background: #fff;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .logo img {
            max-height: 90px;
            margin-bottom: 22px;
        }

        .certificate-title {
            font-size: 40px;
            font-weight: bold;
            color: #6c63ff;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .sub-title {
            font-size: 18px;
            color: #555;
            font-style: italic;
            margin-bottom: 20px;
        }

        .recipient-name {
            font-size: 34px;
            font-weight: bold;
            color: #222;
            margin-bottom: 20px;
        }

        .description {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .organization-name {
            font-size: 20px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
        }

        .date {
            font-size: 14px;
            color: #888;
        }

        .signature-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            margin: 0 auto;
        }

        .signature {
            text-align: center;
        }

        .signature img {
            max-height: 50px;
            margin-bottom: 10px;
        }

        .signature p {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            border-top: 1px solid #555;
            padding-top: 5px;
            margin-top: 5px;
            width: 180px;
            margin: auto;
        }

        .stamp {
            max-height: 80px;
        }

        .digital-info {
            font-size: 14px;
            color: #444;
            margin-top: 15px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        @media (max-width: 768px) {
            .certificate-container {
                padding: 10px;
            }

            .certificate-title {
                font-size: 32px;
            }

            .recipient-name {
                font-size: 26px;
            }

            .description {
                font-size: 14px;
            }

            .organization-name {
                font-size: 16px;
            }

            .signature p {
                font-size: 12px;
            }

            .stamp {
                max-height: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <!-- Logo -->
        <div class="logo">
            @if($logo)
                <img src="{{ $logo }}" alt="Organization Logo">
            @endif
        </div>

        <!-- Certificate Title -->
        <div class="certificate-title">{{ $certificateTitle }}</div>
        <div class="sub-title">This certificate is proudly presented to</div>

        <!-- Recipient Name -->
        <div class="recipient-name">{{ $recipientName }}</div>

        <!-- Description -->
        <div class="description">
            For outstanding performance and successfully completing the program conducted by
        </div>

        <!-- Organization Name -->
        <div class="organization-name">{{ $organizationName }}</div>

        <!-- Date -->
        <div class="date">Date: {{ $date }}</div>

        <!-- Signature Section -->
        <div class="signature-container">
            <!-- Issuer Signature -->
            <div class="signature">
                @if(isset($signature))
                    <img src="{{ $signature }}" alt="Signature">
                @endif
                <p>{{ $issuerName }}</p>
            </div>

            <!-- Stamp -->
            @if(isset($stamp))
                <div class="signature">
                    <img src="{{ $stamp }}" alt="Stamp" class="stamp">
                </div>
            @endif
        </div>

        <!-- Digital Signature and Stamp -->
        <div class="digital-info">
            @if(isset($digitalSignatureText))
                Digital Signature: {{ $digitalSignatureText }}<br>
            @endif
            @if(isset($digitalStampText))
                Digital Stamp: {{ $digitalStampText }}
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Your Organization. All rights reserved.
        </div>
    </div>
</body>

</html>
