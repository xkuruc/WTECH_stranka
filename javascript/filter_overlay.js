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



let filters = { /* aktívne filtre */
  brand: [],
  size: [],
  color: [],
  available: [],
  price: { min: 0, max: 1000},
  gender: []
};


filters.price.min = 500;


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











function add_filter(cat, value, priceArg = "min") {
  const button = document.createElement("button");

  if (cat === "price") {
    filters.price[priceArg] = value;
    button.setAttribute("data-slider", priceArg);
  }

  else {
    if (Array.isArray(filters[cat]) && !filters[cat].includes(value)) { /* pridanie hodnoty ak tam ešte nie je */
      filters[cat].push(value);
    }
    else {
      return; //tlačidlo sa nepridá
    }

  }


  //nastavenie atribútov
  button.setAttribute("onclick", `remove_filter('${cat}', '${value}','${priceArg}')`);
  button.setAttribute("data-category", cat);
  button.setAttribute("data-value", value);


  //formát výpisu
  if (cat === "size") {
    button.textContent = cat + ': ' + value;
  }
  else if (cat === "price") {
    button.textContent = priceArg + ': ' + value;
  } 
  else {
    button.textContent = value;
  }

  added_filters.appendChild(button);
}


function remove_filter(cat, value, priceArg = "min") {


}



function removeElement(element) { /* odstráni element, konkrétne vybraný filter, okrem toho ten filter nič nerobí */
  element.remove();
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



clear_filter.addEventListener('click', (event) => { /* vymaže všetky filtre */
  sel_filters = document.getElementById("sel_filter_container");
  sel_filters.innerHTML = ''; /* odstráni všetkých childov */
});


open_filter.addEventListener('click', (event) => { /* vymaže všetky filtre */
  toggleFilter2(false);

});




added_filters.addEventListener('click', (event) => { /* odstránia sa vybraté filtre, len ten kliknutý */
  




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
      
      currentSelected.classList.remove('selected');
      currentTab.classList.remove('selected');

      newSelected.classList.add('selected');
      newTab.classList.add('selected');

      if (targetId === "size") {
        render_filter_sizes();
      }

    }
    toggleFilter2(false); //otvoriť menu
  }
});



/* to isté ale pre filter big menu záložky */



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
    

    let categoryContainer = target.parentElement.classList.contains("category_entry_list") 
      ? target.parentElement 
      : target.parentElement.parentElement;


    let category;
    let value;


    if (target.matches('.cat_entry_btn, .cat_entry_btn_size')) {
      category = categoryContainer.dataset.category;
      value = target.dataset.value;
      
    }
    else if (target.matches('.category_text, .checkmark, .checkbox')) {
      value = categoryContainer.dataset.value;
      category = categoryContainer.parentElement.dataset.category; /* category entry list, musím prejsť cez checkbox-entry */
      
    
    }

    add_filter(category,value);

    console.log(category,value);

    /* zoberieme kategoriu z toho categoryContainer a value z tlačidla samotného */
   
    //add_filter(categoryContainer.dataset.category,target.dataset.value);





  }








});






render_filter_color_content();