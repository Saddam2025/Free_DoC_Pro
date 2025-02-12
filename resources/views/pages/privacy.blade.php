@extends('layouts.app')

@section('title', 'Privacy Policy | Secure & Transparent | Doc Pro')
@section('meta_description', 'Learn how Doc Pro protects your privacy and secures your data with GDPR & CCPA compliance. Review our privacy practices, cookie policy, and data protection measures.')
@section('meta_keywords', 'privacy policy, Doc Pro, GDPR compliance, data security, user rights, CCPA compliance, encryption, document generator privacy, cookie policy, secure platform')

@push('scripts')
    <!-- ✅ Google AdSense Integration -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2081671021537614" crossorigin="anonymous"></script>
@endpush

@section('schema')
<!-- ✅ Structured Data (SEO-Optimized) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy | Secure & Transparent | Doc Pro",
  "description": "Learn how Doc Pro protects your privacy and secures your data with GDPR & CCPA compliance. Review our privacy practices, cookie policy, and data protection measures.",
  "url": "{{ url()->current() }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://freedocumentmaker.com/privacy-policy"
  },
  "author": {
    "@type": "Organization",
    "name": "Doc Pro",
    "url": "https://freedocumentmaker.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://freedocumentmaker.com/favicon.png",
      "width": 512,
      "height": 512
    },
    "sameAs": [
      "https://www.facebook.com/DocPro",
      "https://twitter.com/DocPro",
      "https://www.linkedin.com/company/docpro"
    ]
  },
  "publisher": {
    "@type": "Organization",
    "name": "Doc Pro",
    "logo": {
      "@type": "ImageObject",
      "url": "https://freedocumentmaker.com/favicon.png",
      "width": 512,
      "height": 512
    }
  },
  "license": "https://freedocumentmaker.com/privacy-policy"
}
</script>
@endsection

@section('content')

{{-- ✅ Hero Section --}}
<section class="bg-gradient-to-r from-blue-500 to-indigo-600 py-24 text-center">
    <div class="container mx-auto px-6 lg:px-16">
        <h1 class="text-5xl font-extrabold text-white mb-6 leading-tight">
            Privacy Policy
        </h1>
        <p class="text-xl sm:text-2xl text-white opacity-90 mt-4 max-w-3xl mx-auto leading-relaxed">
            Transparency and security are our priorities. Learn how Doc Pro safeguards your privacy and data security with the highest standards of data protection.
        </p>
        <p class="text-lg text-white mt-4 opacity-80 sm:max-w-2xl mx-auto leading-relaxed">
            Our commitment to you includes complete transparency in how we collect, use, and protect your data. This Privacy Policy outlines our privacy practices and compliance with GDPR and CCPA regulations.
        </p>
    </div>
</section>

