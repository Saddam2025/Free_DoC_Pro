@section('title', 'Free Expense Report Generator | Track & Manage Expenses Online')
@section('meta_description', 'Generate professional expense reports instantly with our free online expense report generator. Customizable templates, instant PDF downloads, and no signup required!')
@section('meta_keywords', 'expense report generator, free expense report maker, online expense tracking, business expenses, financial reports')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Expense Report Generator - Free Online Expense Tracking",
    "description": "Generate detailed expense reports instantly with our free expense report generator. Choose from pre-designed templates, customize details, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/expense-report-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "180"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Expense Report Generator</h2>

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

        <!-- Report Title and Date -->
        <div class="row">
            <div class="col-md-6">
                <label class="form-label fw-bold">Report Title</label>
                <input type="text" wire:model.lazy="reportTitle" class="form-control" placeholder="Enter report title">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Report Date</label>
                <input type="date" wire:model.lazy="reportDate" class="form-control">
            </div>
        </div>

        <!-- Expenses Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Expenses</label>
            <div class="bg-light p-3 rounded">
                @foreach($expenses as $index => $expense)
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-md-2">
                            <input type="date" wire:model.lazy="expenses.{{ $index }}.date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="text" wire:model.lazy="expenses.{{ $index }}.category" class="form-control" placeholder="Category">
                        </div>
                        <div class="col-md-4">
                            <input type="text" wire:model.lazy="expenses.{{ $index }}.description" class="form-control" placeholder="Description">
                        </div>
                        <div class="col-md-2">
                            <input type="number" wire:model.lazy="expenses.{{ $index }}.amount" class="form-control" placeholder="Amount" step="0.01">
                        </div>
                        <div class="col-md-1">
                            <button type="button" wire:click="removeExpense({{ $index }})" class="btn btn-outline-danger btn-sm">Remove</button>
                        </div>
                    </div>
                @endforeach
                <button type="button" wire:click="addExpense" class="btn btn-outline-primary">+ Add Expense</button>
            </div>
        </div>

        <!-- Notes Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Notes</label>
            <textarea wire:model.lazy="notes" class="form-control" rows="3" placeholder="Enter any additional notes"></textarea>
        </div>

        <!-- Total Amount -->
        <div class="mt-4 text-end">
            <h4>Total: ${{ number_format($totalAmount, 2) }}</h4>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Download Expense Report</button>
        </div>
    </form>
</div>
