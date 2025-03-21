document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("page_list");
    const leftArrow = document.getElementById("prevBtn");
    const rightArrow = document.getElementById("nextBtn");

    const scrollAmount = 84; // Posunie o šírku tlačidla

    function checkButtons() {
        const maxScrollLeft = container.scrollWidth - container.clientWidth;

        //vypni ak sme na začiatku
        leftArrow.disabled = container.scrollLeft <= 0;

        //vypni ak sme na konci
        rightArrow.disabled = container.scrollLeft >= maxScrollLeft - 1;
    }

    leftArrow.addEventListener("click", function () {
        container.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    rightArrow.addEventListener("click", function () {
        container.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });

    container.addEventListener("scroll", checkButtons);
});