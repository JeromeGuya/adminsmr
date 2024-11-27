<x-layout.default>

    <div class="panel">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Manage Cottages
                </h1>
                <a href="{{ route('cottage.create') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    Add Cottage
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow dark:bg-gray-800">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Cottage Name</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Availability</th>
                        <th scope="col" class="px-6 py-3">No. of Available</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($cottage as $cottages)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $cottages->cottage_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Str::limit($cottages->description, 50, '...') }}
                            </td>
                            <td class="px-6 py-4">
                                PHP{{ number_format($cottages->rate, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                @if($cottages->availability)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Available
                                        </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Unavailable
                                        </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $cottages->availability }}
                            </td>

                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('cottage.edit', $cottages->pool_id) }}"
                                   class="text-blue-600 hover:underline dark:text-blue-400">Edit</a>
                                <button type="button" class="text-red-600 hover:underline dark:text-red-400"
                                        data-modal-toggle="deleteRoomModal-{{ $cottages->pool_id }}"
                                        data-modal-target="deleteRoomModal-{{ $cottages->pool_id }}">
                                    Delete
                                </button>

                                <!-- Modal for Delete Confirmation -->
                                <div id="deleteRoomModal-{{ $cottages->pool_id }}" tabindex="-1"
                                     class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
                                    <div class="relative w-full h-full max-w-md md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                            <button type="button"
                                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="deleteRoomModal-{{ $cottages->pool_id }}">
                                                <span class="sr-only">Close modal</span>
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0
                                                              111.414 1.414L11.414 10l4.293 4.293a1 1 0
                                                              01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0
                                                              01-1.414-1.414L8.586 10 4.293 5.707a1 1 0
                                                              010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-12 h-12
                                                         dark:text-gray-200" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9
                                                              0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    Are you sure you want to delete {{ $cottages->cottage_name }}? This
                                                    action cannot be undone.
                                                </h3>
                                                <form action="{{ route('cottages.destroy', $cottages->pool_id) }}"
                                                      method="POST" class="inline-flex">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-700
                                                                focus:ring-4 focus:outline-none focus:ring-red-300
                                                                font-medium rounded-lg text-sm px-5 py-2.5 text-center
                                                                dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                        Yes, delete it
                                                    </button>
                                                </form>
                                                <button type="button"
                                                        data-modal-toggle="deleteRoomModal-{{ $cottages->pool_id }}"
                                                        class="text-gray-500 bg-white hover:bg-gray-100
                                                            focus:ring-4 focus:outline-none focus:ring-gray-200
                                                            rounded-lg border border-gray-200 text-sm font-medium
                                                            px-5 py-2.5 hover:text-gray-900 focus:z-10
                                                            dark:bg-gray-800 dark:text-gray-400
                                                            dark:border-gray-600 dark:hover:text-white
                                                            dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No rooms found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $cottage->links('pagination::tailwind') }}
        </div>
    </div>

</x-layout.default>
