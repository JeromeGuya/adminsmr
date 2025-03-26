<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function downloadApprovedReport()
    {
        // Create an instance of the export class
        $export = new \App\Exports\ApprovedBookingsExport();

        // Return the PDF download response
        return $export->download();
    }
}
