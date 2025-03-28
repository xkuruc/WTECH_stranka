const product_container = document.querySelector(".product_list");
const body = document.body;
const popup_menu = document.getElementById("popup_overlay");
const popup_accept = document.getElementById('popup_accept');
const popup_cancel = document.getElementById('popup_cancel');





product_container.addEventListener('click', async function(event)  { 
  	const target = event.target;

	if (event.target.closest(".trash_can")) {
	 	const pr_id = target.parentElement.dataset.productId; /* toto sa potom pošle na backend, že chcem vymazať tento produkt */


		const confirmed = await show_popup(pr_id, `Chcete vymazať produkt s ID: ${pr_id}`); /* čaká sa na odpoved, skript čaká */


		if (confirmed) { /* ak je odpoveď true (môže byť true/false) */
            console.log("Objekt bol zmazaný!");
            target.parentElement.remove();

        } else {
            console.log("Zmazanie bolo zrušené.");
        }

    }
});




function show_popup(product_id, message) {
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
	body.style.overflow = 'hidden';
    popup_menu.classList.add('active');
}


function close_popup() {
    body.style.overflow = 'visible';
	popup_menu.classList.remove('active');
}


/* 

todo:

sablona pre zoznam objednávok
sablona pre objednavku

*možno tlačidlo na vstup do dashboardu, to čo je, ale další login

je účet označený ako admin, klikne v profile na Admin Dashboard a musí sa zase prihlásiť
upravenie existujúceho produktu - to isté ako pridať produkt, ale dá sa meniť všetko

nákup bez prihlásenia
prenostielnost košíka

popup na odhlásenie -- treba najprv profil 

*/




