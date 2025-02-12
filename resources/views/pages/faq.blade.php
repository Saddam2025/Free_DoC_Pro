@extends('layouts.app')

@section('title', 'FAQ - Find Answers to Your Questions | Doc Pro - Free Document Generator')
@section('meta_description', 'Find answers to your questions about Doc Pro, the ultimate platform for creating free professional documents like invoices, CVs, agreements, and more. Learn how to make document creation effortless!')
@section('meta_keywords', 'FAQ, Doc Pro, free document generator, invoice maker, CV builder, professional templates, online document tools, help center, how-to, troubleshooting')

<!-- Structured Data for FAQ and Breadcrumb -->
@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is Doc Pro?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Doc Pro is a powerful, free online platform that allows individuals and businesses to create professional documents like invoices, CVs, business agreements, resumes, and much more, without any prior design or formatting knowledge. It’s designed to simplify the document creation process with customizable templates for both personal and professional use. Whether you need a professional-looking invoice, a polished CV, or a legal agreement, Doc Pro provides tools that save you time and effort in generating these documents."
      }
    },
    {
      "@type": "Question",
      "name": "How do I create an invoice using Doc Pro?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Creating an invoice on Doc Pro is straightforward. First, navigate to the 'Invoice Generator' section. There, you’ll find a user-friendly template with fields to input the necessary information such as your company name, client details, items or services provided, payment terms, and other relevant details. Once you’ve filled out the template, you can customize the design (such as adding your logo or changing fonts and colors) before downloading your invoice. It’s that simple! No hidden charges, and you get a professional-looking invoice in minutes."
      }
    },
    {
      "@type": "Question",
      "name": "Is Doc Pro completely free to use?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes! Doc Pro is entirely free to use. There are no hidden fees or subscription requirements. You can create, customize, and download an unlimited number of documents, including invoices, CVs, contracts, and more, without any cost. This makes Doc Pro the perfect solution for small businesses, freelancers, or anyone needing to generate professional documents quickly and efficiently. We believe in providing an accessible platform to everyone."
      }
    },
    {
      "@type": "Question",
      "name": "How many documents can I create?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "There is absolutely no limit on how many documents you can create. Whether you need to generate a single invoice, multiple CVs, a series of legal contracts, or any other documents, Doc Pro allows you to create as many as you want, completely free. This flexibility is particularly useful for freelancers, small businesses, and individuals who regularly need to produce professional documents."
      }
    },
    {
      "@type": "Question",
      "name": "Which file formats are supported?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Doc Pro supports several file formats to cater to various needs. The most common format is PDF, which is widely used for official documents and is perfect for sharing or printing. We also offer formats such as Word and Text files, which allow you to further edit or customize your documents after downloading. The file format options depend on the template you choose. PDF is ideal for finalized, shareable documents, while Word or Text formats are perfect if you need to make further adjustments or edits."
      }
    },
    {
      "@type": "Question",
      "name": "Can I customize my document’s look and feel?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, Doc Pro offers full customization options for all documents. You can modify the font style, size, and color scheme to match your branding or personal preferences. Additionally, you can upload your logo, change the layout, and even add or remove sections based on your specific needs. This flexibility ensures that every document you create not only serves its intended purpose but also reflects your unique style and branding."
      }
    },
    {
      "@type": "Question",
      "name": "What about privacy and data security?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We take your privacy and data security very seriously. All your personal information, including document content, is securely encrypted using industry-standard security protocols. Your documents are stored in a secure environment to prevent unauthorized access. We do not sell or share any of your data with third parties. Your data is solely used to generate and save documents for your use. At Doc Pro, we comply with all applicable privacy laws to ensure that your personal information remains safe and private."
      }
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://freedocumentmaker.com"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "FAQ",
      "item": "https://freedocumentmaker.com/faq"
    }
  ]
}
</script>
@endsection

