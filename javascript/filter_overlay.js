/* variables */
const overlay = document.querySelector('.filter_overlay');
const added_filters = document.getElementById('sel_filter_container'); /* aktívne filtre */
const filter_menu = document.getElementById('sliding_filter'); /* filter menu, ktoré otvára veľké menu */
const kat_menu = document.getElementById('cat_filter'); /* sidebar kategórií */
let size_rendered = false; /* flag či je vykreslená záložka size */
let color_rendered = false; /* flag či je vykreslená záložka farba */
const close_btns = [document.getElementById('close_btn'),document.getElementById('applyFilter')];
const clear_filter = document.getElementById('resetFilters'); /* zmazať všetky filtre */
const open_filter = document.getElementById('filter_open_btn');
const filter_content = document.querySelector('.filter_content'); /* stredná sekcia veľkého filtra, obsah filtrov */
const min_price = 0; /* dá sa nastaviť min cena cenového slidera */
const max_price = 1000; /* dá sa nastaviť max cena cenového slidera */


let filters = { /* aktívne filtre */
  brand: [],
  size: [],
  color: [],
  available: [],
  price: { min: min_price, max: max_price},
  sale: [],
  gender: []
};




/* funkcie */
function render_filter_sizes() { /* vykreslí záložku veľkosti */
  if (!size_rendered) {
    const btn_container = document.querySelector(`.cat_btn_container_sizes`);
    for (let i = 17; i <= 50; i++) {
      const button = document.createElement("button");
      button.textContent = i;
    
      button.classList.add("cat_entry_btn_size");
      button.setAttribute("data-value", i);      

      btn_container.appendChild(button);
    }
    size_rendered = true;
  }
}


/* vykreslí záložku farby */
function render_filter_color_content() { 
  if (!color_rendered) {
    const colors = [
      { name: "Červená", hex: "red" },
      { name: "Modrá", hex: "blue" },
      { name: "Zelená", hex: "green" },
      { name: "Oranžová", hex: "orange" },
      { name: "Fialová", hex: "purple" },
      { name: "Biela", hex: "white" },
      { name: "Čierna", hex: "black" },
      { name: "Viacfarebný", hex: "linear-gradient(90deg, rgb(20, 190, 130) 0%, rgb(193, 255, 0) 33%, rgb(255, 85, 85) 67%, rgb(0, 92, 198) 100%)"}
    ];


    /* pridám farby do kontajnera */
    const newTab = document.querySelector(`.cat_btn_container`);
    colors.forEach(color => {
        const button = document.createElement("button");
        
        /* pri tom viacfarebnom ak chcem lin. gradient, tak musím použiť background */
        const property_to_add = (color.name.includes("Viacfarebný")) ? 'background: ' : 'background-color: ';


        /* atribúty a trieda */
        button.classList.add("cat_entry_btn");
        button.setAttribute("data-value", color.name);

        /* do buttonu sa pridá span - farebný štvorček */
        button.innerHTML = `
            <span class="color-box" style="${property_to_add} ${color.hex};"></span>
            ${color.name}
        `;

        newTab.appendChild(button);
    });
    color_rendered = true;
  }
}


//keď stlačím ESC, tak sa zatvorí filter menu
function handle_ESC () {
  if (event.key === "Escape") { 
      toggle_filter(true);
    }
}


/* dočasne applyFilter zatvára filter, kým nebude spravený backend */
function toggle_filter(open) {
  const body = document.body;

  if (open) { //zatvorí filter
    body.style.overflow = 'visible'; //povolí scrollovanie
    overlay.style.display = 'none';
    document.removeEventListener("keydown", handle_ESC); /* keď zatvorím filter, tak nech to necekuje */

  } else { //otvorí filter
    body.style.overflow = 'hidden'; //odstráni scrollbar, zakáže scrollovanie
    overlay.style.display = "flex";
    document.addEventListener("keydown", handle_ESC); /* keď je otvorený filter, tak je to aktívne */
  }
}




