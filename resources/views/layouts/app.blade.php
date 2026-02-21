<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Charat Box</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Responsive Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-50">

    <!-- header -->
    @include('components.header')

    {{-- Page Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- WhatsApp Button --}}
    <a href="https://wa.me/919999999999" target="_blank"
        class="fixed bottom-10 right-4 bg-green-500 text-white p-3 rounded-full shadow-lg hover:bg-green-600 transition z-50 float-animation">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>

    <!-- footer -->
    @include('components.footer')
</body>

</html>