@section('content')
<section class="pt-16 pb-24 bg-gradient-to-br from-blue-50 via-white to-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" data-aos="fade-up">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-3">
                <i class="fas fa-question-circle text-blue-600"></i>
                Frequently Asked Questions
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 font-medium">
                Find answers to the most commonly asked questions about 
                <span class="font-semibold">Doc Pro</span>, your ultimate free document generation tool.
            </p>
        </div>

        <!-- 2-Column FAQ Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8" data-aos="fade-up" data-aos-delay="200">
            <!-- Left Column -->
            <div class="space-y-8">
                <!-- General Questions -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center mb-4">
                        <i class="fas fa-folder-open text-blue-600 mr-2"></i> General Questions
                    </h2>

                    <!-- FAQ Item -->
                    <div class="bg-white rounded-md shadow p-6 flex flex-col md:flex-row items-start">
                        <div class="flex-shrink-0 md:mr-4 text-blue-600">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bullseye text-2xl"></i>
                            </div>
                            <div class="hidden md:block w-px h-16 bg-gray-200 mx-auto mt-4"></div>
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                What is Doc Pro?
                            </h3>
                            <p class="text-gray-600">
                                Doc Pro is a powerful, free online platform that allows individuals and businesses to create professional documents like invoices, CVs, business agreements, resumes, and much more, without any prior design or formatting knowledge. It’s designed to simplify the document creation process with customizable templates for both personal and professional use. Whether you need a professional-looking invoice, a polished CV, or a legal agreement, Doc Pro provides tools that save you time and effort in generating these documents.
                            </p>
                            <a href="#" class="inline-block text-blue-500 font-medium hover:underline mt-3">
                                READ MORE
                            </a>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="bg-white rounded-md shadow p-6 flex flex-col md:flex-row items-start">
                        <div class="flex-shrink-0 md:mr-4 text-blue-600">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bullseye text-2xl"></i>
                            </div>
                            <div class="hidden md:block w-px h-16 bg-gray-200 mx-auto mt-4"></div>
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                How does Doc Pro work?
                            </h3>
                            <p class="text-gray-600">
                                Doc Pro provides an extensive library of customizable templates. Simply select a template, input your details, preview the document, and download it in your preferred format. The process is quick and user-friendly, making document creation effortless for all. Whether you're creating a CV, invoice, or business agreement, you can customize every element to fit your specific needs. The platform's intuitive design allows you to create professional documents in minutes without the need for advanced technical skills.
                            </p>
                            <a href="#" class="inline-block text-blue-500 font-medium hover:underline mt-3">
                                READ MORE
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Usage & Features -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center mb-4 mt-8">
                        <i class="fas fa-cog text-blue-600 mr-2"></i> Usage & Features
                    </h2>

                    <!-- FAQ Item -->
                    <div class="bg-white rounded-md shadow p-6 flex flex-col md:flex-row items-start">
                        <div class="flex-shrink-0 md:mr-4 text-blue-600">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bullseye text-2xl"></i>
                            </div>
                            <div class="hidden md:block w-px h-16 bg-gray-200 mx-auto mt-4"></div>
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                Which file formats are supported?
                            </h3>
                            <p class="text-gray-600">
                                Doc Pro supports various file formats, primarily PDF for professional use, and Word/Text formats for easy editing. Depending on the template, additional formats might be available. PDF is perfect for finalized documents that you want to share or print, while Word/Text formats allow you to make adjustments or further edits. This flexibility ensures that Doc Pro meets the needs of both official and customizable documents.
                            </p>
                            <a href="#" class="inline-block text-blue-500 font-medium hover:underline mt-3">
                                READ MORE
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Account & Security -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center mb-4">
                        <i class="fas fa-user-shield text-blue-600 mr-2"></i> Account & Security
                    </h2>

                    <!-- FAQ Item -->
                    <div class="bg-white rounded-md shadow p-6 flex flex-col md:flex-row items-start">
                        <div class="flex-shrink-0 md:mr-4 text-blue-600">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bullseye text-2xl"></i>
                            </div>
                            <div class="hidden md:block w-px h-16 bg-gray-200 mx-auto mt-4"></div>
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                Do I need an account to use Doc Pro?
                            </h3>
                            <p class="text-gray-600">
                                No, you can use most features without creating an account. However, signing up allows you to save documents for future access, customize your profile, and track your usage. Creating an account ensures that you can keep your documents stored securely, which is especially helpful for businesses that need to manage large volumes of documents. It's free and easy to sign up!
                            </p>
                            <a href="#" class="inline-block text-blue-500 font-medium hover:underline mt-3">
                                READ MORE
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Additional Resources -->
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-link text-blue-600 mr-2"></i> Additional Resources
                    </h2>
                    <ul class="list-disc list-inside text-gray-700 text-lg space-y-2">
                        <li>
                            <i class="fas fa-file-alt text-blue-600"></i> 
                            <a href="{{ route('privacy') }}" class="text-blue-600 hover:underline">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-file-contract text-blue-600"></i> 
                            <a href="{{ route('terms') }}" class="text-blue-600 hover:underline">
                                Terms of Service
                            </a>
                        </li>
                        <li>
                            <i class="fas fa-headset text-blue-600"></i> 
                            <a href="{{ route('contact') }}" class="text-blue-600 hover:underline">
                                Contact Support
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Google AdSense Integration --}}
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

@section('scripts')
<script>
    // Initialize AOS for scroll animations
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
</script>
@endsection
