<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice_number }}</title>
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

        /* Header with gradient and invoice info */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: linear-gradient(90deg, #f8f8f8 0%, #eaeaea 100%);
            padding: 10px 0;
            margin-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        

        .header-logo {
         position: absolute;
         top: 4%;
         transform: translateY(-50%);
         left: 5;
        }


        .header-logo img {
            max-height: 133px;
        }

        .invoice-title {
            text-align: right;
            flex: 1;
            margin-left: 20px;
        }

        .invoice-title h1 {
            margin: 0;
            font-size: 28px;
            color: #444;
        }

        .invoice-title p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #777;
        }

        /* Invoice Details */
        .invoice-details {
            text-align: right;
            margin-bottom: 15px;
        }

        .invoice-details p {
            margin: 2px 0;
        }

        /* Sender & Recipient Info */
        .details {
            margin-bottom: 10px;
        }

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

        /* Additional Information Section */
        .additional-info {
            margin-bottom: 15px;
        }

        .additional-info h3 {
            margin: 0 0 5px;
            font-size: 14px;
        }

        /* Balance Due Highlight */
        .balance-due {
            background-color:rgb(245, 245, 245);
            padding: 10px;
            text-align: right;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .balance-due span {
            font-size: 16px;
            font-weight: bold;
            color: #444;
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

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header: Logo & Invoice Title -->
        <div class="header">
            <div class="header-logo">
                @if($logo)
                <img src="{{ $logo }}" alt="Company Logo">
                @endif
            </div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <p>#{{ $invoice_number }}</p>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <p><strong>Date:</strong> {{ $date }}</p>
            <p><strong>Due Date:</strong> {{ $due_date ?: 'N/A' }}</p>
            <p><strong>Payment Terms:</strong> {{ $payment_terms ?: 'N/A' }}</p>
            @if($po_number)
            <p><strong>PO Number:</strong> {{ $po_number }}</p>
            @endif
        </div>

        <!-- From / To Details -->
        <div class="details">
            <table class="details-table">
                <tr>
                    <td>
                        <strong>From:</strong><br>
                        {!! nl2br(e($who_is_from)) !!}
                        @if($tax_id)
                        <p><strong>Tax ID/VAT:</strong> {{ $tax_id }}</p>
                        @endif
                    </td>
                    <td>
                        <strong>To:</strong><br>
                        {!! nl2br(e($bill_to)) !!}
                    </td>
                </tr>
            </table>
            @if($ship_to)
            <p><strong>Ship To:</strong> {!! nl2br(e($ship_to)) !!}</p>
            @endif
        </div>

        

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th>Item</th>
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
        <!-- Balance Due -->
        <div class="balance-due">
            <span>Balance Due: {{ $currency_symbol }}{{ number_format($balance_due, 2) }}</span>
        </div>

        <!-- Totals -->
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
                <span>-{{ $currency_symbol }}{{ number_format(($subtotal * $discount) / 100, 2) }}</span>
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

        <!-- Additional Information Section -->
        @if(!empty($additionalFields))
        <div class="additional-info">
            <h3>Additional Information:</h3>
            <ul>
                @foreach($additionalFields as $field)
                <li><strong>{{ $field['label'] }}:</strong> {{ $field['value'] }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Notes Section -->
        @if($notes)
        <div class="notes">
            <strong>Notes:</strong>
            {!! nl2br(e($notes)) !!}
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>

</html>
