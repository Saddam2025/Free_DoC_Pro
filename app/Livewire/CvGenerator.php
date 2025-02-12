<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class CvGenerator extends Component
{
    use WithFileUploads;

    // Personal Details
    public $fullName;
    public $email;
    public $phone;
    public $address;
    public $dateOfBirth;
    public $gender;
    public $occupation;
    public $photo;

    // Identity Details
    public $idType;
    public $idNumber;
    public $issueAuthority;
    public $issueDate;
    public $issueState;
    public $expiryDate;

    // Summary
    public $summary;

    // Education, Experience, and Skills
    public $education = [];
    public $experience = [];
    public $skills = [];

    public function mount()
    {
        // Initialize fields with default structure
        $this->education = [
            ['degree' => '', 'institution' => '', 'startYear' => '', 'endYear' => '']
        ];
        $this->experience = [
            ['position' => '', 'company' => '', 'startYear' => '', 'endYear' => '']
        ];
        $this->skills = [''];
    }

    public function addEducation()
    {
        $this->education[] = ['degree' => '', 'institution' => '', 'startYear' => '', 'endYear' => ''];
    }

    public function addExperience()
    {
        $this->experience[] = ['position' => '', 'company' => '', 'startYear' => '', 'endYear' => ''];
    }

    public function addSkill()
    {
        $this->skills[] = '';
    }

    public function removeSkill($index)
    {
        unset($this->skills[$index]);
        $this->skills = array_values($this->skills);
    }

    public function generatePDF()
    {
        $data = [
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'dateOfBirth' => $this->dateOfBirth,
            'gender' => $this->gender,
            'occupation' => $this->occupation,
            'idType' => $this->idType,
            'idNumber' => $this->idNumber,
            'issueAuthority' => $this->issueAuthority,
            'issueDate' => $this->issueDate,
            'issueState' => $this->issueState,
            'expiryDate' => $this->expiryDate,
            'summary' => $this->summary,
            'education' => $this->education,
            'experience' => $this->experience,
            'skills' => $this->skills,
            'photo' => $this->photo ? $this->photo->temporaryUrl() : null, // Pass temporary URL for photo
        ];

        $pdf = Pdf::loadView('livewire.cv-pdf', $data);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            ($this->fullName ?? 'CV') . '_CV.pdf'
        );
    }

    public function render()
    {
        return view('livewire.cv-generator')->layout('layouts.app');
    }
}
