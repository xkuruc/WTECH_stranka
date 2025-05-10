<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botaski</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registracia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>

    <main>
        <section class="osobne_udaje_section">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <h3 class="reg_nadpis">Osobné informácie</h3>
                <div class="osobne_udaje_container">
                    <input class="registration_input" type="text" name="meno"  placeholder="Meno*" required/>
                    <input class="registration_input" type="text" name="priezvisko" placeholder="Priezvisko*" required/>
                    <input class="registration_input" type="email" name="email" placeholder="E-mail*" required/>
                    <input class="registration_input" type="password" name="password" placeholder="Heslo*" required/>

                    <select class="registration_input" name="pohlavie">
                        <option value="" disabled selected>Pohlavie*</option>
                        <option value="male">Muž</option>
                        <option value="female">Žena</option>
                    </select>

                    <input class="registration_input" type="password" name="password_confirmation" placeholder="Potvrdiť heslo*" required/>

                    <div class="date-input">
                        <span class="label">Dátum narodenia</span>
                        <input class="daco" type="date" name="datum_narodenia">
                    </div>
                    <div class="newsletter_reg">
                        <label>
                            <input class="registration_input" type="checkbox" name="newsletter" value="1">
                            Prihlásiť sa k odberu newslettera
                        </label>
                    </div>
                </div>

                <h3 class="reg_nadpis">Kontaktné údaje</h3>
                <div class="kontaktne_udaje_container">
                    <input class="registration_input div1" type="tel" name="telephone" placeholder="Telefónne číslo*" required/>
                    <input class="registration_input div2" type="text" name="ulica" placeholder="Ulica*" required/>
                    <input class="registration_input div3" type="text" name="cisloDomu" placeholder="Číslo domu*" required/>
                    <input class="registration_input div4" type="text" name="mesto" placeholder="Mesto*" required/>
                    <input class="registration_input div5" type="text" name="psc" placeholder="PSČ*" required pattern="[0-9]{5}" />
                    <select class="div6" name="krajina">
                        <option value="Slovensko">Slovensko</option>
                    </select>
                </div>

                <h3 class="reg_nadpis">Personalizácia</h3>
                <div class="personalizacia_container">
                    <!--
                    <input class="registration_input personalizacia_div1" type="text" name="tiktok" placeholder="Tik-tok profil"/>
                    <input class="registration_input personalizacia_div2" type="text" name="instagram" placeholder="Instagramový profil"/>
                    -->


                    <select id="height" name="vyska" class="registration_input personalizacia_div3">
                        <option value="" disabled selected>Tvoja výška</option>
                    </select>

                    <select id="weight" name="hmotnost" class="registration_input personalizacia_div4">
                        <option value="" disabled selected>Tvoja hmotnosť</option>
                    </select>

                    <select id="shoesize" name="velkost_topanok" class="registration_input personalizacia_div5">
                        <option value="" disabled selected>Veľkosť topánok (EU)</option>
                    </select>


                    <div class="personalizacia_div6">
                        <!--
                        <div class="dropdown registration_select" onclick="toggleDropdown('sizesDropdown')">
                            <input type="text" id="selectedSizes" placeholder="Preferovaná veľkosť oblečenia" readonly>
                            <div id="sizesDropdown" class="dropdown-content">
                                <div onclick="selectOption('sizes', 'XXS')">XXS</div>
                                <div onclick="selectOption('sizes', 'XS')">XS</div>
                                <div onclick="selectOption('sizes', 'S')">S</div>
                                <div onclick="selectOption('sizes', 'M')">M</div>
                                <div onclick="selectOption('sizes', 'L')">L</div>
                                <div onclick="selectOption('sizes', 'XL')">XL</div>
                                <div onclick="selectOption('sizes', 'XXL')">XXL</div>
                                <div onclick="selectOption('sizes', 'XXXL')">XXXL</div>
                            </div>
                        </div>
                        -->

                        <div class="dropdown registration_select personalizacia_div7" onclick="toggleDropdown('brandsDropdown')">
                            <input type="text" id="selectedBrands" placeholder="Preferovaná značka" readonly>
                            <input type="hidden" name="znacka" id="brandsHidden">

                            <div id="brandsDropdown" class="dropdown-content">
                                @foreach ($brands as $brand)
                                    <div onclick="selectOption('brands', '{{ $brand->display_name }}')">
                                        {{ $brand->display_name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button_placeholder">
                    <button class="Vytvorit_ucet_button" type="submit"> Vytvoriť účet </button>
                </div>

            </form>
        </section>
    </main>

    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- naše skripty -->
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/registracia.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
