document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("page_list");
    const leftArrow = document.getElementById("prevBtn");
    const rightArrow = document.getElementById("nextBtn");

    // Nastavíme hodnotu posunu
    const scrollAmount = 84; // Posunie o šírku tlačidla

    leftArrow.addEventListener("click", function () {
        container.scrollLeft -= scrollAmount;
    });

    rightArrow.addEventListener("click", function () {
        container.scrollLeft += scrollAmount;
    });

    // Funkcia na kontrolu viditeľnosti šípok
    

    // Sledujeme scroll a upravujeme šípky
    container.addEventListener("scroll", checkArrows);
    window.addEventListener("resize", checkArrows);

    // Inicializácia kontroly pri načítaní stránky
    checkArrows();
});