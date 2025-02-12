@extends('layouts.app')

@section('title', 'Create Your Free Doc Pro Account | Generate Professional Documents Instantly')
@section('meta_description', 'Sign up for Doc Pro in seconds! Instantly generate professional invoices, CVs, receipts, and agreements—100% free. No credit card required. Join now!')
@section('meta_keywords', 'register, create account, free document generator, secure registration, Doc Pro, invoices, CVs, receipts, professional documents, sign up, document tools')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Register - Doc Pro | Free Document Generator",
    "description": "Create your free Doc Pro account and gain access to premium document generation tools including invoices, CVs, receipts, and agreements. Secure, fast, and user-friendly.",
    "url": "{{ url()->current() }}",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url()->current() }}"
    },
    "datePublished": "2024-01-01T00:00:00+00:00",
    "dateModified": "2024-01-01T00:00:00+00:00",
    "image": {
        "@type": "ImageObject",
        "url": "https://freedocumentmaker.com/images/signup-preview.png",
        "width": 1200,
        "height": 630
    },
    "potentialAction": {
        "@type": "RegisterAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "{{ url()->current() }}",
            "actionPlatform": [
                "http://schema.org/DesktopWebPlatform",
                "http://schema.org/MobileWebPlatform"
            ]
        }
    },
    "publisher": {
        "@type": "Organization",
        "name": "Doc Pro",
        "url": "https://www.freedocumentmaker.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://www.freedocumentmaker.com/images/logo.png",
            "width": 512,
            "height": 512
        }
    }
}
</script>

<!-- Fixed Breadcrumb Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": {
                "@type": "Thing",
                "id": "https://www.freedocumentmaker.com"
            }
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "Register",
            "item": {
                "@type": "Thing",
                "id": "{{ url()->current() }}"
            }
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
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden grid grid-cols-1 lg:grid-cols-2 w-11/12 lg:w-3/4">
        <!-- Left Panel: Welcome Message -->
        <div class="p-8 bg-gradient-to-r from-blue-500 to-purple-600 text-white flex flex-col justify-center items-center space-y-6"
             data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-4xl font-extrabold text-center">Welcome to Doc Pro!</h2>
            <p class="text-lg text-center leading-relaxed">
                Join thousands of users who trust Doc Pro for creating professional documents like invoices, CVs, receipts, and more.
            </p>
            <img src="{{ asset('icons/certificate-generator.svg') }}" alt="Certificate Generator Icon" class="w-3/4 mx-auto" loading="lazy">
        </div>

        <!-- Right Panel: Registration Form -->
        <div class="p-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Create Your Account</h2>
                <p class="text-gray-600">Register to get started with Doc Pro.</p>
            </div>
            
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your full name" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Create a strong password" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror"
                        required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" 
                        required>
                </div>

                <!-- Register Button -->
                <button type="submit" 
                    class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition focus:ring-2 focus:ring-blue-400">
                    Register
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <hr class="w-full border-gray-300">
                <span class="px-3 text-gray-500">Or</span>
                <hr class="w-full border-gray-300">
            </div>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            </p>
        </div>
    </div>
</div>
@endsection
