const product_container = document.querySelector(".product_list");
const body = document.body;
const logout_btn = document.getElementById("logout_btn");




/* pre každý ten produkt ak kliknem na koš, tak vyskočí ponuka vymazania */
product_container.addEventListener('click', async function(event)  {
  	const target = event.target;

	if (event.target.closest(".trash_can")) {
	 	const pr_id = target.parentElement.dataset.productId; /* toto sa potom pošle na backend, že chcem vymazať tento produkt */

		const confirmed = await show_popup(`Chcete vymazať produkt s ID: ${pr_id}`); /* čaká sa na odpoved, skript čaká */
		if (confirmed) { /* ak je odpoveď true (môže byť true/false) */
            fetch(`/produkty/${pr_id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Chyba:', error));


            target.parentElement.remove();

        }
    }
    else if (event.target.closest(".product_item_relative")) {
        if (event.target.closest(".product_item_relative").id === 'add_product') {
            window.location.href = "/admin_add_product" /* presmeruje na pridanie_polozky.html */
        }
        else {
            window.location.href = "./polozka_produktu.html"
        }
    }
});



/* keď kliknem na Odhásiť sa, tak vyskočí zase popup menu */
logout_btn.addEventListener('click', async function(event) {
    const confirmed = await show_popup('Chcete opustiť administrátorské rozhranie'); /* čaká sa na odpoved, skript čaká */
    const logoutUrl = event.target.getAttribute('data-logout-url');

    if (confirmed) { /* klikol na odhlásenie */
        logout(logoutUrl) /* presmeruje na index.html */
    }
});


function logout(logoutUrl) {
    const form = document.createElement('form');
    form.method = 'POST';

    form.action = logoutUrl; // Route pre odhlásenie

    // Vytvorenie CSRF token inputu
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // Pridanie formulára do tela a odoslanie
    document.body.appendChild(form);
    form.submit();
}
