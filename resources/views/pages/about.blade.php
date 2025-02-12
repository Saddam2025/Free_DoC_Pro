@extends('layouts.app')

@section('title', 'About Us | Learn More About Doc Pro')
@section('meta_description', 'Learn more about Doc Pro, the leading free online document generator for invoices, CVs, receipts, agreements, and more. Discover our mission and commitment to simplicity and efficiency.')
@section('meta_keywords', 'about Doc Pro, about us, free document generator, company mission, document tools, online document creator')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Doc Pro",
    "url": "https://www.freedocumentmaker.com",
    "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('images/logo.png') }}",
        "width": 512,
        "height": 512
    },
    "description": "Doc Pro provides free, professional document generation tools, including invoices, receipts, CVs, agreements, and more.",
    "sameAs": [
        "https://www.facebook.com/docprofree",
        "https://x.com/saadkhan112233",
        "https://www.linkedin.com/company/docpro",
        "https://www.youtube.com/@DocPro-FreeDocumentMaker"
    ],
    "foundingDate": "2024",
    "founder": {
        "@type": "Person",
        "name": "Your Name or Company Name"
    },
    "contactPoint": [
        {
            "@type": "ContactPoint",
            "telephone": "+8801921727383",
            "contactType": "customer support",
            "email": "info@freedocumentmaker.com"
        }
    ]
}
</script>
@endsection

@push('scripts')
    <!-- Google AdSense Auto Ads Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2081671021537614"
     crossorigin="anonymous"></script>
@endpush

@section('content')

{{-- ✅ Hero Section --}}
<section class="py-20 bg-gradient-to-r from-blue-50 to-indigo-100">
    <div class="container mx-auto px-6 text-center">
        <div class="mb-16" data-aos="fade-up">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-6">About Doc Pro</h1>
            <p class="text-lg sm:text-xl text-gray-600 leading-relaxed">
                Welcome to <strong>Doc Pro</strong>—your ultimate solution for fast, easy, and professional document generation. 
                Designed for individuals, freelancers, and businesses, our platform <strong>saves you time, reduces manual effort, and helps you focus on what truly matters—your goals.</strong>
            </p>
            <p class="text-lg sm:text-xl text-gray-600 mt-4 leading-relaxed">
                With Doc Pro, all of our powerful tools are <strong>100% free</strong>, allowing you to create <strong>invoices, resumes, agreements, receipts, and certificates</strong> with ease.
                No hidden fees, no subscriptions—just effortless document creation at your fingertips.
            </p>
        </div>
    </div>
</section>

