<x-blog-layout>
    <!-- Latest Blogs Section Heading -->
    <section class="py-16 bg-gradient-to-r from-indigo-200 via-indigo-50 to-indigo-200">
        <header class="container mx-auto px-6">
            <h3 class="text-gray-900 text-center text-4xl font-bold leading-tight tracking-tight relative z-10">
                Latest News / Blogs
            </h3>
        </header>
    </section>

    <!-- Blog Cards Section -->
    <section class="pb-16 pt-8">
        <div class="container mx-auto px-6">
            <!-- Blog Grid -->
            <div class="grid gap-x-10 gap-y-14 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($posts as $post)
                    <div class="relative group overflow-hidden rounded-xl shadow-lg bg-white hover:shadow-xl transition-shadow duration-300">
                        <x-blog-card :post="$post" class="transition-transform transform group-hover:scale-105" />
                    </div>
                @empty
                    <!-- Empty State when no posts -->
                    <div class="mx-auto col-span-3">
                        <div class="flex items-center justify-center">
                            <p class="text-2xl font-semibold text-gray-500">No posts found</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Section -->
            <div class="mt-16 flex justify-center">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        </div>
    </section>
</x-blog-layout>
