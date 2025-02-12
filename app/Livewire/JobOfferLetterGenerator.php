<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class JobOfferLetterGenerator extends Component
{
    use WithFileUploads;

    public $candidateName;
    public $candidateAddress;
    public $companyName;
    public $companyAddress;
    public $jobTitle;
    public $startDate;
    public $salary;
    public $additionalTerms;
    public $authorizedPerson;
    public $logo;
    public $signature;

    public function mount()
    {
        $this->candidateName = 'John Doe';
        $this->candidateAddress = '123 Candidate Street, City, Country';
        $this->companyName = 'Tech Innovators Inc.';
        $this->companyAddress = '456 Company Lane, City, Country';
        $this->jobTitle = 'Software Developer';
        $this->startDate = now()->format('Y-m-d');
        $this->salary = '50,000 USD per year';
        $this->authorizedPerson = 'Jane Smith, HR Manager';
    }

    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:1024', // Validate logo upload (1MB max)
        ]);
    }

    public function updatedSignature()
    {
        $this->validate([
            'signature' => 'image|mimes:jpeg,png,jpg|max:512', // Validate signature upload (512KB max)
        ]);
    }

    public function generatePDF()
    {
        $this->validate([
            'candidateName' => 'required|string|max:255',
            'candidateAddress' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'companyAddress' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'startDate' => 'required|date',
            'salary' => 'required|string|max:255',
            'authorizedPerson' => 'required|string|max:255',
        ]);

        $data = [
            'candidateName' => $this->candidateName,
            'candidateAddress' => $this->candidateAddress,
            'companyName' => $this->companyName,
            'companyAddress' => $this->companyAddress,
            'jobTitle' => $this->jobTitle,
            'startDate' => $this->startDate,
            'salary' => $this->salary,
            'additionalTerms' => $this->additionalTerms,
            'authorizedPerson' => $this->authorizedPerson,
            'logo' => $this->logo ? $this->logo->temporaryUrl() : null,
            'signature' => $this->signature ? $this->signature->temporaryUrl() : null,
        ];

        $pdf = Pdf::loadView('livewire.job-offer-letter-pdf', $data);
        return response()->streamDownload(fn() => print($pdf->output()), 'Job_Offer_Letter_' . $this->candidateName . '.pdf');
    }

    public function render()
    {
        return view('livewire.job-offer-letter-generator')->layout('layouts.app');
    }
}
