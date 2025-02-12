<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentReceiptGenerator extends Component
{
    use WithFileUploads;

    public $receiptNumber;
    public $paymentDate;
    public $paymentAmount;
    public $paymentMethod;
    public $payerName;
    public $payerDetails;
    public $notes;
    public $logo;

    public function mount()
    {
        $this->receiptNumber = 'REC-' . strtoupper(uniqid());
        $this->paymentDate = now()->format('Y-m-d');
    }

    public function generatePDF()
    {
        $data = [
            'receiptNumber' => $this->receiptNumber,
            'paymentDate' => $this->paymentDate,
            'paymentAmount' => $this->paymentAmount,
            'paymentMethod' => $this->paymentMethod,
            'payerName' => $this->payerName,
            'payerDetails' => $this->payerDetails,
            'notes' => $this->notes,
            'logo' => $this->logo ? $this->logo->temporaryUrl() : null,
        ];

        $pdf = Pdf::loadView('livewire.payment-receipt-pdf', $data);
        return response()->streamDownload(fn() => print($pdf->output()), $this->receiptNumber . '.pdf');
    }

    public function render()
    {
        return view('livewire.payment-receipt-generator')->layout('layouts.app');
    }
}
