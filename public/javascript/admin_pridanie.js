/** VARIABLES **/
const image_kontajner = document.querySelector('.product_images_kontajner');



/** FUNKCIE **/
function remove_input_event(input) {
    input.addEventListener('click', function(event) {
        event.stopPropagation();
    });
}

function add_input_change(input) {
    input.addEventListener('change', function(event) {
        input_change(event);
    });
}

function input_change(event) {
    const target = event.target;
    const parent = target.parentElement;
    const curr_id2 = parent.dataset.imgId;
    const img = parent.querySelector('img');
    const plusko = parent.querySelector('.plusko');

    const file = target.files[0];

    if (file) {
        const reader = new FileReader();

        /* kopia na pridružený obrázok */
        const velke_a_cloned = document.querySelectorAll(`.big_img[data-img-id="${curr_id2}"]`);


        /* vloží obrázky do placeholderov */
        reader.onload = function (e) {


            /* každému klonu sa nastaví obrázok tiež */
            velke_a_cloned.forEach(div => {
                const img = div.querySelector('img');
                const plusko = div.querySelector('.plusko');
                if (img) {
                    img.src = e.target.result;
                }
                plusko.style.display = 'none'; //skryje plusko
            });

            /* nastaví malému obrázok alebo ak som klikol na veľký, nič sa nestane */
            if (target.classList.contains('small_img')) {
                img.src = e.target.result;
            }
            else {
                /* klikol som na veľké a potrebujem nájsť malé k nemu */
                const prvok = document.querySelector(`.small_img[data-img-id="${curr_id2}"]`);
                const prvok_img = prvok.querySelector('img');
                const prvok_plusko = prvok.querySelector('.plusko');

                prvok_img.src = e.target.result;
                prvok_plusko.style.display = 'none';
            }
        }

        reader.readAsDataURL(file); // Načíta obrázok ako data URL (base64)
    }
}


async function new_add_img(new_src='') {
    /** VYBRANY VELKY ADD **/
    const big_selected = image_kontajner.querySelector('.big_img.add:not(.cloned)');
    let small_selected = image_kontajner.querySelector('.small_img.add');
    const curr_id_target = parseInt(big_selected.dataset.imgId);
    const target_class = big_selected.classList;



    /** AK PRIDAVAM Z CLONED PRVKU **/
    /* ak pridám z 'cloned add', tak by sa mi vymazal nižšie */
    if (target_class.contains('cloned')) {
        target_class.remove('cloned');

        /* sebe zoberiem 'cloned' a pridám ho ostatným, robím zo seba 'originál' */
        const elements = document.querySelectorAll('.add:not(.selected)');
        elements.forEach(el => {
            el.classList.add('cloned');
        });
    }



    /** VYCISTENIE CLONED PRVKOV PRE SPRACOVANIE **/
    /* odstránime cloned prvky, aby sa to správne vložilo */
    image_kontajner.querySelectorAll('.cloned').forEach(el => el.remove());



    /** USPORIADANIE VELKYCH OBRAZKOV **/
    /* preusporiadame veľké obrázky podľa img_id */
    const big_images = Array.from(sliding_container.children);
    big_images.sort((a, b) => {
        return Number(a.dataset.imgId) - Number(b.dataset.imgId);
    });

    /* pridáme v správnom poradí naspäť */
    sliding_container.innerHTML = "";
    big_images.forEach(el => sliding_container.appendChild(el));



    /** KLONOVANIE **/
    /* naklonujeme malý a veľký prvok */
    const big_clone = big_selected.cloneNode(true);
    const small_clone = small_selected.cloneNode(true);
    const clones = [big_clone,small_clone];

    /* odstránime triedy klonom */
    clones.forEach(clone => {
        clone.classList.remove('add','selected','cloned');
    });

    /* posledné prvky v kontajneroch */
    const big_posledne = sliding_container.lastElementChild;
    const small_posledne = small_img_container.lastElementChild;

    /* vloženie pred posledné prvky */
    sliding_container.insertBefore(big_clone,big_selected);
    small_img_container.insertBefore(small_clone,small_selected);



    /** INPUTY KLONOV HANDLING **/
    /* file-inputy klonov, treba ich ošetriť, aby nemali eventy a aby sa dali pridávať obrázky na ne */
    const big_input = big_clone.querySelector('input[type="file"]');
    const small_input = small_clone.querySelector('input[type="file"]');

    /* event handling */
    const inputs = [big_input, small_input];  // Príklad s dvoma klonmi
    inputs.forEach(cloned_input => {
        remove_input_event(cloned_input);
        add_input_change(cloned_input);
    });



    /** PRIDANIE OBRÁZKOV DO KLONOV **/
    /* ček, či nemá img na sebe */
    clones.forEach(clone => {
        const img = clone.querySelector('img');
        if (new_src) {
            img.src = new_src;
        }
        else {
            img.removeAttribute('src');
        }
    });



    /** ZMENA SELECTED **/
    /* nastaví selected na ten, ktorý predchádza add prvku */
    const prev_id = curr_id_target >= 1 ? curr_id_target : 1;
    const prev_el = small_img_container.querySelector(`.small_img[data-img-id="${prev_id}"]`);

    small_selected.classList.remove('selected');
    prev_el.classList.add('selected');


    /* odstránime selected z veľkého obrázku a zvýšime img_id */
    big_selected.dataset.imgId = curr_id_target + 1;
    let curr_big_add = image_kontajner.querySelector('.big_img.add.selected');
    if (curr_big_add) {
        curr_big_add.classList.remove('selected');
    }



    /** inicializovanie skriptu **/
    scroll_init();

    /* nový selected */
    const next_big = get_next_child(sliding_container,big_selected, -1);

    /* trochu mágie */
    load_next(1,next_big);
    curr_big_selected.classList.remove('selected');
    next_big.classList.add('selected');



    /** POSUNIE NA AKTUALNY OBRAZOK, OPRAVA POSUNU **/
    const curr_id_selected = parseInt(curr_big_selected.dataset.imgId);
    if (curr_id_selected != curr_id_target) {
        /* ako ďaleko som od konca */
        const add_posun = curr_id_target - curr_id_selected;
        const target_pos = sliding_container.scrollLeft + add_posun * scroll_distance;

        console.log(sliding_container.scrollLeft,target_pos);

        /* posun */
        await smoothScrollTo(sliding_container, target_pos, 0);
        curr_big_selected = next_big;
    }



    /** UPDATE IMG_ID SELECTED ADD PRVKOV **/
    /* funguje to tak, že svoje id sa použije ako id nového prvku a oni sa potom navýšia o 1 */
    small_selected.dataset.imgId = curr_id_target + 1;
}


