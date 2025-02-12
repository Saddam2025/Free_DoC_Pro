<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class DeliveryNoteGenerator extends Component
{
    use WithFileUploads;

    /**
     * Delivery Note Fields
     */
    public $deliveryNoteNumber;
    public $deliveryDate;
    public $dispatchAddress;
    public $recipientAddress;
    public $senderDetails;
    public $items = [];
    public $totalQuantity = 0; // Total quantity calculation
    public $grandTotal = 0.00; // Grand total calculation
    public $logo;
    public $background; // Added background upload

    // New fields
    public $currency; // Currency selection
    public $notes; // Additional section

    /**
     * Available currencies
     */
    public $currencies = [
        'USD' => 'US Dollar',
        'EUR' => 'Euro',
        'GBP' => 'British Pound',
        'JPY' => 'Japanese Yen',
        'AUD' => 'Australian Dollar',
    ];

    /**
     * Mount function initializes default values
     */
    public function mount()
    {
        $this->deliveryNoteNumber = 'DN-' . strtoupper(uniqid()); // Generating a unique delivery note number
        $this->deliveryDate = now()->format('Y-m-d'); // Setting the default delivery date as today's date
        $this->items = [
            ['description' => 'Sample Item', 'quantity' => 1, 'price' => 0.00], // Default sample item with price
        ];
        $this->currency = 'USD'; // Default currency
        $this->notes = ''; // Initialize notes
        $this->recalculateTotals(); // Recalculate totals for the initial data
    }

    /**
     * Updated logo validation
     */
    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:1024', // Validate logo upload (1MB max)
        ]);
    }

    /**
     * Updated background validation
     */
    public function updatedBackground()
    {
        $this->validate([
            'background' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate background upload (2MB max)
        ]);
    }

    /**
     * Function to add an item row dynamically
     */
    public function addItem()
    {
        $this->items[] = ['description' => '', 'quantity' => 1, 'price' => 0.00]; // Add a new empty item to the list with default price
    }

    /**
     * Function to remove an item row dynamically
     *
     * @param int $index
     */
    public function removeItem($index)
    {
        unset($this->items[$index]); // Remove the item at the given index
        $this->items = array_values($this->items); // Re-index the array
        $this->recalculateTotals(); // Recalculate totals
    }

    /**
     * Function to update total quantity and grand total whenever an item is changed
     */
    public function updatedItems()
    {
        $this->recalculateTotals();
    }

    /**
     * Function to recalculate the total quantity and grand total of all items
     */
    public function recalculateTotals()
    {
        $this->totalQuantity = array_sum(array_column($this->items, 'quantity')); // Sum up the quantities of all items
        $this->grandTotal = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $this->items)); // Calculate the grand total
    }

    /**
     * Function to generate the PDF and return it as a downloadable file
     */
    public function generatePDF()
    {
        $this->validate([
            'dispatchAddress' => 'required|string|max:255', // Validate dispatch address
            'recipientAddress' => 'required|string|max:255', // Validate recipient address
            'senderDetails' => 'required|string|max:255', // Validate sender details
            'currency' => 'required|in:' . implode(',', array_keys($this->currencies)), // Validate currency
            'notes' => 'nullable|string|max:500', // Validate notes (optional)
            'items.*.description' => 'required|string|max:255', // Validate item descriptions
            'items.*.quantity' => 'required|integer|min:1', // Validate item quantities
            'items.*.price' => 'required|numeric|min:0', // Validate item prices
        ]);

        // Prepare the data to be passed to the PDF view
        $data = [
            'deliveryNoteNumber' => $this->deliveryNoteNumber,
            'deliveryDate' => $this->deliveryDate,
            'dispatchAddress' => $this->dispatchAddress,
            'recipientAddress' => $this->recipientAddress,
            'senderDetails' => $this->senderDetails,
            'items' => $this->items,
            'totalQuantity' => $this->totalQuantity,
            'grandTotal' => $this->grandTotal,
            'currency' => $this->currency,
            'notes' => $this->notes,
            'logo' => $this->logo ? $this->logo->store('logos', 'public') : null, // Store the logo and get the path
            'background' => $this->background ? $this->background->store('backgrounds', 'public') : null, // Store the background and get the path
        ];

        // Load the Blade template for the delivery note PDF and generate the PDF
        $pdf = Pdf::loadView('livewire.delivery-note-pdf', $data)->setPaper('a4', 'portrait');

        // Stream the generated PDF as a downloadable file with the delivery note number as the filename
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $this->deliveryNoteNumber . '.pdf');
    }

    /**
     * Render the view for the component
     */
    public function render()
    {
        return view('livewire.delivery-note-generator')->layout('layouts.app');
    }
}
