let slides = document.querySelectorAll('.slide');
let index = 0;

function showSlide() {
    slides.forEach((slide, i) => {
        slide.style.transform = `translateX(${(i - index) * 100}%)`;
    });
}

function nextSlide() {
    index = (index + 1) % slides.length;
    showSlide();
}

setInterval(nextSlide, 5000); // Change slide every 5 seconds
