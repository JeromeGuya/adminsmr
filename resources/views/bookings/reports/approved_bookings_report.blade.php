<x-layout.default>
    <div class="panel mt-6">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Approved Bookings Report
                </h1>
                <!-- Button to Download Report -->
                <a href="{{ route('approvedBookingsExport') }}" class="btn bg-green-500 text-white px-4 py-2 rounded">
                    Download Report
                </a>
            </div>

            <!-- No Bookings Message -->
            @if ($bookings->isEmpty())
                <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6 text-center">
                    <p class="text-gray-700 dark:text-gray-300">
                        No approved bookings found.
                    </p>
                </div>
            @else
                <!-- Approved Bookings Table -->
                <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Booking ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Booking Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Customer Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Payment Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Booking Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Check-in Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Check-out Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Payment Method</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">Total Amount</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->booking_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    @if ($booking->room)
                                        Room: {{ $booking->room->room_type }}
                                    @elseif ($booking->pool)
                                        Pool: {{ $booking->pool->cottage_name }}
                                    @elseif ($booking->activity)
                                        Activity: {{ $booking->activity->activity_name }}
                                    @elseif ($booking->hall)
                                        Hall: {{ $booking->hall->hall_name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->user->first_name ?? 'Unknown' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->payment_status }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->booking_status }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->check_in->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->check_out->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $booking->payment_method ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">PHP {{ number_format($booking->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Total Payments -->
                    <div class="mt-4 text-right">
                        <span class="font-semibold text-lg">Total Payments: </span>
                        <span class="text-green-500 text-xl">PHP {{ number_format($totalPayments, 2) }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout.default>
