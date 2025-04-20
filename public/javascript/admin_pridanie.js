const image_kontajner = document.querySelector('.product_images_kontajner');


image_kontajner.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});



function input_change(event) {
    const target = event.target;
    const parent = target.parentElement;
    const curr_id = parent.dataset.imgId;
    const img = parent.querySelector('img');
    const plusko = parent.querySelector('.plusko');

    console.log('activated change');
    const file = target.files[0];

    if (file) {
        const reader = new FileReader();

        /* kopia na pridružený obrázok */
        const velke_a_cloned = document.querySelectorAll(`.big_img[data-img-id="${curr_id}"]`);


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
                const prvok = document.querySelector(`.small_img[data-img-id="${curr_id}"]`);
                const prvok_img = prvok.querySelector('img');
                const prvok_plusko = prvok.querySelector('.plusko');

                prvok_img.src = e.target.result;
                prvok_plusko.style.display = 'none';
            }
        }

        reader.readAsDataURL(file); // Načíta obrázok ako data URL (base64)
    }
}


/* pridáme im možnosť pridať obrázok */
image_kontajner.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('change', function(event) {
        input_change(event);
    });
});


image_kontajner.addEventListener('click', async function (event) {
    const target = event.target;
    const curr_id_target = target.dataset.imgId;
    /*
        Ak kliknem veľký obrázok, vyberie sa file a nakopíruje sa do prázdneho small_img
        Ak kliknem malý obrázok, ten sa zase nakopíruje podľa id do veľkého a asi tak spravím aj s tým prvým
     */




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
        /* treba pridať 1 veľký a 1 malý obrázok */
        /* najprv malý? */
        const target_class = target.classList;

        if (target_class.contains('cloned')) {
            target_class.remove('cloned');

            const elements = document.querySelectorAll('.add:not(.selected)');
            elements.forEach(el => {
                el.classList.add('cloned');
            });


        }


        /* odstránime cloned prvky, aby sa to správne vložilo */
        image_kontajner.querySelectorAll('.cloned').forEach(el => el.remove());

        const big_images = Array.from(sliding_container.children);
        big_images.sort((a, b) => {
            return Number(a.dataset.imgId) - Number(b.dataset.imgId);
        });

        /* pridáme v správnom poradí naspäť */
        sliding_container.innerHTML = "";
        big_images.forEach(el => sliding_container.appendChild(el));


        const add_self_container = (target_class.contains('big_img')) ? sliding_container : small_img_container;
        const add_other_container = (add_self_container === sliding_container) ? small_img_container : sliding_container;


        const selektor = (target_class.contains('big_img')) ? 'small_img' : 'big_img';
        const other_add = image_kontajner.querySelector(`.${selektor}.add[data-img-id="${curr_id_target}"]`);
        other_add.dataset.imgId = parseInt(target.dataset.imgId) + 1;






        /* klon aktuálneho prvku čo som klikol */
        let cloned = target.cloneNode(true);
        cloned.classList.remove('add','selected');


        /* chceme vložiť na predposledné miesto */
        const posledne = add_self_container.lastElementChild;
        add_self_container.insertBefore(cloned, posledne);



        const cloned_input = cloned.querySelector('input[type="file"]');

        cloned_input.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        cloned_input.addEventListener('change', function(event) {
            input_change(event);
        });



        /* vložíme veľký obrázok na koniec */
        const new_node = add_other_container.lastElementChild;
        const cloned_new = new_node.cloneNode(true);



        cloned_new.classList.remove('selected','cloned','add');
        cloned_new.dataset.imgId = target.dataset.imgId; /* rovnaké ako malý obrázok */


        /* ček, či nemá img na sebe */
        const img = cloned_new.querySelector('img');
        img.removeAttribute('src');



        /* treba jeho inputu zakázať klikanie a umožniť im pridanie obrázkov */
        const big_input = cloned_new.querySelector('input[type="file"]');
        big_input.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        big_input.addEventListener('change', function(event) {
            input_change(event);
        });

        const big_plusko = cloned_new.querySelector('.plusko');
        big_plusko.style.display = 'block';










        /* pridanie nového prvku */
        add_other_container.insertBefore(cloned_new,new_node);
        target.dataset.imgId = parseInt(curr_id_target) + 1; /* uchovávam si aké je ďalšie id */



        const small_selected = image_kontajner.querySelector('.small_img.selected');
        const curr_small = small_selected.dataset.imgId;
        if (small_selected.classList.contains('add')) {
            const prev_id = (curr_small - 1) >= 1 ? curr_small - 1 : 1;

            const prev_el = small_img_container.querySelector(`.small_img[data-img-id="${prev_id}"]`);
            //console.log(prev_el);

            small_selected.classList.remove('selected');
            prev_el.classList.add('selected');
        }



        const curr_big_add = image_kontajner.querySelector('.big_img.add.selected');
        if (curr_big_add) {
            curr_big_add.classList.remove('selected');
        }


        /* inicializovanie skriptu */
        scroll_init();


        const curr_big = image_kontajner.querySelector('.big_img.selected');
        curr_big.classList.remove('selected');



        const next_big = get_next_child(curr_big_add, -1);
        next_big.classList.add('selected');





        if (small_selected.dataset.imgId - 1 != first_img_id) {
            const add_posun = max_id - parseInt(small_selected.dataset.imgId);


            const target_pos = sliding_container.scrollWidth - add_posun * scroll_distance;


            await smoothScrollTo(sliding_container, target_pos, 0);



            curr_big_selected = next_big;
            load_next(1,next_big);
            load_next(-1,next_big);

            //console.log(add_posun, small_selected.dataset.imgId, first_img_id);
        }




        add_img = false;
    }


});





/*
*
* TODO a PROBLEMY:
* - aby ked pridám nový prvok a nie som na prvok, tak nech ma to dá tam kde som bol, čiže ten initial posun -- funguje
* - pridať do velkých ten + image -- funguje
* - plus menšie bugy -- fixed
* - zmazať fotku
* - zmazať všetky fotky
* - nech mi to neotvára input ak som potiahol a skončil cca na rovnakom mieste
*
* */
