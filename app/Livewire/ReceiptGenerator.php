<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptGenerator extends Component
{
    use WithFileUploads;

    public $receiptNumber;
    public $paymentDate;
    public $paymentMethod;
    public $payerName;
    public $payerDetails;
    public $notes;
    public $logo; // For the logo upload
    public $items = [];
    public $currency = 'USD';
    public $currencyOptions = []; // Holds popular currency options
    public $subtotal = 0;
    public $taxRate = 0;
    public $discount = 0;
    public $total = 0;

    public function mount()
    {
        // Default values
        $this->receiptNumber = 'REC-' . strtoupper(uniqid());
        $this->paymentDate = now()->format('Y-m-d');
        $this->items = [
            ['description' => '', 'quantity' => 1, 'rate' => 0, 'amount' => 0],
        ];

        // Set popular currency options
        $this->currencyOptions = [
            'USD' => 'US Dollar',
            'EUR' => 'Euro',
            'GBP' => 'British Pound',
            'INR' => 'Indian Rupee',
            'JPY' => 'Japanese Yen',
            'AUD' => 'Australian Dollar',
            'CAD' => 'Canadian Dollar',
            'CNY' => 'Chinese Yuan',
            'BRL' => 'Brazilian Real',
            'ZAR' => 'South African Rand',
            'BDT' => 'Bangladeshi Taka',
        ];
    }

    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:1024', // Validate logo (max 1MB)
        ]);
    }

    public function updatedItems()
    {
        $this->recalculateTotals();
    }

    public function recalculateTotals()
    {
        $this->subtotal = array_reduce($this->items, function ($carry, $item) {
            $item['amount'] = $item['quantity'] * $item['rate'];
            return $carry + $item['amount'];
        }, 0);

        $tax = ($this->subtotal * $this->taxRate) / 100;
        $discount = ($this->subtotal * $this->discount) / 100;

        $this->total = $this->subtotal + $tax - $discount;
    }

    public function addItem()
    {
        $this->items[] = ['description' => '', 'quantity' => 1, 'rate' => 0, 'amount' => 0];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex items array
        $this->recalculateTotals();
    }

    public function generatePDF()
    {
        $this->recalculateTotals(); // Ensure totals are correct

        $data = [
            'receiptNumber' => $this->receiptNumber,
            'paymentDate' => $this->paymentDate,
            'paymentMethod' => $this->paymentMethod,
            'payerName' => $this->payerName,
            'payerDetails' => $this->payerDetails,
            'notes' => $this->notes,
            'items' => $this->items,
            'currency' => $this->currency,
            'currencyLabel' => $this->currencyOptions[$this->currency] ?? $this->currency,
            'subtotal' => $this->subtotal,
            'taxRate' => $this->taxRate,
            'discount' => $this->discount,
            'total' => $this->total,
            'logo' => $this->logo ? $this->logo->temporaryUrl() : null,
        ];

        $pdf = Pdf::loadView('livewire.receipt-pdf', $data);
        return response()->streamDownload(fn() => print($pdf->output()), $this->receiptNumber . '.pdf');
    }

    public function render()
    {
        return view('livewire.receipt-generator', [
            'currencyOptions' => $this->currencyOptions, // Pass currency options to the view
        ])->layout('layouts.app');
    }
}
