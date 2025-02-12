@section('title', 'Free Invoice Generator | Create Professional Invoices Online')
@section('meta_description', 'Generate invoices online with our free invoice generator. Customizable invoice templates, ready-to-download PDFs, and easy sharing. No signup required!')
@section('meta_keywords', 'invoice generator, free invoice maker, online invoicing, professional invoices, create invoices')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Invoice Generator - Create & Download Invoices Online",
    "description": "Generate professional invoices instantly with our free invoice generator. Easily customize and download invoices as PDFs for clients and businesses.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/invoice-generator-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "210"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Invoice Generator</h2>
    <p class="text-center text-muted lead">
        Create a professional Invoice instantly with our **free online Invoice Generator**. No signup required!
        Simply enter your details, customize your Invoice, and **download your Invoice as a PDF**.
    </p>
    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display Success Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Error Messages -->
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Invoice Form -->
    <form wire:submit.prevent="downloadPDF" class="bg-white p-5 rounded shadow-sm" novalidate>
        
        <!-- Logo Upload Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">
                    Upload Logo <span class="text-muted">(PNG, JPG only)</span>
                </label>
                <div 
                    class="dropzone p-4 border rounded bg-light text-center position-relative" 
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

                    <!-- Upload Button & Loading State -->
                    <button 
                        type="button" 
                        class="btn btn-outline-primary" 
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Choose Logo</span>
                        <span wire:loading>Uploading...</span>
                    </button>
                    <p class="text-muted mt-2">
                        Drag &amp; drop logo here, or click to upload
                    </p>
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
                    <div class="upload-logo-placeholder mt-3 text-center">
                        <p class="text-muted">+ Add Your Logo</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Invoice and Company Details -->
        <div class="row mb-4">
            <!-- Invoice Number -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Invoice #</label>
                <input 
                    type="text" 
                    wire:model.lazy="invoice_number" 
                    class="form-control" 
                    placeholder="Invoice Number" 
                    required
                >
            </div>

            <!-- Date -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Date</label>
                <input 
                    type="date" 
                    wire:model.lazy="date" 
                    class="form-control" 
                    required
                >
            </div>

            <!-- Due Date -->
            <div class="col-md-3">
                <label class="form-label fw-bold">Due Date</label>
                <input 
                    type="date" 
                    wire:model.lazy="due_date" 
                    class="form-control" 
                    required
                >
            </div>

            <!-- Currency -->
<div class="col-md-3">
    <label class="form-label fw-bold">Currency</label>
    <select 
        wire:model.lazy="currency" 
        class="form-select" 
        required
    >
        <option value="" disabled>Select Currency</option>
        @foreach ($currencySymbols as $code => $symbol)
            <option value="{{ $code }}">{{ $code }} ({{ $symbol }})</option>
        @endforeach
    </select>
