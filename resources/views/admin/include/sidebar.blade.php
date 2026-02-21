<nav class="mt-6 flex-1 overflow-y-auto">
    <div class="px-4 mb-4">
        <p class="text-xs uppercase text-gray-500 font-medium tracking-wider">Navigation</p>
    </div>

    <a href="{{ url('/admin/dashboard') }}"
        class="sidebar-link flex items-center px-6 py-3 text-dark hover:bg-yellow-50 transition">
        <i class="fas fa-chart-line mr-3 text-primary"></i>
        Dashboard
    </a>
    <a href="{{ url('/list/users') }}"
        class="sidebar-link flex items-center px-6 py-3 text-dark hover:bg-yellow-50 transition">
        <i class="fas fa-users mr-3 text-primary"></i>
        Users
    </a>
    <a href="{{ url('/list/order') }}"
        class="sidebar-link flex items-center px-6 py-3 text-dark hover:bg-yellow-50 transition">
        <i class="fas fa-cog mr-3 text-primary"></i>
        Orders
    </a>

     <a href="{{ url('contactget') }}"
        class="sidebar-link flex items-center px-6 py-3 text-dark hover:bg-yellow-50 transition">
        <i class="fas fa-cog mr-3 text-primary"></i>
        ContactUs
    </a>
    {{-- <details class="group px-6 py-1">
        <summary class="flex items-center cursor-pointer text-dark hover:bg-yellow-50 px-4 py-2 rounded">
            <i class="fas fa-add mr-3 text-blue-500"></i> Coupons
        </summary>
        <div class="pl-8 mt-1 flex flex-col space-y-1">
            <a href="{{ url('offer') }}" class="text-dark hover:text-yellow-600">AddCoupons</a>
            <a href="{{ route('category.listing') }}" class="text-dark hover:text-yellow-600">AllCoupons</a>
        </div>
    </details>
    <details class="group px-6 py-1">
        <summary class="flex items-center cursor-pointer text-dark hover:bg-yellow-50 px-4 py-2 rounded">
            <i class="fas fa-add mr-3 text-blue-500"></i> Category
        </summary>
        <div class="pl-8 mt-1 flex flex-col space-y-1">
            <a href="{{ url('category') }}" class="text-dark hover:text-yellow-600">Add Category</a>
            <a href="{{ route('category.listing') }}" class="text-dark hover:text-yellow-600">All Category</a>
        </div>
    </details> --}}

    <!-- Dropdown 1: Venues -->
    <details class="group px-6 py-1">
        <summary class="flex items-center cursor-pointer text-dark hover:bg-yellow-50 px-4 py-2 rounded">
            <i class="fas fa-building mr-3 text-blue-500"></i> Products
        </summary>
        <div class="pl-8 mt-1 flex flex-col space-y-1">
            <a href="{{ route('admin.venue.add') }}" class="text-dark hover:text-yellow-600">Add Products</a>
            <a href="{{ route('poducts.listing') }}" class="text-dark hover:text-yellow-600">All Products</a>
        </div>
    </details>
    <!-- Dropdown 4: Blog -->
    <details class="group px-6 py-1">
        <summary class="flex items-center cursor-pointer text-dark hover:bg-yellow-50 px-4 py-2 rounded">
            <i class="fas fa-blog mr-3 text-indigo-500"></i> Shipping..
        </summary>
        <div class="pl-8 mt-1 flex flex-col space-y-1">
            <a href="{{ url('shipping/list') }}" class="text-dark hover:text-yellow-600">All Shipping</a>
            <a href="{{ url('shipping') }}" class="text-dark hover:text-yellow-600">Add Shipping</a>
        </div>
    </details>
</nav>
