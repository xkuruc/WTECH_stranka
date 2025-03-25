// $(document).ready(function() {
//     var owl = $("#owl-demo");
//     owl.owlCarousel({
//         // autoPlay: 1500,
//         autoPlay: 100,
//         items : 4, //10 items above 1000px browser width
//         itemsDesktop : [1000,4], //5 items between 1000px and 901px
//         itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
//         itemsTablet: [600,2], //2 items between 600 and 0;
//         itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
//         pagination:false,
//         margin: 20,
//         loop: true,             // umozni nekonecne opakovanie carouselu
//         autoplay: true,         // zapne automatické prehrávanie
//         autoplayTimeout: 1500,  // interval medzi prechodmi (v ms)
//         autoplayHoverPause: true, // zastavi autoplay, keď prejdeš myšou nad carousel 
//         // responsive: {           // responzivne nastavenia
//         //     0: { items: 1 },
//         //     600: { items: 4 },
//         //     1000: { items: 10 }
//         // }
//     });
//     $(".next").click(function(){
//         owl.trigger('owl.next');
//     })
//     $(".prev").click(function(){
//         owl.trigger('owl.prev');
//     })
//   });
$(document).ready(function() {
    $('.slider-container').each(function(){
      var container = $(this);
      var owl = container.find('.owl-carousel');
      
      owl.owlCarousel({
        autoPlay: 1000,
        items : 4, //10 items above 1000px browser width
        itemsDesktop : [1000,4], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0;
        itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
        pagination:false,
        margin: 40,
        loop: true,             // umozni nekonecne opakovanie carouselu
        autoplay: true,         // zapne automatické prehrávanie
        autoplayTimeout: 1500,  // interval medzi prechodmi (v ms)
        autoplayHoverPause: true, // zastavi autoplay, keď prejdeš myšou nad carousel 
        // responsive: {           // responzivne nastavenia
        //     0: { items: 1 },
        //     600: { items: 4 },
        //     1000: { items: 10 }
        // }
      });
      
      container.find('.next').click(function(){
        owl.trigger('next.owl.carousel');
      });
      container.find('.prev').click(function(){
        owl.trigger('prev.owl.carousel');
      });
    });
  });
  