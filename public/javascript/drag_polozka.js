const sliding_container = document.getElementById('sliding_container');
const small_slider = document.getElementById('small_slider');
const small_img_container = document.querySelector('.small_images');
let window_width = window.innerWidth;


/** VARIABLES **/
let children;
let children_len;
let curr_big_selected;
let first_img_id;
let min_id;
let max_id;
let scroll_distance;


/* gap malých imagov pre posun*/
const styles = getComputedStyle(small_img_container);
const small_gap = parseInt(styles.getPropertyValue('column-gap'));


/* pre eventy */
let isDown = false;
let startX;
let scrollLeft;
let actual_scroll;

/* pridanie súborov */
let can_open_input = false;
let add_img = false;



/** FUNKCIE **/
function scroll_init() { /* potrebujem na začiatok dať posledného childa */
    let child_to_move = null;

    children = Array.from(sliding_container.children);
    children_len = children.length; /* koľko ich je, aby som ich vedel naklonovať */
    min_id = parseInt(small_img_container.firstElementChild.dataset.imgId);
    max_id = parseInt(small_img_container.lastElementChild.dataset.imgId);
    scroll_distance = sliding_container.clientWidth;
    first_img_id = 1;


    if (children_len === 1) {
        /* ten jeden prvok čo tam je */
        const only_child = sliding_container.children[0];
        only_child.classList.remove('selected');

        /* 2 kópie prvku, majú triedu cloned */
        const copy_prep = only_child.cloneNode(true);
        copy_prep.classList.add('cloned');
        const copy_append = copy_prep.cloneNode(true);


        /* pridať kópiu pred a po */
        sliding_container.prepend(copy_prep);
        sliding_container.appendChild(copy_append);

        /* posunúť o scroll_distance nech sme na tom 2. prvku */
        sliding_container.scrollLeft = scroll_distance;

        /* označíme selected prvok */
        curr_big_selected = sliding_container.children[1]; /* bude selected ten prvý nenaklonovaný, čiže 3. v poradí */
        curr_big_selected.classList.add('selected');
    }
    else if (children_len === 2) {
        /* sprav klona dvojky a jednotky */

        const elements = [...sliding_container.children]; //kópia všetkých detí -> 1,2


        const clones = elements.map(el => {
            const clone = el.cloneNode(true);
            clone.classList.add('cloned');
            clone.classList.remove('selected');
            return clone;
        });

        sliding_container.prepend(...clones); /* pridanie klonov */

        sliding_container.scrollLeft = scroll_distance*2;
        curr_big_selected = sliding_container.children[2]; /* bude selected ten prvý nenaklonovaný, čiže 3. v poradí */
        curr_big_selected.classList.add('selected');
    }
    else if (children_len > 2) { /* dám posledného na začiatok, big brain move */
        child_to_move = sliding_container.lastElementChild; // Získajte posledného potomka

        curr_big_selected = sliding_container.firstElementChild;
        curr_big_selected.classList.add('selected');

        sliding_container.prepend(child_to_move);
        sliding_container.scrollLeft = scroll_distance;
    }

    curr_big_selected.classList.remove('cloned');
}



/* vráti ďalší prvok v zozname detí */
function get_next_child(currentElement, direction) {
    children = Array.from(sliding_container.children);
    const currentIndex = children.indexOf(currentElement); // Nájdeme aktuálny index

    if (direction > 0) {
        return children[(currentIndex + 1) % children.length]; // Posun doprava (cirkulárne)
    } else {
        return children[(currentIndex - 1 + children.length) % children.length]; // Posun doľava
    }
}



/* načíta ďalší prvok ak treba */
function load_next(id_change, new_big_selected) {

    /* idem doľava a pridám začiatočný prvok na koniec */
    if (id_change === 1 && new_big_selected === sliding_container.lastElementChild) {
        const first_child = sliding_container.firstElementChild; //prvý child

        /* pridaj na koniec prvého childa */
        sliding_container.appendChild(first_child);
        sliding_container.scrollLeft -= scroll_distance;
    }


    /* idem doprava a pridám posledný prvok na začiatok */
    if (id_change === -1 && new_big_selected === sliding_container.firstElementChild) {
        const lastChild = sliding_container.lastElementChild; //posledný child

        /* pridaj na začiatok posledného childa */
        sliding_container.prepend(lastChild);
        sliding_container.scrollLeft += scroll_distance;
    }
}


