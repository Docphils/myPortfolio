import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const uiRuntime = {
    testimonialIntervals: [],
};

document.addEventListener('DOMContentLoaded', () => {
    setupLivewireScrollEvents();
    bootPageUi();
});

document.addEventListener('livewire:navigating', () => {
    cleanupRuntime();
});

document.addEventListener('livewire:navigated', () => {
    bootPageUi();
});

function bootPageUi() {
    setupMobileMenu();
    setupScrollReveal();
    setupCounterAnimation();
    setupTestimonialRotation();
    applyHashScroll();
}

function cleanupRuntime() {
    uiRuntime.testimonialIntervals.forEach((id) => clearInterval(id));
    uiRuntime.testimonialIntervals = [];
}

function setupMobileMenu() {
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (!menuButton || !mobileMenu || menuButton.dataset.bound === '1') {
        return;
    }

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    menuButton.dataset.bound = '1';
}

function setupScrollReveal() {
    const animatedElements = document.querySelectorAll('[data-animate]:not([data-reveal-bound="1"])');
    if (animatedElements.length === 0) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('animate-pending');
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px',
        }
    );

    animatedElements.forEach((element) => {
        element.classList.add('animate-pending');
        element.dataset.revealBound = '1';
        observer.observe(element);
    });
}

function setupCounterAnimation() {
    const counters = document.querySelectorAll('[data-counter]:not([data-counter-bound="1"])');
    if (counters.length === 0) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const counter = entry.target;
                const targetValue = Number(counter.getAttribute('data-counter') || 0);
                animateCounter(counter, targetValue, 1800);
                observer.unobserve(counter);
            });
        },
        { threshold: 0.5 }
    );

    counters.forEach((counter) => {
        counter.dataset.counterBound = '1';
        observer.observe(counter);
    });
}

function animateCounter(element, target, duration) {
    const startTime = performance.now();

    const update = (currentTime) => {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(target * eased);
        element.textContent = current.toString();

        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            element.textContent = target.toString();
        }
    };

    requestAnimationFrame(update);
}

function setupTestimonialRotation() {
    const stages = document.querySelectorAll('.testimonial-stage');

    stages.forEach((stage) => {
        if (stage.dataset.rotationBound === '1') {
            return;
        }

        const slides = stage.querySelectorAll('.testimonial-slide');
        const dots = stage.querySelectorAll('.testimonial-dot');

        if (slides.length === 0 || dots.length === 0) {
            return;
        }

        let activeIndex = 0;

        const showSlide = (index) => {
            slides.forEach((slide, i) => {
                slide.classList.toggle('is-active', i === index);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('is-active', i === index);
            });
        };

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                activeIndex = index;
                showSlide(activeIndex);
            });
        });

        if (slides.length > 1) {
            const intervalId = setInterval(() => {
                activeIndex = (activeIndex + 1) % slides.length;
                showSlide(activeIndex);
            }, 4500);

            uiRuntime.testimonialIntervals.push(intervalId);
        }

        stage.dataset.rotationBound = '1';
    });
}

function setupLivewireScrollEvents() {
    if (window.__livewireScrollEventBound) {
        return;
    }

    window.addEventListener('scroll-to', (event) => {
        const target = event.detail?.target;
        if (!target) {
            return;
        }

        const section = document.getElementById(target);
        if (!section) {
            return;
        }

        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    window.__livewireScrollEventBound = true;
}

function applyHashScroll() {
    if (!window.location.hash) {
        return;
    }

    const id = window.location.hash.slice(1);
    if (!id) {
        return;
    }

    const section = document.getElementById(id);
    if (!section) {
        return;
    }

    setTimeout(() => {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 40);
}
