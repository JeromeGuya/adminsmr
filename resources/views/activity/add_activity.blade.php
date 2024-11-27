<x-layout.default>
    {{-- Main Content --}}
    <div class="panel mt-6">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Add New Activity
                </h1>
                <a href="{{ route('activity.index') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-800">
                    Back to Activities
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

            <!-- Add Activity Form -->
            <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Activity Name -->
                    <div class="mb-4">
                        <label for="activity_name" class="block text-gray-700 dark:text-gray-300">Activity Name</label>
                        <input type="text" name="activity_name" id="activity_name"
                               value="{{ old('activity_name') }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Activity Name" required>
                    </div>

                    <!-- Activity Description -->
                    <div class="mb-4">
                        <label for="activity_description" class="block text-gray-700 dark:text-gray-300">Activity Description</label>
                        <textarea name="activity_description" id="activity_description" rows="4"
                                  class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                         dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                         focus:border-transparent"
                                  placeholder="Detailed description of the activity..." required>{{ old('activity_description') }}</textarea>
                    </div>

                    <!-- Availability -->
                    <div class="mb-4">
                        <label for="availability" class="block text-gray-700 dark:text-gray-300">Availability</label>
                        <input type="number" name="availability" id="availability"
                               value="{{ old('availability') }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Enter the number of slots available" min="0" required>
                    </div>

                    <!-- Rate -->
                    <div class="mb-4">
                        <label for="rate" class="block text-gray-700 dark:text-gray-300">Rate</label>
                        <input type="number" name="rate" id="rate" step="0.01"
                               value="{{ old('rate') }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Enter the rate for the activity" required>
                    </div>

                    <!-- Package -->
                    <div class="mb-4">
                        <label for="package" class="block text-gray-700 dark:text-gray-300">Package</label>
                        <input type="text" name="package" id="package"
                               value="{{ old('package') }}"
                               class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                      dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                      dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent"
                               placeholder="Package name or details">
                    </div>

                    <!-- Inclusions -->
                    <div class="mb-4">
                        <label for="inclusions" class="block text-gray-700 dark:text-gray-300">Inclusions</label>
                        <textarea name="inclusions" id="inclusions" rows="3"
                                  class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md
                                         dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                         dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                                         focus:border-transparent"
                                  placeholder="List inclusions such as snacks, equipment, etc.">{{ old('inclusions') }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image_url" class="block text-gray-700 dark:text-gray-300">Activity Image</label>
                        <input type="file" name="image_url" id="image_url" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4
                                      file:border file:border-gray-300 file:rounded-md file:text-sm
                                      file:font-semibold file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:border-gray-600
                                      dark:file:text-gray-400 dark:hover:file:bg-gray-600">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Recommended size: 800x600 pixels.</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700
                                       focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            Add Activity
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout.default>