/* pridať filter */
function add_filter(cat, value, price_arg = "min", operator = "od") {
  const button = document.createElement("button");

  if (cat === "price") { /* ak je kategória cena, tak tam sa nepridáva nový prvok, ale mení sa akt. min a max vo filtri */
    filters.price[price_arg] = value;
    button.setAttribute("data-price-arg", price_arg); /* nastaví či ide o min alebo max slider */

    let selector = `button[data-category="${cat}"][data-price-arg="${price_arg}"]`;
    const active_filter = added_filters.querySelector(selector); /* či neexistuje už nejaký existujúci filter */

    if (active_filter) { //ak áno, tak len zmeníme hodnotu

      if (value != parseInt(active_filter.dataset.value)) { /* ak je iná hodnota ako tam už je, tak sa zmení */
        active_filter.dataset.value = value;
        active_filter.textContent = price_arg + ': ' + value;
      }

      return;
    }
  }
  else if (cat === "sale") { /* pre zľavy sa pridáva kombo operátor+value */
    filters[cat].push({
      operator: operator,
      value: value
    });
    button.setAttribute("data-op", operator);

  }
  else { /* ináč sa len pushne hodnota do zoznamu */
    if (Array.isArray(filters[cat]) && !filters[cat].includes(value)) { /* pridanie hodnoty ak tam ešte nie je */
      filters[cat].push(value);
    }
    else {
      return; //tlačidlo sa nepridá, ak už tam taká hodnota existuje
    }

  }


  //nastavenie atribútov pre spätné vymazanie
  button.setAttribute("data-category", cat);
  button.setAttribute("data-value", value);


  //formát výpisu
  switch(cat) {
    case "size": //Veľkosť: 20
      if (window.innerWidth <= 425) {
        button.textContent = 'V' + ': ' + value;
      }
      else {
        button.textContent = 'Veľkosť' + ': ' + value;
      }
      break;

    case "price": //max: 900
      button.textContent = price_arg + ': ' + value;
      break;

    case "sale": //do 20%
      button.textContent = operator + ' ' + value + '%';
      break;

    default: //Červená
      button.textContent = value;

  }


  //console.log(filters); //výpis filtra, či sa to pridalo správne
  added_filters.appendChild(button);
}



/* odstráni element, konkrétne vybraný filter */
function remove_filter(btn, cat, value, price_arg = "min", operator = "od") { 
  
  if (cat === "price") { //pre cenu sa nemaže prvok, ale nastaví sa pôvodná hodnota, niečo ako reset
    if (price_arg === "min") {
      filters.price[price_arg] = min_price;
      set_slider("min",min_price);
    }
    else { /* musí to byť max slider */
      filters.price[price_arg] = max_price;
      set_slider("max",max_price);
    }
    update_filled_slider(); /* aktualizuje sa výplň medzi slider thumbs */
  }
  else if (cat === "sale") { /* tu sa hľadá kombo operátor+value, nielen value */
    const index = filters[cat].findIndex(item => {
      return typeof item === "object"
        ? item.value === value && item.operator === operator
        : item === value;
    });

    if (index !== -1) {
      filters[cat].splice(index, 1); //odstráni filter
    }

  }
  else { /* ostatné kategorie */
    if (Array.isArray(filters[cat])) {
      const index = filters[cat].indexOf(value);
      if (index !== -1) {  // ak existuje
        filters[cat].splice(index, 1);  //odstráni filter
      }
    }

  }


  /* odškrtnutie tlačidla */
  if (cat != "price") {
    
    /* nájdem si najprv kontajner a potom v nom nájdem požadovanú value a tej odstránim triedu clicked */
    const element_container = document.querySelector(`.category_entry_list[data-category="${cat}"]`);
  
    let clicked_btn = element_container.querySelector(`.clicked[data-value="${value}"]`); /* ak sa nájde, tak to nie je checkbox */

    if (!clicked_btn) { /* potrebujem odceknut checkbox a odstrániť "active" checkmarku */
      let checkbox_entry = element_container.querySelector(`.checkbox_entry[data-value="${value}"]`);

      if (cat === "sale") { /* ak je to zlava, tak musím rozlišovať aj operátor, "od 20" != "do 20" */
        checkbox_entry = element_container.querySelector(`.checkbox_entry[data-value="${value}"][data-op="${operator}"]`);
      }
      

      const checkbox = checkbox_entry.querySelector('input[type="checkbox"]');
      const checkmark = checkbox_entry.querySelector('.checkmark');

      checkmark.classList.remove("clicked");
      setTimeout(() => {
        checkbox.checked = false;
        checkbox.dispatchEvent(new Event("change"));
      }, 10); /* po 10ms sa odškrtne checkmark, je to preto, aby sa to stihlo vizuálne prejaviť */
      
    }
    else {
      clicked_btn.classList.remove('clicked');   
    }
  }

  btn.remove();
}