//scroll s Promise, čaká sa na koniec scrollu
function smoothScrollTo(element, targetPosition, duration = 250) {
    return new Promise((resolve) => {
        const start = element.scrollLeft; /* počiatočná pozícia */
        const distance = targetPosition - start; /* koľko musím prejsť */
        const startTime = performance.now(); /* počiatočný čas */


        /* vypneme klikanie na tlačidlá počas animácie */
        element.style.pointerEvents = 'none';


        function step(currentTime) {
            const elapsed = currentTime - startTime; /* koľko prešlo času */
            const progress = Math.min(elapsed / duration, 1); // 0 → 1 (čas) //aký progress sme spravili

            element.scrollLeft = start + distance * easeOutQuad(progress); /* posunie sa o funkciu ease_out_quad */

            if (progress < 1) { /* posunie sa na ďalší snímok ak ešte neskončil */
                requestAnimationFrame(step);
            } else {
                element.style.pointerEvents = 'auto';
                resolve(); /* koniec animácie*/
            }
        }

        function easeOutQuad(t) {
            return t * (2 - t); // zrýchlenie na začiatku, spomalenie na konci
        }

        requestAnimationFrame(step); /* ďalší krok animácie */
    });
}




async function scroll_big(e, x_a) {
    if (!isDown) {
        return;
    }

    isDown = false;

    const x = x_a;
    const diff = x - startX; //rozdiel miesta kde som ťukol prvý krát a posledný


    if (Math.abs(diff) === 0){ /* ak som sa neposunul o viac ako 5px, tak sa nič nestane */
        can_open_input = true;

        /* ak som klikol na ten velký obrázok */
        if (e.target.classList.contains('add')) {
            add_img = true;
        }

        return;
    }


    /* cieľ, kde sa mám posunúť */
    let target_position = (diff > 0) ? actual_scroll - scroll_distance : actual_scroll + scroll_distance;
    const current_selected = document.querySelector('.small_img.selected'); //teraz zvolený v menu


    /* terajšie id a či idem doprava/dolava */
    const curr_id = parseInt(curr_big_selected.dataset.imgId);
    const id_change = (diff > 0 ? -1 : 1);


    /* nový prvok, ktorý sa má selektnut */
    const new_big_selected = get_next_child(curr_big_selected,id_change);
    let new_id = parseInt(new_big_selected.dataset.imgId);
    const new_selected = document.querySelector(`.small_img[data-img-id="${new_id}"]`);


    /* odstránime teraz označený prvok */
    current_selected.classList.remove('selected'); /* malý obrázok */
    curr_big_selected.classList.remove('selected'); /* veľký obrázok */
    curr_big_selected = new_big_selected;



    /* animácia pohybu, posunieme sa želaným smerom */
    await smoothScrollTo(sliding_container, target_position);


    /* čekni či treba načítať ďalší prvok */
    load_next(id_change,new_big_selected);


    /* čekneme, či sa nezmenšilo okno */
    if (window.innerWidth != window_width) {
        scroll_distance = sliding_container.clientWidth;
        window_width = window.innerWidth;
    }


    /* posúvanie malého okna ak nie je vidno prvok */
    /* ide z prvého na koniec */
    if (curr_id === min_id && new_id === max_id) {
        await smoothScrollTo(small_img_container, small_img_container.scrollWidth);
        first_img_id = max_id - 2;
    }
    /* som na pravom okraji malého okienka */
    else if (new_id > first_img_id + 2) {
        await smoothScrollTo(small_img_container, small_img_container.scrollLeft + scroll_distance + small_gap);


        /* ak sa viem posunúť viac ako 3, tak sa posuniem, ináč sa posuniem cez vzorec */
        const id_diff = max_id - first_img_id;
        first_img_id += (id_diff > 3) ? 3 : (max_id - first_img_id) % 3 + 1;

    }
    /* som na pravom okraji a prejdem z napr. 7 na 1, dá ma to na začiatok */
    else if (new_id === min_id) {
        await smoothScrollTo(small_img_container, 0);
        first_img_id = 1;
    }
    /* ak idem naspäť */
    else if (new_id < first_img_id) {
        console.log(small_img_container.scrollLeft);
        await smoothScrollTo(small_img_container, small_img_container.scrollLeft - (scroll_distance) - small_gap);


        /* ak sa dá, posuniem sa o 3, ináč na začiatok */
        const id_diff = first_img_id - min_id;
        first_img_id = (id_diff > 3) ? first_img_id - 3 : 1;
    }


    /* označ nový prvok ako selected */
    new_selected.classList.add('selected');
    new_big_selected.classList.add('selected');
}




/** EVENTY **/
window.addEventListener('resize', function() { /* keď sa zmenší obrazovka, tak nech sa to zarovná */
    scroll_distance = sliding_container.clientWidth;
    sliding_container.scrollLeft = Math.round(sliding_container.scrollLeft / scroll_distance) * scroll_distance;

    /* pre malé obrázky */
    const add_gap = (small_img_container.scrollLeft === 0) ? 0 : 2*small_gap;
    small_img_container.scrollLeft = Math.round((small_img_container.scrollLeft) / scroll_distance) * scroll_distance + add_gap;
});



