<?php

namespace App\Livewire;
use App\Models\Currency;
use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class InvoiceGenerator extends Component
{
    use WithFileUploads;

    // File upload for logo
    public $logo;

    // Basic invoice info
    public $invoice_number;
    public $date;
    public $due_date;
    public $currency = 'USD';  // Default currency code
    public $po_number;

    public $currencySymbols = [
        'USD' => '$', 'EUR' => '€', 'GBP' => '£', 'INR' => '₹', 'JPY' => '¥',
        'CAD' => 'C$', 'AUD' => 'A$', 'CHF' => 'CHF', 'BDT' => '৳', 'BRL' => 'R$',
        'XOF' => '₣', 'RUB' => '₽', 'SEK' => 'kr', 'TRY' => '₺', 'PHP' => '₱',
        'MYR' => 'RM', 'UAH' => '₴', 'AED' => 'د.إ', 'DZD' => 'د.ج', 'PYG' => '₲',
        'ARS' => '₳', 'GEL' => '₾', 'CRC' => '₡', 'KHR' => '៛', 'THB' => '฿',
        'KRW' => '₩', 'ZAR' => 'R', 'XPF' => 'Fr', 'BGN' => 'лв', 'BHD' => 'د.ب',
        'KES' => 'KSh', 'JOD' => 'JD', 'OMR' => 'OMR', 'AWG' => 'ƒ',
    ];

    

    // Sender / Recipient
    public $who_is_from;
    public $tax_id;
    public $bill_to;
    public $ship_to;

    // Payment Method (Optional)
    public $payment_method;

    // Items array
    public $items = [];

    // Additional Custom Fields (Optional)
    public $additionalFields = [];

    public $notes;

    // Finance fields
    public $tax       = 0;
    public $discount  = 0;
    public $shipping  = 0;
    public $subtotal  = 0;
    public $total     = 0;
    public $amount_paid = 0;
    public $balance_due = 0;
    public $payment_terms = '';

    /**
     * Initialize component with default values.
     */
    public function mount(): void
    {
        $this->date = date('Y-m-d');
        $this->due_date = date('Y-m-d', strtotime('+30 days'));
        // Start with one blank item
        $this->items = [
            ['description' => '', 'quantity' => 1, 'rate' => 0],
        ];
        // Initialize with no additional fields
        $this->additionalFields = [];
        $this->calculateSubtotal();
    }

    /**
     * Add a new item to the invoice.
     */
    public function addItem(): void
    {
        $this->items[] = ['description' => '', 'quantity' => 1, 'rate' => 0];
        $this->calculateSubtotal();
    }

    /**
     * Remove an item from the invoice by index.
     *
     * @param int $index
     */
    public function removeItem(int $index): void
    {
        if (isset($this->items[$index])) {
            unset($this->items[$index]);
            // Reindex the array to prevent issues
            $this->items = array_values($this->items);
            $this->calculateSubtotal();
        }
    }

    /**
     * Add a new additional field (e.g., Website, Social Media).
     */
    public function addAdditionalField(): void
    {
        $this->additionalFields[] = ['label' => '', 'value' => ''];
    }

    /**
     * Remove an additional field by index.
     *
     * @param int $index
     */
    public function removeAdditionalField(int $index): void
    {
        if (isset($this->additionalFields[$index])) {
            unset($this->additionalFields[$index]);
            // Reindex the array
            $this->additionalFields = array_values($this->additionalFields);
        }
    }

    /**
     * Calculate the subtotal based on items.
     */
    public function calculateSubtotal(): void
    {
        $this->subtotal = array_reduce($this->items, function ($carry, $item) {
            $quantity = (float) ($item['quantity'] ?? 0);
            $rate     = (float) ($item['rate']     ?? 0);
            return $carry + ($quantity * $rate);
        }, 0);
        $this->calculateTotal();
    }

    /**
     * Calculate the total based on subtotal, tax, discount, and shipping.
     */
    public function calculateTotal(): void
    {
        $taxAmount      = ($this->subtotal * ($this->tax / 100));
        $discountAmount = ($this->subtotal * ($this->discount / 100));
        $this->total    = $this->subtotal + $taxAmount - $discountAmount + $this->shipping;
        $this->balance_due = $this->total - $this->amount_paid;
    }

    /**
     * Remove the uploaded logo.
     */
    public function removeLogo(): void
    {
        $this->logo = null;
    }

    /**
     * Get the symbol for the selected currency.
     *
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        return $this->currencySymbols[$this->currency] ?? '$';  // Default to '$' '৳' if not found
    }

    /**
     * Download PDF with all invoice data.
     */
    public function downloadPDF()
    {
        try {
            $data = [
                'logo'             => $this->logo ? $this->logo->getRealPath() : null,
                'invoice_number'   => $this->invoice_number,
                'po_number'        => $this->po_number,
                'date'             => $this->date,
                'due_date'         => $this->due_date,
                'currency'         => $this->currency,
                'currency_symbol'  => $this->getCurrencySymbol(),
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
                'amount_paid'      => $this->amount_paid,
                'balance_due'      => $this->balance_due,
            ];

            $pdf = Pdf::loadView('livewire.invoice-pdf', $data)
            ->setPaper('A4', 'portrait');

            return response()->streamDownload(
                fn() => print($pdf->output()),
                "invoice-{$this->invoice_number}.pdf"
            );
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to generate PDF. Please check details and try again.');
            Log::error('PDF Generation Error: '.$e->getMessage());
        }
    }

    /**
     * Render the Livewire component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.invoice-generator')->layout('layouts.app');
    }
}