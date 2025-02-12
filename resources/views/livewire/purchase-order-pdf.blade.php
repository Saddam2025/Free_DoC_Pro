<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Order #{{ $purchase_order_number }}</title>
    <style>
        /* Base Reset & Typography */
        * {
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        /* Header Section */
        .header {
            position: relative;
            display: flex;
            justify-content: flex-end; 
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .header-logo {
            position: absolute;
            top: 0;
            left: 0;
        }

        .header-logo img {
            max-height: 78px;
        }

        .title {
            text-align: right;
        }

        .title h1 {
            margin: 0;
            font-size: 28px;
            color: #444;
        }

        .title p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #777;
        }

        /* Details Section */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .details-table td {
            vertical-align: top;
            padding: 8px;
            font-size: 12px;
            width: 50%;
        }

        .details-table td strong {
            font-size: 13px;
            color: #444;
        }

        /* Items Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: bold;
        }

        table td {
            font-size: 12px;
        }

        table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Totals and Notes Layout */
        .totals-notes {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 20px;
        }

        .totals {
            flex: 1;
            text-align: right;
        }

        .totals .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .totals strong {
            font-size: 14px;
        }

        .notes {
            flex: 1;
            text-align: left;
            font-size: 12px;
        }

        .notes strong {
            margin-bottom: 5px;
            display: block;
        }

        /* Footer */
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
                <div class="header-logo">
                    <img src="{{ $logo }}" alt="Company Logo">
                </div>
            @endif
            <div class="title">
                <h1>PURCHASE ORDER</h1>
                <p>#{{ $purchase_order_number }}</p>
                <p>Date: {{ $date }}</p>
                <p>Expiry Date: {{ $expiry_date }}</p>
            </div>
        </div>

        <!-- From / To Details -->
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

        <!-- Billing and Delivery Address -->
        <table class="details-table">
            <tr>
                <td>
                    <strong>Billing Address:</strong><br>
                    {!! nl2br(e($billing_address)) !!}
                </td>
                <td>
                    <strong>Delivery Address:</strong><br>
                    {!! nl2br(e($delivery_address)) !!}
                </td>
            </tr>
        </table>

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

        <!-- Totals & Optional Notes -->
        <div class="totals-notes">
            <!-- Totals -->
            <div class="totals">
                <div class="row">
                    <span>Subtotal:</span>
                    <span>{{ $currency }}{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="row">
                    <span>Tax ({{ $tax_rate }}%):</span>
                    <span>{{ $currency }}{{ number_format($tax_amount, 2) }}</span>
                </div>
                <div class="row">
                    <span>Discount:</span>
                    <span>{{ $currency }}{{ number_format($discount, 2) }}</span>
                </div>
                <div class="row">
                    <span>Shipping Charges:</span>
                    <span>{{ $currency }}{{ number_format($shipping_charges, 2) }}</span>
                </div>
                <div class="row">
                    <strong>Total:</strong>
                    <strong>{{ $currency }}{{ number_format($total, 2) }}</strong>
                </div>
            </div>

            <!-- Extra Terms/Notes -->
            <div class="notes">
                @if($delivery_terms)
                    <p><strong>Delivery Terms:</strong><br>{!! nl2br(e($delivery_terms)) !!}</p>
                @endif
                @if($payment_terms)
                    <p><strong>Payment Terms:</strong><br>{!! nl2br(e($payment_terms)) !!}</p>
                @endif
                @if($authorized_signature)
                    <p><strong>Authorized Signature:</strong><br>{{ $authorized_signature }}</p>
                @endif
                @if($terms_and_conditions)
                    <p><strong>Terms and Conditions:</strong><br>{!! nl2br(e($terms_and_conditions)) !!}</p>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Thank You.
        </div>
    </div>
</body>
</html>
