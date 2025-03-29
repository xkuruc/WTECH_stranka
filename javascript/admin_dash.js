const product_container = document.querySelector(".product_list");
const body = document.body;
const logout = document.getElementById("logout_btn");




/* pre každý ten produkt ak kliknem na koš, tak vyskočí ponuka vymazania */
product_container.addEventListener('click', async function(event)  { 
  	const target = event.target;

	if (event.target.closest(".trash_can")) {
	 	const pr_id = target.parentElement.dataset.productId; /* toto sa potom pošle na backend, že chcem vymazať tento produkt */

		const confirmed = await show_popup(`Chcete vymazať produkt s ID: ${pr_id}`); /* čaká sa na odpoved, skript čaká */
		if (confirmed) { /* ak je odpoveď true (môže byť true/false) */
            target.parentElement.remove();
        } 
    }
});



/* keď kliknem na Odhásiť sa, tak vyskočí zase popup menu */
logout.addEventListener('click', async function(event) {
    const confirmed = await show_popup('Chcete opustiť administrátorské rozhranie'); /* čaká sa na odpoved, skript čaká */

    if (confirmed) { /* klikol na odhlásenie */
        window.location.href = "./index.html" /* presmeruje na index.html */
    }
});





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


/* 

spravené:

*/




