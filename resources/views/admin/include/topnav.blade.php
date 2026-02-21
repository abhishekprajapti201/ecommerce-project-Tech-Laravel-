<!-- Topbar -->
            <header class="bg-white shadow-sm py-4 px-6 flex items-center justify-between">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="text-gray-500 mr-4 md:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-dark"> @yield('heading', 'Dashboard')</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-gray-500 hover:text-dark">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full"></span>
                    </div>

                    <div class="relative">
                        <input type="text" placeholder="Search..." class="bg-gray-100 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-primary">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                </div>
            </header>