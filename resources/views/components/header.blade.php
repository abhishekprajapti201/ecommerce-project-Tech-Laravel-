<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charat Box - Medical Equipment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgb(var(--color-primary) / <alpha-value>)',
                        secondary: 'rgb(var(--color-secondary) / <alpha-value>)',
                        accent: 'rgb(var(--color-accent) / <alpha-value>)',
                        neutral: 'rgb(var(--color-neutral) / <alpha-value>)',
                        bgprimary: 'rgb(var(--bg-primary) / <alpha-value>)',
                        bgsecondary: 'rgb(var(--bg-secondary) / <alpha-value>)',
                        textprimary: 'rgb(var(--text-primary) / <alpha-value>)',
                        textsecondary: 'rgb(var(--text-secondary) / <alpha-value>)',
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --color-primary: 14 165 233;
            --color-secondary: 34 197 94;
            --color-accent: 249 115 22;
            --color-neutral: 100 116 139;
            --bg-primary: 248 250 252;
            --bg-secondary: 255 255 255;
            --text-primary: 15 23 42;
            --text-secondary: 100 116 139;
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 0;
            font-weight: 500;
            color: rgb(var(--text-secondary));
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: rgb(var(--color-primary));
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: rgb(var(--color-primary));
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .btn-primary {
            background-color: rgb(var(--color-primary));
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: rgb(3, 105, 161);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        @keyframes popup {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-popup {
            animation: popup 0.3s ease-out;
        }

        .fade-enter {
            opacity: 0;
            transform: translateY(10px);
        }

        .fade-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .fade-exit {
            opacity: 1;
        }

        .fade-exit-active {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-bgprimary">
    <!-- Header -->
    <header class="bg-bgsecondary shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo"
                        class="w-12 h-12 rounded-full object-cover mr-3">
                    <span class="text-xl font-bold text-primary">Charat Box</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ url('/') }}" class="nav-link active">Home</a>
                        <a href="{{ route('product') }}" class="nav-link">Products</a>
                        <a href="{{ route('about') }}" class="nav-link">About</a>
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                    </div>
                </div>

                <!-- Search and CTA -->
                <div class="hidden md:flex items-center space-x-4">
                    <button class="text-neutral-600 hover:text-primary relative">
                        <i class="fa-regular fa-heart text-2xl"></i>
                        <span class="absolute -top-1 -right-2 bg-red-500 text-white text-xs px-1 rounded-full">2</span>
                    </button>
                    <a href="{{ url('cart') }}" class="text-neutral-600 hover:text-primary relative">
                        <i class="fa-solid fa-cart-shopping text-2xl"></i>
                        <span
                            class="absolute -top-1 -right-2 bg-primary text-white text-xs px-1 rounded-full">
                            {{ App\Models\CartItem::where('user_id',Auth::check() ? Auth::user()->id : '')->count() }}
                        </span>
                    </a>
                    <div class="px-3">
                        <button id="openModal" class="text-neutral-600 hover:text-primary relative">
                            <i class="fa-solid fa-user text-2xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-neutral-400 hover:text-neutral-500 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars h-6 w-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="mobile-menu hidden md:hidden bg-white border-t border-neutral-200">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ url('/') }}" class="nav-link active">Home</a>
                <a href="{{ route('product') }}" class="nav-link block px-3 py-2 rounded-md">Products</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
                <a href="{{ route('contact') }}" class="nav-link block px-3 py-2 rounded-md">Contact</a>

                <div class="pt-4 pb-3 border-t border-neutral-200">
                    <div class="flex items-center justify-around py-2">
                        <button class="text-neutral-600 hover:text-primary relative">
                            <i class="fa-regular fa-heart text-2xl"></i>
                        </button>
                        <button class="text-neutral-600 hover:text-primary relative">
                            <i class="fa-solid fa-cart-shopping text-2xl"></i>
                        </button>
                        <button id="openModalMobile" class="text-neutral-600 hover:text-primary relative">
                            <i class="fa-solid fa-user text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Login/Signup Popup Modal -->
    <div id="modalOverlay" class="fixed inset-0 bg-black/50 hidden items-center justify-center backdrop-blur-sm z-50">
        <div class="bg-white rounded-3xl shadow-2xl w-96 p-8 text-center relative animate-popup">
            <button id="closeModal"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>

            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" class="w-16 mx-auto mb-3" alt="Logo" />
            <h2 id="modalTitle" class="text-xl font-bold text-blue-600 mb-2">Welcome Back!</h2>
            <p id="modalSubtitle" class="text-gray-500 mb-5 italic">Log in to continue</p>

            <!-- LOGIN FORM -->
            <div id="loginForm">
                <form action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <input name="email" type="email" placeholder="Enter Email"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-3 outline-none" />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <input name="password" type="password" placeholder="Password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-4 outline-none" />
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <input type="submit"
                        class="bg-blue-600 w-full text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition"
                        value="Login">
                    <p class="mt-4 text-sm text-gray-600">New here?
                        <button type="button" id="showSignup" class="text-gray-600 font-semibold">Sign Up</button>
                    </p>
                </form>
            </div>

            <!-- SIGNUP FORM -->
            <div id="signupForm" class="hidden">
                <form action="{{ url('store') }}" method="POST">
                    @csrf
                    <input name="name" type="text" placeholder="Full Name"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-3 outline-none" />
                    <input name="email" type="email" placeholder="Email"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-3 outline-none" />
                    <input name="password" type="password" placeholder="Create Password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-3 outline-none" />
                    <input name="phone" type="number" placeholder="Phone Number"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-3 outline-none" />
                    <input name="password_confirmation" type="password" placeholder="Confirm Password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 mb-4 outline-none" />
                    <input type="submit"
                        class="bg-blue-600 w-full text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition"
                        value="Sign Up">
                    <p class="mt-4 text-sm text-gray-600">Already have an account?
                        <button type="button" id="showLogin" class="text-blue-600 font-semibold">Login</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Modal toggle
        const modal = document.getElementById('modalOverlay');
        const openBtns = [document.getElementById('openModal'), document.getElementById('openModalMobile')];
        const closeBtn = document.getElementById('closeModal');

        openBtns.forEach(btn => {
            if (btn) {
                btn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            }
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

        // Login / Signup toggle
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');
        const modalTitle = document.getElementById('modalTitle');
        const modalSubtitle = document.getElementById('modalSubtitle');
        const showSignup = document.getElementById('showSignup');
        const showLogin = document.getElementById('showLogin');

        function fadeSwitch(hideEl, showEl) {
            hideEl.classList.add('fade-exit-active');
            setTimeout(() => {
                hideEl.classList.add('hidden');
                hideEl.classList.remove('fade-exit-active');
                showEl.classList.remove('hidden');
                showEl.classList.add('fade-enter');
                setTimeout(() => {
                    showEl.classList.add('fade-enter-active');
                    setTimeout(() => showEl.classList.remove('fade-enter', 'fade-enter-active'), 300);
                }, 10);
            }, 300);
        }

        showSignup.addEventListener('click', () => {
            fadeSwitch(loginForm, signupForm);
            modalTitle.textContent = "Create Account";
            modalSubtitle.textContent = "Join us and get started!";
        });

        showLogin.addEventListener('click', () => {
            fadeSwitch(signupForm, loginForm);
            modalTitle.textContent = "Welcome Back!";
            modalSubtitle.textContent = "Log in to continue";
        });
    </script>
</body>

</html>
