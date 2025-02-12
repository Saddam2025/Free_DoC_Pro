<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Free Document Maker</title>



  <!-- ✅ Preload Google Fonts for Faster Rendering -->
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"></noscript>

  <style>
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1e3a8a;
        --text-color: #111827;
        --text-secondary: #374151;
        --bg-gradient: linear-gradient(to right, #f8fafc, #eef2ff);
        --transition-speed: 0.3s;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Inter', sans-serif;
        scroll-behavior: smooth;
        color: var(--text-color);
        background-color: #fff;
    }

    /* Fix Navbar Overlapping Hero Section */
    .hero-section {
        width: 100%;
        background: var(--bg-gradient);
        padding: 10rem 0 6rem; /* Adjust padding for navbar */
    }

    .hero-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Fade-in Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        will-change: opacity, transform;
    }
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Hero Text Styling */
    .hero-text {
        max-width: 550px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .hero-description {
        font-size: 1.125rem;
        line-height: 1.6;
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }

    /* CTA Buttons */
    .cta-buttons {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    @media (min-width: 640px) {
        .cta-buttons {
            flex-direction: row;
        }
    }

    .cta-btn {
        display: inline-block;
        padding: 1rem 2rem;
        font-size: 1.125rem;
        font-weight: 600;
        border-radius: 10px;
        text-decoration: none;
        transition: background-color var(--transition-speed) ease, box-shadow var(--transition-speed) ease;
    }

    .cta-btn-primary {
        background: var(--primary-color);
        color: #fff;
    }
    .cta-btn-primary:hover {
        background: var(--primary-dark);
    }

    .cta-btn-secondary {
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
    }
    .cta-btn-secondary:hover {
        background: var(--primary-color);
        color: #fff;
    }

    /* Optimized Hero Image */
    .hero-image {
        max-width: 550px;
    }
    .hero-image img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 12px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .hero-section {
            padding: 9rem 0 4rem;
        }
        .hero-container {
            flex-direction: column;
            text-align: center;
        }
        .hero-text {
            max-width: 100%;
        }
        .hero-title {
            font-size: 2.8rem;
            margin-bottom: 1rem;
        }
        .hero-description {
            font-size: 1rem;
            margin-bottom: 1.25rem;
        }
        .cta-buttons {
            align-items: center;
        }
        .hero-image {
            max-width: 100%;
            margin-top: 20px;
        }
    }
</style>

</head>

<body>

  <!-- ✅ Optimized Hero Section -->
  <section class="hero-section fade-in">
    <div class="hero-container">
        <!-- Hero Text Section -->
        <div class="hero-text">
            <h1 class="hero-title">
                Best &amp; <strong>100% Free</strong> Document Generation
            </h1>
            <p class="hero-description">
                Effortlessly create <strong>invoices</strong>, <strong>CVs</strong>, <strong>receipts</strong>, <strong>credit notes</strong>, and more with our AI-powered, user-friendly tools.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('features') }}" class="cta-btn cta-btn-primary">Explore Features</a>
                <a href="{{ route('pricing') }}" class="cta-btn cta-btn-secondary">Learn More</a>
            </div>
        </div>

        <!-- Hero Image Section -->
        <div class="hero-image">
            <img src="{{ asset('images/document-preview.webp') }}" loading="lazy" width="600" height="400" alt="Optimized Document Preview">
        </div>
    </div>
</section>


  <!-- ✅ Optimized Fade-in Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const fadeInElements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        fadeInElements.forEach(element => observer.observe(element));
    });
</script>


</body>
</html>
