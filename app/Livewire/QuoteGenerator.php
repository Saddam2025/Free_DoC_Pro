<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class QuoteGenerator extends Component
{
    use WithFileUploads;

    // Properties for form data
    public $logo;
    public $quote_number;
    public $date;
    public $expiry_date;
    public $currency = 'USD'; // Default currency
    public $from;
    public $to;
    public $items = [];
    public $subtotal = 0;
    public $tax = 0;
    public $discount = 0;
    public $shipping = 0;
    public $total = 0;
    public $payment_terms;
    public $validity_period;
    public $authorized_signature;
    public $terms_conditions;
    public $notes;

    // Currency options
    public $currencySymbols = [
        'USD' => 'US Dollar ($)',
        'BDT' => 'Bangladeshi Taka (৳)',
        'EUR' => 'Euro (€)',
        'GBP' => 'British Pound (£)',
        'AUD' => 'Australian Dollar (A$)',
        'CAD' => 'Canadian Dollar (C$)',
        'INR' => 'Indian Rupee (₹)',
        'JPY' => 'Japanese Yen (¥)',
        'CNY' => 'Chinese Yuan (¥)',
        'ZAR' => 'South African Rand (R)',
        'MXN' => 'Mexican Peso (MX$)',
        'BRL' => 'Brazilian Real (R$)',
    ];

    // Lifecycle hook
    public function mount()
    {
        $this->items = [['description' => '', 'quantity' => 1, 'rate' => 0, 'amount' => 0]];
        $this->date = now()->format('Y-m-d');
        $this->expiry_date = now()->addDays(30)->format('Y-m-d');
    }

    // Add a new item
    public function addItem()
    {
        $this->items[] = ['description' => '', 'quantity' => 1, 'rate' => 0, 'amount' => 0];
    }

    // Remove an item
    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex array
        $this->calculateTotals();
    }

    // Calculate totals
    public function calculateTotals()
    {
        $this->subtotal = array_reduce($this->items, function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['rate']);
        }, 0);

        $taxAmount = ($this->subtotal * $this->tax) / 100;
        $discountAmount = $this->discount;
        $this->total = $this->subtotal + $taxAmount - $discountAmount + $this->shipping;
    }

    // Generate and download PDF
    public function downloadPDF()
    {
        $this->validate([
            'quote_number' => 'required|string|max:50',
            'date' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:date',
            'from' => 'required|string|max:500',
            'to' => 'required|string|max:500',
            'items.*.description' => 'required|string|max:200',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0',
        ]);

        $this->calculateTotals();

        $pdf = PDF::loadView('livewire.quote-pdf', [
            'logo' => $this->logo ? $this->logo->getRealPath() : null, // Ensure logo path is passed correctly
            'quote_number' => $this->quote_number,
            'date' => $this->date,
            'expiry_date' => $this->expiry_date,
            'currency' => $this->currency,
            'currency_symbol' => $this->currencySymbols[$this->currency] ?? $this->currency,
            'from' => $this->from,
            'to' => $this->to,
            'items' => $this->items,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'shipping' => $this->shipping,
            'total' => $this->total,
            'payment_terms' => $this->payment_terms,
            'validity_period' => $this->validity_period,
            'authorized_signature' => $this->authorized_signature,
            'terms_conditions' => $this->terms_conditions,
            'notes' => $this->notes,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "quote_{$this->quote_number}.pdf");
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'items')) {
            $this->calculateTotals();
        }
    }

    public function render()
    {
        $this->calculateTotals(); // Ensure totals are always updated
        return view('livewire.quote-generator')->layout('layouts.app');
    }
}
