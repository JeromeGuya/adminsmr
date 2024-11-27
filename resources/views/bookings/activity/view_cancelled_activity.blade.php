<x-layout.default>

    <div class="panel">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Cancel/Declined Bookings</h1>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                <tr>
                    <th scope="col" class="py-3 px-6">Booking ID</th>
                    <th scope="col" class="py-3 px-6">Customer Name</th>
                    <th scope="col" class="py-3 px-6">Check-in Date</th>
                    <th scope="col" class="py-3 px-6">Check-out Date</th>
                    <th scope="col" class="py-3 px-6">Total Amount</th>
                    <th scope="col" class="py-3 px-6">Payment Amount</th>
                    <th scope="col" class="py-3 px-6">Payment Status</th>
                    <th scope="col" class="py-3 px-6">Booking Status</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 font-medium text-gray-900">{{ $booking->booking_id }}</td>
                        <td class="py-4 px-6">
                            {{ $booking->user->first_name ?? 'N/A' }} {{ $booking->user->last_name ?? '' }}
                        </td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                        <td class="py-4 px-6">₱{{ number_format($booking->total_amount, 2) }}</td>
                        <td class="py-4 px-6">₱{{ number_format($booking->payment_amount, 2) }}</td>
                        <td class="py-4 px-6">
                            @if($booking->payment_status == 'Partial')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Partial</span>
                            @elseif($booking->payment_status == 'Paid')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Paid</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $booking->payment_status }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($booking->booking_status == 'Approved')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Approved</span>
                            @elseif($booking->booking_status == 'Pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Pending</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $booking->booking_status }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <a href="{{--{{ route('cancelActivity.show', $booking->booking_id) }}--}}" class="text-blue-600 hover:underline flex items-center">
                                <i class="fas fa-eye mr-1"></i> View
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <span class="text-sm text-gray-700">
                Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} Bookings
            </span>
            <div>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

</x-layout.default>
