<x-layout.loging_layout>
    <main class="bg-gradient-to-br from-blue-200 via-blue-400 to-blue-600 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto min-h-screen dark:bg-gray-900">
            <!-- Logo and Branding -->
            <a href="/" class="flex items-center justify-center mb-10 text-3xl font-bold lg:mb-12 dark:text-white">
                <img src="https://vnfoxcdnoahqenfjssdv.supabase.co/storage/v1/object/public/ecolodgesmr/images/logo1.jpg?t=2024-11-20T12%3A18%3A34.885Z"
                     class="mr-4 h-24 w-26" alt="Hotel Resort Logo">
            </a>
            <!-- Card -->
            <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                    SMR, Admin Login
                </h2>

                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200"
                         role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="mt-8 space-y-6" action="/login" method="POST">
                    @csrf
                    <!-- Email Input -->
                    <div>
                        <label for="email"
                               class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-4 py-3 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500"
                               placeholder="admin@hotel.com">
                    </div>
                    <!-- Password Input -->
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 pr-10 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500"
                               placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 mt-7 text-gray-500 dark:text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.33.942-.81 1.812-1.393 2.583m-2.11 2.274A9.965 9.965 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 011.176-2.611"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:underline dark:text-blue-400">Forgot
                            Password?</a>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full px-4 py-3 text-base font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Log In
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-layout.loging_layout>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const isPasswordVisible = passwordInput.type === 'text';

        passwordInput.type = isPasswordVisible ? 'password' : 'text';
        eyeIcon.setAttribute('d', isPasswordVisible
            ? 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.33.942-.81 1.812-1.393 2.583m-2.11 2.274A9.965 9.965 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 011.176-2.611'
            : 'Eye-open path here');
    });
</script>
