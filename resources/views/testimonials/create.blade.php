@extends('layouts.app')

@section('title', 'Share Your Experience with Doc Pro | Submit Your Testimonial')
@section('meta_description', 'Submit your testimonial about Doc Pro and inspire others. Share how Doc Pro has helped you create professional documents with ease.')
@section('meta_keywords', 'testimonial, feedback, Doc Pro reviews, user experience, share experience, write testimonial, professional documents')

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Share Your Experience with Doc Pro | Submit Your Testimonial",
  "description": "Submit your testimonial about Doc Pro and inspire others. Share how Doc Pro has helped you create professional documents with ease.",
  "url": "{{ request()->url() }}",
  "author": {
    "@type": "Organization",
    "name": "Doc Pro",
    "url": "https://freedocumentmaker.com",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "review": {
    "@type": "Review",
    "itemReviewed": {
      "@type": "SoftwareApplication",
      "name": "Doc Pro",
      "applicationCategory": "Document Generation Tool",
      "operatingSystem": "All",
      "offers": {
        "@type": "Offer",
        "price": "0.00",
        "priceCurrency": "USD"
      }
    },
    "reviewBody": "Doc Pro is a fantastic tool for creating professional documents. It has made my workflow seamless and efficient!",
    "author": {
      "@type": "Person",
      "name": "John Doe"
    },
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5"
    }
  }
}
</script>

@section('content')
<!-- ✅ Fixed Full Container -->
<div class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-12 px-6 sm:px-8 flex justify-center">
    <div class="max-w-5xl w-full bg-white rounded-lg shadow-md p-6 lg:p-12 pb-24 mb-24"> <!-- ✅ Increased bottom margin -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Left Column: About Doc Pro -->
            <div class="space-y-6">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800">About Doc Pro</h2>
                <p class="text-gray-600 leading-relaxed">
                    <strong>Doc Pro</strong> empowers you to create essential documents with ease. From invoices and quotes to CVs and certificates, Doc Pro streamlines your workflow and boosts productivity.
                </p>
                <div class="mt-6">
                    <img 
                        src="{{ asset('icons/certificate-generator.svg') }}" 
                        alt="Certificate Generator" 
                        class="w-full lg:w-3/4 mx-auto rounded-md hover:shadow-lg transition duration-200"
                    >
                </div>
            </div>

            <!-- Right Column: Testimonial Form -->
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 text-center lg:text-left">Share Your Experience</h2>
                <p class="text-gray-600 mt-4 text-center lg:text-left">
                    We value your feedback! Help others discover the power of Doc Pro by sharing your story.
                </p>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg my-6 shadow">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Testimonial Submission Form -->
                <form action="{{ route('testimonial.store') }}" method="POST" class="mt-6 space-y-6">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Your Name <span class="text-red-500">*</span></label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            placeholder="Enter your full name"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role Field -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Your Role</label>
                        <input 
                            type="text" 
                            name="role" 
                            id="role"
                            placeholder="e.g., Freelancer, Business Owner, Designer"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        >
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating Field -->
                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700">Your Rating <span class="text-red-500">*</span></label>
                        <select 
                            name="rating" 
                            id="rating"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required
                        >
                            <option value="" disabled selected>Choose a rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4">⭐⭐⭐⭐ Very Good</option>
                            <option value="3">⭐⭐⭐ Good</option>
                            <option value="2">⭐⭐ Fair</option>
                            <option value="1">⭐ Poor</option>
                        </select>
                        @error('rating')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feedback Field -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Your Feedback <span class="text-red-500">*</span></label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="5"
                            placeholder="Write about your experience using Doc Pro..."
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required
                        ></textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit"
                            class="w-full py-3 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 shadow-md transition duration-200"
                        >
                            Submit Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
