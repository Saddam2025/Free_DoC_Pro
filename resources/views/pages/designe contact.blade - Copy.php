@extends('layouts.app')

@section('title', 'Contact Us | Get in Touch with Doc Pro')
@section('meta_description', 'Need support? Contact Doc Pro for inquiries about invoices, receipts, CVs, and other document generation services. Our team is here to help!')
@section('meta_keywords', 'contact Doc Pro, customer support, help desk, document generator support, free invoice generator contact')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "url": "https://www.freedocumentmaker.com/contact",
    "name": "Contact Us - Doc Pro",
    "description": "Get in touch with Doc Pro for support and inquiries about our free document generation tools, including invoices, CVs, receipts, and agreements.",
    "publisher": {
        "@type": "Organization",
        "name": "Doc Pro",
        "url": "https://www.freedocumentmaker.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://www.freedocumentmaker.com/images/logo.png",
            "width": 512,
            "height": 512
        },
        "sameAs": [
            "https://www.facebook.com/docprofree",
            "https://twitter.com/DocProOfficial",
            "https://www.linkedin.com/company/docpro",
            "https://www.youtube.com/@DocPro-FreeDocumentMaker"
        ],
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "+8801921727383",
                "contactType": "Customer Support",
                "email": "support@freedocumentmaker.com",
                "areaServed": "Worldwide",
                "availableLanguage": ["English"]
            }
        ]
    }
}
</script>
@endsection

@section('content')


    <!-- ✅ Hero / Title Section -->
    <section class="bg-gradient-to-r from-blue-50 to-blue-100 py-16 text-center shadow-sm">
        <div class="container mx-auto px-6 md:px-10">
            <h1 class="mb-6 text-4xl font-extrabold tracking-tight text-gray-800 md:text-5xl">
                Contact Us - Doc Pro
            </h1>
            <p class="mx-auto max-w-2xl text-lg text-gray-700 md:text-xl">
                <strong>Need help?</strong> Our support team is here to assist you with any questions.
            </p>
            <p class="mx-auto mt-3 max-w-xl text-md text-gray-600 md:text-lg">
                Whether you need technical assistance, feedback, or have general inquiries, feel free to contact us using the form below. 
                Check our 
                <a href="{{ route('faq') }}" class="text-blue-600 transition-colors duration-200 hover:text-blue-800 hover:underline">
                    FAQ section
                </a>
                for quick answers.
            </p>
        </div>
    </section>

    <!-- ✅ Contact Info & Form Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto grid grid-cols-1 gap-12 px-6 md:grid-cols-2 md:px-10">
            <!-- Contact Details -->
            <div class="rounded-lg bg-white p-8 shadow-xl">
                <h2 class="mb-6 text-3xl font-semibold text-gray-800">
                    Get in Touch
                </h2>
                <p class="mb-8 text-gray-600 leading-relaxed">
                    We value your questions and feedback. Our support team is available to help you with technical issues, service inquiries, or any other questions you might have.
                </p>
                <ul class="space-y-6 text-left">
                    <li class="flex items-start">
                        <!-- Example of replacing Font Awesome with inline SVG (optional) -->
                        <svg class="h-6 w-6 text-blue-600 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M502.3 190.8c3.9 2.8 ..."/>
                        </svg>
                        <div>
                            <strong>Email:</strong><br>
                            <a href="mailto:support@freedocumentmaker.com" class="text-blue-600 transition-colors duration-200 hover:underline hover:text-blue-800">
                                support@freedocumentmaker.com
                            </a>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M493.4 24.6 ..."/>
                        </svg>
                        <div>
                            <strong>Phone:</strong><br>
                            <a href="tel:+8801921727383" class="text-blue-600 transition-colors duration-200 hover:underline hover:text-blue-800">
                                +8801921727383
                            </a>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M256 8C119 ..."/>
                        </svg>
                        <div>
                            <strong>Address:</strong><br>
                            7 Masjed Road, Pagla, Fatullah, Narayanganj,<br>
                            Bangladesh, ZIP 1421
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-blue-600 mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M256 8C119. ..."/>
                        </svg>
                        <div>
                            <strong>Business Hours:</strong><br>
                            Mon - Fri: 9:00 AM - 6:00 PM (BST)
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Contact Form -->
            <div class="rounded-lg bg-white p-8 shadow-xl">
                <h3 class="mb-6 text-2xl font-semibold text-gray-800">
                    Send Us a Message
                </h3>
                <form 
                    action="{{ route('contact.submit') }}" 
                    method="POST" 
                    class="space-y-6"
                    aria-label="Contact Form"
                >
                    @csrf

                    <div>
                        <label for="name" class="mb-1 block text-lg font-medium text-gray-700">
                            Your Name
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            placeholder="Enter your full name" 
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-700 
                                   focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" 
                            required 
                        />
                    </div>

                    <div>
                        <label for="email" class="mb-1 block text-lg font-medium text-gray-700">
                            Your Email
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="you@example.com"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-700 
                                   focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" 
                            required 
                        />
                    </div>

                    <div>
                        <label for="message" class="mb-1 block text-lg font-medium text-gray-700">
                            Your Message
                        </label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="5" 
                            placeholder="How can we help you?"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-700 
                                   focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            required
                        ></textarea>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full rounded-md bg-blue-600 py-3 text-white 
                               transition-colors duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- ✅ Google AdSense (Adaptive) -->
    <section class="bg-white py-16 text-center">
        <div class="container mx-auto px-6 sm:px-10">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block; width:100%; height:auto;"
                 data-ad-client="ca-pub-2081671021537614"
                 data-ad-slot="7423037944"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Example: override or add custom styles if needed */
        /* 
        .your-custom-class { 
            color: #333;
            ...
        } 
        */
    </style>
@endpush
