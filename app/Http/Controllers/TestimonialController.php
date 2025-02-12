<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    /**
     * Display a list of testimonials with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch testimonials with pagination
        $testimonials = Testimonial::latest()->paginate(6); // Display 6 testimonials per page

        return view('testimonials.index', compact('testimonials')); // Testimonials listing view
    }

    /**
     * Render the testimonial submission form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('testimonials.create'); // Render form view
    }

    /**
     * Store the submitted testimonial in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string|min:10|max:1000',
            'role' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        try {
            // Save the testimonial in the database
            Testimonial::create([
                'name' => strip_tags($request->name), // Strip unwanted HTML tags for security
                'content' => strip_tags($request->content),
                'role' => strip_tags($request->role),
                'rating' => $request->rating ?? 0, // Default to 0 if no rating is provided
            ]);

            // Redirect to the homepage with a success message
            return redirect()->route('home')->with('success', 'Thank you for your testimonial!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error saving testimonial: ' . $e->getMessage());

            // Redirect back with a user-friendly error message
            return back()
                ->withInput($request->all())
                ->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }
}
