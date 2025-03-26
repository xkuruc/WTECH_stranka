/* variables */
const filt_top = document.querySelector(".filt_top");
const placeholder = document.getElementById("filter_placeholder");
const back_btn = document.getElementById("resize_back_btn");
const default_placeholder_value = placeholder.textContent;
const filter_cat_container = document.querySelector(".filter_category");
const no_filter = document.getElementById('no_filter');


const media_query = window.matchMedia('(max-width: 760px)');


/* vždy sa strieda kto je vykreslený medzi filter_category a category_content */
function change_filter_identifier() {
  const current_selected = document.querySelector('.category_content.selected'); //aktívny filter content

  if (current_selected) {
    const cat_identifier = current_selected.querySelector(".category_identifier");
    placeholder.textContent = cat_identifier.textContent;
  }

}



function media_query_change(e) {
  
  let current_selected = document.querySelector('.category_content.selected'); //aktívny filter content
  if (e.matches) { // Ak je šírka okna <= 1000px
    
    
    if (no_filter.classList.contains('selected')) { /* aby sa neprepol, ak je aktívny no_filter */
      no_filter.classList.remove('selected');
      current_selected = null;
    }


    if (current_selected) { /* musím mať nejaký filter aktívny, inač sa neprepne */
      back_btn.classList.add('active');
      placeholder.classList.add('noindent');

      filter_cat_container.style.display = 'none';
      change_filter_identifier();
    }

  } else {

    back_btn.classList.remove('active');
    placeholder.classList.remove('noindent'); 
    placeholder.textContent = default_placeholder_value;
    filter_cat_container.style.display = 'block';



    if (current_selected === null) {
      no_filter.classList.add('selected');
    }



  }
}



back_btn.addEventListener("click", (event) => {
    
  if (back_btn.classList.contains('active')) {
    const current_selected = document.querySelector('.category_content.selected'); //aktívny filter content
    current_selected.classList.remove('selected');


    const cat_selected = document.querySelector('.fil_cat.selected');
    cat_selected.classList.remove('selected');

    placeholder.classList.remove('noindent');

    filter_cat_container.style.display = 'block';
    placeholder.textContent = default_placeholder_value;
    back_btn.classList.remove('active');

  }



});




/* 
todo:
prerobiť category entry list, aby nemal data-category, ale nech to ide cez content id, zbytočné, asi potom closest()
sub 1000px zmizne úplne filter menu
ked je malý mobil, tak sa skracuje meno aktívneho filtra
*/



/* 
spravené:

active_filter_slider som dal preč
spravené responzivny layout pre filter
fixed checkbox, fixed slider event
added filters bude dvojriadkový a viac

*/




media_query_change(media_query);

//pri zmene veľkosti okna sa to skontroluje
media_query.addEventListener('change', media_query_change);