@extends('layouts.app')

@section('title', 'Doc Pro - Powerful Document Generation Features')
@section('meta_description', 'Discover Doc Pro\'s top features for creating invoices, CVs, receipts, contracts, and more in seconds. AI-powered efficiency, seamless customization, and high-quality document output.')
@section('meta_keywords', 'document generation, free invoice maker, online CV builder, contract templates, receipt generator, legal documents, digital agreements, professional certificates')

@section('schema')
<!-- ✅ Structured Data for SEO Optimization -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Doc Pro - Powerful Document Generation Features",
  "url": "https://www.freedocumentmaker.com/features",
  "description": "Discover Doc Pro's features for generating invoices, CVs, receipts, and contracts effortlessly. AI-powered, customizable, and professional-grade document creation.",
  "author": {
    "@type": "Organization",
    "name": "Doc Pro",
    "url": "https://www.freedocumentmaker.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://www.freedocumentmaker.com/images/logo.png",
      "width": 512,
      "height": 512
    }
  },
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.freedocumentmaker.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endsection

@section('content')

<!-- ✅ Hero Section -->
<section id="hero" class="relative bg-gradient-to-r from-blue-600 via-indigo-700 to-purple-600 text-white text-center py-24">
    <div class="container mx-auto px-6">
        <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-6 tracking-wide" data-aos="fade-down">
            Generate Documents Instantly, Effortlessly.
        </h1>
        <p class="text-lg sm:text-xl max-w-3xl mx-auto opacity-90 mb-8" data-aos="fade-down" data-aos-delay="100">
            From <strong>invoices and contracts</strong> to <strong>resumes and certificates</strong>, create documents in seconds with professional-grade formatting.
        </p>
        <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-10 py-4 rounded-full font-bold shadow-lg hover:bg-gray-100 transition">
            Get Started for Free 🚀
        </a>
    </div>
</section>

<!-- ✅ Features Section -->
<section id="features" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl sm:text-5xl font-extrabold tracking-wide mb-10 text-gray-800 text-center" data-aos="fade-up">
            Powerful Document Creation Features
        </h2>
        <p class="text-lg sm:text-xl text-gray-600 mb-16 leading-relaxed max-w-3xl mx-auto text-center">
            Simplify your workflow with one-click document generation. Choose from a range of tools to create professional-grade documents effortlessly.
        </p>

        @foreach([
            [
                'title'       => 'Instant Invoice Generator',
                'image'       => 'mockups/invoice-mockup.png',
                'description' => 'Generate <strong>professional invoices</strong> in seconds with tax calculations and branding.',
                'benefit'     => '✔ Custom fields | ✔ Print-ready PDFs | ✔ Client Management',
                'route'       => route('invoice.generator'),
                'reverse'     => false
            ],
            [
                'title'       => 'AI-Powered CV Builder',
                'image'       => 'mockups/cv-mockup.png',
                'description' => 'Create stunning <strong>resumes</strong> with AI-optimized formatting.',
                'benefit'     => '✔ Pre-built templates | ✔ Auto-formatting | ✔ One-click download',
                'route'       => route('cv.generator'),
                'reverse'     => true
            ],
            [
                'title'       => 'Smart Receipt Maker',
                'image'       => 'mockups/receipt-mockup.png',
                'description' => 'Easily create <strong>professional receipts</strong> for transactions.',
                'benefit'     => '✔ Unlimited templates | ✔ Auto-calculations | ✔ Digital storage',
                'route'       => route('receipt.generator'),
                'reverse'     => false
            ],
            [
                'title'       => 'Certificate Generator',
                'image'       => 'mockups/certificate-mockup.png',
                'description' => 'Create professional <strong>certificates</strong> for your achievements or events.',
                'benefit'     => '✔ High-quality design | ✔ Customizable templates | ✔ Free to use',
                'route'       => route('certificate.generator'),
                'reverse'     => true
            ],
            [
                'title'       => 'Agreement Generator',
                'image'       => 'mockups/agreement-mockup.png',
                'description' => 'Generate <strong>legally binding agreements</strong> for business or personal use.',
                'benefit'     => '✔ Pre-written clauses | ✔ Customizable terms | ✔ Instant download',
                'route'       => route('agreement.generator'),
                'reverse'     => false
            ],
            [
                'title'       => 'Job Offer Letter Generator',
                'image'       => 'mockups/job-offer-mockup.png',
                'description' => 'Easily create professional <strong>job offer letters</strong> for recruitment.',
                'benefit'     => '✔ Ready-to-use templates | ✔ Customizable sections | ✔ Free to use',
                'route'       => route('job.offer.letter.generator'),
                'reverse'     => true
            ],
            [
                'title'       => 'Proforma Invoice Generator',
                'image'       => 'mockups/proforma-mockup.png',
                'description' => 'Create <strong>proforma invoices</strong> to provide estimates for your customers.',
                'benefit'     => '✔ Detailed breakdown | ✔ Printable | ✔ Customizable items',
                'route'       => route('proforma.invoice.generator'),
                'reverse'     => false
            ]
        ] as $feature)
            <div class="flex flex-col md:flex-row {{ $feature['reverse'] ? 'md:flex-row-reverse' : '' }} items-center gap-10 mb-20" data-aos="fade-up" data-aos-delay="150">
                <div class="md:w-1/2 relative">
                    <img src="{{ asset($feature['image']) }}" alt="{{ $feature['title'] }}" class="relative w-full rounded-xl shadow-2xl transform hover:scale-105 transition">
                </div>
                <div class="md:w-1/2 text-center md:text-left space-y-4">
                    <h3 class="text-3xl sm:text-4xl font-bold text-gray-800">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600 text-lg">{!! $feature['description'] !!}</p>
                    <p class="mt-1 text-gray-500 text-sm">{{ $feature['benefit'] }}</p>
                    <a href="{{ $feature['route'] }}" class="inline-block mt-4 bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition">
                        Try {{ $feature['title'] }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- ✅ Call-to-Action -->
<section class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-20 text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl sm:text-5xl font-extrabold mb-6">Start Creating Professional Documents Today 📑</h2>
        <p class="text-lg sm:text-xl mb-8">Join over <strong>10,000 professionals</strong> who trust Doc Pro.</p>
        <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-10 py-4 rounded-full font-bold hover:bg-gray-100 transition">
            Sign Up for Free 🚀
        </a>
    </div>
</section>

@endsection
