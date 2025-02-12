@extends('layouts.app')

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // ✅ Optimize AdSense Load (Conditionally Load If Needed)
    if (document.querySelector(".adsense-container")) {
        setTimeout(() => {
          const adScript = document.createElement("script");
          adScript.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2081671021537614";
          adScript.async = true;
          adScript.setAttribute("crossorigin", "anonymous");
          document.body.appendChild(adScript);
        }, 800);  // Slightly reduced delay
    }

    // ✅ Smooth fade-in effect using Intersection Observer for elements with .fade-up class
    const fadeElements = document.querySelectorAll(".fade-up");
    if ("IntersectionObserver" in window) {
        let observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: "0px 0px -50px 0px", threshold: 0.2 });

        fadeElements.forEach(el => observer.observe(el));
    } else {
        fadeElements.forEach(el => el.classList.add("visible"));  // Fallback for older browsers
    }
  });
</script>
@endpush

@section('content')
  {{-- ✅ Hero Section --}}
  <x-hero />

  {{-- Highlights Section --}}
  <section id="highlights" class="py-12 sm:py-16 bg-gradient-to-r from-blue-50 to-indigo-100">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-wide mb-6 sm:mb-8 text-gray-800">
        Highlights of Doc Pro
      </h2>
      <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-12 leading-relaxed max-w-2xl mx-auto">
        Doc Pro is your all-in-one, <strong>free</strong>, and easy-to-use solution for creating professional documents.
      </p>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-12">
        @foreach ([
          'easy_to_use' => ['Easy to Use', 'easy-to-use'],
          'free' => ['100% Free', 'free'],
          'professional_results' => ['Professional Results', 'professional-results'],
          'accessible_anywhere' => ['Accessible Anywhere', 'accessible-anywhere'],
        ] as $key => [$title, $icon])
          <x-card 
            :icon="$icon" 
            :title="$title" 
            :description="[ 
              'easy_to_use' => 'Simplify the process of creating documents with our intuitive tools, accessible to everyone.',
              'free' => 'Enjoy all features at no cost. No hidden charges or subscriptions.',
              'professional_results' => 'Achieve polished and industry-standard documents in just minutes.',
              'accessible_anywhere' => 'Generate documents on any device, anytime, anywhere, with an internet connection.',
            ][$key]"
            class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg fade-up"
          />
        @endforeach
      </div>
    </div>
  </section>

  {{-- Features Section --}}
  <section id="features" class="py-12 sm:py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-wide mb-6 sm:mb-8 text-gray-800">
        Why Choose Doc Pro?
      </h2>
      <p class="text-base sm:text-lg text-gray-600 mb-10 sm:mb-16 leading-relaxed max-w-2xl mx-auto">
        <strong>Free</strong> and quick document generation with no hidden charges. Create invoices, CVs, and more effortlessly.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
        @foreach ([
          'invoice_generator' => ['Invoice Generator', 'invoice-generator', 'Effortlessly create professional invoices for free.'],
          'cv_builder' => ['CV Builder', 'cv-builder', 'Build professional resumes using sleek templates.'],
          'receipt_generator' => ['Receipt Generator', 'receipt-generator', 'Generate detailed receipts quickly and accurately.'],
          'certificate_generator' => ['Certificate Generator', 'certificate-generator', 'Craft high-quality certificates for awards and events.'],
          'agreement_generator' => ['Agreement Generator', 'agreement-generator', 'Draft legally sound agreements tailored to your needs.'],
          'job_offer_letter_generator' => ['Job Offer Letter Generator', 'job-offer-letter-generator', 'Create professional job offer letters effortlessly.'],
        ] as $key => [$title, $icon, $description])
          <x-card 
            :icon="$icon" 
            :title="$title" 
            :description="$description"
            bgColor="bg-gray-50" 
            class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg fade-up"
          />
        @endforeach
      </div>
    </div>
  </section>

  {{-- How It Works Section --}}
  <section class="relative bg-gray-100 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
      <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-12">
        <!-- Left: Illustration -->
        <div class="p-6 bg-white rounded-3xl shadow-md transition-shadow duration-300 hover:shadow-lg">
          <img 
            src="{{ asset('images/Invoice-bro.svg') }}" 
            alt="Illustration of a person working on a laptop"
            loading="lazy"
            decoding="async"
            class="w-full max-w-lg mx-auto rounded-2xl"
          />
        </div>

        <!-- Right: Steps with Icons -->
        <div>
          <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-900">
            How It Works
          </h2>
          <p class="text-lg text-gray-600 mt-4">
            Follow these simple steps to generate professional documents in minutes.
          </p>

          <div class="mt-8 space-y-6">
            @foreach([
              ['icon' => 'fa-file-alt', 'title' => 'Select a Template', 'desc' => 'Choose from a wide range of beautifully designed templates.'],
              ['icon' => 'fa-edit', 'title' => 'Customize Your Document', 'desc' => 'Modify the content, style, and branding to fit your needs.'],
              ['icon' => 'fa-download', 'title' => 'Download & Share', 'desc' => 'Save in multiple formats or instantly share with clients.']
            ] as $step)
              <div class="flex items-start space-x-4">
                <div 
                  class="h-12 w-12 flex items-center justify-center bg-blue-600 
                         text-white rounded-full text-2xl shadow-md"
                >
                  <i class="fas {{ $step['icon'] }}"></i>
                </div>
                <div>
                  <h3 class="text-lg font-semibold text-gray-900">
                    {{ $step['title'] }}
                  </h3>
                  <p class="text-gray-600 mt-1">
                    {{ $step['desc'] }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Benefits Section --}}
  <section id="benefits" class="py-12 sm:py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-wide mb-6 sm:mb-8 text-gray-800">
        Benefits of Using Doc Pro
      </h2>
      <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-12 leading-relaxed max-w-2xl mx-auto">
        Discover the key advantages that make Doc Pro the preferred choice for document generation.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
        @foreach ([
          [
            'icon' => 'fas fa-clock text-blue-600',
            'title' => 'Time Saving',
            'description' => 'Automate your document creation process to reduce manual tasks and increase productivity.',
          ],
          [
            'icon' => 'fas fa-dollar-sign text-green-600',
            'title' => 'Cost Effective',
            'description' => 'Access premium document tools completely free, eliminating expensive software subscriptions.',
          ],
          [
            'icon' => 'fas fa-paint-brush text-purple-600',
            'title' => 'Highly Customizable',
            'description' => 'Tailor each document to your needs with extensive styling and professional templates.',
          ],
          [
            'icon' => 'fas fa-shield-alt text-red-600',
            'title' => 'Secure',
            'description' => 'Your data is protected with advanced security measures, ensuring confidentiality.',
          ],
          [
            'icon' => 'fas fa-headset text-teal-600',
            'title' => '24/7 Support',
            'description' => 'Our dedicated team is available around the clock to assist with any issues or questions.',
          ],
          [
            'icon' => 'fas fa-cogs text-yellow-600',
            'title' => 'Easy Integration',
            'description' => 'Seamlessly integrate Doc Pro into your workflow for enhanced efficiency and productivity.',
          ],
        ] as $benefit)
          <div class="bg-gray-50 rounded-lg p-6 sm:p-8 shadow-md hover:shadow-lg transition-shadow duration-300">
            <i class="{{ $benefit['icon'] }} text-4xl mb-4" aria-hidden="true"></i>
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">
              {{ $benefit['title'] }}
            </h3>
            <p class="text-gray-600">
              {{ $benefit['description'] }}
            </p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Features in Detail Section --}}
  <section id="features-detail" class="py-12 sm:py-16 bg-blue-50">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-wide mb-6 sm:mb-8 text-gray-800">
        Explore Our Features
      </h2>
      <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-12 leading-relaxed max-w-2xl mx-auto">
        Dive deeper into the comprehensive features that make Doc Pro the ultimate tool for all your document needs.
      </p>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
        @foreach ([
          [
            'icon' => 'invoice-generator.svg',
            'alt' => 'Create detailed invoices easily with the Invoice Generator',
            'title' => 'Invoice Generator',
            'description' => 'Effortlessly create customizable invoices. Track payments, manage clients, and stay organized.',
          ],
          [
            'icon' => 'cv-builder.svg',
            'alt' => 'Design professional resumes with the CV Builder',
            'title' => 'CV Builder',
            'description' => 'Craft eye-catching resumes using flexible templates. Highlight your skills and experience seamlessly.',
          ],
          [
            'icon' => 'receipt-generator.svg',
            'alt' => 'Generate professional receipts with the Receipt Generator',
            'title' => 'Receipt Generator',
            'description' => 'Create professional receipts for all transactions. Ensure accurate and convenient documentation.',
          ],
          [
            'icon' => 'certificate-generator.svg',
            'alt' => 'Create professional certificates easily with the Certificate Generator',
            'title' => 'Certificate Generator',
            'description' => 'High-quality certificates for awards and achievements. Customize branding and layout to match your needs.',
          ],
          [
            'icon' => 'agreement-generator.svg',
            'alt' => 'Draft agreements quickly with the Agreement Generator',
            'title' => 'Agreement Generator',
            'description' => 'Draft legally sound agreements tailored to your requirements—ideal for business or freelance projects.',
          ],
          [
            'icon' => 'job-offer-letter-generator.svg',
            'alt' => 'Streamline hiring with the Job Offer Letter Generator',
            'title' => 'Job Offer Letter Generator',
            'description' => 'Simplify your hiring process with professional offer letters. Easily customize terms and benefits.',
          ],
        ] as $feature)
          <x-feature-card 
            :icon="$feature['icon']" 
            :alt="$feature['alt']" 
            :title="$feature['title']" 
            :description="$feature['description']"
            class="flex flex-col items-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
          />
        @endforeach
      </div>
    </div>
  </section>

  {{-- Testimonials Section --}}
  <section id="testimonials" class="py-12 sm:py-16 bg-gradient-to-r from-indigo-100 to-blue-100">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-wide mb-6 sm:mb-8 text-gray-800">
        What Our Users Say
      </h2>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
        @forelse ($testimonials as $testimonial)
          <div class="bg-white rounded-lg p-6 sm:p-8 shadow-md hover:shadow-lg transition-shadow duration-300">
            <p class="text-gray-600 italic mb-4 sm:mb-6">
              "{{ e($testimonial->content) }}"
            </p>
            <h4 class="text-lg sm:text-xl font-bold text-gray-800">
              {{ e($testimonial->name) }}
            </h4>
            <span class="text-sm text-gray-500">
              {{ $testimonial->role ?? 'Customer' }}
            </span>
            @if($testimonial->rating)
              <p class="text-yellow-500 mt-2" aria-label="Rating: {{ $testimonial->rating }} out of 5">
                @for ($i = 0; $i < $testimonial->rating; $i++)
                  <span class="fas fa-star"></span>
                @endfor
                @for ($i = $testimonial->rating; $i < 5; $i++)
                  <span class="far fa-star"></span>
                @endfor
              </p>
            @endif
          </div>
        @empty
          <p class="text-gray-600 italic col-span-full">
            No testimonials available. Be the first to share your experience!
          </p>
        @endforelse
      </div>

      <div class="mt-8">
        <a 
          href="{{ route('testimonial.submit') }}" 
          class="px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-lg transition-colors duration-300 hover:bg-blue-700 focus:outline-none"
        >
          Share Your Experience
        </a>
      </div>
    </div>
  </section>

  {{-- Newsletter Signup Section --}}
  <section id="newsletter" class="py-12 sm:py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-wide mb-6 sm:mb-8 text-gray-800">
        Stay Updated with Doc Pro
      </h2>
      <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-12 leading-relaxed max-w-2xl mx-auto">
        Subscribe to our newsletter for updates, tips, and exclusive offers.
      </p>

      <form 
        action="{{ route('subscribe') }}" 
        method="POST" 
        class="flex flex-col sm:flex-row justify-center items-center"
      >
        @csrf
        <input 
          type="email" 
          name="email" 
          class="p-4 border border-gray-300 rounded-lg w-full sm:w-1/3 focus:ring-2 focus:ring-blue-600 focus:outline-none transition mb-4 sm:mb-0 sm:mr-4" 
          placeholder="Enter your email" 
          required 
          aria-label="Email Address"
        >
        <button 
          type="submit" 
          class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 hover:bg-blue-700 focus:outline-none"
        >
          Subscribe
        </button>
      </form>
    </div>
  </section>

  {{-- Call-to-Action Section --}}
  <section id="cta" class="py-12 sm:py-16 bg-gradient-to-r from-indigo-500 to-blue-500 text-white text-center">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 sm:mb-6">
        Start Creating Your Documents Now
      </h2>
      <p class="text-base sm:text-lg mb-6 sm:mb-8">
        Join thousands of users and simplify your documentation process.
      </p>
      <a 
        href="{{ route('register') }}" 
        class="px-6 py-3 bg-white text-indigo-600 font-bold rounded-lg transition-colors duration-300 hover:text-indigo-800 focus:outline-none"
        aria-label="Sign Up for Free"
      >
        Get Started for Free
      </a>
    </div>
  </section>

  {{-- ✅ Optimize Newsletter Form (AJAX Submission) --}}
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const newsletterForm = document.querySelector("#newsletterForm");
        if (!newsletterForm) return;
        
        newsletterForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch("{{ route('subscribe') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.querySelector("#newsletterMessage").innerText = data.message;
            })
            .catch(error => console.error("Error:", error));
        });
    });
  </script>
@endsection


