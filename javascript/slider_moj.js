const sliderTrack = document.querySelector('.brand_slider_placeholder');
const imageWidth = 100; // sirka kazdeho obrazka (musi sediet s CSS)
const gap = 100 // gap vo pixeloch 
const slideSpeed = imageWidth+ gap;  // Pocet pixelov, o kolko sa posunie v jednom intervale

// na zaciatku to posuniem vsetko o 30 px aby to bolo krajsie, a plynulejsie prechody
Array.from(sliderTrack.children).forEach(elem => {
    let currentX = 0;
    const match = elem.style.transform.match(/-?\d+/);
    if (match) {
      currentX = parseInt(match[0], 10);
    }
    elem.style.transform = `translateX(${currentX + 30}px)`;
});

function slideImages() {
    const images = sliderTrack.children;
    // Posunie vsetky obrazky dolava
    Array.from(images).forEach(elem => {
      let currentX = 0;
      const match = elem.style.transform.match(/-?\d+/); // zisti aktualnu hodnotu argumentu vo transformX , to dnuka je regex
      if (match) {
        currentX = parseInt(match[0], 10); // ak najde tak to pretypuje do 10-sustavy
      }
      elem.style.transform = `translateX(${currentX - slideSpeed}px)`;
    });
    
    for (let i = images.length - 1; i >= 0; i--) {
        if (images[i].getBoundingClientRect().right < sliderTrack.getBoundingClientRect().left) {
            const clone = images[i].cloneNode(true);
            sliderTrack.appendChild(clone);
            // const clone2 = images[i+1].cloneNode(true);    
            // sliderTrack.appendChild(clone2);
            break;
        }    
    }
}
  
setInterval(slideImages, 2000);

