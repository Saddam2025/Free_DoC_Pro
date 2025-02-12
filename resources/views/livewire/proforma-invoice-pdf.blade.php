<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice #{{ $proformaNumber }}</title>
    <style>
        /* Force single-page A4 layout with minimal margins */
        @page {
            size: A4;
            margin: 10mm;
        }

        /* Basic Reset & Typography */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            background-color: #fff;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* Header with gradient background & Title */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(90deg, #f8f8f8 0%, #eaeaea 100%);
            padding: 10px;
            border-bottom: 2px solid #ddd;
            position: relative;
            margin-bottom: 15px;
        }
        .header-logo {
         position: absolute;
         top: 4%;
         transform: translateY(-50%);
         left: 5;
        }


        .header-logo img {
            max-height: 90px;
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

        /* Seller & Buyer Info */
        .details {
            margin-bottom: 15px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            color: #555;
        }
        .details-table td {
            vertical-align: top;
            padding: 6px;
            width: 50%;
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
            padding: 6px;
            font-size: 12px;
            vertical-align: middle;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody td:last-child {
            text-align: right;
        }

        /* Totals Section */
        .totals {
            width: 100%;
            margin-top: 10px;
            font-size: 12px;
            text-align: right;
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

        /* Additional Fields & Notes */
        .additional-info,
        .notes {
            margin-top: 10px;
            font-size: 12px;
            line-height: 1.3;
        }
        .additional-info h3 {
            margin: 0 0 5px;
            font-size: 14px;
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
        <!-- HEADER -->
        <div class="header">
            <div class="header-logo">
                @if($logo)
                    <img src="{{ $logo }}" alt="Company Logo">
                @endif
            </div>
            <div class="invoice-title">
                <h1>PROFORMA INVOICE</h1>
                <p>#{{ $proformaNumber }}</p>
            </div>
        </div>

        <!-- Invoice Details (Dates, Payment Terms, PO) -->
        <div class="invoice-details">
            <p><strong>Date:</strong> {{ $invoiceDate }}</p>
            <p><strong>Expiry Date:</strong> {{ $expiryDate }}</p>
            @if(!empty($payment_terms))
                <p><strong>Payment Terms:</strong> {{ $payment_terms }}</p>
            @endif
            @if(!empty($po_number))
                <p><strong>PO Number:</strong> {{ $po_number }}</p>
            @endif
        </div>

        <!-- Seller & Buyer Info -->
        <div class="details">
            <table class="details-table">
                <tr>
                    <td>
                        <strong>Seller:</strong><br>
                        {!! nl2br(e($who_is_from)) !!}
                        @if(!empty($tax_id))
                            <br><strong>Tax ID / VAT:</strong> {{ $tax_id }}
                        @endif
                    </td>
                    <td>
                        <strong>Buyer:</strong><br>
                        {!! nl2br(e($bill_to)) !!}
                        @if(!empty($ship_to))
                            <br><strong>Ship To:</strong><br>{!! nl2br(e($ship_to)) !!}
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Payment Method (Optional) -->
        @if(!empty($payment_method))
            <p style="text-align:right; margin-bottom:15px;">
                <strong>Payment Method:</strong> {{ $payment_method }}
            </p>
        @endif

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
                        <td>{{ $currencySymbol }}{{ number_format($item['rate'], 2) }}</td>
                        <td>{{ $currencySymbol }}{{ number_format($item['quantity'] * $item['rate'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals">
            <div class="row">
                <span>Subtotal:</span>
                <span>{{ $currencySymbol }}{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="row">
                <span>Tax ({{ $tax }}%):</span>
                <span>{{ $currencySymbol }}{{ number_format(($subtotal * $tax) / 100, 2) }}</span>
            </div>
            <div class="row">
                <span>Discount:</span>
                <span>-{{ $currencySymbol }}{{ number_format(($subtotal * $discount) / 100, 2) }}</span>
            </div>
            <div class="row">
                <span>Shipping:</span>
                <span>{{ $currencySymbol }}{{ number_format($shipping, 2) }}</span>
            </div>
            <div class="row">
                <strong>Total:</strong>
                <strong>{{ $currencySymbol }}{{ number_format($total, 2) }}</strong>
            </div>
        </div>

        <!-- Additional Fields -->
        @if(!empty($additionalFields))
            <div class="additional-info">
                <h3>Additional Information</h3>
                <ul>
                    @foreach($additionalFields as $field)
                        @if(!empty($field['label']) || !empty($field['value']))
                            <li><strong>{{ $field['label'] }}:</strong> {{ $field['value'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Notes -->
        @if(!empty($notes))
            <div class="notes">
                <strong>Notes:</strong>
                {!! nl2br(e($notes)) !!}
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} Thanks.
        </div>
    </div>
</body>
</html>
