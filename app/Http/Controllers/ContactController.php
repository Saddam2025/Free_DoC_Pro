<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\AutoReplyMail;


class ContactController extends Controller
{
    /**
     * Handle contact form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validate the contact form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Notify the support team
        Mail::to('info@freedocumentmaker.com')->send(new ContactFormMail($request->all()));

        // Send an auto-reply to the user
        Mail::to($request->email)->send(new AutoReplyMail($request->name));

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Message sent successfully! We will get back to you shortly.');
    }
}
