<x-layout.default>

    <div class="panel mt-6">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Approved Bookings
                </h1>
                <!-- Link to View Report -->
                <a href="{{ route('approvedBookingsReport') }}" class="btn bg-blue-500 text-white px-4 py-2 rounded">
                    View Report
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
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Booking ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Booking Type
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Customer Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Payment Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Booking Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Total Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $booking->booking_id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    @if ($booking->room)
                                        Room: {{ $booking->room->room_type }}
                                    @elseif ($booking->pool)
                                        Pool: {{ $booking->pool->pool_name }}
                                    @elseif ($booking->activity)
                                        Activity: {{ $booking->activity->activity_name }}
                                    @elseif ($booking->hall)
                                        Hall: {{ $booking->hall->hall_name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $booking->user->first_name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                        <span class="
                                            @if ($booking->payment_status == 'Partial' || $booking->payment_status == 'Pending')
                                                text-orange-500
                                            @elseif ($booking->payment_status == 'Approved' || $booking->payment_status == 'Fully Paid')
                                                text-green-500
                                            @endif
                                        ">
                                            {{ $booking->payment_status }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                        <span class="
                                            @if ($booking->booking_status == 'Approved')
                                                text-green-500
                                            @elseif ($booking->booking_status == 'Pending')
                                                text-orange-500
                                            @endif
                                        ">
                                            {{ $booking->booking_status }}
                                        </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    PHP {{ number_format($booking->total_amount, 2) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-layout.default>