async function delete_img(target) {
    /** PRIPRAVA **/
    const parent = target.parentElement;
    const target_id = parseInt(parent.dataset.imgId);

    /* ak má aj nejakých klonov, tak aj tie selektnem */
    const to_delete = sliding_container.querySelectorAll(`.big_img[data-img-id="${target_id}"]`);

    /* má následovníka smerom dole? */
    const no_next = (target_id - 1 === 0) ? true : false;
    const nasledovnik_id = no_next ? target_id :target_id - 1;

    /* malé, ktoré treba prečísliť, len tie, ktoré majú väčšie id ako ja */
    const small_with_id = small_img_container.querySelector(`.small_img[data-img-id="${target_id}"]`);
    Array.from(small_img_container.children).forEach(el => {
        const el_id = parseInt(el.dataset.imgId);

        if (el_id > target_id) {
            /* velké, ktoré treba prečísliť */
            const velke_with_id = sliding_container.querySelectorAll(`.big_img[data-img-id="${el_id}"]`);
            velke_with_id.forEach(velke => {
               velke.dataset.imgId = parseInt(velke.dataset.imgId) - 1;
            });

            el.dataset.imgId = el_id - 1;
        }
    });



    /** MAZANIE PRVKU **/
    to_delete.forEach(el => {el.remove();});

    /* prislúchajúci malý img */
    small_with_id.remove();



    /** následovníci **/
    const big_nasledovnik = sliding_container.querySelector(`.big_img[data-img-id="${nasledovnik_id}"]:not(.cloned)`);
    const small_nasledovnik = small_img_container.querySelector(`.small_img[data-img-id="${nasledovnik_id}"]`);

    /* dáme im selected */
    big_nasledovnik.classList.add('selected');
    small_nasledovnik.classList.add('selected');

    /* posun nech vidím toho selected */
    const new_big = get_next_child(sliding_container,big_nasledovnik,-1);
    if (!no_next) {
        await smoothScrollTo(sliding_container, sliding_container.scrollLeft - scroll_distance, 0);

        load_next(-1,new_big);
        console.log("posunul?");
    }



    /** OPRAVA VYMAZANIA **/
    /* vymaže klonov a inicializuje skript */
    image_kontajner.querySelectorAll('.cloned').forEach(el => el.remove());
    scroll_init();

    /* poistka keby sa zle načítali deti */
    children = Array.from(sliding_container.children);
}

function delete_all_imgs() {
    /** vymaže všetko čo tam je a nechá len add **/
    /* nastaví zase img_id = 1 pre add prvky, budú selected */

    /* vymažem klonov najprv */
    image_kontajner.querySelectorAll('.cloned').forEach(el => el.remove());

    /* nechám len add */
    image_kontajner.querySelectorAll('.big_img:not(.add)').forEach(el => el.remove());
    image_kontajner.querySelectorAll('.small_img:not(.add)').forEach(el => el.remove());

    /* reset id a selected triedy */
    const big_remaining = sliding_container.querySelector('.big_img.add');
    const small_remaining = small_img_container.querySelector('.small_img.add');
    const adds = [big_remaining, small_remaining];

    /* nastavenie id a selected */
    adds.forEach(add => {
        add.dataset.imgId = 1;
        add.classList.add('selected');
    });

    /* redefinícia children lebo tam má uložených tých vymazaných */
    children = Array.from(sliding_container.children);
}


async function event_handle_img(event) {
    const target = event.target;
    const curr_id_target = target.dataset.imgId;

    /* klikol som na koš */
    if (target.classList.contains('trash_can_right')) {
        delete_img(target);
        return;
    }

    /* input pre súbor */
    const file_input = target.querySelector('input[type="file"]');

    /* otvorím ponuku len ak neťahám obrázok, len klik */
    if (can_open_input) {
        if (!target.classList.contains('add')) {
            file_input.click();
        }

        can_open_input = false;
    }

    if (add_img && target.classList.contains('add')) {
        new_add_img();
    }

    add_img = false;
}



/** EVENTY **/
image_kontajner.querySelectorAll('input[type="file"]').forEach(function(input) {
    remove_input_event(input);
});


/* pridáme im možnosť pridať obrázok */
image_kontajner.querySelectorAll('input[type="file"]').forEach(function(input) {
    add_input_change(input);
});

document.addEventListener('touchend', async function (event) {
    event_handle_img(event);
});

image_kontajner.addEventListener('click', async function (event) {
    event_handle_img(event);
});


/*
* TODO a PROBLEMY:
* - pridať vela obrázkov naraz
* - spraviť z toho formulár
* - zmazať fotku -- spravene
* - zmazať všetky fotky -- spravene
* - upraviť kod, upratať -- spravene
* */
