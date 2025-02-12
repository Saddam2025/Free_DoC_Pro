@extends('layouts.app')

@section('title', 'Doc Pro - Flexible Monetization Plans | Free to Enterprise Solutions')
@section('meta_description', 'Discover Doc Pro\'s flexible monetization plans, from Free to Enterprise solutions. Choose from Premium subscriptions, one-time templates, or white-label options to meet your document generation needs.')
@section('meta_keywords', 'monetization plans, Doc Pro pricing, document generation plans, white-label solutions, one-time templates, affordable plans, customizable pricing')

@section('schema')
<!-- ✅ Structured Data (SEO-Optimized) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Doc Pro - Flexible Monetization Plans | Free to Enterprise Solutions",
  "description": "Explore a variety of plans designed to suit every need—from free trials and affordable subscriptions to premium white-label solutions.",
  "url": "{{ url()->current() }}",
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
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://freedocumentmaker.com/search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endsection

@push('scripts')
<!-- ✅ Google AdSense Integration -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2081671021537614" crossorigin="anonymous"></script>
@endpush

@section('content')

<!-- ✅ Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-r from-green-500 to-indigo-700 text-white text-center py-20">
    <div class="container mx-auto px-11">
        <h1 class="text-5xl font-extrabold leading-tight">Flexible Monetization Plans</h1>
        <p class="text-lg max-w-3xl mx-auto opacity-90 mt-4">
            From free trials and affordable subscriptions to premium white-label solutions—Doc Pro has the perfect plan for you.
        </p>
    </div>
</section>

<!-- ✅ Pricing Plans -->
<section class="py-33 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Our Pricing Options</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['title' => 'Basic Plan', 'price' => 'Free', 'features' => ['Limited templates', 'Basic customization', 'Watermarked downloads'], 'cta' => 'Get Started', 'link' => '#', 'color' => 'blue'],
                ['title' => 'Premium Plan', 'price' => '$10–$20/month', 'features' => ['Unlimited downloads', 'Premium templates', 'Cloud storage'], 'cta' => 'Subscribe Now', 'link' => '#', 'color' => 'yellow'],
                ['title' => 'One-Time Templates', 'price' => '$5–$20/template', 'features' => ['Pay per template', 'No recurring fees', 'Professional designs'], 'cta' => 'Browse Templates', 'link' => '#', 'color' => 'green'],
                ['title' => 'White-Label Solution', 'price' => '$100–$500/month', 'features' => ['Custom branding', 'Priority support', 'Analytics & reporting'], 'cta' => 'Contact Us', 'link' => route('contact', ['plan' => 'White-Label Solution']), 'color' => 'red'],
                ['title' => 'Enterprise Plan', 'price' => '$100+/month', 'features' => ['Bulk document creation', 'Team accounts', 'API integrations'], 'cta' => 'Contact Us', 'link' => route('contact', ['plan' => 'Enterprise']), 'color' => 'purple']
            ] as $plan)
                <div class="bg-white rounded-lg p-6 text-center shadow-lg hover:shadow-2xl transition-transform transform hover:scale-105 border-t-4 border-{{ $plan['color'] }}-500">
                    <h3 class="text-2xl font-bold text-{{ $plan['color'] }}-600 mb-2">{{ $plan['title'] }}</h3>
                    <p class="text-xl font-semibold mb-4">{{ $plan['price'] }}</p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        @foreach($plan['features'] as $feature)
                            <li class="flex items-center justify-center space-x-2">
                                <i class="fas fa-check-circle text-{{ $plan['color'] }}-500"></i>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ $plan['link'] }}" class="bg-{{ $plan['color'] }}-600 hover:bg-{{ $plan['color'] }}-700 text-white font-medium px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition">
                        {{ $plan['cta'] }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ✅ How It Works -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">How It Works</h2>
        <div class="max-w-4xl mx-auto text-gray-700 text-lg">
            <ol class="list-decimal list-inside space-y-4">
                <li><strong>Choose Your Plan:</strong> Select the best plan for your needs.</li>
                <li><strong>Customize Your Experience:</strong> Enjoy customizable features, templates, and branding.</li>
                <li><strong>Start Generating Documents:</strong> Seamlessly create, download, and manage documents.</li>
                <li><strong>Enjoy Ongoing Support:</strong> Our team is here to assist you every step of the way.</li>
            </ol>
        </div>
    </div>
</section>

<!-- ✅ Testimonials -->
<section class="py-16 bg-gray-200 text-center">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">What Our Customers Say</h2>
    <div class="flex justify-center space-x-8">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md">
            <p class="text-gray-600">"Doc Pro has transformed the way I create invoices. It's so simple to use, and the results look professional every time!"</p>
            <p class="mt-4 font-semibold">John Doe, Freelancer</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md">
            <p class="text-gray-600">"We love the flexibility of Doc Pro. The ability to create different types of documents at such an affordable price is invaluable."</p>
            <p class="mt-4 font-semibold">Jane Smith, Startup Owner</p>
        </div>
    </div>
</section>

<!-- ✅ Compare Plans Table -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-extrabold text-gray-800 text-center mb-6">Compare Our Plans</h2>
        <table class="table-auto w-full text-left text-gray-800">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-2">Feature</th>
                    <th class="px-4 py-2">Basic Plan</th>
                    <th class="px-4 py-2">Premium Plan</th>
                    <th class="px-4 py-2">Enterprise Plan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border px-4 py-2">Custom Templates</td>
                    <td class="border px-4 py-2">✔</td>
                    <td class="border px-4 py-2">✔</td>
                    <td class="border px-4 py-2">✔</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">Client Management</td>
                    <td class="border px-4 py-2">✘</td>
                    <td class="border px-4 py-2">✔</td>
                    <td class="border px-4 py-2">✔</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2">Priority Support</td>
                    <td class="border px-4 py-2">✘</td>
                    <td class="border px-4 py-2">✔</td>
                    <td class="border px-4 py-2">✔</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- ✅ Call-to-Action -->
<section class="py-12 bg-gray-100 text-center">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Ready to Get Started?</h2>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-6">
        Whether you're just starting or scaling your business, Doc Pro has the right plan for you.
    </p>
    <a href="{{ route('contact') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-3 rounded-lg transition">
        Contact Us Today
    </a>
</section>

@endsection

@push('styles')
<style>
    /* Custom Pricing Card Styles */
    .bg-gradient-to-r {
        background: linear-gradient(to right, #48bb78, #2f855a);
    }
</style>
@endpush
