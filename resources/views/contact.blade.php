@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.tailwindcss.com"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
</style>


<body>
    <div class="max-w-6xl w-full mx-auto p-10">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <!-- Contact Information Section -->
                <div class="md:w-2/5 bg-gradient-to-br from-blue-600 to-purple-800 text-white p-8 md:p-10">
                    <div class="mb-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-box text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold ml-4">Charat Box</h2>
                        </div>
                        <p class="text-purple-100 opacity-90">Get in touch with us. We're here to help you with any questions about our character subscription boxes.</p>
                    </div>

                    <div class="space-y-6 mb-10">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold">Our Office</h3>
                                <p class="text-purple-100 text-sm mt-1">123 Innovation Drive<br>San Francisco, CA 94107</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold">Phone</h3>
                                <p class="text-purple-100 text-sm mt-1">+1 (555) 123-4567</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold">Email</h3>
                                <p class="text-purple-100 text-sm mt-1">hello@charatbox.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-purple-500 border-opacity-30">
                        <h3 class="font-semibold mb-4">Follow Us</h3>
                        <div class="flex space-x-3">
                            <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center hover:bg-opacity-30 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Section -->
                <div class="md:w-3/5 p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Send us a message</h2>
                        <p class="text-gray-600">Fill out the form below and we'll get back to you as soon as possible.</p>
                    </div>

                    <form class="space-y-6" action="{{ route('contact.me') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition pl-10"
                                        placeholder="Shruti"
                                        required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition pl-10"
                                        placeholder="Singh"
                                        required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <div class="relative">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition pl-10"
                                    placeholder="john.doe@example.com"
                                    required>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition pl-10"
                                    placeholder="How can we help you?"
                                    required>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="inquiry_type" class="block text-sm font-medium text-gray-700 mb-2">Inquiry Type</label>
                            <div class="relative">
                                <select
                                    id="inquiry_type"
                                    name="inquiry_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition pl-10 appearance-none">
                                    <option value="">Select an option</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="subscription">Subscription Question</option>
                                    <option value="billing">Billing Issue</option>
                                    <option value="shipping">Shipping Question</option>
                                    <option value="other">Other</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-question-circle text-gray-400"></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <div class="relative">
                                <textarea
                                    id="message"
                                    name="message"
                                    rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition pl-10"
                                    placeholder="Tell us more about your inquiry..."
                                    required></textarea>
                                <div class="absolute top-3 left-3">
                                    <i class="fas fa-comment text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="newsletter"
                                name="newsletter"
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                                checked>
                            <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                                Subscribe to our newsletter for updates and special offers
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-purple-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-purple-700 transition focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('conatct'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: "{{ session('conatct') }}",
    showConfirmButton: false,
    timer: 3000
});
</script>
@endif

@endsection