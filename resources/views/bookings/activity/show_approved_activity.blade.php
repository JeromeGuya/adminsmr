<x-layout.default>

    <div class="panel">
        @if(session('success', ))
            <div class="mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
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
                        <h3 class="text-lg font-semibold mb-3">Activity Information</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><span class="font-medium">Room Name:</span> {{ $booking->activity->activity_name }}</p>
                            <p><span class="font-medium">Description:</span> {{ $booking->activity->activity_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-wrap justify-end space-x-2">
                    @if ($booking->booking_status !== 'Success' || $booking->payment_status !== 'Fully Paid')
                        <!-- Approve Button -->
                        <button
                            data-modal-target="approveModal"
                            data-modal-toggle="approveModal"
                            class="flex items-center bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition mb-2"
                        >
                            <i class="fas fa-money-bill mr-2"></i> Fully Paid
                        </button>

                        <!-- Decline Button -->
                        <button
                            data-modal-target="declineModal"
                            data-modal-toggle="declineModal"
                            class="flex items-center bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition mb-2"
                        >
                            <i class="fas fa-times mr-2"></i> Decline
                        </button>
                    @else
                        <!-- Email Button -->
                        <form action="{{ route('bookings.email', $booking->booking_id) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="flex items-center bg-yellow-600 text-white px-5 py-2 rounded-lg hover:bg-yellow-700 transition">
                                <i class="fas fa-envelope mr-2"></i> Email
                            </button>
                        </form>
                    @endif

                    <!-- Back Button -->
                    <a href="{{ route('activity.approved.booking') }}"
                       class="flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition mb-2"
                    >
                        <i class="fas fa-arrow-left mr-2"></i> Back to Bookings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
            <div class="relative bg-white rounded-lg shadow">
                <div class="p-6 text-center">
                    <i class="fas fa-check-circle text-green-500 text-6xl mb-4"></i>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to mark this booking as Fully Paid?</h3>
                    <form action="{{ route('approve.activity.payment', $booking->booking_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg text-sm px-5 py-2.5 mr-2">
                            Yes, Approve
                        </button>
                        <button data-modal-hide="approveModal" type="button" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Decline Modal -->
    <div id="declineModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 w-full h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto mt-20">
            <div class="relative bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Reason for Declining</h3>
                    <form action="{{--{{ route('bookings.decline', $booking->booking_id) }}--}}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea name="decline_reason" rows="4" class="w-full p-2 border rounded-lg" placeholder="Enter the reason for declining..." required></textarea>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">
                                Decline Booking
                            </button>
                            <button data-modal-hide="declineModal" type="button" class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout.default>
