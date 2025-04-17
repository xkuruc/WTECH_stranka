<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stranka</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orderby_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_item.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page_number_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter_big_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/text_divider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/popup_overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/objednavka_prehlad.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>

    <main>
        <div class="objednavka_prehlad_wrapper">

            <section class="objednavka_info">
                <h1>Objednávka</h1>

                <ul class="info_ul">
                    <li>Číslo objednávky: <strong>102456123202</strong></li>
                    <li>Dátum vytvorenia: <strong>10.5.2025</strong></li>
                    <li>Spôsob platby <strong>Dobierka</strong></li>
                    <li>Spôsob dopravy: <strong>Osobný odber - Košice Kukučínova 2</strong></li>
                </ul>
            </section>


            <section class="kosik_produkty">
                <hr class="hr_divider full">

                    <div class="produkty_container">

                        <div class="product">
                            <div class="product_obrazok">
                                <img src="./images/sample_topanka2.jpg">
                            </div>
                            <div class="product_info">
                                <ul class="nazov_cena">
                                    <li><strong>NIKE SABRINA 2 “FRESH MINT” WMNS</strong></li>
                                    <li class="cena">130,00 €</li>
                                </ul>
                                <div class="mnozstvo">
                                    Množstvo:
                                    <div class="mnozstvo_btn">1</div>
                                </div>
                                <div class="velkost"><strong>EUR:</strong> 38</div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product_obrazok">
                                <img src="./images/sample_topanka3.jpg">
                            </div>
                            <div class="product_info">
                                <ul class="nazov_cena">
                                    <li><strong>NIKE SABRINA 2 “FRESH MINT” WMNS</strong></li>
                                    <li class="cena">300,00 €</li>
                                </ul>
                                <div class="mnozstvo">
                                    Množstvo:
                                    <div class="mnozstvo_btn">1</div>
                                </div>
                                <div class="velkost"><strong>EUR:</strong> 38</div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product_obrazok">
                                <img src="./images/sample_topanka4.jpg">
                            </div>
                            <div class="product_info">
                                <ul class="nazov_cena">
                                    <li><strong>NIKE SABRINA 2 “FRESH MINT” WMNS</strong></li>
                                    <li class="cena">215,00 €</li>
                                </ul>
                                <div class="mnozstvo">
                                    Množstvo:
                                    <div class="mnozstvo_btn">1</div>
                                </div>
                                <div class="velkost"><strong>EUR:</strong> 38</div>
                            </div>
                        </div>

                        <div class="product">
                            <div class="product_obrazok">
                                <img src="./images/sample_topanka5.jpg">
                            </div>
                            <div class="product_info">
                                <ul class="nazov_cena">
                                    <li><strong>NIKE SABRINA 2 “FRESH MINT” WMNS</strong></li>
                                    <li class="cena">510,00 €</li>
                                </ul>
                                <div class="mnozstvo">
                                    Množstvo:
                                    <div class="mnozstvo_btn">1</div>
                                </div>
                                <div class="velkost"><strong>EUR:</strong> 38</div>
                            </div>
                        </div>
                    </div>

                <hr class="hr_divider full">
            </section>



            <section class="adresa_cena">
                <section class="adresa">
                    <h1>Adresa doručenia</h1>

                    <ul class="info_ul">
                        <li>Adresa: <strong>Záhradná 53</strong></li>
                        <li>Mesto: <strong>Bratislava</strong></li>
                        <li>PSČ: <strong>12345</strong></li>
                        <li>Krajina: <strong>Slovensko</strong></li>
                    </ul>
                </section>

                <section class="cena_section">
                    <h1>Celková cena</h1>

                    <ul class="info_ul">
                        <li>Medzisúčet košíka: <strong>500,00 €</strong></li>
                        <li>Doprava: <strong>4,00 €</strong></li>
                        <li>Daň: <strong>115,00 €</strong></li>
                        <li>Celkom s DPH: <strong>500,00 €</strong></li>
                        <li>Celkom bez DPH: <strong>385,00 €</strong></li>
                    </ul>
                </section>
            </section>
        </div>


        <!-- popup okno -->
        @include('components.popup')
    </main>


    <!-- popup okno -->
    @include('components.footer_newsletter')

    <!-- exterbné skripty -->
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
    <script src="{{ asset('javascript/popup_okno.js') }}"></script>
</body>
</html>
