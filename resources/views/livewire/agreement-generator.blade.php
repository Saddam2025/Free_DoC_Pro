@section('title', 'Free Agreement Generator | Create & Download Legal Agreements Instantly')
@section('meta_description', 'Generate legally binding agreements online with our free Agreement Generator. Customize contracts, add signatures, and download professional PDF agreements.')
@section('meta_keywords', 'agreement generator, contract maker, free agreement generator, online contract creator, legal documents, business agreements')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "Agreement Generator - Free Online Contract Maker",
    "description": "Easily create and download professional agreements with our free online contract generator. Customize legal documents, add digital signatures, and download high-quality PDF agreements.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/agreement-generator-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
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
    <h2 class="text-center mb-4 fw-bold text-dark">Agreement Generator</h2>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Agreement Form -->
    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Party A Details -->
        <h4 class="fw-bold mb-3">Party A Information</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" wire:model="partyA.full_name" class="form-control" placeholder="Enter Full Name">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Date of Birth</label>
                <input type="date" wire:model="partyA.date_of_birth" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" wire:model="partyA.email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Mobile Number</label>
                <input type="tel" wire:model="partyA.mobile" class="form-control" placeholder="Enter Mobile Number">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Gender</label>
                <select wire:model="partyA.gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Occupation</label>
                <input type="text" wire:model="partyA.occupation" class="form-control" placeholder="Enter Occupation">
            </div>
            <div class="col-md-12">
                <label class="form-label fw-bold">Address</label>
                <textarea wire:model="partyA.address" class="form-control" rows="2" placeholder="Enter Address"></textarea>
            </div>
        </div>

        <!-- Party B Details -->
        <h4 class="fw-bold mt-4 mb-3">Party B Information</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" wire:model="partyB.full_name" class="form-control" placeholder="Enter Full Name">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Date of Birth</label>
                <input type="date" wire:model="partyB.date_of_birth" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" wire:model="partyB.email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Mobile Number</label>
                <input type="tel" wire:model="partyB.mobile" class="form-control" placeholder="Enter Mobile Number">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Gender</label>
                <select wire:model="partyB.gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Occupation</label>
                <input type="text" wire:model="partyB.occupation" class="form-control" placeholder="Enter Occupation">
            </div>
            <div class="col-md-12">
                <label class="form-label fw-bold">Address</label>
                <textarea wire:model="partyB.address" class="form-control" rows="2" placeholder="Enter Address"></textarea>
            </div>
        </div>

        <!-- Agreement Details -->
        <h4 class="fw-bold mt-4 mb-3">Agreement Details</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Agreement Date</label>
                <input type="date" wire:model="agreementDate" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Agreement Type</label>
                <input type="text" wire:model="agreementType" class="form-control" placeholder="Enter Agreement Type">
            </div>
        </div>

        <!-- Custom Clauses -->
        <h4 class="fw-bold mt-4 mb-3">Custom Clauses</h4>
        @foreach($customClauses as $index => $clause)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <label class="form-label">Clause Title</label>
                            <input type="text" wire:model="customClauses.{{ $index }}.title" class="form-control" placeholder="Clause Title">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Clause Content</label>
                            <textarea wire:model="customClauses.{{ $index }}.content" class="form-control" placeholder="Clause Content"></textarea>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" wire:click="removeClause({{ $index }})" class="btn btn-outline-danger btn-sm">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <button type="button" wire:click="addClause" class="btn btn-outline-primary mb-4">+ Add Clause</button>

        <!-- Standard Terms -->
        <h4 class="fw-bold mt-4 mb-3">Standard Terms</h4>
        @foreach($standardTerms as $index => $term)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-10">
                            <textarea wire:model="standardTerms.{{ $index }}" class="form-control" placeholder="Enter Standard Term">{{ $term }}</textarea>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" wire:click="removeStandardTerm({{ $index }})" class="btn btn-outline-danger btn-sm">Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <button type="button" wire:click="addStandardTerm" class="btn btn-outline-primary mb-4">+ Add Standard Term</button>

        <!-- Submit Button -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg" wire:loading.attr="disabled">
                <span wire:loading.remove>Generate Agreement</span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Generating...
                </span>
            </button>
        </div>
    </form>
</div>
