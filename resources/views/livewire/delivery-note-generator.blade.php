@section('title', 'Free Delivery Note Generator | Create & Download Delivery Notes')
@section('meta_description', 'Generate professional delivery notes instantly with our free online delivery note generator. Customizable templates, instant PDF downloads, and no signup required!')
@section('meta_keywords', 'delivery note generator, free delivery note maker, create delivery note online, professional delivery documents')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Delivery Note Generator - Free Online Delivery Note Maker",
    "description": "Generate professional delivery notes instantly with our free delivery note generator. Choose from ready-to-use templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/delivery-note-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "170"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Delivery Note Generator</h2>

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
            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Background Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Upload Background (PNG, JPG only)</label>
            <div class="dropzone p-4 border rounded bg-light text-center" style="border-style: dashed;">
                <input type="file" wire:model.lazy="background" class="d-none" id="backgroundUpload">
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('backgroundUpload').click()">Choose Background</button>
                <p class="text-muted mt-2">Drag & drop background here, or click to upload</p>
            </div>
            @if ($background)
                <div class="mt-3 text-center">
                    <img src="{{ $background->temporaryUrl() }}" alt="Background Preview" class="img-fluid img-thumbnail" style="max-height: 120px;">
                    <button type="button" wire:click="$set('background', null)" class="btn btn-outline-danger btn-sm mt-2">Remove Background</button>
                </div>
            @endif
            @error('background') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Delivery Details -->
        <div class="row">
            <div class="col-md-4">
                <label class="form-label fw-bold">Delivery Note #</label>
                <input type="text" wire:model.lazy="deliveryNoteNumber" class="form-control" readonly>
                @error('deliveryNoteNumber') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Delivery Date</label>
                <input type="date" wire:model.lazy="deliveryDate" class="form-control">
                @error('deliveryDate') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Total Quantity</label>
                <input type="text" class="form-control" value="{{ $totalQuantity }}" readonly>
                @error('totalQuantity') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Sender and Recipient Details -->
        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Dispatch Address</label>
                <textarea wire:model.lazy="dispatchAddress" class="form-control" rows="3" placeholder="Enter dispatch address"></textarea>
                @error('dispatchAddress') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Recipient Address</label>
                <textarea wire:model.lazy="recipientAddress" class="form-control" rows="3" placeholder="Enter recipient address"></textarea>
                @error('recipientAddress') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Currency Selection -->
        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Currency</label>
                <select wire:model="currency" class="form-control">
                    @foreach($currencies as $code => $name)
                        <option value="{{ $code }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Items Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Items</label>
            <div class="bg-light p-3 rounded">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price ({{ $currency }})</th>
                            <th>Total ({{ $currency }})</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $index => $item)
                        <tr>
                            <td>
                                <input type="text" wire:model.lazy="items.{{ $index }}.description" class="form-control" placeholder="Item Description">
                                @error('items.' . $index . '.description') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="number" wire:model.lazy="items.{{ $index }}.quantity" class="form-control" placeholder="Quantity" min="1">
                                @error('items.' . $index . '.quantity') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="number" step="0.01" wire:model.lazy="items.{{ $index }}.price" class="form-control" placeholder="Price" min="0">
                                @error('items.' . $index . '.price') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                {{ $currency }} {{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 2) }}
                            </td>
                            <td>
                                <button type="button" wire:click="removeItem({{ $index }})" class="btn btn-outline-danger btn-sm">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Grand Total</th>
                            <th colspan="2">{{ $currency }} {{ number_format($grandTotal, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
                <button type="button" wire:click="addItem" class="btn btn-outline-primary">+ Add Item</button>
                @error('items') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Sender Details -->
        <div class="mt-4">
            <label class="form-label fw-bold">Sender Details</label>
            <textarea wire:model.lazy="senderDetails" class="form-control" rows="3" placeholder="Enter sender's details"></textarea>
            @error('senderDetails') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Additional Notes Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Notes</label>
            <textarea wire:model.lazy="notes" class="form-control" rows="4" placeholder="Enter any additional notes here..."></textarea>
            @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Download Delivery Note</button>
        </div>
    </form>
</div>
