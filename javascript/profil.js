const logout = document.getElementById('logout_btn');


/* keď kliknem na Odhásiť sa, tak vyskočí zase popup menu */
logout.addEventListener('click', async function(event) {
    const confirmed = await show_popup('Chcete sa odhlásiť'); /* čaká sa na odpoved, skript čaká */

    if (confirmed) { /* klikol na odhlásenie */
        window.location.href = "./index.html" /* presmeruje na index.html */
    }
});





