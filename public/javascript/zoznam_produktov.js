const kontajner = document.querySelector('.produkty_kontajner');


kontajner.addEventListener('click', async function(event)  { 
    const target = event.target;

    if (event.target.closest(".product_item")) {
        
        window.location.href = "./polozka_produktu.html" /* presmeruje na index.html */
        
    }
});