{{-- ✅ Our Tools --}}
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-12 text-center" data-aos="fade-up" data-aos-delay="100">
            Our Free Document Generation Tools
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach([
                    ['icon' => 'file-invoice-dollar', 'title' => 'Invoice Generator', 'description' => 'Generate professional invoices quickly and efficiently. Organize payments and maintain transaction records effortlessly with our <strong>free</strong> tool.'],
                    ['icon' => 'file-invoice', 'title' => 'Credit Note Generator', 'description' => 'Easily create credit notes for refunds or adjustments while maintaining professionalism. Completely <strong>free</strong>!'],
                    ['icon' => 'file-contract', 'title' => 'Purchase Order Generator', 'description' => 'Streamline your supplier management with precise purchase orders—all <strong>free</strong> to use.'],
                    ['icon' => 'clipboard-list', 'title' => 'Quote Generator', 'description' => 'Generate clear and professional quotes to outline your services and pricing. Use our <strong>free</strong> tool for easy customization.'],
                    ['icon' => 'receipt', 'title' => 'Receipt Generator', 'description' => 'Create detailed receipts for all transactions. Ensure accurate record-keeping with <strong>free</strong> receipt generation.'],
                    ['icon' => 'file-alt', 'title' => 'Proforma Invoice Generator', 'description' => 'Offer clients a preview of transactions with detailed proforma invoices—all at <strong>no cost</strong> to you.'],
                    ['icon' => 'truck-loading', 'title' => 'Delivery Note Generator', 'description' => 'Generate delivery notes for smooth shipment tracking. Keep operations transparent and <strong>free</strong> with Doc Pro.'],
                    ['icon' => 'id-card', 'title' => 'CV Builder', 'description' => 'Create standout resumes with customizable templates for any industry, completely <strong>free</strong> of charge.'],
                    ['icon' => 'credit-card', 'title' => 'Payment Receipt Generator', 'description' => 'Generate clear, professional payment receipts for tax and accounting purposes. The best part? It’s <strong>free</strong>.'],
                    ['icon' => 'chart-line', 'title' => 'Expense Report Generator', 'description' => 'Track spending and generate detailed expense reports easily. Organize your finances with this <strong>free</strong> tool.'],
                    ['icon' => 'business-time', 'title' => 'Business Card Generator', 'description' => 'Design visually striking business cards to elevate your brand identity. Create business cards <strong>free</strong> of charge.'],
                    ['icon' => 'user-plus', 'title' => 'Job Offer Letter Generator', 'description' => 'Simplify your hiring process by creating professional job offer letters. Templates are available for <strong>free</strong> use.'],
                    ['icon' => 'certificate', 'title' => 'Certificate Generator', 'description' => 'Create high-quality certificates for achievements or events with this <strong>free</strong> tool.'],
                    ['icon' => 'gavel', 'title' => 'Agreement Generator', 'description' => 'Generate legally sound agreements for personal or business needs with this <strong>free</strong> tool.']
                ] as $key => $tool)
                <div class="bg-white rounded-lg p-6 sm:p-8 shadow-md transform transition duration-300 hover:scale-105 hover:shadow-lg" data-aos="fade-up" data-aos-delay="{{ $key * 100 }}">
                    <i class="fas fa-{{ $tool['icon'] }} text-4xl sm:text-6xl text-blue-600 mx-auto mb-4 sm:mb-6" aria-hidden="true"></i>
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-3 sm:mb-4">{{ $tool['title'] }}</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ $tool['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
{{-- Our Mission --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-6">Our Mission</h2>
            <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                At <span class="font-semibold text-blue-600">Doc Pro</span>, our mission is to empower individuals and businesses to create professional, high-quality documents in minutes. We strive to provide <strong>free</strong>, user-friendly tools that streamline workflows and boost productivity. Join the growing community of users who trust Doc Pro to simplify their documentation processes.
            </p>
        </div>
    </section>

    {{-- Our Values --}}
    <section class="py-16 bg-gradient-to-r from-indigo-50 to-blue-100">
        <div class="container mx-auto px-4 text-center" data-aos="fade-up" data-aos-delay="400">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800 mb-6">Our Core Values</h2>
            <p class="text-md sm:text-lg text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                Our values guide the way we work and innovate. At Doc Pro, we are committed to delivering excellence in everything we do. Here's what we stand for:
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach([
                    ['icon' => 'lightbulb', 'title' => 'Innovation', 'description' => 'We continuously innovate to provide cutting-edge solutions that meet evolving user needs.'],
                    ['icon' => 'handshake', 'title' => 'Integrity', 'description' => 'We uphold the highest standards of integrity in all our actions, ensuring trust and reliability.'],
                    ['icon' => 'users', 'title' => 'Collaboration', 'description' => 'We believe in the power of teamwork and collaboration to achieve outstanding results.'],
                    ['icon' => 'chart-line', 'title' => 'Excellence', 'description' => 'We strive for excellence in every aspect of our work, delivering superior quality products and services.'],
                    ['icon' => 'shield-alt', 'title' => 'Security', 'description' => 'We prioritize the security and privacy of our users, implementing robust measures to protect their data.'],
                    ['icon' => 'heart', 'title' => 'Customer Focus', 'description' => 'Our customers are at the heart of everything we do, guiding our decisions and innovations.']
                ] as $value)
                    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-md transform transition duration-300 hover:scale-105 hover:shadow-xl" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <i class="fas fa-{{ $value['icon'] }} text-3xl sm:text-5xl text-indigo-600 mb-4" aria-hidden="true"></i>
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2">{{ $value['title'] }}</h3>
                        <p class="text-gray-600 text-center text-sm sm:text-base leading-relaxed">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
{{-- ✅ Call-to-Action --}}
<section class="py-16 bg-blue-600 text-white text-center">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold">Get Started with Doc Pro Today</h2>
        <p class="text-lg mt-4">
            Join thousands of users who create professional documents every day—free, fast, and secure!
        </p>
        <a href="{{ route('register') }}" class="mt-6 inline-block bg-white text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-200 transition">
            Create Your First Document
        </a>
    </div>
</section>

@endsection

@push('styles')
    <!-- AOS Animation CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- AOS Animation JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
            });
        });
    </script>
@endpush
