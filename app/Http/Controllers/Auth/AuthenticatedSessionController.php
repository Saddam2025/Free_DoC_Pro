<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login authentication.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // Throttling settings
        $maxAttempts = config('auth.throttle.max_attempts', 5);
        $decayMinutes = config('auth.throttle.decay_minutes', 1);
        $rateLimiterKey = $this->getRateLimiterKey($request, $credentials['email']);

        // Check for throttling
        if (RateLimiter::tooManyAttempts($rateLimiterKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);

            return back()->withErrors([
                'email' => __('auth.throttle', ['seconds' => $seconds]),
            ])->withInput();
        }

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            RateLimiter::clear($rateLimiterKey);

            return redirect()->intended(route('home'))->with('success', __('auth.login_success'));
        }

        // Handle failed authentication
        $this->incrementLoginAttempts($rateLimiterKey, $decayMinutes);
        $this->logFailedAttempt($request, $credentials['email']);

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->withInput();
    }

    /**
     * Logout the user and destroy their session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Invalidate the current session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', __('auth.logout_success'));
    }

    /**
     * Generate a unique rate-limiting key.
     *
     * @param Request $request
     * @param string $email
     * @return string
     */
    private function getRateLimiterKey(Request $request, string $email): string
    {
        return 'login|' . $request->ip() . '|' . sha1($email);
    }

    /**
     * Increment the rate limiter count.
     *
     * @param string $key
     * @param int $decayMinutes
     * @return void
     */
    private function incrementLoginAttempts(string $key, int $decayMinutes): void
    {
        RateLimiter::hit($key, $decayMinutes * 60);
    }

    /**
     * Log failed login attempt.
     *
     * @param Request $request
     * @param string $email
     * @return void
     */
    private function logFailedAttempt(Request $request, string $email): void
    {
        Log::warning('Failed login attempt', [
            'email' => sha1($email), // Mask the email for privacy
            'ip' => $request->ip(),
        ]);
    }
}
