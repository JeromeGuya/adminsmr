<!DOCTYPE html>
<html>
<head>
    <title>Approved Bookings Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #CCCCCC;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Approved Bookings Report</h1>
        <p>Generated on: {{ now()->format('F d, Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Booking Type</th>
                <th>Customer Name</th>
                <th>Payment Status</th>
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
                    <td>{{ $booking->user->first_name ?? 'Unknown' }} {{ $booking->user->last_name ?? '' }}</td>
                    <td>{{ $booking->payment_status }}</td>
                    <td>{{ $booking->check_in->format('M d, Y') }}</td>
                    <td>{{ $booking->check_out->format('M d, Y') }}</td>
                    <td>{{ $booking->payment_method ?? 'N/A' }}</td>
                    <td>₱{{ number_format($booking->total_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Page 1</p>
    </div>
</body>
</html>
