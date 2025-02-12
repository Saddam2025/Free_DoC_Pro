@props(['post'])
<div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6 px-6 py-10">
    <!-- Post Image -->
    <div class="md:h-[400px] w-full overflow-hidden rounded-xl bg-zinc-300">
        <img class="flex h-full w-full items-center justify-center md:object-cover object-contain object-top transition-all duration-300 ease-in-out transform hover:scale-105"
             src="{{ asset($post->featurePhoto) }}" alt="{{ $post->photo_alt_text }}">
    </div>

    <!-- Post Details -->
    <div class="flex flex-col justify-center space-y-6 py-4 sm:pl-10">
        <!-- Post Title and Categories -->
        <div>
            <a href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}" 
               class="block text-xl md:text-4xl font-semibold text-gray-800 hover:text-blue-600 transition-colors duration-300 ease-in-out">
                {{ $post->title }}
            </a>
            <div class="mt-3">
                @foreach ($post->categories as $category)
                    <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}">
                        <span class="bg-primary-200 text-primary-800 mr-2 inline-flex rounded-full px-3 py-1 text-xs font-semibold">
                            {{ $category->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Post Subtitle -->
        <p class="text-gray-600 text-sm md:text-base mb-4">
            {!! Str::limit($post->sub_title, 150) !!}
        </p>

        <!-- Author Info -->
        <div class="flex items-center gap-4">
            <img class="h-14 w-14 overflow-hidden rounded-full bg-zinc-300 object-cover text-[0] md:object-fill"
                 src="{{ $post->user->avatar }}" alt="{{ $post->user->name() }}">
            <div>
                <span title="{{ $post->user->name() }}" class="block max-w-[150px] overflow-hidden text-ellipsis whitespace-nowrap font-semibold text-gray-700">
                    {{ $post->user->name() }}
                </span>
                <span class="block text-sm font-medium text-zinc-600">
                    {{ $post->formattedPublishedDate() }}
                </span>
            </div>
        </div>
    </div>
</div>
