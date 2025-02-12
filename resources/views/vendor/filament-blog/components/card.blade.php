@props(['post'])
<a href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}" class="group">
    <div class="flex flex-col gap-y-5 overflow-hidden rounded-xl bg-white shadow-lg hover:shadow-xl transition-shadow duration-300">
        <!-- Post Image Section -->
        <div class="h-[250px] w-full overflow-hidden rounded-xl">
            <img class="flex h-full w-full items-center justify-center object-cover object-top"
                 src="{{ asset($post->featurePhoto) }}" alt="{{ $post->photo_alt_text }}">
        </div>

        <!-- Post Details Section -->
        <div class="flex flex-col justify-between space-y-3 px-4 py-3">
            <!-- Post Title and Sub-title -->
            <div>
                <h2 title="{{ $post->title }}"
                    class="group-hover:text-primary-700 mb-3 text-xl font-semibold line-clamp-2 transition-colors duration-300 hover:text-blue-600">
                    {{ $post->title }}
                </h2>
                <p class="line-clamp-3 text-gray-600">
                    {{ Str::limit($post->sub_title, 100) }}
                </p>
            </div>

            <!-- Author Information -->
            <div class="flex items-center gap-4">
                <img class="h-10 w-10 rounded-full border-2 border-white bg-zinc-300 object-cover"
                     src="{{ $post->user->avatar }}" alt="{{ $post->user->name() }}">
                <div>
                    <span title="{{ $post->user->name() }}"
                          class="block text-sm font-semibold text-gray-800 truncate w-32">{{ $post->user->name() }}</span>
                    <span class="block text-xs text-gray-500">
                        {{ $post->formattedPublishedDate() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</a>
