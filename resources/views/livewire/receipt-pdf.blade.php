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
            font-size: 12px;
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

        .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            margin-bottom: 5px;
            font-size: 16px;
            color: #444;
        }

        .section p {
            margin: 5px 0;
        }

        .details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details th, .details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .details th {
            background-color: #f4f4f4;
            font-size: 14px;
        }

        .details td {
            font-size: 12px;
        }

        .totals {
            width: 50%;
            margin-left: auto;
        }

        .totals .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .totals .row span {
            font-size: 14px;
        }

        .totals .row strong {
            font-size: 16px;
            color: #444;
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
        <!-- Header -->
        <div class="header">
            @if($logo)
                <img src="{{ $logo }}" alt="Company Logo">
            @endif
            <h1>Receipt</h1>
            <p>Receipt #: {{ $receiptNumber }}</p>
            <p>Date: {{ $paymentDate }}</p>
        </div>

        <!-- Payer Details -->
        <div class="section">
            <h3>Payer Information</h3>
            <p><strong>Name/Address:</strong></p>
            <p>{!! nl2br(e($payerDetails)) !!}</p>
        </div>

        <!-- Payment Method -->
        <div class="section">
            <h3>Payment Details</h3>
            <p><strong>Method:</strong> {{ $paymentMethod }}</p>
        </div>

        <!-- Items Table -->
        <table class="details">
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
                        <td>{{ $currency }} {{ number_format($item['rate'], 2) }}</td>
                        <td>{{ $currency }} {{ number_format($item['quantity'] * $item['rate'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Section -->
        <div class="totals">
            <div class="row">
                <span>Subtotal:</span>
                <span>{{ $currency }} {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="row">
                <span>Tax ({{ $taxRate }}%):</span>
                <span>{{ $currency }} {{ number_format(($subtotal * $taxRate) / 100, 2) }}</span>
            </div>
            <div class="row">
                <span>Discount:</span>
                <span>-{{ $currency }} {{ number_format(($subtotal * $discount) / 100, 2) }}</span>
            </div>
            <div class="row">
                <strong>Total:</strong>
                <strong>{{ $currency }} {{ number_format($total, 2) }}</strong>
            </div>
        </div>

        <!-- Notes Section -->
        @if($notes)
            <div class="section">
                <h3>Notes</h3>
                <p>{!! nl2br(e($notes)) !!}</p>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>
</html>
