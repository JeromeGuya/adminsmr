<x-layout.default>

    <div class="panel">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Success Cottage Bookings</h1>

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
                        <td class="py-4 px-6">₱{{ number_format($booking->down_payment, 2) }}</td>
                        <td class="py-4 px-6">
                            @if($booking->payment_status == 'Partial')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Partial</span>
                            @elseif($booking->payment_status == 'Fully Paid')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Fully Paid</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $booking->payment_status }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($booking->booking_status == 'Success')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Success</span>
                            @elseif($booking->booking_status == 'Pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Pending</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $booking->booking_status }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-10 text-center">
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('cottage.approve.payment', $booking->booking_id) }}"
                                   class="text-blue-600 hover:text-blue-700">
                                    <i class="fas fa-eye h-5 w-5"></i>
                                </a>
                                <form id="delete-booking-form-{{ $booking->booking_id }}"
                                      action="{{ route('cottages.destroy.booking', $booking->booking_id) }}"
                                      method="POST"
                                      class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a href="#"
                                   class="text-red-600 hover:text-red-700"
                                   data-modal-target="confirmation-modal-{{ $booking->booking_id }}"
                                   data-modal-toggle="confirmation-modal-{{ $booking->booking_id }}">
                                    <i class="fas fa-trash-alt h-5 w-5"></i>
                                </a>

                                <!-- Confirmation Modal -->
                                <div id="confirmation-modal-{{ $booking->booking_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="confirmation-modal-{{ $booking->booking_id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 111.414 1.414L11.414 10l4.293 4.293a1 1 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this booking?</h3>
                                                <button type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2" onclick="document.getElementById('delete-booking-form-{{ $booking->booking_id }}').submit();">
                                                    Yes, delete it
                                                </button>
                                                <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" data-modal-hide="confirmation-modal-{{ $booking->booking_id }}">No, cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
