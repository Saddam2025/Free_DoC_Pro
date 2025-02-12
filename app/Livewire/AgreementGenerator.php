<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class AgreementGenerator extends Component
{
    // Party A Details
    public $partyA = [
        'full_name' => '',
        'date_of_birth' => '',
        'email' => '',
        'mobile' => '',
        'gender' => '',
        'occupation' => '',
        'id_type' => '',
        'id_number' => '',
        'address' => '', // Added address
    ];

    // Party B Details
    public $partyB = [
        'full_name' => '',
        'date_of_birth' => '',
        'email' => '',
        'mobile' => '',
        'gender' => '',
        'occupation' => '',
        'id_type' => '',
        'id_number' => '',
        'address' => '', // Added address
    ];

    // Agreement Details
    public $agreementDate;
    public $agreementType;

    // Custom Clauses
    public $customClauses = [];

    // Standard Terms
    public $standardTerms = [
        'Confidentiality: Both parties agree to keep all information confidential and not disclose it to any third party without prior written consent.',
        'Termination: Either party may terminate the agreement with a 30-day written notice.',
        'Dispute Resolution: Any disputes arising from this agreement will be resolved through binding arbitration in accordance with the rules of the American Arbitration Association.',
        'Governing Law: This agreement shall be governed by and construed in accordance with the laws of the State of [Your State].',
        'Entire Agreement: This agreement constitutes the entire understanding between the parties and supersedes all prior discussions, negotiations, and agreements.',
        'Amendments: Any amendments to this agreement must be made in writing and signed by both parties.',
        'Force Majeure: Neither party shall be liable for any failure to perform due to causes beyond their reasonable control, including acts of God, war, or natural disasters.',
        'Severability: If any provision of this agreement is found to be unenforceable, the remaining provisions shall continue in full force and effect.',
        'Waiver: The failure of either party to enforce any provision of this agreement shall not be deemed a waiver of future enforcement of that or any other provision.',
        'Notices: All notices under this agreement shall be in writing and delivered to the respective parties at their addresses provided herein.',
    ];

    public function mount()
    {
        // Initialize with one empty custom clause
        $this->customClauses = [
            ['title' => '', 'content' => '']
        ];
    }

    // Methods for Custom Clauses
    public function addClause()
    {
        $this->customClauses[] = ['title' => '', 'content' => ''];
    }

    public function removeClause($index)
    {
        unset($this->customClauses[$index]);
        $this->customClauses = array_values($this->customClauses);
    }

    // Methods for Standard Terms
    public function addStandardTerm()
    {
        $this->standardTerms[] = '';
    }

    public function removeStandardTerm($index)
    {
        unset($this->standardTerms[$index]);
        $this->standardTerms = array_values($this->standardTerms);
    }

    public function generatePDF()
    {
        // Prepare data for the agreement
        $data = [
            'partyA' => $this->partyA,
            'partyB' => $this->partyB,
            'agreementDate' => $this->agreementDate,
            'agreementType' => $this->agreementType,
            'customClauses' => $this->customClauses,
            'standardTerms' => $this->standardTerms,
        ];

        // Generate PDF using a Blade view and specify the paper size (Legal)
        $pdf = Pdf::loadView('livewire.agreement-pdf', $data)
            ->setPaper('legal', 'portrait'); // Legal size, portrait orientation

        // Stream the PDF to the user for download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'agreement.pdf');
    }

    public function render()
    {
        return view('livewire.agreement-generator')->layout('layouts.app');
    }
}
