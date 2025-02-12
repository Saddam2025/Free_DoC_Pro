<!-- ✅ Preload Bootstrap CSS for Faster Rendering -->
<link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css"></noscript>

<!-- ✅ Preload FontAwesome Icons -->
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"></noscript>

<!-- ✅ Main Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/app.min.css') }}"> <!-- Minified Custom CSS -->

<!-- ✅ Load Bootstrap JS (Optimized) -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ Load Livewire Only on Dashboard (Performance Boost) -->
@if (request()->routeIs('dashboard'))
    <script defer src="{{ asset('livewire/livewire.min.js') }}"></script>
@endif

<!-- ✅ Lazy Load Google Ads (Improves FCP/LCP) -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            const adScript = document.createElement("script");
            adScript.src = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2081671021537614";
            adScript.async = true;
            document.body.appendChild(adScript);
        }, 1000); // Reduced delay to 1 second
    });
</script>

<!-- ✅ Back-to-Top Button (Optimized) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const backToTopBtn = document.getElementById('backToTop');

        if (backToTopBtn) {
            window.addEventListener('scroll', () => {
                backToTopBtn.style.display = window.scrollY > 300 ? "block" : "none";
            });

            backToTopBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    });
</script>

<!-- ✅ Custom App JS (Deferred & Minified) -->
@if (file_exists(public_path('assets/app.min.js')))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const appScript = document.createElement("script");
            appScript.src = "{{ asset('assets/app.min.js') }}";
            appScript.defer = true;
            document.body.appendChild(appScript);
        });
    </script>
@endif