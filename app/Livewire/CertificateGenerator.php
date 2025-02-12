<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateGenerator extends Component
{
    use WithFileUploads;

    /**
     * Certificate Text Fields
     */
    public $recipientName;
    public $certificateTitle;
    public $date;
    public $organizationName;
    public $issuerName;
    public $description;

    /**
     * Font Styling
     */
    public $fontSize = 14;
    public $fontStyle = 'serif';

    /**
     * File Uploads
     */
    public $logo;
    public $background;
    public $signature;
    public $stamp;
    public $digitalSignatureText;
    public $digitalStampText;


    /**
     * mount()
     * Initializes default values.
     */
    public function mount()
    {
        $this->recipientName     = 'John Doe';
        $this->certificateTitle  = 'Certificate of Completion';
        $this->date              = now()->format('Y-m-d');
        $this->organizationName  = 'Tech Innovators Inc.';
        $this->issuerName        = 'Jane Smith, Program Director';
        $this->description       = 'For outstanding performance and successfully completing the program.';
    }

    /**
     * generatePDF()
     * Creates and streams the certificate PDF, no validation enforced.
     */
    public function generatePDF()
    {
        // Prepare data array for the PDF
        $data = [
            'recipientName'     => $this->recipientName,
            'certificateTitle'  => $this->certificateTitle,
            'date'              => $this->date,
            'organizationName'  => $this->organizationName,
            'issuerName'        => $this->issuerName,
            'description'       => $this->description,
            'fontSize'          => $this->fontSize,
            'fontStyle'         => $this->fontStyle,

            // Existing file uploads
            'logo'              => $this->logo ? $this->logo->getRealPath() : null,
            'background'        => $this->background ? $this->background->temporaryUrl() : null,
            'signature'         => $this->signature ? $this->signature->temporaryUrl() : null,
            'stamp'             => $this->stamp ? $this->stamp->temporaryUrl() : null,

            // Add digital signature and stamp as text
            'digitalSignatureText' => $this->digitalSignatureText,
            'digitalStampText'     => $this->digitalStampText,
        ];

        // Load the Blade template (e.g., livewire.certificate-pdf) and generate the PDF
        $pdf = Pdf::loadView('livewire.certificate-pdf', $data);

        // Stream the PDF back for download
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Certificate_' . $this->recipientName . '.pdf'
        );
    }

    /**
     * render()
     * Renders the Livewire component view (livewire.certificate-generator).
     */
    public function render()
    {
        return view('livewire.certificate-generator')
            ->layout('layouts.app');
    }
}