</div>


        <!-- PO Number Section -->
        <div class="row mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold">PO Number (Optional)</label>
                <input 
                    type="text" 
                    wire:model.lazy="po_number" 
                    class="form-control" 
                    placeholder="Purchase Order Number"
                >
            </div>
        </div>

        <!-- Sender and Recipient Details -->
        <div class="row mb-4">
            <!-- Sender Details -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Sender Details</label>
                <textarea 
                    wire:model.lazy="who_is_from" 
                    class="form-control mb-3" 
                    rows="3" 
                    placeholder="Your name, address, email, phone..." 
                    required
                ></textarea>
                <input 
                    type="text" 
                    wire:model.lazy="tax_id" 
                    class="form-control" 
                    placeholder="Tax ID / VAT Number (optional)"
                >
            </div>

            <!-- Recipient Details -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Recipient Details</label>
                <textarea 
                    wire:model.lazy="bill_to" 
                    class="form-control mb-3" 
                    rows="3" 
                    placeholder="Recipient's name, address..." 
                    required
                ></textarea>
                <textarea 
                    wire:model.lazy="ship_to" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Shipping address (optional)"
                ></textarea>
            </div>
        </div>

        <!-- Payment Method and Terms -->
        <div class="row mb-4">
            <!-- Payment Method (Optional) -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Payment Method (Optional)</label>
                <input 
                    type="text" 
                    wire:model.lazy="payment_method" 
                    class="form-control" 
                    placeholder="e.g., Bank Transfer, PayPal"
                >
            </div>

            <!-- Payment Terms -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Payment Terms</label>
                <input 
                    type="text" 
                    wire:model.lazy="payment_terms" 
                    class="form-control" 
                    placeholder="e.g., Net 30"
                >
            </div>
        </div>

        <!-- Items Section -->
        <div id="items" class="border rounded mb-4">
            <!-- Items Header -->
            <div class="bg-light text-dark p-3 rounded-top">
                <div class="row text-center">
                    <div class="col-md-4 fw-bold">Item Description</div>
                    <div class="col-md-2 fw-bold">Qty</div>
                    <div class="col-md-2 fw-bold">Rate</div>
                    <div class="col-md-2 fw-bold">Amount</div>
                    <div class="col-md-2"></div>
                </div>
            </div>

            <!-- Items List -->
            @foreach ($items as $index => $item)
                <div class="row g-2 align-items-center p-3" wire:key="item-{{ $index }}">
                    <!-- Description -->
                    <div class="col-md-4">
                        <input 
                            type="text" 
                            wire:model.lazy="items.{{ $index }}.description" 
                            class="form-control" 
                            placeholder="Description..." 
                            required
                        >
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-2">
                        <input 
                            type="number" 
                            wire:model.lazy="items.{{ $index }}.quantity" 
                            class="form-control" 
                            placeholder="1" 
                            min="1" 
                            required 
                            wire:input="calculateSubtotal"
                        >
                    </div>

                    <!-- Rate -->
                    <div class="col-md-2">
                        <input 
                            type="number" 
                            wire:model.lazy="items.{{ $index }}.rate" 
                            class="form-control" 
                            placeholder="Rate" 
                            min="0" 
                            step="0.01" 
                            required 
                            wire:input="calculateSubtotal"
                        >
                    </div>

                    <!-- Amount -->
                    <div class="col-md-2">
                        <input 
                            type="text" 
                            class="form-control" 
                            value="{{ $currency }} {{ number_format($item['quantity'] * $item['rate'], 2) }}" 
                            readonly
                        >
                    </div>

                    <!-- Remove Button -->
                    <div class="col-md-2">
                        <button 
                            type="button" 
                            wire:click="removeItem({{ $index }})" 
                            class="btn btn-outline-danger btn-sm"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            @endforeach

            <!-- Add Item Button -->
            <button 
                type="button" 
                wire:click="addItem" 
                class="btn btn-outline-dark mt-3"
            >
                <span wire:loading.remove>+ Add Item</span>
                <span wire:loading>Adding...</span>
            </button>
        </div>

        <!-- Additional Fields Section -->
        <div id="additional-fields" class="border rounded mb-4">
            <div class="bg-light text-dark p-3 rounded-top d-flex justify-content-between align-items-center">
                <span class="fw-bold">Additional Information (Optional)</span>
                <button type="button" wire:click="addAdditionalField" class="btn btn-outline-success btn-sm">
                    + Add Field
                </button>
            </div>

            @foreach ($additionalFields as $index => $field)
                <div class="row g-2 align-items-center p-3" wire:key="additional-field-{{ $index }}">
                    <!-- Label -->
                    <div class="col-md-5">
                        <input 
                            type="text" 
                            wire:model.lazy="additionalFields.{{ $index }}.label" 
                            class="form-control" 
                            placeholder="Field Label (e.g., Website, Facebook)"
                        >
                        @error("additionalFields.$index.label") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Value -->
                    <div class="col-md-5">
                        <input 
                            type="text" 
                            wire:model.lazy="additionalFields.{{ $index }}.value" 
                            class="form-control" 
                            placeholder="Field Value (e.g., https://example.com)"
                        >
                        @error("additionalFields.$index.value") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Remove Button -->
                    <div class="col-md-2">
                        <button 
                            type="button" 
                            wire:click="removeAdditionalField({{ $index }})" 
                            class="btn btn-outline-danger btn-sm"
                        >
                            Remove
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total Section -->
        <div class="row">
            <div class="col-md-4 offset-md-8">
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Subtotal:</span>
                    <span>{{ $currency }} {{ number_format($subtotal, 2) }}</span>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Tax (%):</span>
                    <input 
                        type="number" 
                        wire:model.lazy="tax" 
                        class="form-control" 
                        style="width: 70px;" 
                        min="0" 
                        step="0.01" 
                        wire:input="calculateTotal"
                    >
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Discount (%):</span>
                    <input 
                        type="number" 
                        wire:model.lazy="discount" 
                        class="form-control" 
                        style="width: 70px;" 
                        min="0" 
                        step="0.01" 
                        wire:input="calculateTotal"
                    >
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Shipping:</span>
                    <input 
                        type="number" 
                        wire:model.lazy="shipping" 
                        class="form-control" 
                        style="width: 70px;" 
                        min="0" 
                        step="0.01" 
                        wire:input="calculateTotal"
                    >
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Amount Paid:</span>
                    <input 
                        type="number" 
                        wire:model.lazy="amount_paid" 
                        class="form-control" 
                        style="width: 100px;" 
                        min="0" 
                        step="0.01" 
                        wire:input="calculateTotal"
                    >
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Total:</span>
                    <span>{{ $currency }} {{ number_format($total, 2) }}</span>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Balance Due:</span>
                    <span>{{ $currency }} {{ number_format($balance_due, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="mb-4 mt-4">
            <label class="form-label fw-bold">Additional Notes</label>
            <textarea 
                wire:model.lazy="notes" 
                class="form-control" 
                rows="4" 
                placeholder="Additional notes (optional)"
            ></textarea>
        </div>

        <!-- Submit Button for PDF Download -->
        <div class="text-center">
            <button 
                type="submit" 
                class="btn btn-outline-success btn-lg fw-bold" 
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Download PDF</span>
                <span wire:loading>Generating...</span>
            </button>
        </div>
    </form>
</div>
