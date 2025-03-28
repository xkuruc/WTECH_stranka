const product_container = document.querySelector(".product_list");
const body = document.body;
const popup_menu = document.querySelector(".popup_overlay");

product_container.addEventListener('click', (event) => { 
  	const target = event.target;

	if (event.target.closest(".trash_can")) {
	 	const pr_id = target.parentElement.dataset.productId; /* toto sa potom pošle na backend, že chcem vymazať tento produkt */


		show_popup(pr_id);

        target.parentElement.remove();


    }




});




function show_popup(product_id) {
	if (popup_menu.classList.contains('active')) { /* je otvorené */
		body.style.overflow = 'visible';
		popup_menu.classList.remove('active');
	}
	else { /* je zatvorené */
		body.style.overflow = 'hidden';
		popup_menu.classList.add('active');
	}


	



}




/* 

todo:
custom popup pri mazaní


sablona pre zoznam objednávok
sablona pre objednavku

*možno tlačidlo na vstup do dashboardu, to čo je, ale další login

je účet označený ako admin, klikne v profile na Admin Dashboard a musí sa zase prihlásiť
upravenie existujúceho produktu - to isté ako pridať produkt, ale dá sa meniť všetko

nákup bez prihlásenia
prenostielnost košíka

popup na odhlásenie

*/




