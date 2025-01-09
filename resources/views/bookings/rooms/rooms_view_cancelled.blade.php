<x.layout-default>


        <div class="p-4 sm:ml-64 mt-16 panel">
            @if(session('success'))
                <div class="mt-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-500 to-green-500 px-6 py-4">
                    <h1 class="text-2xl font-semibold text-white">Booking Details</h1>
                </div>

                <!-- Body -->
                <div class="p-6">
                    <!-- Booking Summary -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Booking ID: {{ $booking->booking_id }}</h2>
                        <p class="text-gray-600">Date: {{ now()->format('F d, Y') }}</p>
                    </div>

                    <!-- Information Sections -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Customer Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p><span class="font-medium">Name:</span> {{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $booking->user->email }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $booking->user->phone_number }}</p>
                            </div>
                        </div>

                        <!-- Booking Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Booking Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p><span class="font-medium">Check-in Date:</span> {{ \Carbon\Carbon::parse($booking->check_in)->format('F d, Y') }}</p>
                                <p><span class="font-medium">Check-out Date:</span> {{ \Carbon\Carbon::parse($booking->check_out)->format('F d, Y') }}</p>
                                <p><span class="font-medium">Total Amount:</span> ₱{{ number_format($booking->total_amount, 2) }}</p>
                                <p><span class="font-medium">Payment Amount:</span> ₱{{ number_format($booking->down_payment, 2) }}</p>
                                <p><span class="font-medium">Payment Method:</span> {{ $booking->payment_method }}</p>
                                <p><span class="font-medium">Payment Status:</span> {{ $booking->payment_status }}</p>
                                <p><span class="font-medium">Booking Status:</span> {{ $booking->booking_status }}</p>
                            </div>
                        </div>

                        <!-- Room Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold mb-3">Room Information</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p><span class="font-medium">Room Name:</span> {{ $booking->room->name }}</p>
                                <p><span class="font-medium">Room Type:</span> {{ $booking->room->room_type }}</p>
                                <p><span class="font-medium">Description:</span> {{ $booking->room->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex flex-wrap justify-end space-x-4">
                        <!-- Delete Button -->
                        <button
                            type="button"
                            data-modal-target="deleteModal"
                            data-modal-toggle="deleteModal"
                            class="flex items-center bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition mb-2"
                        >
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>

                        @if ($booking->payment_status !== 'Refunded')
                            <!-- Refund Button -->
                            <button
                                type="button"
                                data-modal-target="refundModal"
                                data-modal-toggle="refundModal"
                                class="flex items-center bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 transition mb-2"
                            >
                                <i class="fas fa-money-bill-wave mr-2"></i> Refund 50%
                            </button>
                        @endif

                        <!-- Back Button -->
                        <a href="{{ route('roomCancelBookings') }}"
                           class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition mb-2"
                        >
                            <i class="fas fa-arrow-left mr-2"></i> Back to Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" tabindex="-1" aria-hidden="true"
             class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
            <div class="relative w-full max-w-md h-full md:h-auto mx-auto mt-20">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                            data-modal-hide="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-red-600 w-14 h-14" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this booking?</h3>
                        <form action="{{ route('bookings.destroy', $booking->booking_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm inline-flex items-center px-5 py-2.5 mr-2">
                                Yes, Delete
                            </button>
                            <button type="button" data-modal-hide="deleteModal"
                                    class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-sm inline-flex items-center px-5 py-2.5">
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refund Modal -->
        @if ($booking->payment_status !== 'Refunded')
            <div id="refundModal" tabindex="-1" aria-hidden="true"
                 class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
                <div class="relative w-full max-w-md h-full md:h-auto mx-auto mt-20">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <button type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                data-modal-hide="refundModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-teal-500 w-14 h-14" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 10h4l3 9h8l3-9h4"></path>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to refund 50% of this booking?</h3>
                            <form action="{{ route('bookings.refund', $booking->booking_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 rounded-lg text-sm inline-flex items-center px-5 py-2.5 mr-2">
                                    Yes, Refund 50%
                                </button>
                                <button type="button" data-modal-hide="refundModal"
                                        class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-sm inline-flex items-center px-5 py-2.5">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

</x.layout-default>
