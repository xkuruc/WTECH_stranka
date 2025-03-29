const body2 = document.body;


const popup_menu = document.getElementById("popup_overlay");
const popup_accept = document.getElementById('popup_accept');
const popup_cancel = document.getElementById('popup_cancel');


function show_popup(message) {
	return new Promise((resolve, reject) => {
        //nastavím správu popupu
        popup_menu.querySelector('p').textContent = message;
        
        //zobrazenie popupu
        open_popup();


        //klikne na "Áno"
        popup_accept.onclick = () => {
            resolve(true);  //resolve sa nastaví na true, teda potvrdil akciu
            close_popup();
        };

        //klikne na "Nie"
        popup_cancel.onclick = () => {
            resolve(false); //resolve sa nastaví na false, teda zrušil akciu
            close_popup();
        };

        //kliknem mimo overlay, tak sa to zruší
        popup_menu.onclick = () => {
            resolve(false); //resolve sa nastaví na false, teda zrušil akciu
            close_popup();
        };
    });
}


function open_popup() {
	body2.style.overflow = 'hidden';
    popup_menu.classList.add('active');
}


function close_popup() {
    body2.style.overflow = 'visible';
	popup_menu.classList.remove('active');
}