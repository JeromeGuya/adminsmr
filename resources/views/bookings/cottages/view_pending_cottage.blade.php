<x-layout.default>

    <div class="panel">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Cottage Pending Bookings</h1>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                <tr>
                    <th scope="col" class="py-3 px-6">Booking ID</th>
                    <th scope="col" class="py-3 px-6">Customer Name</th>
                    <th scope="col" class="py-3 px-6">Booking Name</th>
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
                        <td class="py-4 px-6">{{$booking->pool->cottage_name }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                        <td class="py-4 px-6">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                        <td class="py-4 px-6">₱{{ number_format($booking->total_amount, 2) }}</td>
                        <td class="py-4 px-6">₱{{ number_format($booking->down_payment, 2) }}</td>
                        <td class="py-4 px-6">
                            @if($booking->payment_status == 'Partial')
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Partial</span>
                            @elseif($booking->payment_status == 'Paid')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Paid</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $booking->payment_status }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($booking->booking_status == 'Approved')
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Approved</span>
                            @elseif($booking->booking_status == 'Pending')
                                <span
                                    class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Pending</span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $booking->booking_status }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-10 text-center">
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('cottage.pending.show', $booking->booking_id) }}"
                                   class="text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-eye h-5 w-5"></i>
                                </a>
                                <button
                                    type="button"
                                    data-modal-target="deleteConfirmationModal"
                                    data-modal-toggle="deleteConfirmationModal"
                                    data-booking-id="{{ $booking->booking_id }}"
                                    class="text-red-600 hover:text-red-700 delete-button">
                                    <i class="fas fa-trash-alt h-5 w-5"></i>
                                </button>
                            </div>
                        </td>

                        <!-- Confirmation Modal -->
                        <div id="deleteConfirmationModal" tabindex="-1"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <!-- Modal Content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal Header -->
                                    <div
                                        class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                            Confirm Deletion
                                        </h3>
                                        <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200
                               hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="deleteConfirmationModal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Modal Body -->
                                    <div class="p-6 space-y-6">
                                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                            Are you sure you want to delete this booking? This action cannot be undone.
                                        </p>
                                    </div>
                                    <!-- Modal Footer -->
                                    <div
                                        class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                                        <form id="deleteForm" method="POST"
                                              action="{{ route('booking.destroy', $booking->booking_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4
                                 focus:outline-none focus:ring-red-300 font-medium rounded-lg
                                 text-sm px-5 py-2.5 text-center dark:bg-red-600
                                 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                Delete
                                            </button>
                                        </form>


                                        <button data-modal-hide="deleteConfirmationModal"
                                                type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4
                               focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200
                               text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700
                               dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600
                               dark:focus:ring-gray-600">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
