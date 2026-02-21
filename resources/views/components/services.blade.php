<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<head>
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
</head>

<body class="bg-bgprimary text-textprimary">
    <!-- Categories Section -->
    <section class="py-16 px-4 md:px-8">
        <div class="container mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Featured Categories</h2>
                <p class="text-textsecondary max-w-2xl mx-auto">
                    Discover our wide range of medical equipment and solutions tailored for healthcare professionals
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Category 1: General Medicine -->
                <div class="bg-bgsecondary rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <img src="{{ asset('assets/images/general-medicine.jpg') }}" alt="General Medicine" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">General Medicine</h3>
                        <p class="text-textsecondary mb-4">
                            Comprehensive medical equipment for general healthcare practices and facilities.
                        </p>
                        <a href="#" class="text-primary font-semibold flex items-center">
                            <span>Explore Products</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 2: Veterinary Machine -->
                <div class="bg-bgsecondary rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <img src="{{ asset('images/dog.jpg') }}" alt="Automotive Spare Parts" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">Veterinary Machine</h3>
                        <p class="text-textsecondary mb-4">
                            Specialized equipment for animal healthcare and veterinary practices.
                        </p>
                        <a href="#" class="text-primary font-semibold flex items-center">
                            <span>Explore Products</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 3: Automotive Spare Parts -->
                <div class="bg-bgsecondary rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <img src="{{ asset('images/spare.jpg') }}" alt="Automotive Spare Parts" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">Automotive Spare Parts</h3>
                        <p class="text-textsecondary mb-4">
                            High-quality automotive parts for medical vehicle maintenance and repair.
                        </p>
                        <a href="#" class="text-primary font-semibold flex items-center">
                            <span>Explore Products</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 4: Accessories -->
                <div class="bg-bgsecondary rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <img src="{{ asset('images/parts.jpg') }}" alt="Automotive Spare Parts" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">Accessories</h3>
                        <p class="text-textsecondary mb-4">
                            Essential accessories and components for medical equipment.
                        </p>
                        <a href="#" class="text-primary font-semibold flex items-center">
                            <span>Explore Products</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 5: Lubricant -->
                <div class="bg-bgsecondary rounded-xl shadow-md border border-gray-100 overflow-hidden">
                    <img src="{{ asset('images/lubricants.jpg') }}" alt="Automotive Spare Parts" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-2">Lubricant</h3>
                        <p class="text-textsecondary mb-4">
                            Specialized lubricants for medical equipment maintenance.
                        </p>
                        <a href="#" class="text-primary font-semibold flex items-center">
                            <span>Explore Products</span>
                            <i class="fas fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>