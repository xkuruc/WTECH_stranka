/* variables */
const container = document.getElementById("sliding_filter");
const left_arrow = document.getElementById("left_arrow");
const right_arrow = document.getElementById("right_arrow");
const filter_menu_arrows = document.getElementById("filter_menu_arrows");

//hodnota posunu, 160 je veľkosť tlačidla
const scroll_amount2 = 160; 

left_arrow.addEventListener("click", function () { /* posúvam kliknutím ľavej šipky */
    container.scrollLeft -= scroll_amount2;
});

right_arrow.addEventListener("click", function () { /* posúvam kliknutím pravej šipky */
    container.scrollLeft += scroll_amount2;
});


/* scrollLeft je aktuálna pozícia scrollovania, ak je 0, tak som vľavo, ak je max, tak som vpravo, teda na konci */
function check_arrows() {
    if (container.scrollLeft <= 0) { /* viditeľnosť pre ľavú šipku */
        left_arrow.style.opacity = "0.5"; 
        left_arrow.style.pointerEvents = "none"; //zablokujeme kliknutie
    } else {
        left_arrow.style.opacity = "1";
        left_arrow.style.pointerEvents = "auto"; //povolíme kliknutie
    }

    if (container.scrollLeft + container.clientWidth >= container.scrollWidth) { /* viditeľnosť pre pravú šipku, či som na konci kontajnera */
        right_arrow.style.opacity = "0.5";
        right_arrow.style.pointerEvents = "none"; //zablokujeme kliknutie
    } else {
        right_arrow.style.opacity = "1";
        right_arrow.style.pointerEvents = "auto"; //povolíme kliknutie
    }
}

//keď sa bude scrollovať alebo ak sa bude meniť veľkosť stránky, tak sa čekne, či treba aktivovať/deaktivovať šipky
container.addEventListener("scroll", check_arrows);
window.addEventListener("resize", check_arrows);

//kontrola pri načítaní stránky
check_arrows();