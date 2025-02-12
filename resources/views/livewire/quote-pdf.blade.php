<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote #{{ $quote_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 90%;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            max-height: 60px;
        }
        .title {
            text-align: right;
        }
        .title h1 {
            margin: 0;
            font-size: 44px;
            color: #444;
        }
        .title p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }
        .details {
            margin-bottom: 20px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 5px;
            vertical-align: top;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            color: #000;
            font-weight: bold;
        }
        table td {
            font-size: 12px;
        }
        .totals {
            width: 40%;
            margin-left: auto;
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9; /* Light background for emphasis */
            border-radius: 5px; /* Rounded corners */
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
            font-size: 14px; /* Highlight important numbers */
        }
        .footer {
            text-align: center;
            margin-top: 50px; /* Add spacing above footer */
            font-size: 10px;
            color: #777;
        }
        .additional-info {
            margin-top: 20px;
        }
        .additional-info p {
            margin: 5px 0;
        }
        .additional-info strong {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                @if($logo)
                <img src="{{ $logo }}" alt="Company Logo">
                @endif
            </div>
            <div class="title">
                <h1>QUOTE</h1>
                <p>#{{ $quote_number }}</p>
            </div>
        </div>

        <!-- Quote Details -->
        <div class="details">
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

        <div>
            <p><strong>Date:</strong> {{ $date }}</p>
            @if($expiry_date)
                <p><strong>Expiry Date:</strong> {{ $expiry_date }}</p>
            @endif
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
                        <td>{{ $currency_symbol }}{{ number_format($item['rate'], 2) }}</td>
                        <td>{{ $currency_symbol }}{{ number_format($item['quantity'] * $item['rate'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Section -->
        <div class="totals">
            <div class="row">
                <span>Subtotal:</span>
                <span>{{ $currency_symbol }}{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="row">
                <span>Tax ({{ $tax }}%):</span>
                <span>{{ $currency_symbol }}{{ number_format(($subtotal * $tax) / 100, 2) }}</span>
            </div>
            <div class="row">
                <span>Discount:</span>
                <span>-{{ $currency_symbol }}{{ number_format($discount, 2) }}</span>
            </div>
            <div class="row">
                <span>Shipping:</span>
                <span>{{ $currency_symbol }}{{ number_format($shipping, 2) }}</span>
            </div>
            <div class="row">
                <strong>Total:</strong>
                <strong>{{ $currency_symbol }}{{ number_format($total, 2) }}</strong>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="additional-info">
            <p><strong>Payment Terms:</strong> {{ $payment_terms }}</p>
            <p><strong>Validity Period:</strong> {{ $validity_period }}</p>
            <p><strong>Authorized Signature:</strong> {{ $authorized_signature }}</p>
            <p><strong>Terms and Conditions:</strong> {{ $terms_conditions }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>
</html>
