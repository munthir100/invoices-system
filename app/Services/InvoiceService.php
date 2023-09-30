<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Status;

class InvoiceService
{
    function getInvoiceData($data)
    {
        // Extract and format data for the invoice
        return [
            'salesperson_id' => $data['user_id'],
            'customer_id' => $data['customer_id'],
            'status_id' => Status::NEW,
        ];
    }

    function getInvoiceItemsData($data)
    {
        $itemsData = [];

        if (isset($data['invoice']) && is_array($data['invoice'])) {
            foreach ($data['invoice'] as $itemData) {
                $itemsData[] = [
                    'item_name' => $itemData['item_name'],
                    'item_price' => $itemData['item_price'],
                    'item_quantity' => $itemData['item_quantity'],
                    'tax_type' => $itemData['tax_type'],
                    'tax_rate' => $itemData['tax_rate'],
                    // You can add more item-level fields here if needed
                ];
            }
        }

        return $itemsData;
    }

    function generateInvoiceNumber()
    {
        // Get the current date in a specific format, e.g., YYYYMMDD
        $currentDate = now()->format('Ymd');

        // Find the latest invoice with a similar date prefix
        $latestInvoice = Invoice::where('invoice_number', 'like', $currentDate . '%')->latest()->first();

        if ($latestInvoice) {
            // Extract the numeric part of the latest invoice number
            $latestNumber = intval(substr($latestInvoice->invoice_number, -3));

            // Increment the numeric part by 1
            $newNumber = str_pad($latestNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no previous invoice exists for the current date, start from 001
            $newNumber = '001';
        }

        // Create the new invoice number by combining the date prefix and the incremented number
        $invoiceNumber = $currentDate . $newNumber;

        return 'INV' . $invoiceNumber;
    }
}
