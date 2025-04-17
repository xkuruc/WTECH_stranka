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

  filled_track.style.left = `calc(${min_percent}%)`; /* v css taktiež posúvam filled track o 12px, čiže na stred thumb */
  filled_track.style.width = `calc(${max_percent - min_percent}% )`; /* odrátam 12px, pretože thumb má 24px, tak aby to bolo v strede */
}


/* resetne slider keď odkliknem a nechám prázdne políčko */
function reset_input_on_blur(input, slider, defaultValue) {
  input.addEventListener("blur", function() {
    if (input.value.trim() === "") {
      input.value = defaultValue;
      slider.value = defaultValue;
      update_filled_slider();
    }
  });
}


/* event handling */
/* uloženie min filtra */
min_slider.addEventListener("input", (event) => {
    if (parseInt(min_slider.value) >= parseInt(max_slider.value)) {
      min_slider.value = max_slider.value - 1; // aby neprekročil maximum
    }

    price_input_min.value = event.target.value;
    update_filled_slider();
});


/* pridanie aktívneho filtra */
min_slider.addEventListener("change", function() {
  add_filter("price",parseInt(this.value),"min");
});


/* pridanie aktívneho filtra */
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
  }
  update_filled_slider();
});


/* to isté pre max input */
price_input_max.addEventListener("keyup", (event) => {
  if (event.target.value === "" || isNaN(event.target.value )) { /* prázdny input dáva NaN */
      min_slider.value = 0;
    }
  else {
    max_slider.value = Math.max(parseInt(event.target.value),parseInt(min_slider.value));
  }
  update_filled_slider();
});


reset_input_on_blur(price_input_min, min_slider, slider_min);
reset_input_on_blur(price_input_max, max_slider, slider_max);
update_filled_slider();