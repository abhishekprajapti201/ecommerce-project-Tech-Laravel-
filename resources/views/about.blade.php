@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About CharatBox - Medical Equipment Solutions</title>
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

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .equipment-image {
            transition: transform 0.5s ease;
        }

        .equipment-image:hover {
            transform: scale(1.03);
        }

        .value-card:hover .value-icon {
            transform: rotateY(180deg);
        }
    </style>
</head>

<body class="bg-bgprimary text-textprimary">
    <!-- Hero Section -->
    <section class="py-16 bg-gradient-to-r from-primary/10 to-secondary/10">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center fade-in">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Advancing Healthcare Through Innovation</h1>
                <p class="text-xl text-textsecondary mb-8">CharatBox provides cutting-edge medical equipment solutions to healthcare providers worldwide, helping them deliver exceptional patient care.</p>
                <button class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary/90 transition">Our Story</button>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-bgsecondary">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h2 class="text-3xl font-bold mb-6">Our Mission</h2>
                    <p class="text-textsecondary mb-4">At CharatBox, we're dedicated to improving patient outcomes by providing healthcare professionals with reliable, innovative medical equipment.</p>
                    <p class="text-textsecondary mb-6">We believe that access to quality medical technology should be seamless, affordable, and tailored to the unique needs of each healthcare facility.</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-heartbeat text-primary text-xl"></i>
                        </div>
                        <p class="font-semibold">Trusted by over 500 medical facilities worldwide</p>
                    </div>
                </div>
                <div class="fade-in">
                    <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1473&q=80" alt="CharatBox medical equipment" class="rounded-lg shadow-lg equipment-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-bgprimary">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto mb-12 fade-in">
                <h2 class="text-3xl font-bold mb-4">Our Core Values</h2>
                <p class="text-textsecondary">These principles guide everything we do at CharatBox</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-bgsecondary p-6 rounded-lg shadow-md hover:shadow-lg transition fade-in value-card">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-4 value-icon transition-transform duration-500">
                        <i class="fas fa-lightbulb text-primary text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Innovation</h3>
                    <p class="text-textsecondary">We continuously research and develop new technologies to stay at the forefront of medical equipment innovation.</p>
                </div>

                <div class="bg-bgsecondary p-6 rounded-lg shadow-md hover:shadow-lg transition fade-in value-card">
                    <div class="w-14 h-14 bg-secondary/10 rounded-full flex items-center justify-center mb-4 value-icon transition-transform duration-500">
                        <i class="fas fa-shield-alt text-secondary text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Reliability</h3>
                    <p class="text-textsecondary">Our equipment is built to the highest standards of quality and durability for critical healthcare environments.</p>
                </div>

                <div class="bg-bgsecondary p-6 rounded-lg shadow-md hover:shadow-lg transition fade-in value-card">
                    <div class="w-14 h-14 bg-accent/10 rounded-full flex items-center justify-center mb-4 value-icon transition-transform duration-500">
                        <i class="fas fa-handshake text-accent text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Partnership</h3>
                    <p class="text-textsecondary">We work closely with healthcare providers to understand their needs and deliver tailored solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipment Showcase -->
    <section class="py-16 bg-gradient-to-r from-primary/5 to-secondary/5">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto mb-12 fade-in">
                <h2 class="text-3xl font-bold mb-4">Our Medical Equipment</h2>
                <p class="text-textsecondary">State-of-the-art equipment for modern healthcare facilities</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-bgsecondary rounded-lg overflow-hidden shadow-md fade-in">
                    <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" alt="Diagnostic equipment" class="w-full h-48 object-cover equipment-image">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Diagnostic Systems</h3>
                        <p class="text-textsecondary">Advanced imaging and diagnostic equipment for accurate patient assessment.</p>
                    </div>
                </div>

                <div class="bg-bgsecondary rounded-lg overflow-hidden shadow-md fade-in">
                    <img src="https://images.unsplash.com/photo-1584614375600-ca0638f21602?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" alt="Monitoring equipment" class="w-full h-48 object-cover equipment-image">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Patient Monitoring</h3>
                        <p class="text-textsecondary">Real-time monitoring systems for continuous patient care and safety.</p>
                    </div>
                </div>

                <div class="bg-bgsecondary rounded-lg overflow-hidden shadow-md fade-in">
                    <img src="https://images.unsplash.com/photo-1582719471384-8946bb3d3e72?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" alt="Surgical equipment" class="w-full h-48 object-cover equipment-image">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Surgical Solutions</h3>
                        <p class="text-textsecondary">Precision instruments and equipment for surgical departments.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Team Section -->
    <section class="py-16 bg-bgprimary">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto mb-12 fade-in">
                <h2 class="text-3xl font-bold mb-4">Our Leadership</h2>
                <p class="text-textsecondary">Meet the experts driving innovation at CharatBox</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center fade-in">
                    <div class="w-48 h-48 mx-auto mb-6 rounded-full bg-primary/10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1573496799652-408c2ac9fe98?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="CEO" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold">Dr. Sarah Johnson</h3>
                    <p class="text-textsecondary mb-3">Chief Executive Officer</p>
                    <p class="text-sm text-textsecondary">With over 20 years in medical technology, Dr. Johnson leads our vision for innovative healthcare solutions.</p>
                </div>

                <div class="text-center fade-in">
                    <div class="w-48 h-48 mx-auto mb-6 rounded-full bg-secondary/10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="CTO" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold">Michael Chen</h3>
                    <p class="text-textsecondary mb-3">Chief Technology Officer</p>
                    <p class="text-sm text-textsecondary">Michael drives our R&D initiatives, ensuring we remain at the forefront of medical equipment innovation.</p>
                </div>

                <div class="text-center fade-in">
                    <div class="w-48 h-48 mx-auto mb-6 rounded-full bg-accent/10 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1361&q=80" alt="COO" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold">Elena Rodriguez</h3>
                    <p class="text-textsecondary mb-3">Chief Operations Officer</p>
                    <p class="text-sm text-textsecondary">Elena ensures our operations run smoothly and our clients receive exceptional service and support.</p>
                </div>
            </div>
        </div>
    </section>



    <script>
        // Fade-in animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');

            const fadeInOptions = {
                threshold: 0.3,
                rootMargin: "0px 0px -50px 0px"
            };

            const fadeInObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, fadeInOptions);

            fadeElements.forEach(element => {
                fadeInObserver.observe(element);
            });
        });
    </script>
</body>

</html>
@endsection
@extends('layouts.app')