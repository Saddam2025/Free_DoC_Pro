@section('title', 'Free Business Card Generator | Create Professional Business Cards Online')
@section('meta_description', 'Design and customize professional business cards online with our free Business Card Generator. Download high-quality business cards in minutes.')
@section('meta_keywords', 'business card generator, free business card maker, online business card creator, professional business cards, custom business card templates')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Business Card Generator - Free Online Business Card Maker",
    "description": "Easily create and download professional business cards with our free online business card generator. Customize with logos, contact details, and branding, and download high-quality business cards in PDF format.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/business-card-generator-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "185"
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
    <h2 class="text-center mb-4 fw-bold text-dark">Business Card Generator</h2>

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

        <!-- Business Card Details -->
        <div class="row">
            <div class="col-md-6">
                <label class="form-label fw-bold">Name</label>
                <input type="text" wire:model.lazy="name" class="form-control" placeholder="Enter your name">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Job Title</label>
                <input type="text" wire:model.lazy="jobTitle" class="form-control" placeholder="Enter your job title">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Company Name</label>
                <input type="text" wire:model.lazy="companyName" class="form-control" placeholder="Enter company name">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" wire:model.lazy="email" class="form-control" placeholder="Enter your email">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone</label>
                <input type="text" wire:model.lazy="phone" class="form-control" placeholder="Enter your phone number">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Website</label>
                <input type="text" wire:model.lazy="website" class="form-control" placeholder="Enter your website">
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label fw-bold">Address</label>
            <textarea wire:model.lazy="address" class="form-control" rows="2" placeholder="Enter your address"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Download Business Card</button>
        </div>
    </form>
</div>
