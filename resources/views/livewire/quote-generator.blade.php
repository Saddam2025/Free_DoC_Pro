@section('title', 'Free Quote Generator | Create & Download Business Quotes Online')
@section('meta_description', 'Generate professional business quotes instantly with our free quote generator. Customize templates, download PDFs, and streamline your quoting process.')
@section('meta_keywords', 'quote generator, free quote maker, create business quotes, online quote generator')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Quote Generator - Free Online Business Quote Maker",
    "description": "Create professional business quotes instantly with our free quote generator. Choose from ready-to-use templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/quote-generator-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "160"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Quote Generator</h2>

    <form wire:submit.prevent="downloadPDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Logo Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Upload Logo <span class="text-muted">(PNG, JPG only)</span></label>
            <div class="dropzone p-4 border rounded bg-light text-center" 
                 style="border-style: dashed; cursor: pointer;" 
                 onclick="document.getElementById('logoUpload').click()">
                <input type="file" wire:model="logo" class="d-none" id="logoUpload">
                <span class="text-muted">Click or drag & drop to upload logo</span>
            </div>
            @if ($logo)
                <div class="mt-3 text-center">
                    <img src="{{ $logo->temporaryUrl() }}" alt="Logo Preview" class="img-fluid img-thumbnail" style="max-height: 120px;">
                </div>
            @endif
        </div>

        <!-- Quote Details -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold">Quote #</label>
                <input type="text" wire:model.lazy="quote_number" class="form-control" placeholder="Enter Quote Number" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Date</label>
                <input type="date" wire:model.lazy="date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Expiry Date</label>
                <input type="date" wire:model.lazy="expiry_date" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Currency</label>
                <select wire:model.lazy="currency" class="form-select" required>
                    <option value="" disabled>Select Currency</option>
                    @foreach($currencySymbols as $symbol => $label)
                        <option value="{{ $symbol }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Sender and Recipient Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">From (Your Details)</label>
                <textarea wire:model.lazy="from" class="form-control" rows="3" placeholder="Your business details" required></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">To (Client Details)</label>
                <textarea wire:model.lazy="to" class="form-control" rows="3" placeholder="Client details" required></textarea>
            </div>
        </div>

        <!-- Items Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Items</label>
            <div class="bg-light p-3 rounded border">
                @foreach($items as $index => $item)
                    <div class="row g-2 align-items-center mb-3" wire:key="item-{{ $index }}">
                        <div class="col-md-4">
                            <input type="text" wire:model.lazy="items.{{ $index }}.description" class="form-control" placeholder="Description" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" wire:model.lazy="items.{{ $index }}.quantity" class="form-control" placeholder="Qty" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" wire:model.lazy="items.{{ $index }}.rate" class="form-control" placeholder="Rate" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-2">
                            <span class="form-control bg-light">{{ $currency }} {{ number_format($item['quantity'] * $item['rate'], 2) }}</span>
                        </div>
                        <div class="col-md-2 text-center">
                            <button type="button" wire:click="removeItem({{ $index }})" class="btn btn-outline-danger btn-sm">Remove</button>
                        </div>
                    </div>
                @endforeach
                <button type="button" wire:click="addItem" class="btn btn-outline-primary mt-2">+ Add Item</button>
            </div>
        </div>

        <!-- Totals Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold">Subtotal</label>
                <span class="form-control bg-light">{{ $currency }} {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Tax (%)</label>
                <input type="number" wire:model.lazy="tax" class="form-control" min="0" step="0.01">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Discount</label>
                <input type="number" wire:model.lazy="discount" class="form-control" min="0" step="0.01">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Shipping</label>
                <input type="number" wire:model.lazy="shipping" class="form-control" min="0" step="0.01">
            </div>
        </div>

        <div class="mt-4">
            <h4 class="fw-bold">Total: {{ $currency }} {{ number_format($total, 2) }}</h4>
        </div>

        <!-- Additional Details -->
        <div class="mb-4">
            <label class="form-label fw-bold">Payment Terms</label>
            <textarea wire:model.lazy="payment_terms" class="form-control" rows="3" placeholder="e.g. Net 30 days"></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Validity Period</label>
            <input type="text" wire:model.lazy="validity_period" class="form-control" placeholder="e.g. 15 days">
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Authorized Signature</label>
            <input type="text" wire:model.lazy="authorized_signature" class="form-control" placeholder="Your name">
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Terms and Conditions</label>
            <textarea wire:model.lazy="terms_conditions" class="form-control" rows="4" placeholder="e.g. This quote is valid for 15 days..."></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg fw-bold">Download Quote</button>
        </div>
    </form>
</div>
