@extends('layouts.app')

@section('title', 'Search Results')
@section('meta_description', 'Search results for documents and pages.')
@section('meta_keywords', 'search, documents, pages, Doc Pro')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">Search Results</h1>

        @if(session('error'))
            <div class="alert alert-warning text-center mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-8">
            <h2 class="text-2xl font-semibold">Pages</h2>
            @if($pages->isEmpty())
                <p>No pages found matching your query.</p>
            @else
                <ul class="list-disc pl-6">
                    @foreach($pages as $page)
                        <li>
                            <a href="{{ route('page.show', $page->id) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-semibold">Documents</h2>
            @if($documents->isEmpty())
                <p>No documents found matching your query.</p>
            @else
                <ul class="list-disc pl-6">
                    @foreach($documents as $document)
                        <li>
                            <a href="{{ route('document.show', $document->id) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $document->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
