@section('title', 'Free Purchase Order Generator | Create & Download Purchase Orders Online')
@section('meta_description', 'Generate professional purchase orders instantly with our free purchase order generator. Easy-to-use templates, instant PDF download, and no signup required!')
@section('meta_keywords', 'purchase order generator, free purchase order maker, create purchase orders, online PO generator')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Purchase Order Generator - Free Online PO Maker",
    "description": "Create professional purchase orders instantly with our free purchase order generator. Choose from ready-to-use templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/purchase-order-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "175"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Purchase Order Generator</h2>

    <!-- Main Form -->
    <form wire:submit.prevent="downloadPDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Logo Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">
                Upload Logo <span class="text-muted">(PNG, JPG only)</span>
            </label>
            <div 
                class="dropzone p-4 border rounded bg-light text-center" 
                style="border-style: dashed; cursor: pointer;"
                onclick="document.getElementById('logoUpload').click()"
            >
                <!-- Hidden File Input -->
                <input 
                    type="file" 
                    wire:model.lazy="logo" 
                    class="d-none" 
                    id="logoUpload" 
                    accept="image/png, image/jpeg"
                />
                <!-- Button & Info -->
                <button type="button" class="btn btn-outline-primary">
                    Choose Logo
                </button>
                <p class="text-muted mt-2">
                    Drag & drop logo here, or click to upload
                </p>
            </div>
            <!-- Preview -->
            @if($logo)
                <div class="mt-3 text-center">
                    <img 
                        src="{{ $logo->temporaryUrl() }}" 
                        alt="Logo Preview" 
                        class="img-fluid img-thumbnail" 
                        style="max-height: 120px;"
                    >
                    <button 
                        type="button" 
                        wire:click="$set('logo', null)" 
                        class="btn btn-outline-danger btn-sm mt-2"
                    >
                        Remove Logo
                    </button>
                </div>
            @endif
        </div>

        <!-- Purchase Order Basic Info -->
        <div class="row">
            <!-- PO Number -->
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Purchase Order #</label>
                <input 
                    type="text" 
                    wire:model.lazy="purchase_order_number" 
                    class="form-control" 
                    placeholder="Enter Purchase Order Number" 
                    required
                >
            </div>
            <!-- Date -->
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Date</label>
                <input 
                    type="date" 
                    wire:model.lazy="date" 
                    class="form-control" 
                    required
                >
            </div>
            <!-- Expiry Date -->
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Expiry Date</label>
                <input 
                    type="date" 
                    wire:model.lazy="expiry_date" 
                    class="form-control" 
                    required
                >
            </div>
        </div>

        <!-- Currency -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Currency</label>
                <select 
                    wire:model.lazy="currency" 
                    class="form-select" 
                    required
                >
                    <option value="" disabled>Select Currency</option>
                    @foreach($currencySymbols as $symbol => $label)
                        <option value="{{ $symbol }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Seller & Buyer -->
        <div class="row">
            <!-- Seller/From -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">From (Supplier)</label>
                <textarea 
                    wire:model.lazy="from" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Your Name, Address, Contact"
                    required
                ></textarea>
            </div>
            <!-- Buyer/To -->
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">To (Buyer)</label>
                <textarea 
                    wire:model.lazy="to" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Recipient's Name, Address, Contact"
                    required
                ></textarea>
            </div>
        </div>

        <!-- Optional Reference & Delivery Address -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Reference Quote Number</label>
                <input 
                    type="text" 
                    wire:model.lazy="reference_quote_number" 
                    class="form-control" 
                    placeholder="Enter Quote Number (if applicable)"
                >
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Delivery Address</label>
                <textarea 
                    wire:model.lazy="delivery_address" 
                    class="form-control" 
                    rows="3" 
                    placeholder="Delivery Address"
                ></textarea>
            </div>
        </div>

        <!-- Billing Address -->
        <div class="mb-4">
            <label class="form-label fw-bold">Billing Address</label>
            <textarea 
                wire:model.lazy="billing_address" 
                class="form-control" 
                rows="3" 
                placeholder="Billing Address"
            ></textarea>
        </div>

        <!-- Items -->
        <div class="mb-4">
            <label class="form-label fw-bold">Items</label>
            <div class="bg-light p-3 rounded border">
                @foreach($items as $index => $item)
                    <div class="row g-2 align-items-center mb-3" wire:key="item-{{ $index }}">
                        <div class="col-md-4">
                            <input 
                                type="text" 
                                wire:model.lazy="items.{{ $index }}.description" 
                                class="form-control" 
                                placeholder="Description" 
                                required
                            >
                        </div>
                        <div class="col-md-2">
                            <input 
                                type="number" 
                                wire:model.lazy="items.{{ $index }}.quantity" 
                                class="form-control" 
                                placeholder="Qty" 
                                min="1"
                                required
                            >
                        </div>
                        <div class="col-md-2">
                            <input 
                                type="number" 
                                wire:model.lazy="items.{{ $index }}.rate" 
                                class="form-control" 
                                placeholder="Rate" 
                                min="0" 
                                step="0.01"
                                required
                            >
                        </div>
                        <div class="col-md-2">
                            <span class="form-control text-muted bg-light">
                                {{ $currency }} 
                                {{ number_format($item['quantity'] * $item['rate'], 2) }}
                            </span>
                        </div>
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
                <button 
                    type="button" 
                    wire:click="addItem" 
                    class="btn btn-outline-primary"
                >
                    + Add Item
                </button>
            </div>
        </div>

        <!-- Totals -->
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
                        wire:model.lazy="tax_rate" 
                        class="form-control" 
                        style="width: 70px;" 
                        min="0" 
                        step="0.01"
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
                    >
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Shipping:</span>
                    <input 
                        type="number" 
                        wire:model.lazy="shipping_charges" 
                        class="form-control" 
                        style="width: 70px;" 
                        min="0" 
                        step="0.01"
                    >
                </div>
                
                <hr class="my-2">
                
                <div class="d-flex justify-content-between mt-2">
                    <span class="fw-bold">Total:</span>
                    <span>{{ $currency }} {{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Delivery Terms -->
        <div class="mt-4">
            <label class="form-label fw-bold">Delivery Terms</label>
            <textarea 
                wire:model.lazy="delivery_terms" 
                class="form-control" 
                rows="3" 
                placeholder="Enter Delivery Terms"
            ></textarea>
        </div>

        <!-- Payment Terms -->
        <div class="mt-4">
            <label class="form-label fw-bold">Payment Terms</label>
            <textarea 
                wire:model.lazy="payment_terms" 
                class="form-control" 
                rows="3" 
                placeholder="Enter Payment Terms"
            ></textarea>
        </div>

        <!-- Authorized Signature -->
        <div class="mt-4">
            <label class="form-label fw-bold">Authorized Signature</label>
            <input 
                type="text" 
                wire:model.lazy="authorized_signature" 
                class="form-control" 
                placeholder="Authorized Person's Name"
            >
        </div>

        <!-- Terms and Conditions -->
        <div class="mt-4">
            <label class="form-label fw-bold">Terms and Conditions</label>
            <textarea 
                wire:model.lazy="terms_and_conditions" 
                class="form-control" 
                rows="3" 
                placeholder="Terms and Conditions (Optional)"
            ></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button 
                type="submit" 
                class="btn btn-success btn-lg fw-bold"
            >
                Download Purchase Order
            </button>
        </div>
    </form>
</div>
