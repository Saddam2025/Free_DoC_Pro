<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class PurchaseOrderGenerator extends Component
{
    use WithFileUploads;

    /**
     * -------------------------
     * Fields and Properties
     * -------------------------
     */
    public $logo;

    // Basic Purchase Order info
    public $purchase_order_number;
    public $date;
    public $expiry_date;
    public $currency = '$';

    // Currency symbols map if needed in the UI
    public $currencySymbols = [
        '$'  => 'USD ($)',
        '€'  => 'EUR (€)',
        '£'  => 'GBP (£)',
        '₹'  => 'INR (₹)',
        '¥'  => 'JPY (¥)',
        'C$' => 'CAD (C$)',
        'A$' => 'AUD (A$)',
        'CHF'=> 'CHF',
    ];

    // Seller & Buyer details
    public $from;  // Seller
    public $to;    // Buyer

    // Items array
    public $items = [];

    // Misc fields
    public $notes;
    public $payment_terms;
    public $validity_period;
    public $authorized_signature;
    public $terms_and_conditions;
    public $delivery_terms;
    public $billing_address;
    public $delivery_address;

    // Financial
    public $subtotal         = 0;
    public $tax_rate         = 0;
    public $tax_amount       = 0;
    public $discount         = 0;       // discount percentage
    public $discount_amount  = 0;       // discount calculated amount
    public $shipping_charges = 0;
    public $total            = 0;

    /**
     * mount()
     * Sets default values upon component initialization
     */
    public function mount(): void
    {
        // Default dates
        $this->date        = now()->format('Y-m-d');
        $this->expiry_date = now()->addDays(30)->format('Y-m-d');

        // Start with one empty item row
        $this->items = [
            ['description' => '', 'quantity' => 1, 'rate' => 0],
        ];

        $this->calculateTotals();
    }

    /**
     * updated()
     * Trigger recalculation whenever properties change
     */
    public function updated($propertyName): void
    {
        $this->calculateTotals();
    }

    /**
     * addItem()
     * Add a blank item row.
     */
    public function addItem(): void
    {
        $this->items[] = ['description' => '', 'quantity' => 1, 'rate' => 0];
        $this->calculateTotals();
    }

    /**
     * removeItem($index)
     * Remove an item row by index.
     */
    public function removeItem(int $index): void
    {
        if (isset($this->items[$index])) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
            $this->calculateTotals();
        }
    }

    /**
     * calculateTotals()
     * Summation logic for subtotal, tax, discount, shipping, final total
     */
    public function calculateTotals(): void
    {
        // Reset subtotal
        $this->subtotal = 0;

        // Calculate item-level cost
        foreach ($this->items as $item) {
            $quantity = (float) ($item['quantity'] ?? 0);
            $rate     = (float) ($item['rate'] ?? 0);
            $this->subtotal += ($quantity * $rate);
        }

        // Global tax & discount
        $this->tax_amount      = $this->subtotal * ($this->tax_rate / 100);
        $this->discount_amount = $this->subtotal * ($this->discount / 100);

        // Final total
        $this->total = $this->subtotal + $this->tax_amount + $this->shipping_charges - $this->discount_amount;
    }

    /**
     * sanitizeData($data)
     * Remove any funky characters, trim strings, convert to UTF-8
     */
    private function sanitizeData(array $data): array
    {
        return array_map(function ($item) {
            if (is_string($item)) {
                return mb_convert_encoding(trim($item), 'UTF-8', 'auto');
            } elseif (is_array($item)) {
                return $this->sanitizeData($item);
            }
            return $item;
        }, $data);
    }

    /**
     * downloadPDF()
     * Generate and return the PDF for download (no validation needed, per instructions)
     */
    public function downloadPDF()
    {
        try {
            // Ensure up-to-date totals
            $this->calculateTotals();

            // Prepare data for PDF
            $data = $this->sanitizeData([
                'logo'                => $this->logo ? $this->logo->getRealPath() : null,
                'purchase_order_number' => $this->purchase_order_number,
                'date'               => $this->date,
                'expiry_date'        => $this->expiry_date,
                'currency'           => $this->currency,
                'from'               => $this->from,
                'to'                 => $this->to,
                'items'              => $this->items,
                'notes'              => $this->notes,
                'subtotal'           => $this->subtotal,
                'tax_rate'           => $this->tax_rate,
                'tax_amount'         => $this->tax_amount,
                'discount'           => $this->discount_amount,
                'shipping_charges'   => $this->shipping_charges,
                'total'              => $this->total,
                'payment_terms'      => $this->payment_terms,
                'validity_period'    => $this->validity_period,
                'authorized_signature' => $this->authorized_signature,
                'terms_and_conditions' => $this->terms_and_conditions,
                'delivery_terms'     => $this->delivery_terms,
                'billing_address'    => $this->billing_address,
                'delivery_address'   => $this->delivery_address,
            ]);

            // Generate PDF using the Blade view at: resources/views/livewire/purchase-order-pdf.blade.php
            $pdf = Pdf::loadView('livewire.purchase-order-pdf', $data);

            // Return the PDF for download (streamed)
            return response()->streamDownload(
                fn () => print($pdf->output()),
                "purchase-order-{$this->purchase_order_number}.pdf"
            );
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to generate the PDF. Please check the details and try again.');
            Log::error('PDF Generation Error: ' . $e->getMessage());
        }
    }

    /**
     * render()
     * Renders the Livewire component view
     */
    public function render()
    {
        // Use the layout in layouts/app.blade.php
        return view('livewire.purchase-order-generator')
            ->layout('layouts.app');
    }
}
