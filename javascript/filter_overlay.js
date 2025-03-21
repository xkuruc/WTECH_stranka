/* variables */
const overlay = document.querySelector('.filter_overlay');
const added_filters = document.getElementById('sel_filter_container');
const filter_menu = document.getElementById('sliding_filter');
const kat_menu = document.getElementById('cat_filter');
var size_rendered = false;
const close_btns = [document.getElementById('close_btn'),document.getElementById('applyFilter')];
const clear_filter = document.getElementById('resetFilters');
const open_filter = document.getElementById('filter_open_btn');

const filter_content = document.querySelector('.filter_content');
const minPrice = 0; 
const maxPrice = 1000;


let filters = { /* aktívne filtre */
  brand: [],
  size: [],
  color: [],
  available: [],
  price: { min: minPrice, max: maxPrice},
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


function render_filter_color_content() { /* vykreslí záložku farby */
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
      
      const propertyToAdd = (color.name.includes("Viacfarebný")) ? 'background: ' : 'background-color: ';

      button.classList.add("cat_entry_btn");
      button.setAttribute("data-value", color.name);


      button.innerHTML = `
          <span class="color-box" style="${propertyToAdd} ${color.hex};"></span>
          ${color.name}
      `;

      newTab.appendChild(button);
  });
}



/* dočasne applyFilter zatvára filter, kým nebude spravený backend */
function toggleFilter2(open) {
  const body = document.body;

  if (open) { //zatvorí filter
    body.style.overflow = 'visible';
    overlay.style.display = 'none';

  } else { //otvorí filter
    body.style.overflow = 'hidden'; //odstráni scrollbar, zakáže scrollovanie
    overlay.style.display = "block";
  }
}




/* pridať filter */
function add_filter(cat, value, priceArg = "min", operator = "od") {
  const button = document.createElement("button");

  if (cat === "price") {
    filters.price[priceArg] = value;
    button.setAttribute("data-price-arg", priceArg);

    let selector = `button[data-category="${cat}"][data-price-arg="${priceArg}"]`;
    const active_filter = added_filters.querySelector(selector);

    if (active_filter) { // napr. už máme min filter, tak len zmeníme hodnotu

      if (value != parseInt(active_filter.dataset.value)) { /* ak je iná hodnota ako tam už je, tak sa zmení */
        active_filter.dataset.value = value;
        active_filter.textContent = priceArg + ': ' + value;
      }
      
      return;

    }
  }
  else if (cat === "sale") {
    filters[cat].push({
      operator: operator,
      value: value
    });
    button.setAttribute("data-op", operator);

  }
  else {
    if (Array.isArray(filters[cat]) && !filters[cat].includes(value)) { /* pridanie hodnoty ak tam ešte nie je */
      filters[cat].push(value);
    }
    else {
      return; //tlačidlo sa nepridá
    }

  }


  //nastavenie atribútov pre spätné vymazanie
  button.setAttribute("data-category", cat);
  button.setAttribute("data-value", value);


  //formát výpisu
  switch(cat) {
    case "size": //Veľkosť: 20
      button.textContent = 'Veľkosť' + ': ' + value;
      break;

    case "price": //max: 900
      button.textContent = priceArg + ': ' + value;
      break;

    case "sale": //do 20%
      button.textContent = operator + ' ' + value + '%';
      break;

    default: //Červená
      button.textContent = value;

  }


  console.log(filters);
  added_filters.appendChild(button);
}



/* odstráni element, konkrétne vybraný filter */
function remove_filter(btn, cat, value, priceArg = "min") { 
  let operator = "od";
  if (cat === "price") { //pre cenu sa nemaže prvok, ale nastaví sa pôvodná hodnota, niečo ako reset
    console.log(priceArg);
    if (priceArg === "min") {
      filters.price[priceArg] = minPrice;
      set_slider("min",minPrice);
    }
    else {
      filters.price[priceArg] = maxPrice;
      set_slider("max",maxPrice);
    }
    update_filled_slider();
  }
  else if (cat === "sale") {
    operator = btn.dataset.op;
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
  
    let clicked_btn = element_container.querySelector(`.clicked[data-value="${value}"]`);


    if (!clicked_btn) { /* potrebujem odceknut checkbox a odstrániť "active" checkmarku */
      let checkbox_entry = element_container.querySelector(`.checkbox_entry[data-value="${value}"]`);


      if (cat === "sale") {
        checkbox_entry = element_container.querySelector(`.checkbox_entry[data-value="${value}"][data-op="${operator}"]`);
      }
      






      const checkbox = checkbox_entry.querySelector('input[type="checkbox"]');
      const checkmark = checkbox_entry.querySelector('.checkmark');

      
      checkmark.classList.remove("clicked");
      setTimeout(() => {
        checkbox.checked = false;
        checkbox.dispatchEvent(new Event("change"));
        console.log("Odškrtnuté:", checkbox.checked);
      }, 10);
      
      

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
    toggleFilter2(true);
  }
});

