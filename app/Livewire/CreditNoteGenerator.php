<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithFileUploads;

class CreditNoteGenerator extends Component
{
    use WithFileUploads;

    // Public properties for form inputs
    public $credit_note_number;
    public $date;
    public $currency;
    public $from;
    public $to;
    public $reference_invoice_number;
    public $reason_for_issuance;
    public $items = [];
    public $subtotal = 0;
    public $tax_rate = 0;
    public $tax_amount = 0;
    public $total = 0;
    public $notes;
    public $logo;
    public $payment_details;
    public $authorized_signature;
    public $terms_and_conditions;

    public $currencySymbols = [
        'USD' => 'US Dollar',
        'GBP' => 'British Pound',
        'EUR' => 'Euro',
        'INR' => 'Indian Rupee',
    ];

    public function mount()
    {
        $this->items = [
            ['description' => '', 'quantity' => 1, 'rate' => 0],
        ];
    }

    // Automatically calculate totals when fields are updated
    public function updated($field)
    {
        if (str_contains($field, 'items')) {
            $this->updateTotals();
        } elseif ($field === 'tax_rate') {
            $this->updateTotals();
        }
    }

    // Add and remove items from the list of credit note items
    public function addItem()
    {
        $this->items[] = ['description' => '', 'quantity' => 1, 'rate' => 0];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->updateTotals();
    }

    // Update subtotal, tax, and total amounts based on the items
    public function updateTotals()
    {
        $this->subtotal = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['rate'];
        }, $this->items));

        $this->tax_amount = ($this->subtotal * $this->tax_rate) / 100;
        $this->total = $this->subtotal + $this->tax_amount;
    }

    // Generate PDF for the credit note
    public function downloadPDF()
    {
        $data = [
            'credit_note_number' => $this->credit_note_number,
            'date' => $this->date,
            'currency' => $this->currency,
            'from' => $this->from,
            'to' => $this->to,
            'reference_invoice_number' => $this->reference_invoice_number,
            'reason_for_issuance' => $this->reason_for_issuance,
            'items' => $this->items,
            'subtotal' => $this->subtotal,
            'tax_rate' => $this->tax_rate,
            'tax_amount' => $this->tax_amount,
            'total' => $this->total,
            'notes' => $this->notes,
            'logo' => $this->logo ? $this->logo->getRealPath() : null,
            'payment_details' => $this->payment_details,
            'authorized_signature' => $this->authorized_signature,
            'terms_and_conditions' => $this->terms_and_conditions,
        ];

        $pdf = Pdf::loadView('livewire.credit-note-pdf', $data);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "credit-note-{$this->credit_note_number}.pdf"
        );
    }

    public function render()
    {
        return view('livewire.credit-note-generator')->layout('layouts.app');
    }
}
