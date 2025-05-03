/* variables */
const overlay = document.querySelector('.filter_overlay');
const added_filters = document.getElementById('sel_filter_container'); /* aktívne filtre */
const filter_menu = document.getElementById('sliding_filter'); /* filter menu, ktoré otvára veľké menu */
const kat_menu = document.getElementById('cat_filter'); /* sidebar kategórií */
let size_rendered = false; /* flag či je vykreslená záložka size */
let color_rendered = false; /* flag či je vykreslená záložka farba */
const close_btn = document.getElementById('close_btn');
const clear_filter = document.getElementById('resetFilters'); /* zmazať všetky filtre */
const open_filter = document.getElementById('filter_open_btn');
const filter_content = document.querySelector('.filter_content'); /* stredná sekcia veľkého filtra, obsah filtrov */
const query_btn = document.getElementById('applyFilter');
const type = document.getElementById('type_placeholder');
const select_sort = document.getElementById('sort');


const min_price = 0; /* dá sa nastaviť min cena cenového slidera */
const max_price = 1000; /* dá sa nastaviť max cena cenového slidera */


let filters = { /* aktívne filtre */
  brand: [],
  size: [],
  color: [],
  available: [],
  price: { min: min_price, max: max_price},
  sale: [],
  gender: [],
  season: []
};




/* funkcie */
//keď stlačím ESC, tak sa zatvorí filter menu
function handle_ESC () {
  if (event.key === "Escape") {
      toggle_filter(true);
    }
}

function uncheck_checkbox_entry(checkbox_entry) {
    const checkbox = checkbox_entry.querySelector('input[type="checkbox"]');
    const checkmark = checkbox_entry.querySelector('.checkmark');

    checkmark.classList.remove("clicked");
    setTimeout(() => {
        checkbox.checked = false;
        checkbox.dispatchEvent(new Event("change"));
    }, 10); /* po 10ms sa odškrtne checkmark, je to preto, aby sa to stihlo vizuálne prejaviť */
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
function add_filter(cat, value, price_arg = "min", operator = "od", display_value="") {
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
      const existingIndex = filters[cat].findIndex(item => item.operator === operator);

      if (existingIndex !== -1) { /* ak tam je, tak len updatni hodnotu napr. už tam je "od", tak zmením 20 -> 40 */
          const old_value = filters[cat][existingIndex].value;
          filters[cat][existingIndex].value = value;

          /* treba odstranit ten stary */
          let selector = `button[data-category="${cat}"][data-op="${operator}"]`;
          const active_filter = added_filters.querySelector(selector);
          if (active_filter) {
              active_filter.dataset.value = value;

              /* update toho čo sa tam píše */
              active_filter.textContent = `${operator} ${value}%`;

              /* odznačíme to čo sme klikli predtým */
              const element_container = document.querySelector(`.category_entry_list[data-category="${cat}"]`);

              const to_uncheck = element_container.querySelector(`.checkbox_entry[data-value="${old_value}"][data-op="${operator}"]`);
              uncheck_checkbox_entry(to_uncheck);

          }

          return;

      } else { /* nie je tam, tak pridaj */
          filters[cat].push({
              operator: operator,
              value: value
          });
      }

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

    case "brand":
        button.textContent = display_value;
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

      uncheck_checkbox_entry(checkbox_entry);
    }
    else {
      clicked_btn.classList.remove('clicked');
    }
  }

  btn.remove();
}


function parse_url(url) {
    const parsedUrl = new URL(url);

    /* ak to je search, obsahuje namiesto typu search?query= */
    if (parsedUrl.pathname === '/search' && parsedUrl.searchParams.has('query')) {
        return `search?query=${parsedUrl.searchParams.get('query').split('/')[0]}`;
    }

    /* ak nie, tak vráť len prvý segment cesty: tenisky, lopty, kopacky, ... */
    const pathParts = parsedUrl.pathname.split('/').filter(part => part);
    return pathParts[0] || '';
}



