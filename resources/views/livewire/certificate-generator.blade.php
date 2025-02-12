@section('title', '⭐ Free Certificate Generator - Design & Download Professional Certificates Online')
@section('meta_description', '✅ Instantly generate high-quality certificates online! Free certificate maker with customizable templates, ready-to-print PDFs & no signup required.')
@section('meta_keywords', 'certificate generator, free certificate maker, online certificate creator, professional certificates, document generator, design certificates online, digital certificates')
@section('schema')

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Certificate Generator - Create Professional Certificates for Free",
    "description": "Generate professional certificates quickly with our free certificate generator. Simple, efficient, and secure document creation.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/logo.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "125"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Doc Pro",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('images/logo.png') }}"
        }
    },
    "sameAs": [
        "https://www.facebook.com/docprofree",
        "https://twitter.com/docproofficial",
        "https://www.linkedin.com/company/docpro",
        "https://www.youtube.com/@DocPro-FreeDocumentMaker"
    ]
}
</script>
@endsection


<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-dark">Certificate Generator</h2>

    <!-- Main Form Triggering generatePDF() in CertificateGenerator Livewire Component -->
    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm">

        <!-- Logo Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">
                Upload Logo (PNG, JPG only)
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
                />
                <button 
                    type="button" 
                    class="btn btn-outline-primary"
                >
                    Choose Logo
                </button>
                <p class="text-muted mt-2">
                    Drag &amp; drop logo here, or click to upload
                </p>
            </div>

            <!-- Preview -->
            @if ($logo)
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

        <!-- Background Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">
                Upload Background (PNG, JPG only)
            </label>
            <div 
                class="dropzone p-4 border rounded bg-light text-center" 
                style="border-style: dashed; cursor: pointer;"
                onclick="document.getElementById('backgroundUpload').click()"
            >
                <!-- Hidden File Input -->
                <input 
                    type="file" 
                    wire:model.lazy="background" 
                    class="d-none" 
                    id="backgroundUpload"
                />
                <button 
                    type="button" 
                    class="btn btn-outline-primary"
                >
                    Choose Background
                </button>
                <p class="text-muted mt-2">
                    Drag &amp; drop background here, or click to upload
                </p>
            </div>

            <!-- Preview -->
            @if ($background)
                <div class="mt-3 text-center">
                    <img 
                        src="{{ $background->temporaryUrl() }}" 
                        alt="Background Preview" 
                        class="img-fluid img-thumbnail" 
                        style="max-height: 120px;"
                    >
                    <button 
                        type="button" 
                        wire:click="$set('background', null)" 
                        class="btn btn-outline-danger btn-sm mt-2"
                    >
                        Remove Background
                    </button>
                </div>
            @endif
        </div>

        <!-- Certificate Fields -->
        <div class="mb-4">
            <label class="form-label fw-bold">Recipient Name</label>
            <input 
                type="text" 
                wire:model.lazy="recipientName" 
                class="form-control" 
                placeholder="Enter recipient's name"
            >
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Certificate Title</label>
            <input 
                type="text" 
                wire:model.lazy="certificateTitle" 
                class="form-control" 
                placeholder="Enter certificate title"
            >
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Date</label>
            <input 
                type="date" 
                wire:model.lazy="date" 
                class="form-control"
            >
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Organization Name</label>
            <input 
                type="text" 
                wire:model.lazy="organizationName" 
                class="form-control" 
                placeholder="Enter organization name"
            >
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Issuer Name</label>
            <input 
                type="text" 
                wire:model.lazy="issuerName" 
                class="form-control" 
                placeholder="Enter issuer's name and title"
            >
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="form-label fw-bold">Description</label>
            <textarea 
                wire:model.lazy="description" 
                class="form-control" 
                rows="3" 
                placeholder="Enter a custom description"
            ></textarea>
        </div>

        <!-- Font Style & Size -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Font Style</label>
                <select 
                    wire:model.lazy="fontStyle" 
                    class="form-select"
                >
                    <option value="serif">Serif</option>
                    <option value="sans-serif">Sans-serif</option>
                    <option value="monospace">Monospace</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Font Size</label>
                <input 
                    type="number" 
                    wire:model.lazy="fontSize" 
                    class="form-control" 
                    placeholder="Enter font size" 
                    min="10" 
                    max="50"
                >
            </div>
        </div>

        <!-- Signature Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">
                Upload Signature (PNG, JPG only)
            </label>
            <div 
                class="dropzone p-4 border rounded bg-light text-center" 
                style="border-style: dashed; cursor: pointer;"
                onclick="document.getElementById('signatureUpload').click()"
            >
                <!-- Hidden File Input -->
                <input 
                    type="file" 
                    wire:model.lazy="signature" 
                    class="d-none" 
                    id="signatureUpload"
                />
                <button 
                    type="button" 
                    class="btn btn-outline-primary"
                >
                    Choose Signature
                </button>
                <p class="text-muted mt-2">
                    Drag &amp; drop signature here, or click to upload
                </p>
            </div>
            @if($signature)
                <div class="mt-3 text-center">
                    <img 
                        src="{{ $signature->temporaryUrl() }}" 
                        alt="Signature Preview" 
                        class="img-fluid img-thumbnail" 
                        style="max-height: 120px;"
                    >
                    <button 
                        type="button" 
                        wire:click="$set('signature', null)" 
                        class="btn btn-outline-danger btn-sm mt-2"
                    >
                        Remove Signature
                    </button>
                </div>
            @endif
        </div>

        <!-- Digital Signature Text Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Digital Signature (Type Name)</label>
            <input 
                type="text" 
                wire:model.lazy="digitalSignatureText" 
                class="form-control" 
                placeholder="Enter digital signature text"
            >
        </div>

        <!-- Stamp Upload Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">
                Upload Stamp (PNG, JPG only)
            </label>
            <div 
                class="dropzone p-4 border rounded bg-light text-center" 
                style="border-style: dashed; cursor: pointer;"
                onclick="document.getElementById('stampUpload').click()"
            >
                <!-- Hidden File Input -->
                <input 
                    type="file" 
                    wire:model.lazy="stamp" 
                    class="d-none" 
                    id="stampUpload"
                />
                <button 
                    type="button" 
                    class="btn btn-outline-primary"
                >
                    Choose Stamp
                </button>
                <p class="text-muted mt-2">
                    Drag &amp; drop stamp here, or click to upload
                </p>
            </div>
            @if($stamp)
                <div class="mt-3 text-center">
                    <img 
                        src="{{ $stamp->temporaryUrl() }}" 
                        alt="Stamp Preview" 
                        class="img-fluid img-thumbnail" 
                        style="max-height: 120px;"
                    >
                    <button 
                        type="button" 
                        wire:click="$set('stamp', null)" 
                        class="btn btn-outline-danger btn-sm mt-2"
                    >
                        Remove Stamp
                    </button>
                </div>
            @endif
        </div>

        <!-- Additional Digital Stamp Text Section -->
        <div class="mb-4">
            <label class="form-label fw-bold">Digital Stamp (Type Text)</label>
            <input 
                type="text" 
                wire:model.lazy="digitalStampText" 
                class="form-control" 
                placeholder="Enter digital stamp text"
            >
        </div>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button 
                type="submit" 
                class="btn btn-success btn-lg"
            >
                Download Certificate
            </button>
        </div>
    </form>
</div>
