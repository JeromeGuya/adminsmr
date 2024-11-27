<x-layout.default>
    {{-- Main Content --}}
    <div class="panel mt-6">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Edit Room
                </h1>
                <a href="{{ route('rooms.index') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-800">
                    Back to Rooms
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

            <!-- Edit Room Form -->
            <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                <form action="{{ route('rooms.update', $room->room_id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Room Name -->
                    <div class="mb-4">
                        <label for="room_name" class="block text-gray-700 dark:text-gray-300">Room Name</label>
                        <input type="text" name="room_type" id="room_name"
                               value="{{ old('room_name', $room->room_type) }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Deluxe Suite" required>
                    </div>

                    <!-- Room Type -->
                    <div class="mb-4">
                        <label for="room_type" class="block text-gray-700 dark:text-gray-300">Bed Type</label>
                        <select name="name" id="room_type"
                                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                   focus:border-transparent" required>
                            <option value="">Select Bed Type</option>
                            @foreach ($roomTypes as $type)
                                <option
                                    value="{{ $type }}" {{ old('room_type', $room->name) == $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 dark:text-gray-300">Price (per night)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                PHP
                            </span>
                            <input type="number" name="rate" id="price"
                                   value="{{ old('rate', $room->rate) }}"
                                   step="0.01"
                                   class="mt-1 block w-full pl-10 px-4 py-2 bg-white border border-gray-300
                                          rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                          dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                          focus:border-transparent"
                                   placeholder="e.g., 1500.00" required>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="mb-4">
                        <label for="availability" class="block text-gray-700 dark:text-gray-300">Number of Available
                            Rooms</label>
                        <div class="mt-1">
                            <input type="number" name="availability" id="availability"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                   min="0" step="1" value="{{ old('availability', $room->availability ?? 0) }}">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                         dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                         focus:border-transparent"
                                  placeholder="Detailed description of the room...">{{ old('description', $room->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Amenities</label>
                        <div class="mt-2 grid grid-cols-2 md:grid-cols-3 gap-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="amenities[]" value="Wi-Fi"
                                       class="form-checkbox h-5 w-5 text-blue-600"
                                    {{ (is_array(old('amenities', $roomAmenities)) && in_array('Wifi', old('amenities', $roomAmenities))) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Wi-Fi</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="amenities[]" value="Air Conditioning"
                                       class="form-checkbox h-5 w-5 text-blue-600"
                                    {{ (is_array(old('amenities', $roomAmenities)) && in_array('Air Conditioning', old('amenities', $roomAmenities))) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Air Conditioning</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="amenities[]" value="TV"
                                       class="form-checkbox h-5 w-5 text-blue-600"
                                    {{ (is_array(old('amenities', $roomAmenities)) && in_array('TV', old('amenities', $roomAmenities))) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">TV</span>
                            </label>
                            <!-- Add other amenities as necessary -->
                        </div>
                    </div>


                    <!-- Images -->
                    <div class="mb-4">
                        <label for="images" class="block text-gray-700 dark:text-gray-300">Room Images</label>
                        <input type="file" name="image_url" id="images" accept="image/*" multiple
                               class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4
                                      file:border file:border-gray-300 file:rounded-md file:text-sm
                                      file:font-semibold file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:border-gray-600
                                      dark:file:text-gray-400 dark:hover:file:bg-gray-600">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">You can upload multiple images.
                            Recommended size: 800x600 pixels.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700
                                       focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            Update Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>
