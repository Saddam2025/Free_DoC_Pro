{{-- resources/views/components/feature-card.blade.php --}}
@props([
    'icon', 
    'alt', 
    'title', 
    'description',
    'delay' => 0 // Provide a default, e.g. 0
])

<div 
    class="flex flex-col items-center"
    data-aos="fade-up" 
    data-aos-delay="{{ $delay }}"
>
    <img 
        src="{{ asset('icons/' . $icon) }}" 
        alt="{{ $alt }}" 
        class="h-32 w-32 mb-6" 
        loading="lazy"
    >
    <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $title }}</h3>
    <p class="text-gray-600">{{ $description }}</p>
</div>
