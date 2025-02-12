@section('title', 'Free Payment Receipt Generator | Create & Download Receipts Online')
@section('meta_description', 'Generate professional payment receipts instantly with our free online receipt generator. Customizable templates, instant PDF downloads, and no signup required!')
@section('meta_keywords', 'payment receipt generator, free receipt maker, online receipt creator, create payment receipt')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Payment Receipt Generator - Free Online Receipt Maker",
    "description": "Generate professional payment receipts instantly with our free receipt generator. Choose from ready-to-use templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/payment-receipt-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "200"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Doc Pro",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('images/logo.png') }}"
        }
    }
}
</script>
@endsection



<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-dark">Payment Receipt Generator</h2>

    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Logo Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Upload Logo (PNG, JPG only)</label>
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

        <!-- Payment Details -->
        <div class="row">
            <div class="col-md-4">
                <label class="form-label fw-bold">Receipt #</label>
                <input type="text" wire:model.lazy="receiptNumber" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Payment Date</label>
                <input type="date" wire:model.lazy="paymentDate" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Payment Amount</label>
                <input type="number" wire:model.lazy="paymentAmount" class="form-control" placeholder="Enter amount" required>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Payer Name</label>
                <input type="text" wire:model.lazy="payerName" class="form-control" placeholder="Enter payer's name" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Payment Method</label>
                <select wire:model.lazy="paymentMethod" class="form-select" required>
                    <option value="" disabled>Select Payment Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Online Payment">Online Payment</option>
                </select>
            </div>
        </div>

        <!-- Additional Details -->
        <div class="mt-4">
            <label class="form-label fw-bold">Payer Details</label>
            <textarea wire:model.lazy="payerDetails" class="form-control" rows="3" placeholder="Enter additional payer details"></textarea>
        </div>
        <div class="mt-4">
            <label class="form-label fw-bold">Notes</label>
            <textarea wire:model.lazy="notes" class="form-control" rows="3" placeholder="Enter any additional notes"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Download Receipt</button>
        </div>
    </form>
</div>
