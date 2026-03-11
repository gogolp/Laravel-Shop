document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.location-slide');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const dotsContainer = document.querySelector('.slider-dots');
    const dots = document.querySelectorAll('.dot');
    let currentIndex = 0;

    function updateSlider() {
        slides.forEach((slide, index) => {
            slide.classList.remove('active-slide');

            if (index === currentIndex) {
                slide.style.transform = 'translateX(0)';
                slide.classList.add('active-slide');
            } else if (index < currentIndex) {
                slide.style.transform = 'translateX(-100%)';
            } else {
                slide.style.transform = 'translateX(100%)';
            }
        });

        dots.forEach((dot, index) => {
            dot.classList.toggle('active-dot', index === currentIndex);
        });
    }

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlider();
    });

    dotsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('dot')) {
            const index = parseInt(event.target.dataset.index);
            if (!isNaN(index) && index !== currentIndex) {
                currentIndex = index;
                updateSlider();
            }
        }
    });

    updateSlider();
});