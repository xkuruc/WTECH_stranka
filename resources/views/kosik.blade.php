<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botaski</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>



<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
    </header>


    <main>
        <form action="/submit" method="post">
            <section class="pokladna_section">
                <div class="pokladna_container">
                    <div class="pokladna_nadpis">
                        <h1>Pokladňa</h1>
                    </div>

                    <div class="pokladna_informacie_container">
                        <div class="information_dodacia_adresa">
                            <div class="element_napis"> Dodacia adresa</div>
                            <div class="emial_container">
                                <label for="input_email"> E-mail adresa <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="input_email" type="email" name="email" placeholder="Email*" required  value="{{ old('email', optional(auth()->user())->email) }}" >


                            </div>
                            <div class="dalsie_info_container">
                                <div class="dalsie_info_div1">
                                    <label for="meno_input"> Meno <span class="hviezdicka">*</span></label>
                                    <input class="pokladna_input" id="meno_input" type="text" name="meno" placeholder="Meno*" value="{{ old('meno', optional(auth()->user())->meno) }}" required>
                                </div>

                                <div class="dalsie_info_div2">
                                    <label for="priezvisko_input"> Priezvisko <span class="hviezdicka">*</span></label>
                                    <input class="pokladna_input" id="priezvisko_input" type="text" name="priezvisko" placeholder="Priezvisko*"  value="{{ old('priezvisko', optional(auth()->user())->priezvisko) }}" required>
                                </div>


                                <div class="dalsie_info_div3">
                                    <label for="tel_cislo_input"> Telefónne číslo <span class="hviezdicka">*</span></label>
                                    <input class="pokladna_input" id="tel_cislo_input" type="tel" name="tel_cislo" placeholder="Tel číslo*"  value="{{ old('tel', optional(auth()->user())->telephone) }}" required>
                                </div>


                                <div class="dalsie_info_div4">
                                    <label for="adresa_input"> Adresa <span class="hviezdicka">*</span></label>
                                    <input class="pokladna_input" id="adresa_input" type="text" name="adresa" placeholder="Adresa*" value="{{ old('adresa', optional($shipping)->ulica) }}"  required>
                                </div>


                                <div class="dalsie_info_div5">
                                    <label for="cislo_input"> Číslo <span class="hviezdicka">*</span></label>
                                    <!-- <input class="pokladna_input" id="cislo_input" type="text" name="cislo"  placeholder="Číslo*" required> -->
                                    <input class="pokladna_input" id="cislo_input" type="text" name="cislo" placeholder="Číslo*"  value="{{ old('cislo', optional($shipping)->cisloDomu) }}" required>
                                </div>


                                <div class="dalsie_info_div6">
                                    <label for="mesto_input"> Mesto <span class="hviezdicka">*</span></label>
                                    <!-- <input class="pokladna_input" id="mesto_input" type="text" name="mesto"  placeholder="Mesto*" required> -->
                                    <input class="pokladna_input" id="mesto_input" type="text" name="mesto" placeholder="Mesto*"  value="{{ old('mesto', optional($shipping)->mesto) }}" required>
                                </div>


                                <div class="dalsie_info_div7">
                                    <label for="psc_input"> PSČ <span class="hviezdicka">*</span></label>
                                    <!-- <input class="pokladna_input" id="psc_input" type="text" name="psc"  placeholder="PSČ*" required required pattern="[0-9]{5}"> -->
                                    <input class="pokladna_input" id="psc_input" type="text" name="psc" placeholder="PSČ*" value="{{ old('psc', optional($shipping)->psc) }}" required>
                                </div>


                                <div class="dalsie_info_div8">
                                    <label for="krajina"> Krajina <span class="hviezdicka">*</span></label>
                                    <select id="krajina" class="krajina_select">
                                        <option value="Slovensko">Slovensko</option>
                                    </select>
                                </div>

                            </div>



                        </div>

                        <div class="sposob_dopravy_a_platba">
                            <div class="element_napis"> Spôsob dopravy</div>
                            <div class="moznosti">
                                <label>
                                    <input type="radio" name="doprava" value="osobny_odber_BA" data-price="1.00" required>
                                    <span>1,00 € </span>
                                    <span>Osobný odber- Bratislava Mlynské Nivy 10</span>

                                </label>

                                <label>
                                    <input type="radio" name="doprava" value="osobny_odber_KE" data-price="1.00">
                                    <span>1,00 € </span>
                                    <span>Osobný odber- Košice Kukučínová 2</span>
                                </label>

                                <label>
                                    <input type="radio" name="doprava" value="packeta" data-price="3.00">
                                    <span>3,00 € </span>
                                    <span>Výdajné Packeta miesto</span>
                                </label>

                                <label>
                                    <input type="radio" name="doprava" value="kurier" data-price="4.00">
                                    <span>4,00 € </span>
                                    <span>Kuriér Packeta (2-3 dni)</span>
                                </label>
                            </div>
                            <div class="platba">
                                <div class="element_napis"> Spôsob platby</div>
                                <div class="moznosti">
                                    <label>
                                        <input type="radio" name="platba" value="osobny_odber_BA" required>
                                        <span><i class="fas fa-box"></i> Dobierka </span>
                                    </label>
                                    <label>
                                        <input type="radio" name="platba" value="osobny_odber_BA">
                                        <span> <i class="fa-solid fa-credit-card"></i> Platba kartou </span>
                                    </label>
                                    <label>
                                        <input type="radio" name="platba" value="osobny_odber_BA">
                                        <span><i class="fa-brands fa-paypal"></i> Paypall express </span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="suhrn_objednavky">
                            <div class="element_napis"> Súhrn objednávky</div>
                            <div class="element_napis2"> Položky vo košíku </div>
                            <div class="polozky_vo_kosiku">


                @forelse($items as $item)
                    <div class="polozky_vo_kosiku_item">
                        <!-- 1) Obrázok produktu -->
                        <div class="cast1">
                            <img class="item_image"
                                 src="{{ asset('images/'. $item->product->images->firstWhere('is_main', true)->image_path) }}"
                                 alt="{{ $item->product->name }}">
                        </div>

                        <!-- 2) Popis, cena, veľkosť, množstvo -->
                        <div class="cast2">
                            <!-- Názov / popis -->
                            <div class="item_description">
                                {{ $item->product->name }}
                            </div>

                            <!-- Cena za kus -->
                            <div class="item_price_div">
                                <span class="item_price">
                                    {{ number_format($item->product->price, 2, ',', ' ') }} €
                                </span>
                            </div>

                            <!-- Veľkosť -->
                            <div class="item_size_div">
                                Size:
                                <span class="item_size">
                                    {{ $item->size }}
                                </span>
                            </div>

                            <!-- Množstvo s + / – tlačidlami -->
                            <!-- <div class="mnozstvo_div">
                                <span class="item_category">Množstvo:</span>
                                <form action="{{ route('cart.decrement', $item->id) }}"
                                    method="POST"
                                    class="quantity-form"
                                    style="display:inline">
                                    @csrf
                                    <button type="submit" class="quantity-btn">–</button>
                                </form>

                                <span class="quantity-value">{{ $item->quantity }}</span>

                                <form action="{{ route('cart.increment', $item->id) }}"
                                    method="POST"
                                    class="quantity-form"
                                    style="display:inline">
                                    @csrf
                                    <button type="submit" class="quantity-btn">+</button>
                                </form>
                            </div> -->
                            @csrf
                            <div class="mnozstvo_div">  
                                <span class="item_category">Množstvo:</span>
                                <a
                                    href="{{ route('cart.decrement', $item->id) }}"
                                    class="quantity-btn"
                                    title="Znížiť množstvo"
                                >-</a>

                                <span class="quantity-value">{{ $item->quantity }}</span>

                                <a
                                    href="{{ route('cart.increment', $item->id) }}"
                                    class="quantity-btn"
                                    title="Zvýšiť množstvo"
                                >+</a>
                            </div>


                        </div>
                    </div>
                @empty
                    <p>V košíku momentálne nič nie je.</p>
                @endforelse
                            </div>
                            @php
                                    $total = $items->sum(fn($item) => $item->product->price * $item->quantity);
                            @endphp
                            <div class="objednavka_information">
                                <div class="medzisucet_div">Medzisúčet košíka <span id="medzisucet_specified">{{ number_format($total, 2) }} </span></div>
                                <div class="doprava_div">
                                    <div class="doprava1">
                                        <div class="doprava_nadpis"> Doprava </div>
                                    </div>
                                    <div class="doprava2"></div>
                                    <span id="kamo" > - </span>
                                </div>
                                <div class="celkom_so_dph">
                                    <div>Celkom so DPH</div>
                                    <span id="celkom_so_dph_specified"> {{ number_format($total, 2) }} </span>
                                </div>
                                <div class="celkom_bez_dph">
                                    <div>Celkom bez DPH</div>
                                    <span id="celkom_bez_dph_specified"> {{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                            <!-- onclick="window.location.href='{{ url('/') }}' -->
                            <button type="submit" class="objednat_button"> OBJEDNAŤ </button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </main>


    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/kosik_srandy.js') }}"></script>
</body>
</html>

