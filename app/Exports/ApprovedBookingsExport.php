<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApprovedBookingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::where('booking_status', 'Approved')->get(); // Fetch approved bookings
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Booking ID',
            'Booking Type',
            'Customer Name',
            'Payment Status',
            'Booking Status',
            'Check-in Date',
            'Check-out Date',
            'Payment Method',
            'Total Amount',
        ];
    }

    /**
     * @param Booking $booking
     * @return array
     */
    public function map($booking): array
    {
        return [
            $booking->booking_id,
            $booking->room ? 'Room: ' . $booking->room->room_type :
                ($booking->pool ? 'Pool: ' . $booking->pool->cottage_name :
                    ($booking->activity ? 'Activity: ' . $booking->activity->activity_name :
                        ($booking->hall ? 'Hall: ' . $booking->hall->hall_name : 'N/A'))),
            $booking->user->first_name ?? 'Unknown',
            $booking->payment_status,
            $booking->booking_status,
            $booking->check_in->format('M d, Y'),
            $booking->check_out->format('M d, Y'),
            $booking->payment_method ?? 'N/A',
            $booking->total_amount,
        ];
    }
}
