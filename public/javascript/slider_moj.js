// const sliderTrack = document.querySelector('.brand_slider_placeholder');
// const imageWidth = 100; // sirka kazdeho obrazka (musi sediet s CSS)
// const gap = 100 // gap vo pixeloch 
// const slideSpeed = imageWidth+ gap;  // Pocet pixelov, o kolko sa posunie v jednom intervale

// // na zaciatku to posuniem vsetko o 30 px aby to bolo krajsie, a plynulejsie prechody
// Array.from(sliderTrack.children).forEach(elem => {
//     let currentX = 0;
//     const match = elem.style.transform.match(/-?\d+/);
//     if (match) {
//       currentX = parseInt(match[0], 10);
//     }
//     elem.style.transform = `translateX(${currentX + 30}px)`;
// });

// function slideImages() {
//     const images = sliderTrack.children;
//     // Posunie vsetky obrazky dolava
//     Array.from(images).forEach(elem => {
//       let currentX = 0;
//       const match = elem.style.transform.match(/-?\d+/); // zisti aktualnu hodnotu argumentu vo transformX , to dnuka je regex
//       if (match) {
//         currentX = parseInt(match[0], 10); // ak najde tak to pretypuje do 10-sustavy
//       }
//       elem.style.transform = `translateX(${currentX - slideSpeed}px)`;
//     });
    
//     for (let i = images.length - 1; i >= 0; i--) {
//         if (images[i].getBoundingClientRect().right < sliderTrack.getBoundingClientRect().left) {
//             const clone = images[i].cloneNode(true);
//             sliderTrack.appendChild(clone);
//             // const clone2 = images[i+1].cloneNode(true);    
//             // sliderTrack.appendChild(clone2);
//             break;
//         }    
//     }
// }
  
// setInterval(slideImages, 2000);


$(document).ready(function() {
  $('.slider-containerBRAND').each(function() {
    var $owl = $(this).find('.owl-carouselBRAND');
    $owl.owlCarousel({
      loop: true,               // nekonečné opakovanie
      autoplay: true,           // automatické prehrávanie
      autoplayTimeout: 1500,    // interval medzi prechodmi (ms)
      autoplayHoverPause: true, // pauza pri hover
      center: true,             // centrovaný aktívny item
      pagination: false,        // žiadne bodky
      nav: false,      // vypne šípky (“navigation”)
      dots: false,     // vypne bodky (“pagination”)
      responsive: {
        0:    { items: 3 },
        700:  { items: 4 },
        1000: { items: 5 },
        1200: { items: 9 }
      }
    });
  });
});