/* eventy pre myš */
sliding_container.addEventListener("mousedown", (e) => { /* klikol som a taham */
    isDown = true;

    startX = e.pageX;

    scrollLeft = sliding_container.scrollLeft;
    actual_scroll = sliding_container.scrollLeft; /* uložím si začiatok obrázka */
});


sliding_container.addEventListener("touchstart", (e) => {
    isDown = true;
    const touch = e.touches[0];
    startX = touch.pageX;


    scrollLeft = sliding_container.scrollLeft;
    actual_scroll = sliding_container.scrollLeft;
    e.preventDefault();
});



/* vypnem natívne tahanie obrázka */
sliding_container.addEventListener("dragstart", (e) => {
    e.preventDefault();
});

/* vypnem natívne tahanie obrázka */
small_slider.addEventListener("dragstart", (e) => {
    e.preventDefault();
});



/* keď pohybujem, tak nech sa to ťahá */
document.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    const walk = (e.pageX - startX);
    sliding_container.scrollLeft = scrollLeft - walk;
});


/* keď pohybujem, tak nech sa to ťahá */
sliding_container.addEventListener("touchmove", (e) => {
    if (!isDown) return;

    const touch = e.touches[0];
    const walk = touch.pageX - startX;

    sliding_container.scrollLeft = scrollLeft - walk;

    e.preventDefault();
});


/* pustenie myši a posunutie obrázkov veľkých */
document.addEventListener("mouseup", async (e) => {
    x = e.pageX;
    scroll_big(e, x);
});

document.addEventListener("touchend", async (e) => {
    const toucha = e.changedTouches[0].pageX;

    e.preventDefault();
    scroll_big(e, toucha);
});


/* ked kliknem na malé okienko */
small_img_container.addEventListener('pointerdown', async (event) => {
    const target = event.target;

    /* ak som klikol na malé tlačitko */
    if (target.classList.contains('small_img')) {
        if (target.classList.contains('add')) {
            add_img = true;
            return;
        }


        /* čo je teraz označené a na čo som klikol */
        const clicked_id = parseInt(target.dataset.imgId);
        const current_selected = document.querySelector('.small_img.selected');
        let curr_id = parseInt(current_selected.dataset.imgId);


        /* koľko obrázkov sa potrebujem posunúť a akým smerom */
        const diff = clicked_id - curr_id;
        const id_change = (diff > 0 ? 1 : -1);

        if (diff === 0) { /* klikol som na to, čo už je selected */
            can_open_input = true;
        }

        /* čekneme, či sa nezmenšilo okno */
        if (window.innerWidth != window_width) {
            scroll_distance = sliding_container.clientWidth;
            window_width = window.innerWidth;
        }


        /* posuniem sa o ten rozdiel čo som vyššie vypočítal, po 1nom obrázku idem */
        for (let i = 0; i < Math.abs(diff); i++) {
            curr_id += id_change;


            //vyberie sa aktuálny prvok
            const prev_selected = document.querySelector('.small_img.selected');


            /* odznačí sa aktuálny prvok malý aj veľký */
            curr_big_selected.classList.remove('selected');
            prev_selected.classList.remove('selected');


            /* nové prvky, ktoré treba označiť a ich označenie*/
            const new_selected = document.querySelector(`.small_img[data-img-id="${curr_id}"]`);
            const new_big_selected = get_next_child(curr_big_selected,id_change);
            new_selected.classList.add('selected');
            new_big_selected.classList.add('selected');


            /* terajší prvok je predchádzajúci nový prvok */
            curr_big_selected = new_big_selected;


            /* nová pozícia, posuniem sa o scroll_distance daným smerom */
            const target_position = sliding_container.scrollLeft + ((scroll_distance) * id_change); // scroll_distance = šírka karty


            /* čakáme na koniec animácie */
            await smoothScrollTo(sliding_container, target_position);

            /* čekneme, či netreba načítať ďalšie obrázky */
            load_next(id_change,new_big_selected);
        }
    }
});


/** FUNGOVANIE **/
/* ako to funguje? */
/*
    vždy presuniem o jeden další prvok z konca/začiatku na začiatok/koniec
    čiže napr. mám 1,2,3 a chcem ísť dolava z 2tky, tak ked sa posuniem na 1, tak zoberiem 3 z konca a dam na začiatok
    že nikdy nebudem na konci kontajnera, vždy bude niekto pred alebo za mnou

    že nejdem z 3 doprava a hodím tam 1tku, ale hodím tam 1tku už keď prídem na 2

*/


/* inicializácia */
scroll_init();
