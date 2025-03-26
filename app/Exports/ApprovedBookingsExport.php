<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class ApprovedBookingsExport implements FromView, ShouldAutoSize, WithStyles
{
    /**
     * @return View
     */
    public function view(): View
    {
        $bookings = Booking::where('booking_status', 'Success')->get();

        return view('exports.approved_bookings', [
            'bookings' => $bookings
        ]);
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (header)
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCCCCC'],
                ],
            ],
            // Set borders for all cells
            'A1:I'.$sheet->getHighestRow() => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Generate PDF for approved bookings
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download()
    {
        $bookings = Booking::where('booking_status', 'Success')->get();

        $pdf = PDF::loadView('exports.approved_bookings_pdf', [
            'bookings' => $bookings
        ]);

        // Set paper size and orientation for the PDF
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('approved-bookings.pdf');
    }
}
