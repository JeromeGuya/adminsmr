<x-layout.default>

    {{-- Main Content --}}
    <div class="panel">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Edit Room Booking
                </h1>
                <a href="{{ route('room.pending.booking') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-800">
                    Back to Bookings
                </a>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Room Booking Form -->
            <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                <form action="{{--{{ route('booking.update', $booking->booking_id) }}--}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Room Selection -->
                    <div class="mb-4">
                        <label for="room_id" class="block text-gray-700 dark:text-gray-300">Room</label>
                        <select name="room_id" id="room_id"
                                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                       focus:border-transparent" required>
                            @foreach ($rooms as $room)
                                <option
                                    value="{{ $room->id }}" {{ old('room_id', $booking->room_id) == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_type }} (Capacity: {{ $room->room_capacity }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label for="payment_method" class="block text-gray-700 dark:text-gray-300">Payment
                            Method</label>
                        <input type="text" name="payment_method" id="payment_method"
                               value="{{ old('payment_method', $booking->payment_method) }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Enter Payment Method" required>
                    </div>

                    <!-- Check-in Date -->
                    <div class="mb-4">
                        <label for="check_in" class="block text-gray-700 dark:text-gray-300">Check-in Date and
                            Time</label>
                        <input type="datetime-local" name="check_in" id="check_in"
                               value="{{ old('check_in', $booking->check_in ? $booking->check_in->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                  dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                  focus:border-transparent"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="check_out" class="block text-gray-700 dark:text-gray-300">Check-out Date and
                            Time</label>
                        <input type="datetime-local" name="check_out" id="check_out"
                               value="{{ old('check_out', $booking->check_out ? $booking->check_out->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                  dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                  focus:border-transparent"
                               required>
                    </div>


                    <!-- Total Amount -->
                    <div class="mb-4">
                        <label for="total_amount" class="block text-gray-700 dark:text-gray-300">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount"
                               value="{{ old('total_amount', $booking->total_amount) }}"
                               step="0.01"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Enter total amount" required>
                    </div>

                    <!-- Down Payment -->
                    <div class="mb-4">
                        <label for="down_payment" class="block text-gray-700 dark:text-gray-300">Down Payment</label>
                        <input type="number" name="down_payment" id="down_payment"
                               value="{{ old('down_payment', $booking->down_payment) }}"
                               step="0.01"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Enter down payment" required>
                    </div>

                    <!-- Payment Status -->
                    <div class="mb-4">
                        <label for="payment_status" class="block text-gray-700 dark:text-gray-300">Payment
                            Status</label>
                        <select name="payment_status" id="payment_status"
                                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                       focus:border-transparent" required>
                            <option
                                value="pending" {{ old('payment_status', $booking->payment_status) == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option
                                value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>
                                Fully Paid
                            </option>
                            <option
                                value="cancelled" {{ old('payment_status', $booking->payment_status) == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </div>

                    <!-- Booking Status -->
                    <div class="mb-4">
                        <label for="booking_status" class="block text-gray-700 dark:text-gray-300">Booking
                            Status</label>
                        <select name="booking_status" id="booking_status"
                                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                       focus:border-transparent" required>
                            <option
                                value="confirmed" {{ old('booking_status', $booking->booking_status) == 'confirmed' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option
                                value="pending" {{ old('booking_status', $booking->booking_status) == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option
                                value="cancelled" {{ old('booking_status', $booking->booking_status) == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700
                                       focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            Update Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>

