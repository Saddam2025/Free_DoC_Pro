@section('title', 'Free Credit Note Generator | Create & Download Credit Notes Online')
@section('meta_description', 'Generate professional credit notes instantly with our free credit note generator. Easy-to-use templates, instant PDF download, and no signup required!')
@section('meta_keywords', 'credit note generator, free credit note maker, create credit notes, online credit memo generator')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Credit Note Generator - Free Online Credit Memo Maker",
    "description": "Create professional credit notes instantly with our free credit note generator. Choose from ready-to-use templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/credit-note-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "140"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Credit Note Generator</h2>

    {{-- Show error message if exists --}}
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="downloadPDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Logo Upload Section (Drag-and-Drop) -->
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

        <!-- Credit Note Details -->
        <div class="row">
            <div class="col-md-4">
                <label class="form-label fw-bold">Credit Note #</label>
                <input type="text" wire:model.lazy="credit_note_number" class="form-control" placeholder="Enter Credit Note Number" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Date</label>
                <input type="date" wire:model.lazy="date" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Currency</label>
                <select wire:model.lazy="currency" class="form-select" required>
                    <option value="" disabled>Select Currency</option>
                    @foreach($currencySymbols as $symbol => $label)
                        <option value="{{ $symbol }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Seller and Buyer Details -->
        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">From (Seller)</label>
                <textarea wire:model.lazy="from" class="form-control" rows="3" placeholder="Your Name, Address, Contact" required></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">To (Buyer)</label>
                <textarea wire:model.lazy="to" class="form-control" rows="3" placeholder="Recipient's Name, Address, Contact" required></textarea>
            </div>
        </div>

        <!-- Reference Invoice Number and Reason for Issuance -->
        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Reference Invoice Number</label>
                <input type="text" wire:model.lazy="reference_invoice_number" class="form-control" placeholder="Invoice Number (if applicable)">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Reason for Issuance</label>
                <input type="text" wire:model.lazy="reason_for_issuance" class="form-control" placeholder="Reason for Issuing the Credit Note">
            </div>
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

        <!-- Tax Details -->
        <div class="row mt-4">
            <div class="col-md-4">
                <label class="form-label fw-bold">Tax Rate (%)</label>
                <input type="number" wire:model.lazy="tax_rate" class="form-control" placeholder="Tax Rate" min="0" step="0.01" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Tax Amount</label>
                <input type="number" wire:model.lazy="tax_amount" class="form-control" placeholder="Tax Amount" min="0" step="0.01" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Total Amount</label>
                <input type="number" wire:model.lazy="total" class="form-control" placeholder="Total Amount" min="0" step="0.01" disabled>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Notes</label>
            <textarea wire:model.lazy="notes" class="form-control" rows="4" placeholder="Additional Notes (Optional)"></textarea>
        </div>

        <!-- Payment Details -->
        <div class="mt-4">
            <label class="form-label fw-bold">Payment Details</label>
            <textarea wire:model.lazy="payment_details" class="form-control" rows="2" placeholder="How the credit will be adjusted"></textarea>
        </div>

        <!-- Signature -->
        <div class="mt-4">
            <label class="form-label fw-bold">Authorized Signature</label>
            <input type="text" wire:model.lazy="authorized_signature" class="form-control" placeholder="Authorized Person's Name">
        </div>

        <!-- Terms and Conditions (Optional) -->
        <div class="mt-4">
            <label class="form-label fw-bold">Terms and Conditions</label>
            <textarea wire:model.lazy="terms_and_conditions" class="form-control" rows="3" placeholder="Any Terms and Conditions (Optional)"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg fw-bold">Download Credit Note</button>
        </div>
    </form>
</div>
