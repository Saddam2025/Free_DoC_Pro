<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $testimonials = [
            [
                'content' => 'Doc Pro made my life so much easier. Highly recommended!',
                'name' => 'Jane Doe',
                'role' => 'Freelancer',
            ],
            [
                'content' => 'The best document generator I have ever used!',
                'name' => 'John Smith',
                'role' => 'Business Owner',
            ],
            [
                'content' => 'Quick, easy, and professional results every time.',
                'name' => 'Alice Brown',
                'role' => 'HR Manager',
            ],
        ];

        return view('welcome', compact('testimonials'));
    }
    
}
