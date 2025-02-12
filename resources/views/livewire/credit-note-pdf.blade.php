<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Note #{{ $credit_note_number }}</title>
    <style>
        /* Base Reset & Typography */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            color: #333;
            line-height: 1.4;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 800px;
            margin: auto;
            padding: 20px 0;
        }

        /* Header with gradient and credit note info */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: linear-gradient(90deg, #f8f8f8 0%, #eaeaea 100%);
            padding: 10px 0;
            margin-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }

        .header-logo img {
            max-height: 77px;
        }

        .credit-note-title {
            text-align: right;
            margin-left: 44px;
        }

        .credit-note-title h1 {
            margin: 0;
            font-size: 33px;
            color: #444;
        }

        .credit-note-title p {
            margin: 11px 0 0;
            font-size: 14px;
            color: #777;
        }

        /* Credit Note Details */
        .credit-note-details {
            text-align: right;
            margin-bottom: 10px;
        }

        .credit-note-details p {
            margin: 2px 0;
        }

        /* Sender & Recipient Info */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            color: #555;
        }

        .details-table td {
            vertical-align: top;
            padding: 5px;
        }

        .details-table strong {
            font-size: 13px;
        }

        /* Items Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table thead th {
            background-color: #555;
            color: #fff;
            padding: 8px;
            font-weight: 600;
            font-size: 12px;
        }

        table tbody td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
            vertical-align: middle;
        }

        table tbody td:last-child {
            text-align: right;
        }

        /* Totals */
        .totals {
            width: 100%;
            margin-top: 15px;
            font-size: 12px;
        }

        .totals .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .totals .row span {
            font-size: 12px;
        }

        .totals .row strong {
            font-size: 13px;
        }

        /* Notes Section */
        .notes {
            margin-top: 10px;
            font-size: 12px;
        }

        .notes strong {
            display: block;
            margin-bottom: 3px;
        }

        /* Authorized Signature */
        .signature {
            font-family: 'Brush Script MT', cursive;
            font-size: 22px;
            margin-top: 30px;
            padding: 10px 0;
            border-top: 1px solid #333;
            text-align: center;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #777;
        }

        /* Accessibility Enhancements */
        .footer a {
            color: #007BFF;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header: Logo & Credit Note Title -->
        <div class="header">
            <div class="header-logo">
                @if($logo)
                    <img src="{{ $logo }}" alt="Company Logo">
                @endif
            </div>
            <div class="credit-note-title">
                <h1>CREDIT NOTE</h1>
                <p>#{{ $credit_note_number }}</p>
            </div>
        </div>

        <!-- Credit Note Details -->
        <div class="credit-note-details">
            <p><strong>Date:</strong> {{ $date }}</p>
            <p><strong>Reference Invoice #:</strong> {{ $reference_invoice_number }}</p>
            <p><strong>Reason for Issuance:</strong> {{ $reason_for_issuance }}</p>
        </div>

        <!-- From / To Details -->
        <div>
            <table class="details-table">
                <tr>
                    <td>
                        <strong>From:</strong><br>
                        {!! nl2br(e($from)) !!}
                    </td>
                    <td>
                        <strong>To:</strong><br>
                        {!! nl2br(e($to)) !!}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $currency }}{{ number_format($item['rate'], 2) }}</td>
                        <td>{{ $currency }}{{ number_format($item['quantity'] * $item['rate'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Section -->
        <div class="totals">
            <div class="row">
                <span>Subtotal:</span>
                <span>{{ $currency }}{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="row">
                <span>Tax Amount:</span>
                <span>{{ $currency }}{{ number_format($tax_amount, 2) }}</span>
            </div>
            <div class="row">
                <strong>Total Amount:</strong>
                <strong>{{ $currency }}{{ number_format($total, 2) }}</strong>
            </div>
        </div>

        <!-- Payment Details Section -->
        @if($payment_details)
        <div class="notes">
            <strong>Payment Details:</strong>
            {!! nl2br(e($payment_details)) !!}
        </div>
        @endif

        <!-- Terms and Conditions Section -->
        @if($terms_and_conditions)
        <div class="notes">
            <strong>Terms and Conditions:</strong>
            {!! nl2br(e($terms_and_conditions)) !!}
        </div>
        @endif

        <!-- Notes Section -->
        @if($notes)
        <div class="notes">
            <strong>Notes:</strong>
            {!! nl2br(e($notes)) !!}
        </div>
        @endif

        <!-- Authorized Signature Section -->
        @if($authorized_signature)
        <div class="signature">
            <strong>Authorized Signature:</strong><br>
            {{ $authorized_signature }}
        </div>
        @endif

        

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>

</html>
