


const minSlider = document.querySelector(".minSlider");
const maxSlider = document.querySelector(".maxSlider");
const priceInputMin = document.querySelector(".minPrice");
const priceInputMax = document.querySelector(".maxPrice");
let filledTrack = document.getElementById("filledTrack");


const min = minSlider.min;
const max = maxSlider.max;


const minGap = 1500;
const range = document.querySelector(".slider-track");




let timeout;







minSlider.addEventListener("input", (event) => {

    if (parseInt(minSlider.value) >= parseInt(maxSlider.value)) {
      minSlider.value = maxSlider.value - 1; // aby neprekročil maximum
    }
    priceInputMin.value = event.target.value;

    update_filled_slider();
});


/* uloženie filtra */
minSlider.addEventListener("change", function() {
  add_filter("price",parseInt(this.value),"min");
});

maxSlider.addEventListener("change", function() {
  add_filter("price",parseInt(this.value),"max");
});




maxSlider.addEventListener("input", (event) => {
    if (parseInt(maxSlider.value) <= parseInt(minSlider.value)) {
      maxSlider.value = parseInt(minSlider.value) + 1; // aby neprekročil minimum
    }

    priceInputMax.value = event.target.value;
    update_filled_slider();
  

});




add_filter("price",700,"max");







function update_filled_slider() {
  let minPercent = ((minSlider.value - minSlider.min) / (maxSlider.max - minSlider.min)) * 100;
  let maxPercent = ((maxSlider.value - minSlider.min) / (maxSlider.max - minSlider.min)) * 100;

  filledTrack.style.left = minPercent + 1 +"%" ;
  filledTrack.style.width = (maxPercent - minPercent) - 2 + "%";



}



update_filled_slider();


