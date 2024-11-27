<x-layout.default>
    <div class="panel mt-6">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Customer Feedback
                </h1>
            </div>

            <!-- No Feedbacks Message -->
            @if ($feedbacks->isEmpty())
                <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6 text-center">
                    <p class="text-gray-700 dark:text-gray-300">
                        No feedbacks found.
                    </p>
                </div>
            @else
                <!-- Feedback Table -->
                <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Booking ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Customer Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Comments
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                Rating
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $feedback->booking->id ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $feedback->user->first_name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ $feedback->comments }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    <span class="text-yellow-500 font-semibold">{{ $feedback->rating }} / 5</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Total Feedback Count -->
                    <div class="mt-4 text-right">
                        <span class="font-semibold text-lg">Total Feedbacks: </span>
                        <span class="text-blue-500 text-xl">{{ $feedbacks->count() }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout.default>
