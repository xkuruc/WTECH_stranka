<div class="overlay" onclick="toggleSidebar()"></div>
<div class="kosik_sidebar" id="kosik_sidebar">
    <div class="kosik_sidebar_header">
        <p>MôJ KOŠÍK  </p>
        <div >
            <i class="fa-solid fa-arrow-right" onclick="toggleSidebarKosik(event)"></i>
        </div>
    </div>


<div class="kosik_sidebar_items_container">
    @forelse($cartItems as $item)
        <div class="kosik_sidebar_item">
            <!-- 1) Obrázok produktu -->
            <div >
                <img  id="kosik_sidebar_item_photo"
                    src="{{ asset('images/'. $item->product->main_image) }}"
                    alt="{{ $item->product->name }}" 
                >
            </div>

            <!-- 2) Informácie o produkte -->
            <div class="kosik_sidebar_item_information">
                <!-- Názov -->
                <div class="kosik_sidebar_item_name">
                    <span id="kosik_sidebar_item_name_specified">
                        {{ $item->product->name }}
                    </span>
                </div>
                <!-- Veľkosť -->
                <div class="kosik_sidebar_item_size">
                    US: 
                    <span id="kosik_sidebar_item_size_specified">
                        {{ $item->size }}
                    </span>
                </div>
                <!-- Cena za kus -->
                <div class="kosik_sidebar_item_price">
                    <span class="item_category"> Cena:</span> <span class="cena_kus"> {{ number_format($item->product->price, 2) }} €</span>
                </div>  {{-- Blade zobrazenie dát používa jednoduchú syntaxu {{ }} :contentReference[oaicite:0]{index=0} --}}


                <!-- Množstvo -->
                <div class="kosik_sidebar_item_quantity">
                <span class="item_category">Qty</span>: {{ $item->quantity }}
                <!-- Množstvo + ovládacie tlačidlá -->
<div class="kosik_sidebar_item_quantity">
    <form action="{{ route('cart.decrement', $item->id) }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="quantity-btn">-</button>
    </form>

    <span class="quantity-value">{{ $item->quantity }}</span>

    <form action="{{ route('cart.increment', $item->id) }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="quantity-btn">+</button>
    </form>
</div>
                </div>

            </div>
        </div>
    @empty
        <p>V košíku momentálne nič nie je.</p>
    @endforelse
</div>
    @php
        // vypočíta sumu: cena * množstvo pre každú položku
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    @endphp

    <div class="kosik_sidebar_zaverecne_info">
        <div class="kosik_sidebar_zaverecne_info_medzisucet">
            <div class="kosik_sidebar_zaverecne_info_medzisucet1">Medzisúčet košíka </div>
            <div class="kosik_sidebar_zaverecne_info_medzisucet2"><span id="kosik_sidebar_zaverecne_info_medzisucet_specified">{{ number_format($total, 2) }}</span> </div>

        </div>
        
        <a href="{{ route('kosik') }}" class="prejst_do_pokladne_button"> Prejsť do pokladne </a>
    </div>
</div>
<div class="overlay2" onclick="toggleSidebarKosik()"></div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    @if(session('toggle_sidebar'))
      // zavolá tvoju funkciu a sidebar ostane otvorený
      toggleSidebarKosik();
    @endif
  });
</script>