<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CharatBox - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e73c7e', // Yellow from screenshot
                        secondary: '#10b981', // Green from featured tags
                        dark: '#1f2937', // Dark gray for text
                        light: '#f3f4f6' // Light background
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-link.active {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            color: #b45309;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .login-card {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Login Screen -->
    <div id="login-screen" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary/10 p-4">
        <div class="login-card w-full max-w-md bg-white rounded-xl overflow-hidden">
            <div class="bg-primary p-6">
                <h1 class="text-2xl font-bold text-white text-center">CharatBox Admin</h1>
                <p class="text-white/80 text-center mt-2">Manage Product, bookings, and Users</p>
            </div>

            <div class="p-8">
            <form id="login-form" method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="mb-5">
                    <label for="email" class="block text-dark text-sm font-medium mb-2">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="charatbox@gmail.com"
                        required
                        autofocus
                    >
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-dark text-sm font-medium mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="h-4 w-4 text-primary focus:ring-primary"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="" class="text-sm text-primary font-medium hover:underline">Forgot password?</a>
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary hover:bg-yellow-600 text-white font-medium py-3 px-4 rounded-lg transition duration-300"
                >
                    Sign In
                </button>
            </form>
            </div>

            <div class="bg-gray-50 px-8 py-4 text-center border-t">
                <p class="text-gray-600 text-sm">© 2025 CharatBox. All rights reserved.</p>
            </div>
        </div>
    </div>



    <script>
        // Toggle between login and admin panel
        document.getElementById('login-form').addEventListener('submit', function(e) {
            // e.preventDefault();
            document.getElementById('login-screen').classList.add('hidden');
            document.getElementById('admin-panel').classList.remove('hidden');
        });

        // Mobile sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.w-64');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('absolute');
            sidebar.classList.toggle('z-50');
        });

        // Set active state for sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
