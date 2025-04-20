
document.addEventListener('DOMContentLoaded', () => {
  const radios = document.querySelectorAll('input[name="doprava"]');
  const kamoEl = document.getElementById('kamo');
  const VAT_RATE = 0.23;  // 23 % DPH
  const subtotalEl = document.getElementById('medzisucet_specified');
  const totalNetEl = document.getElementById('celkom_bez_dph_specified');
  const totalGrossEl = document.getElementById('celkom_so_dph_specified');


  // Funkcia, ktorá zistí vybranú cenu a vráti ju ako číslo
  function getSelectedPrice() {
    const checked = document.querySelector('input[name="doprava"]:checked');
    if (!checked) return null;
    return parseFloat(checked.dataset.price);
  }

  // Funkcia na aktualizáciu elementu kamo
  function updateKamo() {
    const price = getSelectedPrice();
    if (price !== null) {
      // formát: dve desatinné miesta + euro znak
      kamoEl.textContent = price.toFixed(2);
    } else {
      kamoEl.textContent = '—';
    }
    let text = subtotalEl.textContent.trim().replace(/\s|€/g, '').replace(',', '.');
    const subtotal = parseFloat(text);
    const total = subtotal + price;
    totalNetEl.textContent = Math.round(total.toFixed(2) * (1-VAT_RATE) * 100) / 100;
    totalGrossEl.textContent = Math.round(total.toFixed(2)* 100) / 100;;





  }

  // Pridáme listener na všetky radio buttony
  radios.forEach(radio => {
    radio.addEventListener('change', updateKamo);
  });

  // Volanie hneď po načítaní, ak je niečo predvybraté
  updateKamo();
});

