@section('title', 'Free CV Maker | Create Professional Resumes Instantly')
@section('meta_description', 'Build a professional CV online for free. Our CV generator provides customizable templates and instant downloads. No signup required!')
@section('meta_keywords', 'cv maker, free cv generator, online resume builder, create cv, professional resume maker')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "CV Maker - Free Online Resume Builder",
    "description": "Create a professional CV instantly with our free CV generator. Choose from ready-to-use templates, customize your resume, and download it as a PDF.",
    "applicationCategory": "BusinessApplication",
    "operatingSystem": "All",
    "url": "{{ request()->url() }}",
    "image": "{{ asset('images/cv-generator-preview.png') }}",
    "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
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
    <!-- Page Title & Introduction -->
    <h2 class="text-center mb-4 fw-bold text-dark">Free Online CV Generator</h2>

    <p class="text-center text-muted lead">
        Create a professional CV instantly with our **free online CV maker**. No signup required!
        Simply enter your details, customize your resume, and **download your CV as a PDF**.
    </p>

    <form wire:submit.prevent="generatePDF" class="bg-white p-5 rounded shadow-sm">
        <!-- Profile Photo Upload -->
        <h4 class="fw-bold mb-3">Profile Photo</h4>
        <div class="mb-4">
            <div class="dropzone p-4 border rounded bg-light text-center" style="border-style: dashed;">
                <input type="file" wire:model.lazy="photo" class="d-none" id="photoUpload">
                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('photoUpload').click()">Choose Photo</button>
                <p class="text-muted mt-2">Drag & drop your photo here, or click to upload</p>
            </div>
            @if ($photo)
                <div class="mt-3 text-center">
                    <img src="{{ $photo->temporaryUrl() }}" alt="Profile Photo Preview" class="img-fluid img-thumbnail" style="max-height: 120px;">
                </div>
            @endif
        </div>

        <!-- Personal Details -->
        <h4 class="fw-bold mb-3">Personal Details</h4>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" wire:model.lazy="fullName" class="form-control" placeholder="Enter your name">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Date of Birth</label>
                <input type="date" wire:model.lazy="dob" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Email</label>
                <input type="email" wire:model.lazy="email" class="form-control" placeholder="Enter your email">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Mobile Number</label>
                <input type="tel" wire:model.lazy="phone" class="form-control" placeholder="Enter mobile number">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Gender</label>
                <select wire:model.lazy="gender" class="form-select">
                    <option value="" disabled>Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Occupation</label>
                <input type="text" wire:model.lazy="occupation" class="form-control" placeholder="Enter occupation">
            </div>
        </div>

        <!-- Identity Details -->
        <h4 class="fw-bold mt-4 mb-3">Identity Details</h4>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">ID Type</label>
                <input type="text" wire:model.lazy="idType" class="form-control" placeholder="Enter ID type">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">ID Number</label>
                <input type="text" wire:model.lazy="idNumber" class="form-control" placeholder="Enter ID number">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Issue Authority</label>
                <input type="text" wire:model.lazy="issueAuthority" class="form-control" placeholder="Enter issue authority">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Issue Date</label>
                <input type="date" wire:model.lazy="issueDate" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Issue State</label>
                <input type="text" wire:model.lazy="issueState" class="form-control" placeholder="Enter issue state">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Expiry Date</label>
                <input type="date" wire:model.lazy="expiryDate" class="form-control">
            </div>
        </div>

        <!-- Summary -->
        <h4 class="fw-bold mt-4 mb-3">Summary</h4>
        <div class="mb-4">
            <textarea wire:model.lazy="summary" class="form-control" rows="3" placeholder="Write a short professional summary"></textarea>
        </div>

        <!-- Education -->
        <h4 class="fw-bold mt-4 mb-3">Education</h4>
        <div class="mb-4">
            @foreach($education as $index => $edu)
                <div class="row g-2 mb-2">
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="education.{{ $index }}.degree" class="form-control" placeholder="Degree">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="education.{{ $index }}.institution" class="form-control" placeholder="Institution">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="education.{{ $index }}.startYear" class="form-control" placeholder="Start Year">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="education.{{ $index }}.endYear" class="form-control" placeholder="End Year">
                    </div>
                </div>
            @endforeach
            <button type="button" wire:click="addEducation" class="btn btn-outline-primary btn-sm">+ Add Education</button>
        </div>

        <!-- Work Experience -->
        <h4 class="fw-bold mt-4 mb-3">Work Experience</h4>
        <div class="mb-4">
            @foreach($experience as $index => $exp)
                <div class="row g-2 mb-2">
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="experience.{{ $index }}.position" class="form-control" placeholder="Position">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="experience.{{ $index }}.company" class="form-control" placeholder="Company">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="experience.{{ $index }}.startYear" class="form-control" placeholder="Start Year">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model.lazy="experience.{{ $index }}.endYear" class="form-control" placeholder="End Year">
                    </div>
                </div>
            @endforeach
            <button type="button" wire:click="addExperience" class="btn btn-outline-primary btn-sm">+ Add Experience</button>
        </div>

        <!-- Skills -->
        <h4 class="fw-bold mt-4 mb-3">Skills</h4>
        <div class="mb-4">
            <textarea wire:model.lazy="skills" class="form-control" rows="3" placeholder="Enter your skills, separated by commas"></textarea>
        </div>

        <!-- Submit -->
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg">Generate CV</button>
        </div>
    </form>
</div>
