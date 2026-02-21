import './bootstrap';
// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');

            // Toggle icon between menu and X
            const icon = mobileMenuButton.querySelector('i');
            if (mobileMenu.classList.contains('hidden')) {
                icon.setAttribute('data-lucide', 'menu');
            } else {
                icon.setAttribute('data-lucide', 'x');
            }

            // Re-initialize Lucide icons
            lucide.createIcons();
        });
    }

    // Category card hover effects and click handlers
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('click', function () {
            const categoryName = this.querySelector('h3').textContent;
            console.log(`Clicked on category: ${categoryName}`);
            // Add your category navigation logic here
        });

        // Add subtle animation on hover
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Search functionality
    const searchInputs = document.querySelectorAll('input[placeholder="Search equipment..."]');
    searchInputs.forEach(input => {
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    console.log(`Searching for: ${searchTerm}`);
                    // Add your search logic here
                }
            }
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add scroll effect to header
    let lastScrollTop = 0;
    const header = document.querySelector('header');

    window.addEventListener('scroll', function () {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            header.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            header.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop;
    });

    // Add loading animation for category cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Initially hide cards for animation
    categoryCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });

    // Color theme management
    window.MedicalEquipmentTheme = {
        // Function to change the primary color throughout the site
        changePrimaryColor: function (newColor) {
            document.documentElement.style.setProperty('--color-primary', newColor);
            console.log(`Primary color changed to: ${newColor}`);
        },

        // Function to change the secondary color throughout the site
        changeSecondaryColor: function (newColor) {
            document.documentElement.style.setProperty('--color-secondary', newColor);
            console.log(`Secondary color changed to: ${newColor}`);
        },

        // Function to change the accent color throughout the site
        changeAccentColor: function (newColor) {
            document.documentElement.style.setProperty('--color-accent', newColor);
            console.log(`Accent color changed to: ${newColor}`);
        },

        // Function to reset to default colors
        resetColors: function () {
            document.documentElement.style.setProperty('--color-primary', '14 165 233');
            document.documentElement.style.setProperty('--color-secondary', '34 197 94');
            document.documentElement.style.setProperty('--color-accent', '249 115 22');
            console.log('Colors reset to default');
        }
    };

    // Example usage (uncomment to test):
    // setTimeout(() => {
    //     MedicalEquipmentTheme.changePrimaryColor('139 69 19'); // Brown
    // }, 3000);
});

// Utility functions for Laravel integration
window.MedicalEquipmentUtils = {
    // Function to handle AJAX requests for Laravel
    makeRequest: function (url, method = 'GET', data = null) {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        };

        if (data && method !== 'GET') {
            options.body = JSON.stringify(data);
        }

        return fetch(url, options)
            .then(response => response.json())
            .catch(error => {
                console.error('Request failed:', error);
                throw error;
            });
    },

    // Function to show notifications
    showNotification: function (message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                    type === 'warning' ? 'bg-yellow-500 text-black' :
                        'bg-blue-500 text-white'
            }`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000);
    }
};

