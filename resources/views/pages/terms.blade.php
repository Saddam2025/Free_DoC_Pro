@extends('layouts.app')

@section('title', 'Terms and Conditions | Transparent & Secure | Doc Pro')
@section('meta_description', 'Review the terms and conditions for using Doc Pro, a secure and professional free document generator. Clear user agreements and legal compliance guidelines.')
@section('meta_keywords', 'terms and conditions, Doc Pro, free document generator, user agreement, usage policy, legal compliance, platform rules, Bangladesh jurisdiction')

@section('schema')
<!-- ✅ SEO-Optimized Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Terms and Conditions | Transparent & Secure | Doc Pro",
  "description": "Review the terms and conditions for using Doc Pro, a secure and professional free document generator. Clear rules for user agreements and legal compliance.",
  "url": "{{ url()->current() }}",
  "image": {
    "@type": "ImageObject",
    "url": "https://freedocumentmaker.com/images/article-thumbnail.png",
    "width": 1200,
    "height": 630
  },
  "datePublished": "2024-01-01T00:00:00+00:00",
  "dateModified": "2024-01-01T00:00:00+00:00",
  "author": {
    "@type": "Organization",
    "name": "Doc Pro",
    "url": "https://freedocumentmaker.com",
    "logo": {
      "@type": "ImageObject",
      "url": "https://freedocumentmaker.com/favicon.png",
      "width": 512,
      "height": 512
    }
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
  "termsOfService": "https://freedocumentmaker.com/terms-and-conditions"
}
</script>
@endsection

@section('content')

{{-- ✅ Hero Section --}}
<section class="bg-gradient-to-r from-blue-100 to-blue-50 py-20 text-center">
    <div class="container mx-auto px-6">
        <h1 class="text-5xl md:text-6xl font-extrabold text-blue-600 mb-6">
            <i class="fas fa-file-contract text-blue-800 mr-4"></i> Terms and Conditions
        </h1>
        <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
            Welcome to <strong>Doc Pro</strong>. By using our services, you agree to our terms and conditions. Please read them carefully.
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
                    'General Terms' => 'general-terms',
                    'User Responsibilities' => 'user-responsibilities',
                    'Intellectual Property' => 'intellectual-property',
                    'Limitation of Liability' => 'limitation-of-liability',
                    'Termination of Services' => 'termination-of-services',
                    'Governing Law' => 'governing-law',
                    'Your Rights' => 'your-rights',
                    'Dispute Resolution' => 'dispute-resolution',
                    'Contact Us' => 'contact-us'
                ] as $title => $id)
                <li><a href="#{{ $id }}" class="hover:underline flex items-center"><i class="fas fa-chevron-right mr-2"></i> {{ $title }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</section>

{{-- ✅ Terms and Conditions Sections --}}
<section class="py-12 bg-white">
    <div class="container mx-auto max-w-5xl px-4 md:px-0">
        @foreach([
            ['icon' => 'info-circle', 'title' => 'Introduction', 'id' => 'introduction', 'content' => 'By accessing and using Doc Pro, you agree to comply with these terms and policies. These terms apply to all users who access or use our platform, including registered users and non-registered visitors.'],
            ['icon' => 'gavel', 'title' => 'General Terms', 'id' => 'general-terms', 'content' => 'Users must be at least 18 years old or have parental consent to use Doc Pro. The platform may update these terms at any time, and users will be notified of such updates. Continued use of the platform constitutes acceptance of the updated terms.'],
            ['icon' => 'user-shield', 'title' => 'User Responsibilities', 'id' => 'user-responsibilities', 'content' => 'Users must not engage in illegal activities or use the platform for fraudulent, harmful, or malicious purposes. This includes, but is not limited to, generating false documents, harassment, or any actions that violate the rights of other users or entities. Users are also responsible for maintaining the confidentiality of their account credentials.'],
            ['icon' => 'lightbulb', 'title' => 'Intellectual Property', 'id' => 'intellectual-property', 'content' => 'All content, trademarks, and branding on Doc Pro are the intellectual property of Doc Pro. Users are granted a non-exclusive, non-transferable license to use the platform only for personal or business purposes within the bounds of these terms. Unauthorized copying, reproduction, or use of our intellectual property is prohibited.'],
            ['icon' => 'exclamation-triangle', 'title' => 'Limitation of Liability', 'id' => 'limitation-of-liability', 'content' => 'Doc Pro will not be liable for any indirect, incidental, special, or consequential damages arising from the use of the platform. This includes loss of data, loss of profits, or any other form of damage resulting from the use or inability to use the service. Users acknowledge that they use the platform at their own risk.'],
            ['icon' => 'times-circle', 'title' => 'Termination of Services', 'id' => 'termination-of-services', 'content' => 'Doc Pro reserves the right to suspend or terminate user accounts at its discretion, particularly in cases of violation of these terms. Users may terminate their accounts at any time by contacting support. Upon termination, users lose access to their account and any content they have generated or stored on the platform.'],
            ['icon' => 'balance-scale', 'title' => 'Governing Law', 'id' => 'governing-law', 'content' => 'These terms are governed by the laws of Bangladesh. Any disputes related to these terms will be subject to the exclusive jurisdiction of the courts in Bangladesh. Users outside of Bangladesh agree to comply with local laws while using the platform.'],
            ['icon' => 'user', 'title' => 'Your Rights', 'id' => 'your-rights', 'content' => 'Users have the right to access, modify, or delete their personal data stored on Doc Pro. Requests for data access or modification must be made through the platform’s support channels. Users may also request account deletion, in which case all associated data will be permanently removed after a specified period.'],
            ['icon' => 'handshake', 'title' => 'Dispute Resolution', 'id' => 'dispute-resolution', 'content' => 'In the event of a dispute, users agree to first attempt to resolve the issue through informal discussions with Doc Pro. If the dispute cannot be resolved informally, it will be resolved through binding arbitration in Bangladesh, under the rules of the Bangladesh Arbitration Act.'],
            ['icon' => 'envelope-open-text', 'title' => 'Contact Us', 'id' => 'contact-us', 'content' => 'For any questions, concerns, or requests related to these Terms and Conditions, users can contact us via email at support@freedocumentmaker.com. We aim to respond to all inquiries within 48 hours, excluding weekends and holidays.']
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



{{-- ✅ Google AdSense --}}
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
