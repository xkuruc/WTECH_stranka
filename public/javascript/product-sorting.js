document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('sort-cheapest');
    const container = document.querySelector('.product_list');
  
    btn.addEventListener('click', () => {
      // všetky linky do poľa
      const items = Array.from(container.querySelectorAll('.product_link'));
  
      // zoradíme podľa ceny vnútri <strong class="price">
      items.sort((a, b) => {
        const pa = parsePrice(a), pb = parsePrice(b);
        return pa - pb;
      });
  
      // vyprázdnime a znovu pripojíme v poradí
      container.innerHTML = '';
      items.forEach(item => container.appendChild(item));
    });
  
    function parsePrice(linkEl) {
      // nájdeme <strong class="price">12.34 €
      const txt = linkEl.querySelector('.price').textContent;
      // odstránime medzery, znak eur a premeníme na číslo
      return parseFloat(txt.replace(/\s|€/g, '').replace(',', '.')) || 0;
    }
  });
  