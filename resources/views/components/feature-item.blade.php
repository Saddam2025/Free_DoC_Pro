@props(['icon', 'title', 'description', 'routeName'])

<div class="feature-item bg-white shadow-lg rounded-lg p-6 text-center transform transition duration-300 hover:scale-105 hover:shadow-2xl">
    <!-- Icon -->
    <img 
        src="{{ asset('icons/' . $icon . '.svg') }}" 
        alt="{{ $title }} icon" 
        class="h-16 w-16 mx-auto mb-4" 
        loading="lazy" 
        onerror="this.src='{{ asset('icons/default-icon.svg') }}';" 
    >
    
    <!-- Title -->
    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $title }}</h3>
    
    <!-- Description -->
    <p class="text-sm text-gray-600 mb-4">{{ $description }}</p>
    
    <!-- Learn More Link -->
    <a href="{{ route($routeName) }}" class="text-blue-500 hover:underline">
        Learn More
    </a>
</div>
