@section('title', 'Free Proforma Invoice Generator | Create & Download Proforma Invoices')
@section('meta_description', 'Generate professional proforma invoices instantly with our free online proforma invoice generator. Customizable templates, instant PDF downloads, and no signup required!')
@section('meta_keywords', 'proforma invoice generator, free proforma invoice maker, create proforma invoice online, professional proforma invoicing')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Proforma Invoice Generator - Free Online Proforma Invoice Maker",
    "description": "Generate professional proforma invoices instantly with our free proforma invoice generator. Choose from ready-to-use templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/proforma-invoice-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "190"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Proforma Invoice Generator</h2>
    <p class="text-center text-muted lead">
        Create a professional Proforma Invoice instantly with our **free online Proforma Invoice Generator**. No signup required!
        Simply enter your details, customize your Proforma Invoice, and **download your Proforma Invoice as a PDF**.
    </p>
    <!-- Display Validation / Error / Success Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Proforma Invoice Form -->
    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm" novalidate>
        
        <!-- Logo Upload Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">
                    Upload Logo <span class="text-muted">(PNG, JPG)</span>
                </label>
                <div 
                    class="border rounded bg-light text-center p-4"
                    style="cursor: pointer;"
                    onclick="document.getElementById('logoUpload').click()"
                >
                    <!-- Hidden File Input -->
                    <input 
                        type="file" 
                        wire:model="logo" 
                        class="d-none" 
                        id="logoUpload" 
                        accept="image/png, image/jpeg"
                    />
                    
                    <!-- Button & Loading State -->
                    <button 
                        type="button" 
                        class="btn btn-outline-primary" 
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Choose Logo</span>
                        <span wire:loading>Uploading...</span>
                    </button>
                    <p class="text-muted mt-2">Click or drag & drop</p>
                </div>

                <!-- Logo Preview -->
                @if ($logo)
                    <div class="text-center mt-3">
                        <img 
                            src="{{ $logo->temporaryUrl() }}" 
                            alt="Logo Preview" 
                            class="img-fluid img-thumbnail" 
                            style="max-height: 120px;"
                        >
                        <button 
                            type="button" 
                            wire:click="removeLogo" 
                            class="btn btn-outline-danger mt-2 btn-sm"
                        >
                            Remove Logo
                        </button>
                    </div>
                @else
                    <div class="mt-3 text-center text-muted">
                        + No Logo Uploaded
                    </div>
                @endif
            </div>
        </div>

        <!-- Proforma Invoice & Company Details -->
        <div class="row mb-4">
            <!-- Proforma Number -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Proforma #</label>
                <input 
                    type="text" 
                    wire:model.lazy="proformaNumber" 
                    class="form-control" 
                    readonly
                >
            </div>

            <!-- Invoice Date -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Invoice Date</label>
                <input 
                    type="date" 
                    wire:model.lazy="invoiceDate" 
                    class="form-control"
                >
            </div>

            <!-- Expiry Date -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Expiry Date</label>
                <input 
                    type="date" 
                    wire:model.lazy="expiryDate" 
                    class="form-control"
                >
            </div>

            <!-- Currency -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Currency</label>
                <select wire:model.lazy="currency" class="form-select">
                    <option value="" disabled>Select Currency</option>
                    @foreach ($currencySymbols as $code => $symbol)
                        <option value="{{ $code }}">
                            {{ $code }} ({{ $symbol }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- PO Number -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold">PO Number (Optional)</label>
                <input 
                    type="text" 
                    wire:model.lazy="po_number" 
                    class="form-control" 
                    placeholder="PO-XXXX"
                >
            </div>
        </div>

        <!-- Seller & Buyer Details -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Seller Details</label>
                <textarea 
                    wire:model.lazy="who_is_from" 
                    class="form-control mb-3" 
                    rows="3"
                    placeholder="Your company name, address..."
                ></textarea>
                <input 
                    type="text" 
                    wire:model.lazy="tax_id" 
                    class="form-control" 
                    placeholder="Tax ID / VAT Number (optional)"
                >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Buyer Details</label>
                <textarea 
                    wire:model.lazy="bill_to" 
                    class="form-control mb-3" 
                    rows="3"
                    placeholder="Buyer name, address..."
                ></textarea>
                <textarea 
                    wire:model.lazy="ship_to" 
                    class="form-control" 
                    rows="3"
                    placeholder="Shipping address (optional)"
                ></textarea>
            </div>
        </div>

        <!-- Payment & Terms -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Payment Method (Optional)</label>
                <input 
                    type="text" 
                    wire:model.lazy="payment_method" 
                    class="form-control" 
                    placeholder="Bank Transfer, PayPal..."
                >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Payment Terms</label>
                <input 
                    type="text" 
                    wire:model.lazy="payment_terms" 
                    class="form-control"
                    placeholder="e.g. Net 30"
                >
            </div>
        </div>

        <!-- Items Section -->
        <div class="border rounded mb-4">
            <div class="bg-light p-3 rounded-top text-center fw-bold">
                Items
            </div>
            <div class="p-3">
                @foreach ($items as $index => $item)
                    <div class="row g-2 align-items-end mb-2" wire:key="item-{{ $index }}">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Description</label>
                            <input 
                                type="text" 
                                wire:model.lazy="items.{{ $index }}.description"
                                class="form-control"
                                placeholder="Item description"
                            >
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Qty</label>
                            <input 
                                type="number" 
                                wire:model.lazy="items.{{ $index }}.quantity"
                                class="form-control" 
                                min="1"
                                wire:input="calculateSubtotal"
                            >
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Rate</label>
                            <input 
                                type="number" 
                                wire:model.lazy="items.{{ $index }}.rate"
                                class="form-control" 
                                min="0" 
                                step="0.01"
                                wire:input="calculateSubtotal"
                            >
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Amount</label>
                            <input 
                                type="text"
                                class="form-control"
                                value="{{ ($items[$index]['quantity'] ?? 0) * ($items[$index]['rate'] ?? 0) }}"
                                readonly
                            >
                        </div>
                        <div class="col-md-2 text-end">
                            <button 
                                type="button"
                                wire:click="removeItem({{ $index }})"
                                class="btn btn-outline-danger"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach

                <button 
                    type="button"
                    wire:click="addItem"
                    class="btn btn-outline-dark mt-2"
                >
                    + Add Item
                </button>
            </div>
        </div>

        <!-- Additional Fields (Optional) -->
        @if(!empty($additionalFields))
            <div class="border rounded mb-4">
                <div class="bg-light p-3 rounded-top d-flex justify-content-between align-items-center">
                    <strong>Additional Fields (Optional)</strong>
                    <button 
                        type="button" 
                        wire:click="addAdditionalField"
                        class="btn btn-outline-success btn-sm"
                    >
                        + Add Field
                    </button>
                </div>
                <div class="p-3">
                    @foreach ($additionalFields as $i => $field)
                        <div class="row g-2 mb-2" wire:key="additional-field-{{ $i }}">
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Label</label>
                                <input 
                                    type="text"
                                    wire:model.lazy="additionalFields.{{ $i }}.label"
                                    class="form-control"
                                    placeholder="e.g., Website"
                                >
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Value</label>
                                <input 
                                    type="text"
                                    wire:model.lazy="additionalFields.{{ $i }}.value"
                                    class="form-control"
                                    placeholder="e.g., https://example.com"
                                >
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button 
                                    type="button"
                                    wire:click="removeAdditionalField({{ $i }})"
                                    class="btn btn-outline-danger"
                                >
                                    Remove
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Button to create the first additional field -->
            <button 
                type="button"
                wire:click="addAdditionalField"
                class="btn btn-outline-success mb-4"
            >
                + Add Additional Field
            </button>
        @endif

        <!-- Financials -->
        <div class="row mb-4">
            <div class="col-md-4 offset-md-8">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Subtotal:</span>
                    <span>{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Tax (%):</span>
                    <input
                        type="number"
                        wire:model.lazy="tax"
                        class="form-control"
                        min="0"
                        step="0.01"
                        style="width: 70px"
                        wire:input="calculateTotal"
                    >
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Discount (%):</span>
                    <input
                        type="number"
                        wire:model.lazy="discount"
                        class="form-control"
                        min="0"
                        step="0.01"
                        style="width: 70px"
                        wire:input="calculateTotal"
                    >
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Shipping:</span>
                    <input
                        type="number"
                        wire:model.lazy="shipping"
                        class="form-control"
                        min="0"
                        step="0.01"
                        style="width: 70px"
                        wire:input="calculateTotal"
                    >
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Total:</span>
                    <span>{{ $currency }} {{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="mb-4">
            <label class="form-label fw-bold">Additional Notes</label>
            <textarea
                wire:model.lazy="notes"
                class="form-control"
                rows="3"
                placeholder="Any extra instructions or notes"
            ></textarea>
        </div>

        <!-- Submit Button for PDF -->
        <div class="text-center">
            <button 
                type="submit" 
                class="btn btn-outline-success btn-lg fw-bold"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Download Proforma PDF</span>
                <span wire:loading>Generating PDF...</span>
            </button>
        </div>
    </form>
</div>
