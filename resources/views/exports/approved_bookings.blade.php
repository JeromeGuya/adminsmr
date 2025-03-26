<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Booking Type</th>
            <th>Customer Name</th>
            <th>Payment Status</th>
            <th>Booking Status</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Payment Method</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->booking_id }}</td>
                <td>
                    @if($booking->room)
                        Room: {{ $booking->room->room_type }}
                    @elseif($booking->pool)
                        Pool: {{ $booking->pool->cottage_name }}
                    @elseif($booking->activity)
                        Activity: {{ $booking->activity->activity_name }}
                    @elseif($booking->hall)
                        Hall: {{ $booking->hall->hall_name }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $booking->user->first_name ?? 'Unknown' }}</td>
                <td>{{ $booking->payment_status }}</td>
                <td>{{ $booking->booking_status }}</td>
                <td>{{ $booking->check_in->format('M d, Y') }}</td>
                <td>{{ $booking->check_out->format('M d, Y') }}</td>
                <td>{{ $booking->payment_method ?? 'N/A' }}</td>
                <td>{{ $booking->total_amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
