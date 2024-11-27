<x-layout.default>

    <div class="panel">
        <div class="container mx-auto px-4">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- Back Button -->
                        <a href="{{ route('users.index')}}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blues-700 focus:ring-4 focus:ring-teal-300 dark:focus:ring-teal-800 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span>Back</span>
                        </a>
                        <!-- Page Title -->
                        <h1 class="text-2xl font-semibold">
                            Add New User
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="{{ route('users.store') }}" method="POST" id="addUserForm" class="space-y-6 max-w-4xl mx-auto p-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- First Name Field -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <input type="text" id="first_name" name="first_name" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="John" />
                        </div>

                        <!-- Middle Name Field -->
                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name"
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="William" />
                        </div>

                        <!-- Last Name Field -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="Doe" />
                        </div>

                        <!-- Phone Number Field -->
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="number" id="phone_number" name="phone_number" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="(123) 456-7890" />
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                            <input type="email" id="email" name="email" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="example@example.com" />
                        </div>

                        <!-- Address Field -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <input type="text" id="address" name="address" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="123 Resort Ave, Beach City, Country" />
                        </div>

                        <!-- Password Field -->
                        <div class="relative">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <input type="password" id="password" name="password" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="********" />
                            <button type="button" id="toggle-password" class="absolute right-3 top-9 text-gray-500 dark:text-gray-300">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-gray-500 dark:text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.33.942-.81 1.812-1.393 2.583m-2.11 2.274A9.965 9.965 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 011.176-2.611"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="relative">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   class="mt-2 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   placeholder="********" />
                            <button type="button" id="toggle-password-confirmation" class="absolute right-3 top-9 text-gray-500 dark:text-gray-300">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-gray-500 dark:text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.33.942-.81 1.812-1.393 2.583m-2.11 2.274A9.965 9.965 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 011.176-2.611"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="button" data-modal-toggle="addUserModal" data-modal-target="addUserModal"
                                class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            Add User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addUserModal" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full p-4 overflow-x-hidden overflow-y-auto md:inset-0">
        <div class="relative w-full h-full max-w-lg md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex justify-end p-2">
                    <button type="button" data-modal-toggle="addUserModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto dark:hover:bg-gray-600 dark:hover:text-white">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6.293 4.293a1 1 0 011.414 0L10 6.586l2.293-2.293a1 1 0 111.414 1.414L11.414 8l2.293 2.293a1 1 0 01-1.414 1.414L10 9.414l-2.293 2.293a1 1 0 11-1.414-1.414L8.586 8 6.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Confirm User Creation</h3>
                    <p class="text-gray-500 dark:text-gray-400">Are you sure you want to create this user? Once confirmed, the action will be completed.</p>
                    <div class="mt-4 space-x-4">
                        <button type="submit" form="addUserForm" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Confirm</button>
                        <button type="button" data-modal-toggle="addUserModal" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get the password visibility toggle buttons and inputs
        const togglePassword = document.getElementById("toggle-password");
        const passwordInput = document.getElementById("password");
        const togglePasswordConfirmation = document.getElementById("toggle-password-confirmation");
        const passwordConfirmationInput = document.getElementById("password_confirmation");

        // Toggle password visibility
        togglePassword.addEventListener("click", () => {
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;
        });

        togglePasswordConfirmation.addEventListener("click", () => {
            const type = passwordConfirmationInput.type === "password" ? "text" : "password";
            passwordConfirmationInput.type = type;
        });
    </script>

</x-layout.default>
