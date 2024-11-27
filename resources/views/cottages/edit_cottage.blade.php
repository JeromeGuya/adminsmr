<x-layout.default>
    {{-- Main Content --}}
    <div class="panel mt-6">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Edit Cottage
                </h1>
                <a href="{{ route('cottage.index') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-800">
                    Back to Cottages
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

            <!-- Edit Cottage Form -->
            <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                <form action="{{ route('cottage.update', $cottage->pool_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Cottage Name -->
                    <div class="mb-4">
                        <label for="cottage_name" class="block text-gray-700 dark:text-gray-300">Cottage Name</label>
                        <input type="text" name="cottage_name" id="cottage_name"
                               value="{{ old('cottage_name', $cottage->cottage_name) }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Deluxe Cottage" required>
                    </div>

                    <!-- Cottage Type -->
                    <div class="mb-4">
                        <label for="cottage_type" class="block text-gray-700 dark:text-gray-300">Cottage Type</label>
                        <select name="cottage_type" id="cottage_type"
                                class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                       dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                       focus:border-transparent" required>
                            <option value="">Select Cottage Type</option>
                            @foreach ($cottageTypes as $type)
                                <option
                                    value="{{ $type }}" {{ old('cottage_type', $cottage->cottage_type) == $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="rate" class="block text-gray-700 dark:text-gray-300">Price (per night)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                PHP
                            </span>
                            <input type="number" name="rate" id="rate"
                                   value="{{ old('rate', $cottage->rate) }}"
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
                        <label for="availability" class="block text-gray-700 dark:text-gray-300">Number of Available Cottages</label>
                        <div class="mt-1">
                            <input type="number" name="availability" id="availability"
                                   class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                   min="0" step="1" value="{{ old('availability', $cottage->availability ?? 0) }}">
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
                                  placeholder="Detailed description of the cottage...">{{ old('description', $cottage->description) }}</textarea>
                    </div>

                    <!-- Images -->
                    <div class="mb-4">
                        <label for="image_url" class="block text-gray-700 dark:text-gray-300">Cottage Image</label>
                        @if ($cottage->image_url)
                            <div class="mb-2">
                                <img src="{{ $cottage->image_url }}" alt="Activity Image"
                                     class="h-32 rounded-md shadow-md">
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Current Image</p>
                            </div>
                        @endif
                        <input type="file" name="image_url" id="image_url" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4
                                      file:border file:border-gray-300 file:rounded-md file:text-sm
                                      file:font-semibold file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:border-gray-600
                                      dark:file:text-gray-400 dark:hover:file:bg-gray-600">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Upload a new image to replace the existing one. Recommended size: 800x600 pixels.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700
                                       focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            Update Cottage
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>