/* eventListeners */
//zmizne filter, keď kliknem na overlay, mimo menu
overlay.addEventListener('click', (event) => {
  if (event.target === overlay) {
    overlay.style.display = 'none';
    toggle_filter(true);
  }
});



/* zatvorí filter */
close_btns.forEach(
  button => {
    button.addEventListener('click', (event) => {
      toggle_filter(true);
    });
});



/* vymaže všetky filtre */
clear_filter.addEventListener('click', (event) => { 

  /* potrebujem odstrániť triedu clicked pre všetky aktívne filtery */
  for (let i = added_filters.children.length-1; i >= 0; i--) { /* vymazávam od konca, lebo sa mi mení zoznam mazaním */
    const child = added_filters.children[i];
    const category = child.dataset.category;
    const value = child.dataset.value;
    const price_arg = child.dataset.priceArg; /* js používa camelCase */
    const operator = child.dataset.op;
  
    remove_filter(child,category,value, price_arg, operator);
  }


  /* resetovanie aktívnych filtrov */
  sel_filters = document.getElementById("sel_filter_container");
  sel_filters.innerHTML = ''; /* odstráni všetkých childov */

  filters = { /* reset filtra */
    brand: [],
    size: [],
    color: [],
    available: [],
    price: { min: min_price, max: max_price},
    sale: [],
    gender: []
  };

});



/* otvorí filter menu */
open_filter.addEventListener('click', (event) => { 
  toggle_filter(false);
});


/* odstránia sa vybraté filtre, len ten kliknutý */
added_filters.addEventListener('click', (event) => { 
  const target = event.target;
  remove_filter(target, target.dataset.category, target.dataset.value, target.dataset.priceArg, target.dataset.op);
});



/* event pre všetky tlačidlá filter slideru */
filter_menu.addEventListener('click', (event) => {
  if (event.target.matches('.filter_menu_item')) { /* ak som klikol na menu_item, tak sa otvorí požadovaný tab */
    const currentSelected = document.querySelector('.category_content.selected'); //aktívny filter content
    const targetId = event.target.dataset.category;
    const newSelected = document.getElementById(`${targetId}`); /* ktorý tab/filter content sa má otvoriť */

    if (currentSelected != newSelected) { /* už to netreba znova renderovať ak idem znova na tú istú kat */
      const currentTab = document.querySelector('.fil_cat.selected'); //teraz zvolený v menu
      const newTab = document.querySelector(`.fil_cat[data-category="${targetId}"]`);
      

      /* odstráni sa trieda selected od aktuálneho tabu a stlačeného tlačidla*/
      currentSelected.classList.remove('selected');
      if (currentTab) {
        currentTab.classList.remove('selected');
      }
      

      /* pridá sa na nové tlačidlo a nový tab */
      newSelected.classList.add('selected');
      newTab.classList.add('selected');

      if (targetId === "size") { /* ak ideme vykresľovať veľkosti, tak sa nech sa vykreslia */
        render_filter_sizes();
      }
      else if (targetId === "color") {
        render_filter_color_content(); /* vykreslí farby, sú vykreslované cez skript, čiže musím takto */
      }


      if (window.innerWidth <= 760) { /* sme na zmenšenom filtri, treba prepnut text */
        change_filter_identifier();
      }


    }
    toggle_filter(false); //otvoriť menu
  }
});




