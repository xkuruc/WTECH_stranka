<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
        @include('components.kosik_sidebar')
    </header>


    <main>
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
                            <input class="pokladna_input" id="input_email" type="text" name="email"  placeholder="Email*" required>
                            <div class="emial_container_odkaz">Po dokončení nákupu môžete vytvoriť účet. </div>
                        </div>
                        <div class="dalsie_info_container">
                            <div class="dalsie_info_div1">
                                <label for="meno_input"> Meno <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="meno_input" type="text" name="meno"  placeholder="Meno*" required>
                            </div>

                            <div class="dalsie_info_div2">
                                <label for="priezvisko_input"> Priezvisko <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="priezvisko_input" type="text" name="priezvisko"  placeholder="Priezvisko*" required>
                            </div>


                            <div class="dalsie_info_div3">
                                <label for="tel_cislo_input"> Telefónne číslo <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="tel_cislo_input" type="tel" name="tel_cislo"  placeholder="Tel číslo*" required>
                            </div>


                            <div class="dalsie_info_div4">
                                <label for="adresa_input"> Adresa <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="adresa_input" type="text" name="adresa"  placeholder="Adresa*" required>
                            </div>


                            <div class="dalsie_info_div5">
                                <label for="cislo_input"> Číslo <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="cislo_input" type="text" name="cislo"  placeholder="Číslo*" required>
                            </div>


                            <div class="dalsie_info_div6">
                                <label for="mesto_input"> Mesto <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="mesto_input" type="text" name="mesto"  placeholder="Mesto*" required>
                            </div>


                            <div class="dalsie_info_div7">
                                <label for="psc_input"> PSČ <span class="hviezdicka">*</span></label>
                                <input class="pokladna_input" id="psc_input" type="text" name="psc"  placeholder="PSČ*" required required pattern="[0-9]{5}">
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
                                <input type="radio" name="doprava" value="osobny_odber_BA">
                                <span>1,00 € </span>
                                <span>Osobný odber- Bratislava Mlynské Nivy 10</span>

                            </label>

                            <label>
                                <input type="radio" name="doprava" value="osobny_odber_KE">
                                <span>1,00 € </span>
                                <span>Osobný odber- Košice Kukučínová 2</span>
                            </label>

                            <label>
                                <input type="radio" name="doprava" value="packeta">
                                <span>3,00 € </span>
                                <span>Výdajné Packeta miesto</span>
                            </label>

                            <label>
                                <input type="radio" name="doprava" value="kurier">
                                <span>4,00 € </span>
                                <span>Kuriér Packeta (2-3 dni)</span>
                            </label>
                        </div>

                        <div class="platba">
                            <div class="element_napis"> Spôsob platby</div>
                            <div class="moznosti">
                                <label>
                                    <input type="radio" name="platba" value="osobny_odber_BA">
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
                            <div class="polozky_vo_kosiku_item">
                                <div class="cast1">
                                    <div id="item_image"></div>
                                </div>
                                <div class="cast2">
                                    <div id="item_description">Air Jordan 4 RM "University Blue" </div>
                                    <div class="item_price_div"> <span id="item_price"> 150,00 </span></div>
                                    <div class="mnozstvo_div"> Množstvo <input type="text" value="1" id="item_amount"> </span> </div>
                                    <div class="item_size_div"> EUR: <span id="item_size">40.5</span> </div>
                                    <div class="icon_div"> <i class="fa-solid fa-trash"></i> </div>
                                </div>
                            </div>
                            <div class="polozky_vo_kosiku_item">
                                <div class="cast1">
                                    <div id="item_image"></div>
                                </div>
                                <div class="cast2">
                                    <div id="item_description">Air Jordan 4 RM "University Blue" </div>
                                    <div class="item_price_div"> <span id="item_price"> 150,00 </span></div>
                                    <div class="mnozstvo_div"> Množstvo <input type="text" value="1" id="item_amount"> </span> </div>
                                    <div class="item_size_div"> EUR: <span id="item_size">40.5</span> </div>
                                    <div class="icon_div"> <i class="fa-solid fa-trash"></i> </div>
                                </div>
                            </div>


                        </div>
                        <div class="objednavka_information">
                            <div class="medzisucet_div">Medzisúčet košíka <span id="medzisucet_specified">150.00 </span></div>
                            <div class="doprava_div">
                                <div class="doprava1">
                                    <div class="doprava_nadpis"> Doprava </div>
                                    <div id="doprava_typ"> Packeta - Kuriér (2-3 dni) </div>
                                </div>
                                <div class="doprava2"></div>
                                 <span id="doprava_specified">4.00 </span>
                            </div>
                            <div class="celkom_so_dph">
                                <div>Celkom so DPH</div>
                                <span id="celkom_so_dph_specified"> 154.00</span>
                            </div>
                            <div class="celkom_bez_dph">
                                <div>Celkom bez DPH</div>
                                <span id="celkom_bez_dph_specified"> 125.20</span>
                            </div>
                        </div>
                        <button class="objednat_button"> OBJEDNAŤ </button>
                    </div>
                </div>
            </div>
        </section>
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
</body>
</html>
