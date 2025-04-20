<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
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
            <section class="text_divider"> <!-- text admin dashboard a potom oddelovať čiara -->
                <div class="h1_buttons">
                    <h1>Admin Dashboard</h1>
                    <a id="logout_btn" data-logout-url="{{ route('admin_leave_dash') }}">Opustiť rozhranie</a>
                </div>
                <hr class="hr_divider">
            </section>


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
                <article class="product_item_relative" id="add_product">
                    <div class="item_img"></div>

                    <div class="product_info">
                        <p>Pridať nový produkt</p>
                        <p><strong>0,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-??%</div>
                </article>


                <article class="product_item_relative" data-product-id="1">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-20%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="2">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-30%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="3">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-50%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>


                <article class="product_item_relative" data-product-id="4">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-10%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>


                <article class="product_item_relative" data-product-id="5">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-15%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="6">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-80%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="1">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-20%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="2">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-30%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="3">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-50%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>


                <article class="product_item_relative" data-product-id="4">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-10%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>


                <article class="product_item_relative" data-product-id="5">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-15%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="6">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-80%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="1">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-20%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="2">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-30%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>

                <article class="product_item_relative" data-product-id="3">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>

                    <div class="sale_placeholder">-50%</div>
                    <button class="trash_can">
                        <img src="./icons/kos_icon.png">
                    </button>
                </article>
            </div>



            <!-- stránkovanie -->
            <nav class="page_number_list">
                <button id="prev_page_btn"><img src="./icons/filter_sipka.svg"></button>
                <div id="page_list">
                    <button class="page_number active",id="page1">1</button>
                    <button class="page_number",id="page2">2</button>
                    <button class="page_number",id="page3">3</button>
                    <button class="page_number",id="page4">4</button>
                </div>
                <button id="next_page_btn"><img src="./icons/filter_sipka.svg"></button>
                <script src="./javascript/page_number.js"></script>
            </nav>
        </section>


        <!-- filter overlay -->
        @include('components.big_filter')

        <!-- popup okno -->
        @include('components.popup')
    </main>


    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/filter_overlay.js') }}"></script>
    <script src="{{ asset('javascript/price_slider.js') }}"></script>
    <script src="{{ asset('javascript/filter_resize.js') }}"></script>
    <script src="{{ asset('javascript/admin_dash.js') }}"></script>
    <script src="{{ asset('javascript/popup_okno.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
