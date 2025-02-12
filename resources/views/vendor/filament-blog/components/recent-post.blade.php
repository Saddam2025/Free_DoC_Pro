@foreach ($posts as $post)
    <a href="{{ route('post.show', ['post' => $post->slug]) }}" 
       class="block text-gray-800 hover:text-blue-600 py-4 transition-all duration-300 ease-in-out hover:translate-x-1">
        <h3 class="text-lg font-semibold leading-tight">
            {{ $post->title }}
        </h3>
    </a>
@endforeach
