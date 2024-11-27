<div :class="{ 'dark text-white-dark': $store.app.semidark }">
    <nav x-data="sidebar"
         class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
        <div class="bg-white dark:bg-[#0e1726] h-full">
            <div class="flex justify-between items-center px-4 py-3">
                <a href="{{ route('admin.dashboard') }}" class="main-logo flex items-center shrink-0">
                    <img class="w-10 h-8 ml-[5px] flex-none" src="/assets/images/logo1.jpg"
                         alt="image" />
                    <span
                        class="text-2xl ltr:ml-1.5 rtl:mr-1.5  font-semibold  align-middle lg:inline dark:text-white-light">SMR Admin</span>
                </a>
                <a href="javascript:;"
                   class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180"
                   @click="$store.app.toggleSidebar()">
                    <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round" />
                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <ul class="perfect-scrollbar relative font-semibold space-y-0.5 h-[calc(100vh-80px)] overflow-y-auto overflow-x-hidden  p-4 py-0"
                x-data="{ activeDropdown: null }">
                <li class="menu nav-item">
                    <button type="button" class="nav-link group" :class="{ 'active': activeDropdown === 'dashboard' }"
                            @click="activeDropdown === 'dashboard' ? activeDropdown = null : activeDropdown = 'dashboard'">
                        <div class="flex items-center">

                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5"
                                      d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                      fill="currentColor" />
                                <path
                                    d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                    fill="currentColor" />
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'dashboard' }">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'dashboard'" x-collapse class="sub-menu text-gray-500">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                    </ul>
                </li>

                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Categories</span>
                </h2>

                <li class="nav-item">
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('rooms.index') }}" class="group">
                                <div class="flex items-center">
                                    <svg class="group-hover:!text-primary shrink-0" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L2 9h3v11h14V9h3L12 2z" fill="currentColor" />
                                        <path d="M9 22V12h6v10H9z" fill="currentColor" opacity="0.5" />
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Rooms</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cottage.index') }}" class="group">
                                <div class="flex items-center">
                                    <svg class="group-hover:!text-primary shrink-0" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 12L12 4l8 8v8H4v-8z" fill="currentColor" />
                                        <path d="M7 20v-6h10v6H7z" fill="currentColor" opacity="0.5" />
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Cottages</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('activity.index') }}" class="group">
                                <div class="flex items-center">
                                    <svg class="group-hover:!text-primary shrink-0" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2a5 5 0 015 5v10a5 5 0 11-10 0V7a5 5 0 015-5z"
                                              fill="currentColor" />
                                        <path d="M12 22a3 3 0 100-6 3 3 0 000 6z" fill="currentColor" opacity="0.5" />
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Activity</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hall.index') }}" class="group">
                                <div class="flex items-center">
                                    <svg class="group-hover:!text-primary shrink-0" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 12h18v8H3v-8z" fill="currentColor" />
                                        <path d="M6 6h12v4H6V6z" fill="currentColor" opacity="0.5" />
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Function Hall</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                </li>

                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Bookings</span>
                </h2>

                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full flex justify-between items-center"
                            :class="{ 'active': activeDropdown === 'rooms' }"
                            @click="activeDropdown === 'rooms' ? activeDropdown = null : activeDropdown = 'rooms'">
                        <div class="flex items-center">
                            <!-- Rooms Icon -->
                            <svg width="20" height="20" fill="currentColor" class="group-hover:!text-primary shrink-0"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M21 11V20C21 21.1 20.1 22 19 22H5C3.9 22 3 21.1 3 20V11H21ZM19 2H5C3.9 2 3 2.9 3 4V8H21V4C21 2.9 20.1 2 19 2Z" />
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Rooms</span>
                        </div>
                        <!-- Dropdown Arrow -->
                        <div class="transition-transform rtl:rotate-180"
                             :class="{ '!rotate-90': activeDropdown === 'rooms' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'rooms'" x-collapse class="sub-menu text-gray-500">
                        <li><a href="{{ route('room.approved.booking') }}">Approved</a></li>
                        <li><a href="{{ route('room.pending.booking') }}">Pending</a></li>
                        <li><a href="{{ route('room.cancel.booking') }}">Cancelled</a></li>
                    </ul>
                </li>

                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full flex justify-between items-center"
                            :class="{ 'active': activeDropdown === 'cottages' }"
                            @click="activeDropdown === 'cottages' ? activeDropdown = null : activeDropdown = 'cottages'">
                        <div class="flex items-center">
                            <!-- Cottages Icon -->
                            <svg width="20" height="20" fill="currentColor" class="group-hover:!text-primary shrink-0"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2L2 10H5V20H10V14H14V20H19V10H22L12 2Z" />
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Cottages</span>
                        </div>
                        <!-- Dropdown Arrow -->
                        <div class="transition-transform rtl:rotate-180"
                             :class="{ '!rotate-90': activeDropdown === 'cottages' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'cottages'" x-collapse class="sub-menu text-gray-500">
                        <li><a href="{{ route('cottage.approved.booking') }}">Approved</a></li>
                        <li><a href="{{ route('cottage.pending.booking') }}">Pending</a></li>
                        <li><a href="{{ route('cottage.cancel.booking') }}">Cancelled</a></li>
                    </ul>
                </li>

                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full flex justify-between items-center"
                            :class="{ 'active': activeDropdown === 'activities' }"
                            @click="activeDropdown === 'activities' ? activeDropdown = null : activeDropdown = 'activities'">
                        <div class="flex items-center">
                            <!-- Activity Icon -->
                            <svg width="20" height="20" fill="currentColor" class="group-hover:!text-primary shrink-0"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM16.6 14.25L12.76 8.73C12.38 8.19 11.63 8.19 11.24 8.73L7.4 14.25C7.09 14.7 7.39 15.31 7.94 15.31H16.06C16.61 15.31 16.91 14.7 16.6 14.25Z" />
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Activity</span>
                        </div>
                        <!-- Dropdown Arrow -->
                        <div class="transition-transform rtl:rotate-180"
                             :class="{ '!rotate-90': activeDropdown === 'activities' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'activities'" x-collapse class="sub-menu text-gray-500">
                        <li><a href="{{ route('activity.approved.booking') }}">Approved</a></li>
                        <li><a href="{{ route('activity.pending.booking') }}">Pending</a></li>
                        <li><a href="{{ route('activity.cancel.booking') }}">Cancelled</a></li>
                    </ul>
                </li>

                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full flex justify-between items-center"
                            :class="{ 'active': activeDropdown === 'function_hall' }"
                            @click="activeDropdown === 'function_hall' ? activeDropdown = null : activeDropdown = 'function_hall'">
                        <div class="flex items-center">
                            <!-- Function Hall Icon -->
                            <svg width="20" height="20" fill="currentColor" class="group-hover:!text-primary shrink-0"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M3 22V20H21V22H3ZM12 2L2 8H5V14H19V8H22L12 2Z" />
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Function Hall</span>
                        </div>
                        <!-- Dropdown Arrow -->
                        <div class="transition-transform rtl:rotate-180"
                             :class="{ '!rotate-90': activeDropdown === 'function_hall' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'function_hall'" x-collapse class="sub-menu text-gray-500">
                        <li><a href="{{ route('function.approved.booking') }}">Approved</a></li>
                        <li><a href="{{ route('function.pending.booking') }}">Pending</a></li>
                        <li><a href="{{ route('function.cancel.booking') }}">Cancelled</a></li>
                    </ul>
                </li>


                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Overall Reports</span>
                </h2>

                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full flex justify-between items-center"
                            :class="{ 'active': activeDropdown === 'booking_report' }"
                            @click="activeDropdown === 'booking_report' ? activeDropdown = null : activeDropdown = 'booking_report'">
                        <div class="flex items-center">
                            <!-- Booking Report Icon -->
                            <svg width="20" height="20" fill="currentColor" class="group-hover:!text-primary shrink-0"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M4 4H20V6H4V4ZM4 9H20V11H4V9ZM4 14H14V16H4V14ZM4 19H10V21H4V19Z" />
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Booking Report</span>
                        </div>
                        <!-- Dropdown Arrow -->
                        <div class="transition-transform rtl:rotate-180"
                             :class="{ '!rotate-90': activeDropdown === 'booking_report' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'booking_report'" x-collapse class="sub-menu text-gray-500">
                        <li><a href="{{ route('bookings.approved') }}">Approved</a></li>
                        <li><a href="{{ route('bookings.pending') }}">Pending</a></li>
                        <li><a href="/reports/bookings/cancelled">Cancelled</a></li>
                    </ul>
                </li>


                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>MANAGEMENT</span>
                </h2>

                <li class="menu nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link group w-full flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Users Icon -->
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.5" cx="15" cy="6" r="3" fill="currentColor" />
                                <ellipse opacity="0.5" cx="16" cy="17" rx="5" ry="3" fill="currentColor" />
                                <circle cx="9.00098" cy="6" r="4" fill="currentColor" />
                                <ellipse cx="9.00098" cy="17.001" rx="7" ry="4" fill="currentColor" />
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Users</span>
                        </div>
                    </a>
                </li>

                <li class="menu nav-item">
                    <a href="{{ route('employees.index') }}" class="nav-link group w-full flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Employees Icon -->
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="9" cy="8" r="4" fill="currentColor" />
                                <circle cx="15" cy="8" r="4" fill="currentColor" />
                                <path d="M5 18C5 15.79 7.79 14 10 14H14C16.21 14 19 15.79 19 18" fill="none"
                                      stroke="currentColor" stroke-width="2" />
                                <path d="M16 17C16 16 17 16 17 17" fill="none" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Employees</span>
                        </div>
                    </a>
                </li>

                <li class="menu nav-item">
                    <a href="{{ route('feedbacks') }}" class="nav-link group w-full flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Feedbacks Icon -->
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" stroke="currentColor" stroke-width="2" d="M12 3L2 12h3v8h6v-5h2v5h6v-8h3L12 3z" />
                                <circle cx="12" cy="12" r="1.5" fill="currentColor" />
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Feedbacks</span>
                        </div>
                    </a>
                </li>


            </ul>
        </div>
    </nav>
</div>

