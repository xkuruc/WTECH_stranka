document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("sliding_filter");
    const leftArrow = document.getElementById("left_arrow");
    const rightArrow = document.getElementById("right_arrow");

    // Nastavíme hodnotu posunu
    const scrollAmount = 160; // Posunie o šírku tlačidla

    leftArrow.addEventListener("click", function () {
        container.scrollLeft -= scrollAmount;
    });

    rightArrow.addEventListener("click", function () {
        container.scrollLeft += scrollAmount;
    });

    // Funkcia na kontrolu viditeľnosti šípok
    function checkArrows() {
        if (container.scrollLeft <= 0) {
            leftArrow.style.opacity = "0.5"; // Znížime priehľadnosť
            leftArrow.style.pointerEvents = "none"; // Zablokujeme kliknutie
        } else {
            leftArrow.style.opacity = "1";
            leftArrow.style.pointerEvents = "auto";
        }

        if (container.scrollLeft + container.clientWidth >= container.scrollWidth) {
            rightArrow.style.opacity = "0.5";
            rightArrow.style.pointerEvents = "none";
        } else {
            rightArrow.style.opacity = "1";
            rightArrow.style.pointerEvents = "auto";
        }
    }

    // Sledujeme scroll a upravujeme šípky
    container.addEventListener("scroll", checkArrows);
    window.addEventListener("resize", checkArrows);

    // Inicializácia kontroly pri načítaní stránky
    checkArrows();
});
