<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt #{{ $receiptNumber }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #444;
        }

        .details, .notes {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if($logo)
                <img src="{{ $logo }}" alt="Company Logo">
            @endif
            <h1>Payment Receipt</h1>
            <p>Receipt #: {{ $receiptNumber }}</p>
            <p>Date: {{ $paymentDate }}</p>
        </div>

        <div class="details">
            <h3>Payer Name: {{ $payerName }}</h3>
            <p>Payment Method: {{ $paymentMethod }}</p>
            <p>Payment Amount: ${{ number_format($paymentAmount, 2) }}</p>
            <p>Payer Details: {{ $payerDetails }}</p>
        </div>

        @if($notes)
            <div class="notes">
                <h3>Notes:</h3>
                <p>{{ $notes }}</p>
            </div>
        @endif

        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>
