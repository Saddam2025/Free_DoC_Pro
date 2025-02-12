<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class BusinessCardGenerator extends Component
{
    use WithFileUploads;

    public $name;
    public $jobTitle;
    public $companyName;
    public $email;
    public $phone;
    public $website;
    public $address;
    public $logo;

    public function mount()
    {
        $this->name = 'John Doe';
        $this->jobTitle = 'Software Developer';
        $this->companyName = 'Tech Innovators Inc.';
        $this->email = 'john.doe@example.com';
        $this->phone = '+1 234 567 890';
        $this->website = 'www.techinnovators.com';
        $this->address = '123 Tech Street, Silicon Valley, CA';
    }

    // Logo validation
    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:1024', // Validate image size and type
        ]);
    }

    // Generate PDF for business card
    public function generatePDF()
    {
        $data = [
            'name' => $this->name,
            'jobTitle' => $this->jobTitle,
            'companyName' => $this->companyName,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'address' => $this->address,
            'logo' => $this->logo ? $this->logo->getRealPath() : null, // Ensure logo path is passed correctly
        ];

        // Generate the PDF for the business card layout
        $pdf = Pdf::loadView('livewire.business-card-pdf', $data);

        // Stream the generated PDF for download
        return response()->streamDownload(fn() => print($pdf->output()), 'Business_Card_' . $this->name . '.pdf');
    }

    // Render the Livewire component view
    public function render()
    {
        return view('livewire.business-card-generator')->layout('layouts.app');
    }
}
