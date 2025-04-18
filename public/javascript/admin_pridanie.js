const image_kontajner = document.querySelector('.product_images_kontajner');

document.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});



document.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('change', function(event) {
        const target = event.target;
        const parent = target.parentElement;
        const img = parent.querySelector('img');
        const plusko = parent.querySelector('.plusko');

        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            /* kopia na pridružený obrázok */
            const curr_id = parent.dataset.imgId;
            const selektor = (parent.classList.contains('big_img')) ? 'small_img' : 'big_img';
            const prvok = document.querySelector(`.${selektor}[data-img-id="${curr_id}"]`);
            const prvok_img = prvok.querySelector('img');


            /* vloží obrázky do placeholderov */
            reader.onload = function (e) {
                img.src = e.target.result;
                prvok_img.src = e.target.result;
            }


            plusko.style.display = 'none'; //skryje plusko
            reader.readAsDataURL(file); // Načíta obrázok ako data URL (base64)
        }
    });
});


image_kontajner.addEventListener('click', function (event) {
    const target = event.target;

    /*
        Ak kliknem veľký obrázok, vyberie sa file a nakopíruje sa do prázdneho small_img
        Ak kliknem malý obrázok, ten sa zase nakopíruje podľa id do veľkého a asi tak spravím aj s tým prvým
     */


    /* input pre súbor */
    const file_input = target.querySelector('input[type="file"]');


    /* otvorím ponuku len ak neťahám obrázok, len klik */
    if (can_open_input) {
        file_input.click();
        can_open_input = false;
    }
});
