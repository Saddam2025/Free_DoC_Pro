<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            // Add FAQs here (as in the previous code snippet)
        ];

        $generalFAQs = array_filter($faqs, function ($faq) {
            return in_array($faq['question'], [
                'How does Doc Pro work?',
                'Is it really free to use?',
                'Can I modify the documents after generating them?',
                'What kind of documents can I generate with Doc Pro?',
            ]);
        });

        $accountFAQs = array_filter($faqs, function ($faq) {
            return in_array($faq['question'], [
                'Do I need to create an account to use Doc Pro?',
                'How secure is my data on Doc Pro?',
                'What happens if I lose my documents?',
            ]);
        });

        $supportFAQs = array_filter($faqs, function ($faq) {
            return in_array($faq['question'], [
                'How can I contact Doc Pro support?',
                'How is Doc Pro different from other document generators?',
                'Can I suggest new features or tools?',
            ]);
        });

        return view('pages.faq', compact('generalFAQs', 'accountFAQs', 'supportFAQs'));
    }
}
