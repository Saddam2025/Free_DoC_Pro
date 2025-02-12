<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SearchController,
    SubscriptionController,
    PageController,
    ContactController,
    FaqController,
    TestimonialController,
    PostController,
    BlogController,
    Auth\AuthenticatedSessionController,
    Auth\RegisteredUserController,
    Auth\PasswordResetLinkController,
    Auth\NewPasswordController
};
use App\Livewire\{
    InvoiceGenerator,
    CreditNoteGenerator,
    PurchaseOrderGenerator,
    QuoteGenerator,
    ReceiptGenerator,
    ProformaInvoiceGenerator,
    DeliveryNoteGenerator,
    CvGenerator,
    PaymentReceiptGenerator,
    ExpenseReportGenerator,
    BusinessCardGenerator,
    JobOfferLetterGenerator,
    CertificateGenerator,
    AgreementGenerator
};

// =============================
// ✅ Home Page (Manual SEO)
// =============================
Route::get('/', function () {
    // Fetch latest testimonials
    $testimonials = \App\Models\Testimonial::latest()->take(6)->get();
    
    // Return the welcome view
    return view('welcome', compact('testimonials'));
})->name('home');

// =============================
// ✅ Document Generator Routes (Manual SEO)
// =============================
Route::get('/invoice-generator', InvoiceGenerator::class)->name('invoice.generator');
Route::get('/credit-note-generator', CreditNoteGenerator::class)->name('credit.note.generator');
Route::get('/purchase-order-generator', PurchaseOrderGenerator::class)->name('purchase.order.generator');
Route::get('/quote-generator', QuoteGenerator::class)->name('quote.generator');
Route::get('/receipt-generator', ReceiptGenerator::class)->name('receipt.generator');
Route::get('/proforma-invoice-generator', ProformaInvoiceGenerator::class)->name('proforma.invoice.generator');
Route::get('/delivery-note-generator', DeliveryNoteGenerator::class)->name('delivery.note.generator');
Route::get('/cv-generator', CvGenerator::class)->name('cv.generator');
Route::get('/payment-receipt-generator', PaymentReceiptGenerator::class)->name('payment.receipt.generator');
Route::get('/expense-report-generator', ExpenseReportGenerator::class)->name('expense.report.generator');
Route::get('/business-card-generator', BusinessCardGenerator::class)->name('business.card.generator');
Route::get('/job-offer-letter-generator', JobOfferLetterGenerator::class)->name('job.offer.letter.generator');
Route::get('/certificate-generator', CertificateGenerator::class)->name('certificate.generator');
Route::get('/agreement-generator', AgreementGenerator::class)->name('agreement.generator');

// =============================
// Authentication Routes
// =============================
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// =============================
// Contact Form
// =============================
Route::post('/contact-submit', [ContactController::class, 'submit'])
    ->name('contact.submit');
// =============================


// =============================
// ✅ Testimonial Routes
// =============================
Route::controller(TestimonialController::class)->group(function () {
    Route::get('/testimonial/submit', 'create')->name('testimonial.submit');
    Route::post('/testimonial/store', 'store')->name('testimonial.store');
    Route::get('/testimonials', 'index')->name('testimonial.index');
});

// =============================
// ✅ Subscription Route
// =============================
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

// =============================
// ✅ Search Route
// =============================
Route::get('/search', [SearchController::class, 'index'])->name('search');

// =============================
// ✅ Static Pages (Manual SEO in Blade Files)
// =============================
Route::view('/features', 'pages.features')->name('features');
Route::view('/pricing', 'pages.pricing')->name('pricing');
Route::view('/about', 'pages.about')->name('about');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// =============================
// ✅ Sitemap Route
// =============================
Route::get('/generate-sitemap', function () {
    Artisan::call('sitemap:generate');
    return "✅ Sitemap Updated Successfully!";
});

Route::get('/profile', function () {
    return view('profile'); // or redirect()->route('dashboard');
})->name('profile');