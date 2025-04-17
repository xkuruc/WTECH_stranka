const container = document.querySelector('.objednavky_container');


/* presmeruje na stránku o prehlade objednávky */
/* samozrejme, ked bude backend, tak to pojde cez backend */
container.addEventListener('click', (event) => { 
  	const target = event.target;

	window.location.href = "./objednavka_prehlad.html"
});