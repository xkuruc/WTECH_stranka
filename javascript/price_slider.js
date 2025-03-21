/* variables */
const min_slider = document.querySelector(".min_slider");
const max_slider = document.querySelector(".max_slider");
const price_input_min = document.querySelector(".min_price");
const price_input_max = document.querySelector(".max_price");
let filled_track = document.getElementById("filled_track");

const slider_min = min_slider.min;
const slider_max = max_slider.max;



/* funkcie */
function set_slider(type,value) {
  if (type === "min") {
    min_slider.value = value;
    price_input_min.value = value;
  }
  else {
    max_slider.value = value;
    price_input_max.value = value;
  }
}





/* vykreslí/upraví ten vyfarbený slider medzi thumbs sliderov */
function update_filled_slider() {
  let min_percent = ((min_slider.value - slider_min) / (slider_max - slider_min)) * 100;
  let max_percent = ((max_slider.value - slider_min) / (slider_max - slider_min)) * 100;

  filled_track.style.left = min_percent + 1 +"%" ;
  filled_track.style.width = Math.max((max_percent - min_percent) - 2,0) + "%"; /* bol tu problém, že ak boli na rovnakom mieste, tak bola záporná šírka */
}





/* event handling */
min_slider.addEventListener("input", (event) => {
    if (parseInt(min_slider.value) >= parseInt(max_slider.value)) {
      min_slider.value = max_slider.value - 1; // aby neprekročil maximum
    }

    price_input_min.value = event.target.value;
    update_filled_slider();
});


/* uloženie min filtra */
min_slider.addEventListener("change", function() {
  add_filter("price",parseInt(this.value),"min");
});

max_slider.addEventListener("change", function() {
  add_filter("price",parseInt(this.value),"max");
});



/* uloženie max filtra */
max_slider.addEventListener("input", (event) => {
  if (parseInt(max_slider.value) <= parseInt(min_slider.value)) {
    max_slider.value = parseInt(min_slider.value) + 1; // aby neprekročil minimum
  }

  price_input_max.value = event.target.value;
  update_filled_slider();
});



/* zmena slidera keď píšem do inputu */
price_input_min.addEventListener("keyup", (event) => {
  if (event.target.value === "" || isNaN(event.target.value )) { /* prázdny input dáva NaN */
    min_slider.value = 0;
  }
  else {
    min_slider.value = Math.min(parseInt(event.target.value),parseInt(max_slider.value));
    update_filled_slider();
  }
});


price_input_max.addEventListener("keyup", (event) => {
  if (event.target.value === "" || isNaN(event.target.value )) { /* prázdny input dáva NaN */
      min_slider.value = 0;
    }
  else {
    max_slider.value = Math.max(parseInt(event.target.value),parseInt(min_slider.value));
    update_filled_slider();
  }
});






update_filled_slider();