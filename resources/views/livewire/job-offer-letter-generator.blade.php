@section('title', 'Free Job Offer Letter Generator | Create & Download Offer Letters Instantly')
@section('meta_description', 'Generate professional job offer letters online for free with our Job Offer Letter Generator. Customize details, add company branding, and download as a PDF.')
@section('meta_keywords', 'job offer letter generator, free job offer template, online job letter creator, employment offer letter, HR job offer letter maker')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Job Offer Letter Generator - Free Online Job Offer Letter Maker",
    "description": "Create professional job offer letters instantly with our free generator. Customize company details, include position information, and download as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/job-offer-letter-preview.png') }}",
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
    <h2 class="text-center mb-4 fw-bold text-dark">Job Offer Letter Generator</h2>

    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Logo Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Upload Company Logo (PNG, JPG only)</label>
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

        <!-- Candidate Details -->
        <div class="mb-4">
            <label class="form-label fw-bold">Candidate Name</label>
            <input type="text" wire:model.lazy="candidateName" class="form-control" placeholder="Enter candidate's name">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Candidate Address</label>
            <textarea wire:model.lazy="candidateAddress" class="form-control" rows="2" placeholder="Enter candidate's address"></textarea>
        </div>

        <!-- Company Details -->
        <div class="mb-4">
            <label class="form-label fw-bold">Company Name</label>
            <input type="text" wire:model.lazy="companyName" class="form-control" placeholder="Enter company name">
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Company Address</label>
            <textarea wire:model.lazy="companyAddress" class="form-control" rows="2" placeholder="Enter company address"></textarea>
        </div>

        <!-- Job Details -->
        <div class="row">
            <div class="col-md-6">
                <label class="form-label fw-bold">Job Title</label>
                <input type="text" wire:model.lazy="jobTitle" class="form-control" placeholder="Enter job title">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Start Date</label>
                <input type="date" wire:model.lazy="startDate" class="form-control">
            </div>
        </div>
        <div class="mt-4">
            <label class="form-label fw-bold">Salary</label>
            <input type="text" wire:model.lazy="salary" class="form-control" placeholder="Enter salary details">
        </div>

        <!-- Additional Terms -->
        <div class="mt-4">
            <label class="form-label fw-bold">Additional Terms</label>
            <textarea wire:model.lazy="additionalTerms" class="form-control" rows="3" placeholder="Enter any additional terms"></textarea>
        </div>

        <!-- Signature Upload Section -->
        <div class="mt-4">
            <label class="form-label fw-bold">Upload Authorized Signature (PNG, JPG only)</label>
            <div class="dropzone p-4 border rounded bg-light text-center" style="border-style: dashed;">
                <input type="file" wire:model.lazy="signature" class="d-none" id="signatureUpload">
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('signatureUpload').click()">Choose Signature</button>
                <p class="text-muted mt-2">Drag & drop signature here, or click to upload</p>
            </div>
            @if ($signature)
                <div class="mt-3 text-center">
                    <img src="{{ $signature->temporaryUrl() }}" alt="Signature Preview" class="img-fluid img-thumbnail" style="max-height: 120px;">
                    <button type="button" wire:click="$set('signature', null)" class="btn btn-outline-danger btn-sm mt-2">Remove Signature</button>
                </div>
            @endif
        </div>

        <!-- Authorized Person -->
        <div class="mt-4">
            <label class="form-label fw-bold">Authorized Person</label>
            <input type="text" wire:model.lazy="authorizedPerson" class="form-control" placeholder="Enter authorized person's name and title">
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Download Job Offer Letter</button>
        </div>
    </form>
</div>
