<!-- resources/views/emails/booking_status.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        /* Basic Reset */
        body, p, h1, h2, h3, h4, h5, h6, div {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #004080; /* Dark Blue */
            padding: 20px;
            display: flex;
            align-items: center;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .header-title {
            color: #ffffff;
            margin-left: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #004080;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
        }
        .details th, .details td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #dddddd;
        }
        .details th {
            width: 30%;
            background-color: #f2f2f2;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            color: #777777;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #004080;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }
        .button:hover {
            background-color: #0066cc;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header with Logo -->
    <div class="header">
        <!-- Logo Placeholder -->
        <img src="https://vnfoxcdnoahqenfjssdv.supabase.co/storage/v1/object/public/ecolodgesmr/images/logo1.jpg" alt="Hotel Logo" class="logo">
        <div class="header-title">Booking Confirmation</div>
    </div>

    <!-- Email Content -->
    <div class="content">
        <!-- Greeting -->
        <div class="section">
            <p>Dear {{ $booking->user->first_name }},</p>
            <p>Thank you for choosing EcoLodge-SMR. We are pleased to confirm your booking.</p>
        </div>

        <!-- Booking Summary -->
        <div class="section">
            <h2>Booking Summary</h2>
            <div class="details">
                <table>
                    <tr>
                        <th>Booking ID:</th>
                        <td>{{ $booking->booking_id }}</td>
                    </tr>
                    <tr>
                        <th>Booking Date:</th>
                        <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Booking Status:</th>
                        <td>{{ $booking->booking_status }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status:</th>
                        <td>{{ $booking->payment_status }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="section">
            <h2>Customer Information</h2>
            <div class="details">
                <table>
                    <tr>
                        <th>Name:</th>
                        <td>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $booking->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $booking->user->phone_number }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="section">
            <h2>Booking Details</h2>
            <div class="details">
                <table>
                    <tr>
                        <th>Check-in Date:</th>
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Check-out Date:</th>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('F d, Y') }}</td>
                    </tr>

                    <!-- Room Details -->
                    @if($booking->room)
                        <tr>
                            <th>Room Name:</th>
                            <td>{{ $booking->room->room_name }}</td>
                        </tr>
                        <tr>
                            <th>Room Type:</th>
                            <td>{{ $booking->room->room_type }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $booking->room->description }}</td>
                        </tr>

                        <!-- Activity Details -->
                    @elseif($booking->activity)
                        <tr>
                            <th>Activity Name:</th>
                            <td>{{ $booking->activity->activity_name }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $booking->activity->activity_description }}</td>
                        </tr>

                        <!-- Function Hall Details -->
                    @elseif($booking->hall)
                        <tr>
                            <th>Function Hall Name:</th>
                            <td>{{ $booking->hall->name }}</td>
                        </tr>
                        <tr>
                            <th>Function Hall Capacity:</th>
                            <td>{{ $booking->hall->capacity }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $booking->hall->description }}</td>
                        </tr>

                        <!-- Pool Details -->
                    @elseif($booking->pool)
                        <tr>
                            <th>Pool Name:</th>
                            <td>{{ $booking->pool->cottage_name }}</td>
                        </tr>
                        <tr>
                            <th>Pool Type:</th>
                            <td>{{ $booking->pool->cottage_type }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $booking->pool->description }}</td>
                        </tr>

                    @endif

                    <tr>
                        <th>Total Amount:</th>
                        <td>₱{{ number_format($booking->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Amount:</th>
                        <td>₱{{ number_format($booking->payment_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method:</th>
                        <td>{{ $booking->payment_method }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Additional Information (Optional) -->
        @if($additionalInfo)
            <div class="section">
                <h2>Additional Information</h2>
                <p>{{ $additionalInfo }}</p>
            </div>
        @endif

        <!-- Thank You Note -->
        <div class="section">
            <p>We look forward to hosting you. Should you have any questions or need further assistance, please do not hesitate to contact us.</p>
            <p>Best Regards,<br>SMR Team</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; {{ date('Y') }} Ecolodge-SMR. All rights reserved.<br>
        Albuera, Leyte Philippines | 09123445678 | info@adminsmr.site
    </div>
</div>
</body>
</html>