close_btns.forEach(
  button => {
    button.addEventListener('click', (event) => {
      toggleFilter2(true);
    });
});



/* vymaže všetky filtre */
clear_filter.addEventListener('click', (event) => { 

  /* potrebujem odstrániť triedu clicked pre všetky aktívne filtery */

  for (let i = added_filters.children.length-1; i >= 0; i--) { /* vymazávam od konca, lebo sa mi mení zoznam mazaním */
    
    const child = added_filters.children[i];
    const category = child.dataset.category;
    const value = child.dataset.value;
    const priceArg = child.dataset.priceArg;
  
    console.log(child);
    remove_filter(child,category,value, priceArg);
  }


  sel_filters = document.getElementById("sel_filter_container");
  sel_filters.innerHTML = ''; /* odstráni všetkých childov */

  filters = { /* reset filtra */
    brand: [],
    size: [],
    color: [],
    available: [],
    price: { min: minPrice, max: maxPrice},
    sale: [],
    gender: []
  };


});


open_filter.addEventListener('click', (event) => { /* vymaže všetky filtre */
  toggleFilter2(false);

});



/* odstránia sa vybraté filtre, len ten kliknutý */
added_filters.addEventListener('click', (event) => { 
  const target = event.target;
  remove_filter(target,target.dataset.category,target.dataset.value,target.dataset.priceArg);
});




/* event pre všetky tlačidlá filter slideru */
filter_menu.addEventListener('click', (event) => {
  if (event.target.matches('.filter_menu_item')) {
    const currentSelected = document.querySelector('.category_content.selected'); //aktívny filter content
    const targetId = event.target.dataset.category;
    const newSelected = document.getElementById(`${targetId}`);

    if (currentSelected != newSelected) { /* už to netreba znova renderovať ak idem znova na tú istú kat */
      const currentTab = document.querySelector('.fil_cat.selected'); //teraz zvolený v menu
      const newTab = document.querySelector(`.fil_cat[data-category="${targetId}"]`);
      

      /* odstráni sa trieda selected od aktuálneho tabu a stlačeného tlačidla*/
      currentSelected.classList.remove('selected');
      currentTab.classList.remove('selected');


      /* pridá sa na nové tlačidlo a nový tab */
      newSelected.classList.add('selected');
      newTab.classList.add('selected');

      if (targetId === "size") {
        render_filter_sizes();
      }

    }
    toggleFilter2(false); //otvoriť menu
  }
});




/* eventy pre big menu, prepínanie tabov + stláčanie filter tlačidiel */
filter_content.addEventListener('click', (event) => {
  const target = event.target;

  /* pre prepínanie tabov */
  if (event.target.matches('.fil_cat')) {
    const currentSelected = document.querySelector('.fil_cat.selected'); //teraz zvolený v menu
    const targetId = target.dataset.category;
    const newSelected = document.getElementById(`${targetId}`);

    if (currentSelected != newSelected) { /* nech sa to znova nerenderuje */
      const act_cat = currentSelected.dataset.category; //momentalne zapnutá kategória
      const content_sel = document.getElementById(`${act_cat}`); //korešpondujúci filter content

      content_sel.classList.remove('selected');
      currentSelected.classList.remove('selected');
    
      newSelected.classList.add('selected');
      event.target.classList.add('selected');

      if (targetId === "size") {
        render_filter_sizes();
      }

    }
  }
  else if (target.matches('.category_text, .checkmark, .checkbox, .cat_entry_btn, .cat_entry_btn_size')) { /* ide o stlačenie filter buttonu */
    let category;
    let value;
    let operator;

    let categoryContainer = target.parentElement.classList.contains("category_entry_list") 
      ? target.parentElement 
      : target.parentElement.parentElement;



    /* určíme si kategoriu a hodnotu */
    if (target.matches('.cat_entry_btn, .cat_entry_btn_size')) {
      category = categoryContainer.dataset.category;
      value = target.dataset.value;
      
    }
    else if (target.matches('.category_text, .checkmark, .checkbox')) {
      category = categoryContainer.parentElement.dataset.category; /* category entry list, musím prejsť cez checkbox-entry */
      value = categoryContainer.dataset.value;
      operator = categoryContainer.dataset.op;
    }


    /* prepínanie triedy clicked */
    if (target.classList.contains('clicked')) {
      target.classList.remove('clicked'); /* odstráni sa trieda clicked, akože sa odklikne */

      /* odstráni sa vybraný filter, potrebujem nájsť tlačidlo v added_filters */
      let selector = `button[data-category="${category}"][data-value="${value}"]`;
      const active_filter = added_filters.querySelector(selector);

      remove_filter(active_filter,category,value);

    }
    else {
      add_filter(category,value,undefined,operator);
      target.classList.add('clicked');
    }

    /* zoberieme kategoriu z toho categoryContainer a value z tlačidla samotného */
  }

});





/* todo
  slider pre filtre aktívne
  responzivnosť filtra nejak
*/





render_filter_color_content();