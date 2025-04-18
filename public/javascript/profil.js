const logout_btn = document.getElementById('logout_btn');


/* keď kliknem na Odhásiť sa, tak vyskočí zase popup menu */
logout_btn.addEventListener('click', async function(event) {
    const confirmed = await show_popup('Chcete sa odhlásiť'); /* čaká sa na odpoved, skript čaká */
    const logoutUrl = event.target.getAttribute('data-logout-url');

    if (confirmed) { /* klikol na odhlásenie */
        logout(logoutUrl); /* presmeruje na index.html */
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



