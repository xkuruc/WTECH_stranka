/* variables */
const page_list = document.getElementById("page_list");
const left_btn = document.getElementById("prev_page_btn");
const right_btn = document.getElementById("next_page_btn");

const scroll_amount = 84; // Posunie o šírku tlačidla

function check_btns() {
    const max_scroll_left = page_list.scrollWidth - page_list.clientWidth;

    //vypni ak sme na začiatku
    left_btn.disabled = page_list.scrollLeft <= 0;

    //vypni ak sme na konci
    right_btn.disabled = page_list.scrollLeft >= max_scroll_left - 1;
}

left_btn.addEventListener("click", function () {
    page_list.scrollBy({ left: -scroll_amount, behavior: "smooth" });
});

right_btn.addEventListener("click", function () {
    page_list.scrollBy({ left: scroll_amount, behavior: "smooth" });
});

page_list.addEventListener("scroll", check_btns); /* pri scrollovaní sa cekuje či sa má niečo spraviť s šipkami */