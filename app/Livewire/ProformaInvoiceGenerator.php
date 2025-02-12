<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ProformaInvoiceGenerator extends Component
{
    use WithFileUploads;

    /**
     * -------------------------
     * Logo Upload
     * -------------------------
     */
    public $logo;

    /**
     * -------------------------
     * Proforma Invoice Details
     * -------------------------
     */
    public $proformaNumber;    // e.g., "PRO-XYZ123"
    public $invoiceDate;       // e.g., "2025-01-17"
    public $expiryDate;        // e.g., "2025-02-16"
    public $currency = 'USD';  // Default currency code
    public $po_number;         // (Optional) Purchase Order Number

    /**
     * -------------------------
     * Currency Symbol Dictionary
     * -------------------------
     * If not using a DB table, rely on this array.
     */
    public $currencySymbols = [
        'USD' => '$', 'EUR' => '€', 'GBP' => '£', 'INR' => '₹', 'JPY' => '¥',
        'CAD' => 'C$', 'AUD' => 'A$', 'CHF' => 'CHF', 'BDT' => '৳', 'BRL' => 'R$',
        'XOF' => '₣', 'RUB' => '₽', 'SEK' => 'kr', 'TRY' => '₺', 'PHP' => '₱',
        'MYR' => 'RM', 'UAH' => '₴', 'AED' => 'د.إ', 'DZD' => 'د.ج', 'PYG' => '₲',
        'ARS' => '₳', 'GEL' => '₾', 'CRC' => '₡', 'KHR' => '៛', 'THB' => '฿',
        'KRW' => '₩', 'ZAR' => 'R', 'XPF' => 'Fr', 'BGN' => 'лв', 'BHD' => 'د.ب',
        'KES' => 'KSh', 'JOD' => 'JD', 'OMR' => 'OMR', 'AWG' => 'ƒ',
    ];

    /**
     * -------------------------
     * Seller & Buyer Details
     * -------------------------
     */
    public $who_is_from;  // Seller info
    public $tax_id;       // Seller Tax/VAT ID
    public $bill_to;      // Buyer info
    public $ship_to;      // Shipping address (optional)

    /**
     * -------------------------
     * Payment / Terms
     * -------------------------
     */
    public $payment_method;    // e.g., "Bank Transfer"
    public $payment_terms = ''; // e.g., "Net 30"

    /**
     * -------------------------
     * Items
     * -------------------------
     */
    public $items = [];  // e.g., [ ['description'=>'Item1', 'quantity'=>2, 'rate'=>100], ...]

    /**
     * -------------------------
     * Additional Fields (Optional)
     * -------------------------
     */
    public $additionalFields = []; // e.g., [ ['label'=>'Website','value'=>'https://...'] ]

    /**
     * -------------------------
     * Notes / Terms
     * -------------------------
     */
    public $notes;

    /**
     * -------------------------
     * Financial Fields
     * -------------------------
     */
    public $tax      = 0;    // Percentage
    public $discount = 0;    // Percentage
    public $shipping = 0;    // Extra shipping cost
    public $subtotal = 0;
    public $total    = 0;

    /**
     * mount()
     * Called once when this Livewire component is mounted.
     */
    public function mount(): void
    {
        // Generate a unique Proforma Number
        $this->proformaNumber = 'PRO-' . strtoupper(uniqid());

        // Default invoice date = today, expiry date = +30 days
        $this->invoiceDate = date('Y-m-d');
        $this->expiryDate  = date('Y-m-d', strtotime('+30 days'));

        // Initialize with one blank item
        $this->items = [
            ['description' => '', 'quantity' => 1, 'rate' => 0],
        ];

        // Initialize additional fields
        $this->additionalFields = [];

        // Calculate initial totals
        $this->calculateSubtotal();
    }

    /**
     * addItem()
     * Adds a new line item.
     */
    public function addItem(): void
    {
        $this->items[] = [
            'description' => '',
            'quantity' => 1,
            'rate' => 0
        ];
        $this->calculateSubtotal();
    }

    /**
     * removeItem($index)
     * Removes a line item by index.
     */
    public function removeItem(int $index): void
    {
        if (isset($this->items[$index])) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
            $this->calculateSubtotal();
        }
    }

    /**
     * addAdditionalField()
     * Adds a new custom field (e.g. 'Website', 'Social Media').
     */
    public function addAdditionalField(): void
    {
        $this->additionalFields[] = [
            'label' => '',
            'value' => ''
        ];
    }

    /**
     * removeAdditionalField($index)
     */
    public function removeAdditionalField(int $index): void
    {
        if (isset($this->additionalFields[$index])) {
            unset($this->additionalFields[$index]);
            $this->additionalFields = array_values($this->additionalFields);
        }
    }

    /**
     * removeLogo()
     * Clears out the uploaded logo.
     */
    public function removeLogo(): void
    {
        $this->logo = null;
    }

    /**
     * calculateSubtotal()
     * Sums up line items to find the subtotal.
     */
    public function calculateSubtotal(): void
    {
        $this->subtotal = array_reduce($this->items, function ($carry, $item) {
            $qty  = (float)$item['quantity'];
            $rate = (float)$item['rate'];
            return $carry + ($qty * $rate);
        }, 0);

        $this->calculateTotal();
    }

    /**
     * calculateTotal()
     * Applies tax, discount, shipping.
     */
    public function calculateTotal(): void
    {
        $taxAmount      = ($this->subtotal * ($this->tax / 100));
        $discountAmount = ($this->subtotal * ($this->discount / 100));

        $this->total = $this->subtotal + $taxAmount - $discountAmount + $this->shipping;
    }

    /**
     * getCurrencySymbol()
     * Returns the symbol for the currently selected currency code.
     */
    public function getCurrencySymbol(): string
    {
        return $this->currencySymbols[$this->currency] ?? '$';
    }

    /**
     * generatePDF()
     * Generates the PDF and streams it for download.
     */
    public function generatePDF()
    {
        try {
            // Make sure totals are updated
            $this->calculateSubtotal();

            $data = [
                'logo'             => $this->logo ? $this->logo->getRealPath() : null,
                'proformaNumber'   => $this->proformaNumber,
                'po_number'        => $this->po_number,
                'invoiceDate'      => $this->invoiceDate,
                'expiryDate'       => $this->expiryDate,
                'currency'         => $this->currency,
                'currencySymbol'   => $this->getCurrencySymbol(),
                'who_is_from'      => $this->who_is_from,
                'tax_id'           => $this->tax_id,
                'bill_to'          => $this->bill_to,
                'ship_to'          => $this->ship_to,
                'payment_method'   => $this->payment_method,
                'payment_terms'    => $this->payment_terms,
                'items'            => $this->items,
                'additionalFields' => $this->additionalFields,
                'notes'            => $this->notes,
                'subtotal'         => $this->subtotal,
                'tax'              => $this->tax,
                'discount'         => $this->discount,
                'shipping'         => $this->shipping,
                'total'            => $this->total,
            ];

            // Ensure 'livewire.proforma-invoice-pdf' matches the actual path of your PDF Blade
            $pdf = Pdf::loadView('livewire.proforma-invoice-pdf', $data)
                      ->setPaper('A4', 'portrait');

            return response()->streamDownload(
                fn() => print($pdf->output()),
                "proforma-{$this->proformaNumber}.pdf"
            );
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to generate Proforma PDF. Please check details and try again.');
            Log::error('Proforma PDF Generation Error: '.$e->getMessage());
        }
    }

    /**
     * render()
     * Renders the Blade view for the Proforma Invoice form.
     */
    public function render()
    {
        // Create your Blade file: resources/views/livewire/proforma-invoice-generator.blade.php
        return view('livewire.proforma-invoice-generator')
               ->layout('layouts.app');
    }
}
