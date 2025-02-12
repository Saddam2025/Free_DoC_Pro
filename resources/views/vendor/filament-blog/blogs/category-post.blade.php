<x-blog-layout>
    <!-- Category Header Section -->
    <section>
        <header class="container mx-auto mb-8 max-w-[800px] px-6 pb-4 mt-10 text-center">
            <p class="text-gray-800 text-center text-3xl font-semibold tracking-tight border-b-2 border-gray-200 pb-4">
                Category: {{ $category->name }}
            </p>
        </header>
    </section>

    <!-- Blog Posts Section -->
    <section class="pb-16 pt-8">
        <div class="container mx-auto px-6">
            <!-- Blog Grid Layout with Borders -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($posts as $post)
                    <div class="relative group overflow-hidden rounded-xl border-2 border-gray-300 shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
                        <x-blog-card :post="$post" class="transition-transform duration-300 ease-in-out transform group-hover:scale-105" />
                    </div>
                @empty
                    <!-- Empty State: No Posts Found -->
                    <div class="mx-auto col-span-3 text-center">
                        <p class="text-2xl font-semibold text-gray-500">No posts found</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Section with Stylish Border -->
            <div class="mt-10 flex justify-center">
                <div class="border-t-2 w-32"></div> <!-- Stylish separator -->
            </div>
            <div class="mt-5 flex justify-center">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
</x-blog-layout>
