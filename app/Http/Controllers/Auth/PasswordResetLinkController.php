<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate email input
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Attempt to send reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Log failed attempts for debugging
        if ($status != Password::RESET_LINK_SENT) {
            Log::warning('Password reset link request failed', ['email' => $request->email, 'status' => $status]);
        }

        // Provide user feedback
        if ($status == Password::RESET_LINK_SENT) {
            // Add a success message for the user
            return back()->with('success', 'A password reset link has been sent to your email address.');
        }

        // Handle errors
        return back()->withErrors(['email' => 'Unable to send reset link. Please try again later.']);
    }
}
