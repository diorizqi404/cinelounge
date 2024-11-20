    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full z-10">
        <div class="max-w-full mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="text-gray-500 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <span class="ml-4 text-lg font-semibold">Dashboard</span>
                </div>
                <div class="flex items-center">
                    <div class="relative">
                        <button class="flex items-center">
                            <div class="py-1.5 px-4 bg-blue-500 rounded-md text-white mr-2 flex items-center">
                                <span class="material-symbols-rounded mr-2">
                                    person
                                    </span>
                                <span class="text-md">{{ Auth::user('admin')->username }}</span>
                            </div>
                            <a class="py-1.5 px-4 bg-red-500 rounded-md text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); 
    document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            {{-- <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin+User" alt="User avatar"> --}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
