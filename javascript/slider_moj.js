let currentIndex = 0;
const images = document.querySelectorAll('.brand_slider_image');
const totalImages = images.length;

function slideImages() {
    currentIndex = (currentIndex + 1) % totalImages;
    const offset = -currentIndex * 100;  // Posunie obrázky o 100% šírky
    images.forEach(image => {
        image.style.transform = `translateX(${offset}%)`;
    });
}

// Spustí slide každé 3 sekundy
setInterval(slideImages, 1000);
