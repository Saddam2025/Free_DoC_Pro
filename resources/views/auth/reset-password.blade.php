@extends('layouts.app')

@push('scripts')
    <!-- Google AdSense Auto Ads Script -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2081671021537614"
     crossorigin="anonymous"></script>
@endpush

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden grid grid-cols-1 lg:grid-cols-2 w-11/12 lg:w-3/4">

        <!-- Left Panel: Welcome Message -->
        <div class="p-8 bg-gradient-to-r from-blue-500 to-purple-600 text-white flex flex-col justify-center items-center space-y-6" data-aos="fade-up" data-aos-duration="600">
            <h2 class="text-4xl font-extrabold text-center lg:text-4xl">Forgot Your Password?</h2>
            <p class="text-center text-lg leading-relaxed mb-6">
                No worries, just enter your email, and we will send you a reset link to regain access to your account.
            </p>
            <img src="{{ asset('icons/certificate-generator.svg') }}" alt="Reset Password Illustration" 
                 class="w-3/4 sm:w-1/2 lg:w-3/4 mx-auto" loading="lazy">
        </div>

        <!-- Right Panel: Forgot Password Form -->
        <div class="p-8" data-aos="fade-up" data-aos-duration="600">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Reset Your Password</h2>
                <p class="text-gray-600">Enter your email below to receive the password reset link.</p>
            </div>
            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="flex flex-col">
                    <label for="email" class="text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        required 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition-all focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    Send Password Reset Link
                </button>
            </form>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Remember your password? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            </p>
        </div>
    </div>
</div>

<!-- AdSense Below Content -->
<div class="text-center my-4">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-2081671021537614"
         data-ad-slot="7423037944"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
@endsection

@push('scripts')
<!-- AOS Animation Script -->
<script>
    AOS.init({
        duration: 600,
        once: true,
    });
</script>
@endpush
