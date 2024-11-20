    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed left-0 top-0 w-64 h-screen bg-gray-800 text-white pt-20 transform transition-transform duration-300">
        <div class="px-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-gray-700' : '' }} flex items-center p-2 rounded hover:bg-gray-700">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard.film') }}" class="{{ Route::currentRouteName() == 'admin.dashboard.film' ? 'bg-gray-700' : '' }} flex items-center p-2 rounded hover:bg-gray-700">
                        <span class="material-symbols-rounded mr-3">
                            movie
                            </span>
                        Film
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard.form') }}" class="{{ Route::currentRouteName() == 'admin.dashboard.form' ? 'bg-gray-700' : '' }} flex items-center p-2 rounded hover:bg-gray-700">
                        <span class="material-symbols-rounded mr-3">
                            description
                            </span>
                        Form
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard.admin') }}" class="{{ Route::currentRouteName() == 'admin.dashboard.admin' ? 'bg-gray-700' : '' }} flex items-center p-2 rounded hover:bg-gray-700">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>