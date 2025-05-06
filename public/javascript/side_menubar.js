function toggleSidebar() {
    //document.getElementById('sidebar').classList.toggle('active');
    var sidebar = document.getElementById('sidebar');
    var overlay = document.querySelector('.overlay');

    sidebar.classList.toggle('active');
    overlay.style.display = sidebar.classList.contains('active') ? "block" : "none";
}

function toggleSubmenu(event) {
    event.preventDefault(); /* zabráni event správaniu */

    /* na čo som klikol */
    const target = event.target;

    /* parent lebo chcem dať select na sibling element */
    const parent = target.parentNode;
    const submenu = parent.querySelector('[class*="submenu"]');

    /* minusko/plusko */
    var plusMinus = target.querySelector(".plus");

    /* ak existuje submenu, tak ho prepni */
    if (submenu) {
        submenu.classList.toggle('open');
        plusMinus.textContent = submenu.classList.contains('open') ? "-" : "+";
    }
}