/* eventy pre big menu, prepínanie tabov + stláčanie filter (vo veľkom menu) tlačidiel */
filter_content.addEventListener('click', (event) => {
  const target = event.target;
  


  /* pre prepínanie tabov */
  if (event.target.matches('.fil_cat')) {
    const currentSelected = document.querySelector('.fil_cat.selected'); //teraz zvolený v menu
    const targetId = target.dataset.category;
    const newSelected = document.getElementById(`${targetId}`); /* tab, ktorý sa má otvoriť */


    if (no_filter.classList.contains('selected')) { /* ak je aktívny no_filter, tak sa vypne a zapne sa kategoria, ktorú chcem */
      no_filter.classList.remove('selected');
    }


    /* selektne tlačidlo, ktoré som klikol a zapne nový kontent */
    newSelected.classList.add('selected');
    event.target.classList.add('selected');

    

    /* ak kliknem ktaegóriu, ktorá už je vykreslená, tak sa neodznačí */
    if (currentSelected != null && currentSelected.dataset.category != targetId) {
      const act_cat = currentSelected.dataset.category; //momentalne zapnutá kategória
      const content_sel = document.getElementById(`${act_cat}`); //korešpondujúci filter content

      content_sel.classList.remove('selected');

      currentSelected.classList.remove('selected');

    }
      

      if (targetId === "size") { /* ak sa prepne size, tak sa vykreslí */
        render_filter_sizes();
      }
      else if (targetId === "color") {
        render_filter_color_content(); /* vykreslí farby, sú vykreslované cez skript, čiže musím takto */
      }

      if (window.innerWidth <= 760) { /* pri malom okne sa zobrazí šipka späť a upravia sa placeholdery */
        filter_cat_container.style.display = 'none';
        back_btn.classList.add('active');
        placeholder.classList.add('noindent');
        change_filter_identifier(); /* hore vypíše aká je to kategória namiesto default "Filtre" */
      }

  }
  else if (target.matches('.category_text, .checkmark, .checkbox, .cat_entry_btn, .cat_entry_btn_size')) { /* ide o stlačenie filter buttonu */
    let category;
    let value;
    let oper;
    let clicked = target;


    /* vieme, že buď bude category_entry_list parent alebo parent.parent z nášho layoutu */
    /* teda buď je priamy parent alebo ešte existuje btn_container a potrebujeme ísť ešte o úroveň nižšie */
    let categoryContainer = target.parentElement.classList.contains("category_entry_list") 
      ? target.parentElement 
      : target.parentElement.parentElement;



    /* určíme si kategoriu a hodnotu */
    if (target.matches('.cat_entry_btn, .cat_entry_btn_size')) {
      category = categoryContainer.dataset.category;
      value = target.dataset.value;
      
    }
    else { /* je to checkbox */
      category = categoryContainer.parentElement.dataset.category; /* category entry list, musím prejsť cez checkbox-entry */
      value = categoryContainer.dataset.value;
      oper = categoryContainer.dataset.op;
      const check_parent = target.closest('.custom_checkbox');

      clicked = check_parent.querySelector('.checkmark');
    }



    /* prepínanie triedy clicked */
    if (clicked.classList.contains('clicked')) {
      
      /* odstráni sa vybraný filter, potrebujem nájsť tlačidlo v added_filters */
      let selector = `button[data-category="${category}"][data-value="${value}"]`;
      remove_filter(added_filters.querySelector(selector),category,value, oper);

    }
    else {
      add_filter(category,value,undefined,oper); /* pridám filter do aktívnych filterov */



      clicked.classList.add('clicked');
    }

    /* zoberieme kategoriu z toho categoryContainer a value z tlačidla samotného */
  }

});