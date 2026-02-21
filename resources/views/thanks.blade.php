@extends('layouts.app')
@section('content')
<section class="bg-gray-50 py-auto flex items-center justify-center py-28 px-6">
    <div class="bg-white shadow-lg rounded p-10 w-xl text-center border border-pink-100">
        <!-- Success Icon -->
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-pink-100 text-pink-600 flex items-center justify-center rounded-full">
                <i class="fa-solid fa-circle-check text-4xl"></i>
            </div>
        </div>

        <!-- Thank You -->
        <h2 class="text-3xl text-gray-800 mb-2">Thank You for Your Order!</h2>
        <p class="text-gray-600 mb-6">Your orders will be on its way soon <i class="fa-solid fa-splotch"></i></p>


        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" class="flex-1  text-pink-600 hover:text-pink-700 hover:underline transition">Continue
                Shopping <i class="fa-solid fa-arrow-right-long"></i></a>

        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>


<script>
    window.onload = function() {
        confetti({
            particleCount: 150,
            spread: 80,
            origin: {
                y: 0.6
            }
        });
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: "{{ session('success') }}",
    showConfirmButton: false,
    timer: 2000
});
</script>
@endif
@endsection