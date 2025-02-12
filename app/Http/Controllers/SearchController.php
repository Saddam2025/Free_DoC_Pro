<?php

namespace App\Http\Controllers;

use App\Models\Page; // Page model
use App\Models\Document; // Document model
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query'); // Get the search query from the input

        // Validate query is not empty
        if (empty($query)) {
            return back()->with('error', 'Please enter a search term.');
        }

        // Search Pages (search in title and content)
        $pages = Page::where('title', 'LIKE', '%' . $query . '%')
                    ->orWhere('content', 'LIKE', '%' . $query . '%') // Optional: search in content
                    ->get();

        // Search Documents (search in name and description)
        $documents = Document::where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%') // Optional: search in description
                            ->get();

        // Return the search results view, passing the results for pages and documents
        return view('search.results', compact('pages', 'documents'));
    }
}
