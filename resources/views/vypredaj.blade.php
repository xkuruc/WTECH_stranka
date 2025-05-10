<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botaski</title>

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
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>


    <main>

        <!-- filter menu -->
        @include('components.filter_menu')


        <section class="produkty_kontajner">
            <!-- zoradiť podľa menučko -->
            <div class="orderby_menu">
                <p>Zoradiť podľa: </p>
                <select id="Najnovšie" name="ovocie">
                  <option value="Najnovšie">Najnovšie</option>
                  <option value="Najlacnejšie">Najlacnejšie</option>
                  <option value="Najdrahšie">Najdrahšie</option>
                  <option value="Najpredávanejšie">Najpredávanejšie</option>
                </select>
            </div>


            <!-- obrázky a info/ceny k nim pochádzajú zo stránky https://www.thestreets.sk/ -->
            <!-- zoznam produktov -->
            <div class="product_list">
                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-20%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-30%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-50%</div>
                </article>


                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-10%</div>
                </article>


                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-15%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-80%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-20%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-30%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-50%</div>
                </article>


                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-10%</div>
                </article>


                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-15%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-80%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-20%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-30%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-50%</div>
                </article>


                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-10%</div>
                </article>


                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-15%</div>
                </article>

                <article class="product_item_relative">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-80%</div>
                </article>
            </div>


            <!-- stránkovanie -->
            <nav class="page_number_list">
                <button id="prev_page_btn"><img src="./icons/filter_sipka.svg"></button>
                <div id="page_list">
                    <button class="page_number active" id="page1">1</button>
                    <button class="page_number" id="page2">2</button>
                    <button class="page_number" id="page3">3</button>
                    <button class="page_number" id="page4">4</button>
                </div>
                <button id="next_page_btn"><img src="./icons/filter_sipka.svg"></button>
                <script src="./javascript/page_number.js"></script>
            </nav>
        </section>

        <!-- filter overlay -->
        @include('components.big_filter')
    </main>


    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/product_slider.js') }}"></script>
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
