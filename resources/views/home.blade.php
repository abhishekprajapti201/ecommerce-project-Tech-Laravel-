@extends('layouts.app')

@section('content')




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charat Box - Medical Equipment Provider</title>
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
          },
          animation: {
            'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
          }
        }
      }
    }
  </script>
  <style type="text/css">
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
  </style>
</head>

<body class="bg-bgprimary text-textprimary">


  <!-- Hero Section -->
  <section class="py-12 md:py-20 px-4 md:px-8">
    <div class="container mx-auto">
      <div class="flex flex-col md:flex-row items-center hero-content">
        <!-- Text Content -->
        <div class="md:w-1/2 mb-12 md:mb-0 md:pr-10">
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
            Advanced Medical Equipment <span class="text-primary">Solutions</span>
          </h1>
          <p class="text-lg text-textsecondary mb-8 max-w-lg">
            Charat Box provides state-of-the-art medical equipment and technology to healthcare facilities, ensuring the highest standards of patient care and medical excellence.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 mb-10">
            <button class="bg-primary hover:bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg flex items-center justify-center">
              <i class="fas fa-box-open mr-2"></i> Explore Products
            </button>
            <button class="border border-neutral hover:border-primary text-textprimary font-semibold py-3 px-8 rounded-lg transition duration-300 flex items-center justify-center">
              <i class="fas fa-headset mr-2"></i> Contact Sales
            </button>
          </div>

          <div class="flex flex-wrap gap-6">
            <div class="flex items-center">
              <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-secondary mr-3">
                <i class="fas fa-check-circle"></i>
              </div>
              <span>Certified Equipment</span>
            </div>
            <div class="flex items-center">
              <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-primary mr-3">
                <i class="fas fa-truck"></i>
              </div>
              <span>Fast Delivery</span>
            </div>
          </div>
        </div>

        <!-- Visual Content -->
        <div class="md:w-1/2 flex justify-center relative">
          <div class="relative w-full max-w-lg">
            <!-- Main image/illustration area -->
            <div class="bg-white p-6 rounded-2xl shadow-xl floating">
              <div class="bg-gradient-to-r from-primary to-blue-400 rounded-xl h-64 flex items-center justify-center">
                <i class="fas fa-heartbeat text-white text-7xl"></i>
              </div>
            </div>

            <!-- Floating elements -->
            <div class="absolute -top-4 -left-4 bg-white p-4 rounded-xl shadow-md floating" style="animation-delay: 1s;">
              <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-primary">
                <i class="fas fa-stethoscope text-xl"></i>
              </div>
            </div>

            <div class="absolute -bottom-4 -right-4 bg-white p-4 rounded-xl shadow-md floating" style="animation-delay: 2s;">
              <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-secondary">
                <i class="fas fa-procedures text-xl"></i>
              </div>
            </div>

            <div class="absolute top-1/3 -right-6 bg-white p-3 rounded-lg shadow-md floating" style="animation-delay: 1.5s;">
              <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-accent">
                <i class="fas fa-syringe"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <x-services />

  <!-- Stats Section -->
  <section class="mt-16 bg-gradient-to-r from-primary to-blue-900 p-8 md:p-12 text-white shadow-2xl rounded-2xl w-full">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">

      <!-- Stat Item -->
      <div class="text-center p-4">
        <div class="text-4xl font-extrabold mb-2">500+</div>
        <div class="text-lg opacity-90">Medical Products Delivered</div>
      </div>

      <!-- Stat Item -->
      <div class="text-center p-4">
        <div class="text-4xl font-extrabold mb-2">15+</div>
        <div class="text-lg opacity-90">Years Serving Healthcare</div>
      </div>

      <!-- Stat Item -->
      <div class="text-center p-4">
        <div class="text-4xl font-extrabold mb-2">300+</div>
        <div class="text-lg opacity-90">Hospitals & Clinics Trusted</div>
      </div>

      <!-- Stat Item -->
      <div class="text-center p-4">
        <div class="text-4xl font-extrabold mb-2">24/7</div>
        <div class="text-lg opacity-90">Customer Support</div>
      </div>

    </div>
  </section>


  <!-- Features Section -->
  <section class="py-16 bg-bgsecondary px-4">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center mb-12">Why Choose Charat Box?</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Feature 1 -->
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-shield-alt text-primary text-2xl"></i>
          </div>
          <h3 class="font-semibold text-lg mb-2">Quality Certified</h3>
          <p class="text-textsecondary">All our equipment meets international quality standards and certifications.</p>
        </div>

        <!-- Feature 2 -->
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-tools text-secondary text-2xl"></i>
          </div>
          <h3 class="font-semibold text-lg mb-2">Maintenance Support</h3>
          <p class="text-textsecondary">Comprehensive maintenance and support services for all products.</p>
        </div>

        <!-- Feature 3 -->
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
          <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-graduation-cap text-accent text-2xl"></i>
          </div>
          <h3 class="font-semibold text-lg mb-2">Training Programs</h3>
          <p class="text-textsecondary">We provide training for medical staff on equipment usage.</p>
        </div>

        <!-- Feature 4 -->
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
          <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-hand-holding-usd text-neutral text-2xl"></i>
          </div>
          <h3 class="font-semibold text-lg mb-2">Flexible Financing</h3>
          <p class="text-textsecondary">Various payment and financing options available for all needs.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ-->
  <x-faq />


  <script>
    // Mobile menu toggle
    document.getElementById('menu-toggle').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });

    // Simple animation for elements when they come into view
    function checkVisibility() {
      const elements = document.querySelectorAll('.bg-white');

      elements.forEach(element => {
        const position = element.getBoundingClientRect();

        // If the element is in the viewport
        if (position.top < window.innerHeight && position.bottom >= 0) {
          element.classList.add('animate-pulse-slow');
        }
      });
    }

    // Check on load and scroll
    window.addEventListener('load', checkVisibility);
    window.addEventListener('scroll', checkVisibility);

    // Button hover effects
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
      button.addEventListener('mouseenter', function() {
        if (this.textContent.includes('Explore Products') || this.textContent.includes('Contact Us Today')) {
          this.classList.add('shadow-xl');
        }
      });

      button.addEventListener('mouseleave', function() {
        if (this.textContent.includes('Explore Products') || this.textContent.includes('Contact Us Today')) {
          this.classList.remove('shadow-xl');
        }
      });
    });
  </script>
</body>

</html>






@endsection