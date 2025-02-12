<!DOCTYPE html>
<html>
<head>
    <title>Delivery Note - {{ $deliveryNoteNumber }}</title>
    <style>
        /* PDF Styling */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            position: relative;
            padding: 20px;
            color: #000;
        }
        .header, .addresses, .currency, .sender-details, .items, .notes {
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            vertical-align: middle;
        }
        .header h1 {
            display: inline-block;
            margin-left: 20px;
            vertical-align: middle;
        }
        .header p {
            margin: 5px 0;
        }
        .addresses, .currency, .sender-details, .items, .notes {
            page-break-inside: avoid;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .notes p {
            white-space: pre-wrap; /* Preserve line breaks */
        }
        /* Background Image */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            z-index: -1;
            opacity: 0.1; /* Adjust opacity as needed */
        }
    </style>
</head>
<body>
    @if($background)
        <div class="background" style="background-image: url('{{ storage_path('app/public/' . $background) }}');"></div>
    @endif

    <div class="header">
        @if($logo)
            <img src="{{ storage_path('app/public/' . $logo) }}" alt="Company Logo">
        @endif
        <h1>Delivery Note</h1>
        <p><strong>Number:</strong> {{ $deliveryNoteNumber }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($deliveryDate)->format('F j, Y') }}</p>
    </div>

    <!-- Addresses in a Table -->
    <div class="addresses">
        <h3>Addresses</h3>
        <table>
            <thead>
                <tr>
                    <th>Dispatch Address</th>
                    <th>Recipient Address</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $dispatchAddress }}</td>
                    <td>{{ $recipientAddress }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="currency">
        <h3>Currency</h3>
        <p>{{ $currency }}</p>
    </div>

    <div class="sender-details">
        <h3>Sender Details</h3>
        <p>{{ $senderDetails }}</p>
    </div>

    <div class="items">
        <h3>Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price ({{ $currency }})</th>
                    <th>Total ({{ $currency }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $currency }} {{ number_format($item['price'], 2) }}</td>
                        <td>{{ $currency }} {{ number_format($item['quantity'] * $item['price'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right;">Grand Total</th>
                    <th>{{ $currency }} {{ number_format($grandTotal, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Additional Notes Section -->
    @if($notes)
        <div class="notes">
            <h3>Notes</h3>
            <p>{{ $notes }}</p>
        </div>
    @endif

</body>
</html>
