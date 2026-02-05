(function() {
    'use strict';

    // Mobile Menu Toggle
    function initMobileMenu() {
        const menuButton = document.querySelector('.menu-toggle');
        const mainNav = document.querySelector('.main-navigation');

        if (menuButton && mainNav) {
            menuButton.addEventListener('click', function() {
                mainNav.classList.toggle('active');
                menuButton.setAttribute('aria-expanded', mainNav.classList.contains('active'));
            });
        }
    }

    // Smooth Scrolling
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                const target = document.querySelector(href);
                if (!target) return;

                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });
    }

    // Lazy Load Images
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initMobileMenu();
            initSmoothScroll();
            initLazyLoad();
        });
    } else {
        initMobileMenu();
        initSmoothScroll();
        initLazyLoad();
    }
})();