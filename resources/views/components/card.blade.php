{{-- resources/views/components/card.blade.php --}}
@props(['icon', 'title', 'description', 'bgColor' => 'bg-white'])

<div 
    {{ $attributes->merge(['class' => "$bgColor shadow-lg rounded-lg p-8 transform transition duration-300 hover:scale-105 hover:shadow-2xl"]) }}
>
    <img src="{{ asset('icons/' . $icon . '.svg') }}" alt="{{ $title }} icon" class="h-64 w-64 mx-auto mb-6" loading="lazy">
    <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $title }}</h3>
    <p class="text-gray-600">{{ $description }}</p>
</div>
