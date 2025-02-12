<x-blog-layout>
    @if(count($posts))
    <!-- 🌟 Featured Post Section -->
    <section class="py-14 bg-gradient-to-r from-gray-100 to-gray-50">
        <div class="container mx-auto">
            {{-- 🌟 Featured Post --}}
            @foreach ($posts->take(1) as $post)
            <div class="relative group mb-12">
                <x-blog-feature-card :post="$post" class="transition-transform duration-300 ease-in-out transform hover:scale-105" />
            </div>
            @endforeach
        </div>
    </section>

    <!-- 📌 Blog Grid Section -->
    <section class="py-12">
        <div class="container mx-auto">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($posts->skip(1) as $post)
                <div class="relative group overflow-hidden rounded-lg bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out border border-gray-200">
                    <x-blog-card :post="$post" class="transition-transform duration-300 ease-in-out transform group-hover:scale-[1.02]" />
                </div>
                @endforeach
            </div>

            <!-- 🟢 Show All Blogs Button -->
            <div class="flex justify-center pt-16">
                <a href="{{ route('filamentblog.post.all') }}"
                   class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-indigo-600 rounded-full shadow-md transition-all duration-300 ease-in-out hover:bg-indigo-700 hover:scale-105" aria-label="Show all blog posts">
                    <span>Show All Blogs</span>
                    <i class="fas fa-arrow-right ml-2"></i> <!-- Font Awesome Icon -->
                </a>
            </div>
        </div>
    </section>

    @else
    <!-- 🔴 Empty State -->
    <section class="flex items-center justify-center min-h-screen bg-gray-50">
        <div class="text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mx-auto text-gray-300" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16M4 16h16M4 12h16" />
            </svg>
            <p class="mt-4 text-2xl font-semibold text-gray-500">No blog posts found.</p>
            <a href="{{ route('filamentblog.post.create') }}" class="mt-4 inline-block text-lg font-medium text-indigo-600 hover:underline">
                Create your first post →
            </a>
        </div>
    </section>
    @endif
</x-blog-layout>
