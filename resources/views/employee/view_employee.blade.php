<x-layout.default>
    <div class="panel">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4 sm:mb-0">
                    Manage Employees
                </h1>
                <a href="{{ route('employees.create') }}"
                   class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    Add Employee
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow dark:bg-gray-800">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Phone</th>
                        <th scope="col" class="px-6 py-3">Created At</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employee as $employees)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">{{ $employees->employee_first_name }}</td>
                            <td class="px-6 py-4">{{ $employees->employee_email }}</td>
                            <td class="px-6 py-4">{{ $employees->employee_phone }}</td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($employees->created_at)->format('F j, Y, g:i a') }}
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('employees.edit', $employees->employee_id) }}"
                                   class="text-blue-600 hover:underline dark:text-blue-400">Edit</a>
                                <button type="button" class="text-red-600 hover:underline dark:text-red-400"
                                        data-modal-toggle="deleteEmployeeModal-{{ $employees->employee_id }}"
                                        data-modal-target="deleteEmployeeModal-{{ $employees->employee_id }}">
                                    Delete
                                </button>

                                <!-- Modal for Delete Confirmation -->
                                <div id="deleteEmployeeModal-{{ $employees->employee_id }}" tabindex="-1"
                                     class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
                                    <div class="relative w-full h-full max-w-lg md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                            <div class="flex justify-end p-2">
                                                <button type="button"
                                                        data-modal-toggle="deleteEmployeeModal-{{ $employees->id }}"
                                                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <span class="sr-only">Close</span>
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                              d="M6.293 4.293a1 1 0 011.414 0L10 6.586l2.293-2.293a1 1 0 111.414 1.414L11.414 8l2.293 2.293a1 1 0 01-1.414 1.414L10 9.414l-2.293 2.293a1 1 0 11-1.414-1.414L8.586 8 6.293 5.707a1 1 0 010-1.414z"
                                                              clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="px-6 py-6 lg:px-8">
                                                <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">
                                                    Confirm Employee Deletion
                                                </h3>
                                                <p class="text-gray-500 dark:text-gray-400">
                                                    Are you sure you want to
                                                    delete {{ $employees->first_name }} {{ $employees->last_name }}? This action
                                                    cannot be undone.
                                                </p>
                                                <div class="mt-4 flex justify-end space-x-4">
                                                    <form action="{{ route('employees.destroy', $employees->employee_id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                                            Confirm Delete
                                                        </button>
                                                    </form>
                                                    <button type="button"
                                                            data-modal-toggle="deleteEmployeeModal-{{ $employees->employee_id }}"
                                                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                                                        Cancel
                                                    </button>
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
            <div class="flex justify-between items-center mt-6">
                <span class="text-sm text-gray-700">
                    Showing {{ $employee->firstItem() }} to {{ $employee->lastItem() }} of {{ $employee->total() }} Employees
                </span>
                <div>
                    {{ $employee->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout.default>
