/* variables */
const filt_top = document.querySelector(".filt_top");
const placeholder = document.getElementById("filter_placeholder");
const back_btn = document.getElementById("resize_back_btn");
const default_placeholder_value = placeholder.textContent;
const filter_cat_container = document.querySelector(".filter_category");
const no_filter = document.getElementById('no_filter');


const media_query = window.matchMedia('(max-width: 760px)');
const media_mobile_query = window.matchMedia('(max-width: 426px)');


/* vždy sa strieda kto je vykreslený medzi filter_category a category_content */
function change_filter_identifier() {
  const current_selected = document.querySelector('.category_content.selected'); //aktívny filter content

  if (current_selected) {
    const cat_identifier = current_selected.querySelector(".category_identifier");
    placeholder.textContent = cat_identifier.textContent;
  }

}



function media_query_change(e) { /* čo sa má stať ak sa zmení media query v css, buď sa naplní alebo z neho odídeme */
  let current_selected = document.querySelector('.category_content.selected'); //aktívny filter content
  if (e.matches) { //ak je šírka menšia ako určuje query, napr. menej ako 760px
    
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

  } else { /* vrátime sa do pôvodného stavu, zmizne šipka, vráti sa placeholder aká tam bol a pod */

    back_btn.classList.remove('active');
    placeholder.classList.remove('noindent'); 
    placeholder.textContent = default_placeholder_value;
    filter_cat_container.style.display = 'block';


    if (current_selected === null) {
      no_filter.classList.add('selected');
    }
  }
}


/* ak prepneme na veľkosť mobilu, tj. 426px (<=425px) */
/* tento skript robí len to, že keď som na mobile, tak sa mi skráti názov aktívneho filtra z "Veľkosť: 18" na "V: 18", aby 
sa tam zmestilo viac filtrov a bolo to krajšie, platí aj opačne */
function media_mobile_change(e) {
  if (e.matches) { //ak je šírka menej ako 426px
    Array.from(added_filters.children).forEach(child => {
      if (child.dataset.category === "size") {
        child.textContent = 'V: ' + child.dataset.value;
      }
    });
    

  } else { //zase sa zväčší obrazovka
    Array.from(added_filters.children).forEach(child => {
      if (child.dataset.category === "size") {
        child.textContent = 'Veľkosť: ' + child.dataset.value;
      }
    });
  }
}




back_btn.addEventListener("click", (event) => { /* šipka späť */
  if (back_btn.classList.contains('active')) { /* môžem ju kliknúť len, ak je viditeľná */
    const current_selected = document.querySelector('.category_content.selected'); //aktívny filter content
    current_selected.classList.remove('selected');


    const cat_selected = document.querySelector('.fil_cat.selected'); /* vybraté tlačidlo v menu */
    cat_selected.classList.remove('selected');

    placeholder.classList.remove('noindent'); /* estetické pridanie odsadenia späť */

    filter_cat_container.style.display = 'block'; /* zobrazí sa sidebar v menu s tlačidlami */
    placeholder.textContent = default_placeholder_value; /* vráti sa pôvodný text placeholdera */
    back_btn.classList.remove('active'); /* zmizne šipka */
  }
});



//pri zmene veľkosti okna sa to skontroluje
media_query.addEventListener('change', media_query_change);
media_mobile_query.addEventListener('change', media_mobile_change);