/** BACKEND QUERY STAVANIE **/
function build_query(filters) {


    /*** STAVANIE QUERY ***/
    /** TYP PRODUKTOV **/
    const current_url = window.location.href;
    let url = parse_url(current_url) + '/';


    /** FILTER **/
    let filterParts = [];

    if (filters.brand.length > 0) {
        filterParts.push('brand-' + filters.brand.join('-'));
    }
    if (filters.size.length > 0) {
        filterParts.push('size-' + filters.size.join('-'));
    }
    if (filters.color.length > 0) {
        filterParts.push('color-' + filters.color.join('-'));
    }

    if (filters.available.length > 0) {
        filterParts.push('available-' + filters.available.join('-'));
    }

    if (filters.price.min && filters.price.max) {
        filterParts.push('price-' + filters.price.min + '-' + filters.price.max);
    }

    if (filters.sale.length > 0) {
        let saleParts = filters.sale.map(sale => `${sale.operator}${sale.value}`); // napr. od20, do20
        filterParts.push('sale-' + saleParts.join('-'));
    }


    if (filters.gender.length > 0) {
        filterParts.push('gender-' + filters.gender.join('-'));
    }

    if (filters.season.length > 0) {
        filterParts.push('season-' + filters.season.join('-'));
    }

    /* spojenie s url */
    url += filterParts.join('_');


    /** ZORADENIE **/
    const sortSelect = document.getElementById('sort');
    let orderby = select_sort.value || 'price~asc'; // Default to 'price~asc' if no value is selected
    url += orderby ? `&orderby=${orderby}` : '';


    return url;
}





/** EVENT* **/
//zmizne filter, keď kliknem na overlay, mimo menu
overlay.addEventListener('click', (event) => {
  if (event.target === overlay) {
    overlay.style.display = 'none';
    toggle_filter(true);
  }
});



/* zatvorí filter */
close_btn.addEventListener('click', (event) => {
    toggle_filter(true);
});



query_btn.addEventListener('click', (event) => {
    const query = build_query(filters);
    window.location.href = `/${query}`;
});


select_sort.addEventListener('change', (event) => {
    const query = build_query(filters);
    window.location.href = `/${query}`;
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
    gender: [],
    season: []
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
      remove_filter(added_filters.querySelector(selector),category,value,undefined, oper);
    }
    else {
        let display_value = "";
        if (category === 'brand') {
            const cat_text = categoryContainer.querySelector('.category_text');
            display_value = cat_text.textContent;
        }

      add_filter(category,value,undefined,oper,display_value); /* pridám filter do aktívnych filterov */
      clicked.classList.add('clicked');
    }

    /* zoberieme kategoriu z toho categoryContainer a value z tlačidla samotného */
  }

});


document.addEventListener('DOMContentLoaded', function() {
    // Akonáhle sa dokument načíta
    const checkboxes = filter_content.querySelectorAll('.checkbox_entry');

    checkboxes.forEach(checkbox => {
       const checkmark = checkbox.querySelector('.checkmark');
       if (!checkmark.classList.contains('clicked')) {
           return;
       }

       const parent = checkbox.parentElement;
       const category = parent.dataset.category;
       const value = checkbox.dataset.value;
       let display_text;
       let operator;

       if (category === 'brand') {
           const cat_text = checkbox.querySelector('.category_text');
           display_text = cat_text.textContent;
       }

       if (category === 'sale') {
           operator = checkbox.dataset.op;
       }

       add_filter(category,value,undefined,operator,display_text);
    });


    const cat_buttons = filter_content.querySelectorAll('.cat_entry_btn, .cat_entry_btn_size');

    // Spracuj všetky tlačidlá
    cat_buttons.forEach(function(btn) {
        if (btn.classList.contains('clicked')) {
            const parent = btn.parentElement.parentElement;
            const category = parent.dataset.category;
            const value = btn.dataset.value;

            add_filter(category,value);
        }
    });


    /* slidery ešte treba nastaviť */
    const min_price = filter_content.querySelector('.min_price');
    const max_price = filter_content.querySelector('.max_price');

    const min_value = parseInt(min_price.value);
    const max_value = parseInt(max_price.value);


    if (min_value != slider_min) { add_filter("price",min_value,"min"); }
    if (max_value != slider_max) { add_filter("price",max_value,"max"); }
});
