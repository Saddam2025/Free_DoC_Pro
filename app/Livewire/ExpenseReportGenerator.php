<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpenseReportGenerator extends Component
{
    use WithFileUploads;

    public $reportTitle = 'Expense Report';
    public $reportDate;
    public $totalAmount = 0;
    public $expenses = [];
    public $notes;
    public $logo;

    public function mount()
    {
        $this->reportDate = now()->format('Y-m-d');
        $this->expenses = [
            ['date' => now()->format('Y-m-d'), 'category' => '', 'description' => '', 'amount' => 0],
        ];
    }

    public function addExpense()
    {
        $this->expenses[] = ['date' => now()->format('Y-m-d'), 'category' => '', 'description' => '', 'amount' => 0];
    }

    public function removeExpense($index)
    {
        unset($this->expenses[$index]);
        $this->expenses = array_values($this->expenses);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalAmount = array_reduce($this->expenses, fn($carry, $expense) => $carry + $expense['amount'], 0);
    }

    public function generatePDF()
    {
        $this->calculateTotal();

        $data = [
            'reportTitle' => $this->reportTitle,
            'reportDate' => $this->reportDate,
            'totalAmount' => $this->totalAmount,
            'expenses' => $this->expenses,
            'notes' => $this->notes,
            'logo' => $this->logo ? $this->logo->temporaryUrl() : null,
        ];

        $pdf = Pdf::loadView('livewire.expense-report-pdf', $data);
        return response()->streamDownload(fn() => print($pdf->output()), 'Expense_Report_' . $this->reportDate . '.pdf');
    }

    public function render()
    {
        return view('livewire.expense-report-generator')->layout('layouts.app');
    }
}