{{-- ✅ Table of Contents --}}
<section class="py-8 bg-white">
    <div class="container mx-auto px-6">
        <nav aria-label="Table of Contents">
            <ul class="flex flex-wrap justify-center space-x-4 text-blue-600">
                @foreach([
                    'Introduction' => 'introduction',
                    'Information We Collect' => 'information-we-collect',
                    'How We Use Your Information' => 'how-we-use-your-information',
                    'Cookies & Tracking' => 'cookies-and-tracking',
                    'Third-Party Services' => 'third-party-services',
                    'How We Protect Your Data' => 'how-we-protect-your-data',
                    'Your Rights' => 'your-rights',
                    'Legal Compliance' => 'legal-compliance',
                    'Contact Us' => 'contact-us'
                ] as $title => $id)
                <li><a href="#{{ $id }}" class="hover:underline flex items-center"><i class="fas fa-chevron-right mr-2"></i> {{ $title }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</section>

{{-- ✅ Privacy Policy Sections --}}
<section class="py-12 bg-white">
    <div class="container mx-auto max-w-5xl px-4 md:px-0">
        @foreach([
            ['icon' => 'info-circle', 'title' => 'Introduction', 'id' => 'introduction', 'content' => 'At Doc Pro, we are committed to protecting your privacy. This Privacy Policy outlines the practices and procedures that we follow to protect your personal information and ensure compliance with privacy laws such as GDPR and CCPA. We believe that transparency is vital, and this policy aims to explain clearly how we collect, use, and protect your data.'],
            ['icon' => 'clipboard-list', 'title' => 'Information We Collect', 'id' => 'information-we-collect', 'content' => 'We collect personal information such as your name, email address, and payment information to provide our services. Additionally, we collect non-personal data such as IP addresses, browser types, and usage patterns. This helps us improve our platform and user experience. We use Google Analytics to understand how our website is used and improve our service.'],
            ['icon' => 'briefcase', 'title' => 'How We Use Your Information', 'id' => 'how-we-use-your-information', 'content' => 'Your personal information is used to create and manage your account, provide personalized content, process payments, and improve the functionality of our services. We also use your email address to communicate with you about important updates, offers, and promotions related to our services. Any data we collect is used to enhance the security of our platform and to ensure a smooth user experience.'],
            ['icon' => 'cookie-bite', 'title' => 'Cookies & Tracking', 'id' => 'cookies-and-tracking', 'content' => 'We use cookies and similar tracking technologies to improve your experience on our website. Cookies help us understand your preferences and tailor our services to better suit your needs. We also use cookies to analyze user behavior, such as page views and click patterns. You can manage or disable cookies in your browser settings, but this may affect your ability to use certain features of the site.'],
            ['icon' => 'handshake', 'title' => 'Third-Party Services', 'id' => 'third-party-services', 'content' => 'We may share your data with third-party service providers, such as payment processors and analytics services, to provide the services you request. All third-party services are vetted to ensure they comply with data protection standards. We do not sell or rent your personal data to any third parties. Our third-party partners include Google Analytics, Stripe (for payment processing), and email service providers.'],
            ['icon' => 'lock', 'title' => 'How We Protect Your Data', 'id' => 'how-we-protect-your-data', 'content' => 'We use advanced encryption technologies, such as SSL and TLS, to protect your data during transmission. Your personal information is stored in secure servers and protected by firewalls and encryption methods to prevent unauthorized access. We also conduct regular security audits to assess and improve our security practices. However, please note that no method of online transmission is 100% secure, and while we strive to protect your data, we cannot guarantee its absolute security.'],
            ['icon' => 'user-shield', 'title' => 'Your Rights', 'id' => 'your-rights', 'content' => 'You have several rights regarding your personal data. These include the right to access your data, the right to rectify inaccurate information, the right to request data deletion, and the right to restrict or object to the processing of your data. If you wish to exercise any of these rights, please contact us at support@freedocumentmaker.com. We will respond to your request in accordance with applicable privacy laws.'],
            ['icon' => 'gavel', 'title' => 'Legal Compliance', 'id' => 'legal-compliance', 'content' => 'We comply with the General Data Protection Regulation (GDPR) and California Consumer Privacy Act (CCPA) to ensure that we are safeguarding your data in accordance with the law. This includes providing you with rights over your data and ensuring that data is collected and used responsibly. If you are located in the European Union or California, you have specific rights regarding your data, which we are committed to upholding.'],
            ['icon' => 'envelope-open-text', 'title' => 'Contact Us', 'id' => 'contact-us', 'content' => 'If you have any questions or concerns about this Privacy Policy or how your data is handled, please feel free to contact us. You can reach us at support@freedocumentmaker.com. We are happy to assist you with any privacy-related requests or inquiries.'],
        ] as $section)
        <div class="mb-12" id="{{ $section['id'] }}">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-{{ $section['icon'] }} text-blue-600 mr-3"></i> {{ $section['title'] }}
            </h2>
            <p class="text-lg text-gray-700 leading-relaxed">{{ $section['content'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ✅ How We Protect Your Data Section --}}
<section class="py-12 bg-white">
    <div class="container mx-auto max-w-5xl px-4 md:px-0">
        <div class="mb-12" id="how-we-protect-your-data">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-lock text-blue-600 mr-3"></i> How We Protect Your Data
            </h2>
            <p class="text-lg text-gray-700 leading-relaxed mb-6">
                At Doc Pro, your data security is our top priority. Here are the measures we use to protect your personal data:
            </p>
            <ul class="text-sm text-gray-600 list-disc list-inside">
                <li>✔ <strong>SSL/TLS Encryption</strong>: Your data is transmitted securely using SSL/TLS encryption, ensuring protection against unauthorized access during data transmission.</li>
                <li>✔ <strong>Secure Servers & Firewalls</strong>: We store your data on secure servers protected by firewalls to prevent unauthorized access.</li>
                <li>✔ <strong>Regular Security Audits</strong>: We conduct frequent security audits and updates to ensure our systems remain secure and compliant with the latest security standards.</li>
            </ul>
        </div>
    </div>
</section>

{{-- ✅ Frequently Asked Questions Section --}}
<section class="py-8 bg-gray-100">
    <div class="container mx-auto px-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Frequently Asked Questions</h3>
        <ul class="list-disc list-inside text-gray-600">
            <li><strong>How is my data protected?</strong> Your data is protected using SSL encryption during transmission, and stored in secure servers with encryption methods and firewalls.</li>
            <li><strong>Can I request my data?</strong> Yes, you have the right to access your data, rectify it, or request its deletion. Please contact us for more details.</li>
            <li><strong>Do you share my data with third parties?</strong> We may share your data with third-party services such as payment processors and analytics providers. However, we ensure that these services comply with data protection standards and do not sell or rent your data.</li>
            <li><strong>What happens if there is a data breach?</strong> In the event of a data breach, we will notify affected users and take immediate action to minimize any potential harm. We also report the breach to relevant authorities as required by law.</li>
        </ul>
    </div>
</section>



{{-- ✅ Google AdSense Integration --}}
<section class="py-16 bg-white text-center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block;width:100%;height:auto"
         data-ad-client="ca-pub-2081671021537614"
         data-ad-slot="7423037944"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</section>

@endsection
