@extends('layouts.app')

@section('title', 'Free Receipt Generator - Create Digital Receipts Online | Doc Pro')
@section('meta_description', 'Generate digital receipts online for free with our Receipt Generator. Customize, edit, and download professional receipts instantly. No signup required!')
@section('meta_keywords', 'receipt generator, free receipt maker, online receipt tool, digital receipts, printable receipts, professional receipt templates, business receipts')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "@id": "{{ url()->current() }}",
    "name": "Receipt Generator - Create & Download Digital Receipts Online",
    "description": "Easily generate and download professional digital receipts with our free Receipt Generator. Ideal for businesses and individuals.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "softwareVersion": "1.0",
    "url": "{{ url()->current() }}",
    "image": "{{ asset('images/receipt-generator-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock",
        "url": "{{ url()->current() }}"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "150"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Doc Pro",
        "url": "https://www.freedocumentmaker.com",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('images/logo.png') }}",
            "width": 512,
            "height": 512
        }
    }
}
</script>
@endsection


<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-dark">Receipt Generator</h2>

    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Logo Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Upload Logo <span class="text-muted">(PNG, JPG only)</span></label>
            <div class="dropzone p-4 border rounded bg-light text-center" style="border-style: dashed;">
                <input type="file" wire:model.lazy="logo" class="d-none" id="logoUpload">
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('logoUpload').click()">Choose Logo</button>
                <p class="text-muted mt-2">Drag & drop logo here, or click to upload</p>
            </div>
            @if ($logo)
                <div class="mt-3 text-center">
                    <img src="{{ $logo->temporaryUrl() }}" alt="Logo Preview" class="img-fluid img-thumbnail" style="max-height: 120px;">
                    <button type="button" wire:click="$set('logo', null)" class="btn btn-outline-danger btn-sm mt-2">Remove Logo</button>
                </div>
            @endif
        </div>

        <!-- Receipt Details -->
        <div class="row">
            <div class="col-md-4">
                <label class="form-label fw-bold">Receipt #</label>
                <input type="text" wire:model.lazy="receiptNumber" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Payment Date</label>
                <input type="date" wire:model.lazy="paymentDate" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Payment Method</label>
                <select wire:model.lazy="paymentMethod" class="form-select" required>
                    <option value="">Select Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
        </div>

        <!-- Currency Selection -->
        <div class="row mt-4">
            <div class="col-md-4">
                <label class="form-label fw-bold">Currency</label>
                <select wire:model.lazy="currency" class="form-select" required>
                    @foreach($currencyOptions as $code => $name)
                        <option value="{{ $code }}">{{ $name }} ({{ $code }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Payer Details -->
        <div class="mt-4">
            <label class="form-label fw-bold">Payer's Details</label>
            <textarea wire:model.lazy="payerDetails" class="form-control" rows="3" placeholder="Enter payer's name and address" required></textarea>
        </div>

        <!-- Items Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Items</label>
            <div class="bg-light p-3 rounded border">
                @foreach($items as $index => $item)
                    <div class="row g-2 align-items-center mb-3" wire:key="item-{{ $index }}">
                        <div class="col-md-4">
                            <input type="text" wire:model.lazy="items.{{ $index }}.description" class="form-control" placeholder="Description" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" wire:model.lazy="items.{{ $index }}.quantity" class="form-control" placeholder="Quantity" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" wire:model.lazy="items.{{ $index }}.rate" class="form-control" placeholder="Rate" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-2">
                            <span class="form-control text-muted bg-light">{{ $currency }} {{ number_format($item['quantity'] * $item['rate'], 2) }}</span>
                        </div>
                        <div class="col-md-2">
                            <button type="button" wire:click="removeItem({{ $index }})" class="btn btn-outline-danger btn-sm">Remove</button>
                        </div>
                    </div>
                @endforeach
                <button type="button" wire:click="addItem" class="btn btn-outline-primary">+ Add Item</button>
            </div>
        </div>

        <!-- Total Section -->
        <div class="row mt-4">
            <div class="col-md-4 offset-md-8">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Subtotal:</span>
                    <span>{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Tax (%):</span>
                    <input type="number" wire:model.lazy="taxRate" class="form-control" style="width: 70px;" min="0" step="0.01">
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Discount (%):</span>
                    <input type="number" wire:model.lazy="discount" class="form-control" style="width: 70px;" min="0" step="0.01">
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Total:</span>
                    <span>{{ $currency }} {{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Notes</label>
            <textarea wire:model.lazy="notes" class="form-control" rows="3" placeholder="Optional notes"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg fw-bold">Download Receipt</button>
        </div>
    </form>
</div>
