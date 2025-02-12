@extends('layouts.app')

@section('title', 'Sign In to Your Account - Doc Pro | Free Document Generator')
@section('meta_description', 'Sign in to your Doc Pro account to access free tools for generating professional documents like invoices, CVs, and receipts. Fast, secure, and user-friendly!')
@section('meta_keywords', 'login, sign in, free document generator, secure login, access account, Doc Pro, invoices, CVs, receipts, professional documents, access tools')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Sign In - Doc Pro",
    "description": "Login to your account on Doc Pro, a free document generator platform.",
    "url": "{{ url()->current() }}",

    "publisher": {
        "@type": "Organization",
        "name": "Doc Pro",
        "url": "https://freedocumentmaker.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://freedocumentmaker.com/images/logo.png",
            "width": 512,
            "height": 512
        }
    },

    "potentialAction": {
        "@type": "LoginAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "{{ url()->current() }}",
            "actionPlatform": [
                "https://schema.org/DesktopWebPlatform",
                "https://schema.org/MobileWebPlatform"
            ]
        }
    }
}
</script>
@endsection

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white shadow-xl rounded-lg grid grid-cols-1 lg:grid-cols-2 w-11/12 lg:w-3/4">
        <!-- Welcome Message -->
        <div class="p-8 bg-gradient-to-r from-red-500 to-pink-600 text-white flex flex-col justify-center items-center space-y-6">
            <h2 class="text-4xl font-extrabold text-center">Welcome Back!</h2>
            <p class="text-lg text-center">
                Access your account to generate professional documents effortlessly.
            </p>
            <img src="{{ asset('icons/certificate-generator.svg') }}" alt="Certificate Generator" class="w-3/4" loading="lazy">
        </div>

        <!-- Login Form -->
        <div class="p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800">Sign In</h2>
            <p class="text-center text-gray-600 mb-6">Login to your account</p>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('email') border-red-500 @enderror" 
                           value="{{ old('email') }}" required autocomplete="email" aria-describedby="emailHelp">
                    @error('email')
                        <p id="emailHelp" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" 
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror" 
                           required autocomplete="current-password" aria-describedby="passwordHelp">
                    @error('password')
                        <p id="passwordHelp" class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 text-red-500 border-gray-300 rounded focus:ring-red-400">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Forgot Password -->
                <div class="text-right">
                    <a href="{{ route('password.request') }}" class="text-sm text-red-500 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 text-white bg-red-500 rounded-lg hover:bg-red-600 transition duration-300">
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <hr class="w-full border-gray-300">
                <span class="px-3 text-gray-500">Or</span>
                <hr class="w-full border-gray-300">
            </div>

            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-red-500 hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>
@endsection
