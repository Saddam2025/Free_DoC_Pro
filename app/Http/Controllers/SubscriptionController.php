<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ✅ Import DB Facade

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validate email input
        $validated = $request->validate([
            'email' => 'required|email|unique:subscriptions,email', // Prevent duplicate emails
        ]);

        // Save the email to the database
        DB::table('subscriptions')->insert([
            'email' => $validated['email'],
            'created_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}
