const product_container = document.querySelector(".product_list");



product_container.addEventListener('click', (event) => { 
  	const target = event.target;

	if (event.target.closest(".trash_can")) {
	 	const pr_id = target.parentElement.dataset.productId; /* toto sa potom pošle na backend, že chcem vymazať tento produkt */

        target.parentElement.remove();
    }

});



