$(document).ready(function() {
    $('.slider-container').each(function(){
      var container = $(this);
      var owl = container.find('.owl-carousel');
      
      owl.owlCarousel({
        autoPlay: 2000,
        itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
        pagination:false,
        // margin: 40,
        loop: true,             // umozni nekonecne opakovanie carouselu
        autoplay: true,         // zapne automatické prehrávanie
        autoplayTimeout: 1500,  // interval medzi prechodmi (v ms)
        autoplayHoverPause: true, // zastavi autoplay, keď prejdeš myšou nad carousel 
        center: true,  //
        // responsive: {   
        //   0: { items: 1, margin: 40},   // pod 600px zobrazí 1 položku
        //   700: { items: 2, margin: 40 }, // medzi 600px a 900px zobrazí 2 položky
        //   1000: { items: 3, margin: 40 }, // medzi 900px a 1200px zobrazí 3 položky
        //   1200: { items: 4 , margin: 40}  // nad 1200px zobrazí 4 položky
        // }
        responsive: {   
          0: { items: 1},   // pod 600px zobrazí 1 položku
          700: { items: 2 }, // medzi 600px a 900px zobrazí 2 položky
          1000: { items: 3 }, // medzi 900px a 1200px zobrazí 3 položky
          1200: { items: 4 }  // nad 1200px zobrazí 4 položky
        }
      });
      
      container.find('.next').click(function(){
        owl.trigger('next.owl.carousel');
      });
      container.find('.prev').click(function(){
        owl.trigger('prev.owl.carousel');
      });
    });
  });
  