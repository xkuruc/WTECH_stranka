<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stranka</title>

    <link rel="stylesheet" href="./css/menu_bar.css">
    <link rel="stylesheet" href="./css/main_image.css">
    <link rel="stylesheet" href="./css/filter_menu.css">
    <link rel="stylesheet" href="./css/product_list.css">
    <link rel="stylesheet" href="./css/orderby_menu.css">
    <link rel="stylesheet" href="./css/product_item.css">
    <link rel="stylesheet" href="./css/page_number_list.css">
    <link rel="stylesheet" href="./css/filter_big_menu.css">
    <link rel="stylesheet" href="./css/newsletter.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/dropdown.css">
    <link rel="stylesheet" href="./css/menu_sidebar.css">
    <link rel="stylesheet" href="./css/kosik_sidebar.css">
    <link rel="stylesheet" href="./css/profile_intro.css">

</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.blade.php" class="logo_link"> <div class="logo main_category" >Logo </div> </a>
            <div class="menu_icon" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="nav">
                <ul class="menu">
                    <li class="main_category" id="tenisky">
                        <a href="./zoznam_produktov.html">Tenisky</a>
                        <ul class="dropdown-menu dropdown-menuTENISKY">
                            <li class="inside_category">
                                <span class="inside_category_name"><a href="#panskeTenisky"> Pánske tenisky </a></span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Pánske sportove tenisky </span>
                                    <span class="konkretna_moznost" >Pánske livestyle tenisky</span>
                                    <span class="konkretna_moznost">Nike</span>
                                    <span class="konkretna_moznost">Jordan</span>
                                    <span class="konkretna_moznost">Adidas</span>
                                    <span class="konkretna_moznost">Converse</span>
                                    <span class="konkretna_moznost">New balance</span>
                                    <span class="konkretna_moznost">Reebok</span>
                                    <span class="konkretna_moznost">Puma</span>
                                    <span class="konkretna_moznost">Vans</span>
                                </div>
                            </li>
                            <li class="inside_category">
                                <span class="inside_category_name"><a href="#damskeTenisky"> Dámske tenisky</a></span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Dámske sportove tenisky </span>
                                    <span class="konkretna_moznost">Dámske livestyle tenisky</span>
                                    <span class="konkretna_moznost">Nike</span>
                                    <span class="konkretna_moznost">Jordan</span>
                                    <span class="konkretna_moznost">Adidas</span>
                                    <span class="konkretna_moznost">Converse</span>
                                    <span class="konkretna_moznost">New balance</span>
                                    <span class="konkretna_moznost">Reebok</span>
                                    <span class="konkretna_moznost">Puma</span>
                                    <span class="konkretna_moznost">Vans</span>
                                </div>
                            </li>
                            <li class="inside_category">
                                <span class="inside_category_name"> Značky</span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Nike</span>
                                    <span class="konkretna_moznost">Jordan</span>
                                    <span class="konkretna_moznost">Adidas</span>
                                    <span class="konkretna_moznost">Converse</span>
                                    <span class="konkretna_moznost">New balance</span>
                                    <span class="konkretna_moznost">Reebok</span>
                                    <span class="konkretna_moznost">Puma</span>
                                    <span class="konkretna_moznost">Vans</span>
                                </div>
                            </li>
                            <li class="inside_category inside_category_posledny">
                                <span class="inside_category_name"><a href="#detskeTenisky"> Tenisky detské </a></span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Tenisky detské - bábätká (TD) </span>
                                    <span class="konkretna_moznost">Tenisky detské - mladšie deti (PS) </span>
                                    <span class="konkretna_moznost">Tenisky detské - staršie deti (GS) </span>
                                    <span class="konkretna_moznost">Nike</span>
                                    <span class="konkretna_moznost">Jordan</span>
                                    <span class="konkretna_moznost">Adidas</span>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="main_category">
                        <a href="./zoznam_produktov.html">Oblecenie</a>
                        <ul class="dropdown-menu dropdown-menuOBLECENIE">
                            <li class="inside_category">
                                <span class="inside_category_name"><a href="#panskeTenisky"> MUŽI </a></span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Pánske tričká </span>
                                    <span class="konkretna_moznost">Pánske mikiny </span>
                                    <span class="konkretna_moznost">Pánske bundy </span>
                                    <span class="konkretna_moznost">Pánske nohavice </span>
                                    <span class="konkretna_moznost">Pánske kraťasy </span>

                                </div>
                            </li>
                            <li class="inside_category">
                                <span class="inside_category_name"><a href="#damskeTenisky"> ŽENY </a></span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Dámske tričká </span>
                                    <span class="konkretna_moznost">Dámske mikiny </span>
                                    <span class="konkretna_moznost">Dámske bundy </span>
                                    <span class="konkretna_moznost">Dámske nohavice </span>
                                    <span class="konkretna_moznost">Dámske kraťasy </span>
                                </div>
                            </li>
                            <li class="inside_category">
                                <span class="inside_category_name"> Značky</span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Nike</span>
                                    <span class="konkretna_moznost">Jordan</span>
                                    <span class="konkretna_moznost">Adidas</span>
                                    <span class="konkretna_moznost">Adidas originals</span>
                                    <span class="konkretna_moznost">Puma</span>
                                    <span class="konkretna_moznost">Pleasures</span>
                                </div>
                            </li>
                            <li class="inside_category inside_category_posledny">
                                <span class="inside_category_name"><a href="#detskeTenisky"> DETI </a></span>
                                <div class="inside_category_moznosti">
                                    <span class="konkretna_moznost">Tričká </span>
                                    <span class="konkretna_moznost">Detské mikiny </span>
                                    <span class="konkretna_moznost">Detské bundy </span>
                                    <span class="konkretna_moznost">Detské kraťasy</span>
                                    <span class="konkretna_moznost">Detské súpravy </span>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="main_category">
                        <a href="./zoznam_produktov.html">Doplnky</a>
                        <ul class="dropdown-menu dropdown-menuDOPLNKY">
                            <div class="doplnky_placeholder">
                                <li class="inside_category">
                                    <span class="inside_category_Doplnky"><a href="#LOPTY"> LOPTY </a></span>
                                </li>
                                <li class="inside_category">
                                    <span class="inside_category_Doplnky"><a href="#BATOHY"> BATOHY </a></span>
                                </li>
                                <li class="inside_category">
                                    <span class="inside_category_Doplnky"> <a href="#CIAPKY"> ČIAPKY </a></span></span>
                                </li>
                                <li class="inside_category">
                                    <span class="inside_category_Doplnky"><a href="#PONOZKY"> PONOŽKY </a></span>
                                </li>
                                <li class="inside_category">
                                    <span class="inside_category_Doplnky"><a href="#SILTOVKY"> ŠILTOVKY </a></span>
                                </li>
                                <li class="inside_category">
                                    <span class="inside_category_Doplnky"><a href="#LADVINKA"> ĽADVINKA </a></span>
                                </li>
                                <li class="inside_category inside_category_posledny">
                                    <span class="inside_category_Doplnky"><a href="#OSTATNE"> OSTATNÉ </a></span>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li class="main_category"><a href="vypredaj.blade.php">Výpredaj</a></li>
                </ul>

            </div>
            <div class="right_part">
                <input class="vyhladaj_input"/>
                <a href="prihlasenie.blade.php" class="logo_link"><div class="profil">PROFIL </div></a>
                <div class="kosik last" onclick="toggleSidebarKosik()">KOSIK </div>
            </div>
        </nav>

        <div class="sidebar" id="sidebar">
            <div class="sidebar_header">
                <p class="sidebar_header_item"> Ponuka</p>
                <div >
                    <i class="fa-solid fa-arrow-left sidebar_header_item" onclick="toggleSidebar(event)"></i>
                </div>
            </div>
            <ul>
                <li>
                    <div class="sidebar_item" onclick="toggleSubmenu(event)">
                        <span class="sidebar_main" > TENISKY </span>
                        <span class="sidebar_main plus"> + </span>
                    </div>
                    <ul class="submenu">
                      <ul class="submenu2">
                        <li>
                            <div class="sidebar_item" onclick="toggleSubmenuPanskeTenisky(event)">
                                <span class="sidebar2_main" > Pánske tenisky </span>
                                <span class="sidebar_main plus"> + </span>
                            </div>
                            <ul class="submenu3 submenuPanskeTenisky ">
                                <li> <span class="submenu_item">Pánske sportove tenisky </span> </li>
                                <li> <span class="submenu_item">Pánske livestyle tenisky </span> </li>
                                <li> <span class="submenu_item">Nike </span> </li>
                                <li> <span class="submenu_item">Jordan </span> </li>
                                <li> <span class="submenu_item">Adidas </span> </li>
                                <li> <span class="submenu_item">Converse </span> </li>
                                <li> <span class="submenu_item">New Balance </span> </li>
                                <li> <span class="submenu_item">Rebook  </span> </li>
                                <li> <span class="submenu_item">Puma </span> </li>
                                <li> <span class="submenu_item">Vans </span> </li>
                            </ul>
                        </li>
                        <li>
                            <div class="sidebar_item" onclick="toggleSubmenuDamskeTenisky(event)">
                                <span class="sidebar2_main" > Dámske tenisky </span>
                                <span class="sidebar_main plus"> + </span>
                            </div>
                            <ul class="submenu3 submenuDamskeTenisky">
                                <li> <span class="submenu_item">Dámske sportove tenisky </span> </li>
                                <li> <span class="submenu_item">Dámske livestyle tenisky </span> </li>
                                <li> <span class="submenu_item">Nike </span> </li>
                                <li> <span class="submenu_item">Jordan </span> </li>
                                <li> <span class="submenu_item">Adidas </span> </li>
                                <li> <span class="submenu_item">Converse </span> </li>
                                <li> <span class="submenu_item">New Balance </span> </li>
                                <li> <span class="submenu_item">Rebook  </span> </li>
                                <li> <span class="submenu_item">Puma </span> </li>
                                <li> <span class="submenu_item">Vans </span> </li>
                            </ul>
                        </li>
                        <li>
                            <div class="sidebar_item" onclick="toggleSubmenuZnacky(event)">
                                <span class="sidebar2_main" > Značky </span>
                                <span class="sidebar_main plus"> + </span>
                            </div>
                            <ul class="submenu3 submenuZnacky">
                                <li> <span class="submenu_item">Nike </span> </li>
                                <li> <span class="submenu_item">Jordan </span> </li>
                                <li> <span class="submenu_item">Adidas </span> </li>
                                <li> <span class="submenu_item">Converse </span> </li>
                                <li> <span class="submenu_item">New Balance </span> </li>
                                <li> <span class="submenu_item">Rebook  </span> </li>
                                <li> <span class="submenu_item">Puma </span> </li>
                                <li> <span class="submenu_item">Vans </span> </li>
                            </ul>
                        </li>
                        <li>
                            <div class="sidebar_item" onclick="toggleSubmenuDetskeTenisky(event)">
                                <span class="sidebar2_main" > Detské tenisky </span>
                                <span class="sidebar_main plus"> + </span>
                            </div>
                            <ul class="submenu3 submenuDetskeTenisky">
                                <li> <span class="submenu_item">Tenisky detské - bábätká (TD)  </span> </li>
                                <li> <span class="submenu_item">Tenisky detské - mladšie deti (PS) </span> </li>
                                <li> <span class="submenu_item">Tenisky detské - staršie deti (GS) </span> </li>
                                <li> <span class="submenu_item">Nike </span> </li>
                                <li> <span class="submenu_item">Jordan </span> </li>
                                <li> <span class="submenu_item">Adidas  </span> </li>
                            </ul>
                        </li>
                      </ul>

                    </ul>
                  </li>
              <li>
                <div class="sidebar_item" onclick="toggleSubmenu(event)">
                    <span class="sidebar_main" href="#">OBLEČENIE </span>
                    <span class="sidebar_main plus"> + </span>
                </div>
                <ul class="submenu">
                    <ul class="submenu2">
                      <li>
                          <div class="sidebar_item" onclick="toggleSubmenuMUZI(event)">
                              <span class="sidebar2_main" > Muži </span>
                              <span class="sidebar_main plus"> + </span>
                          </div>
                          <ul class="submenu3 submenuMUZI ">
                              <li> <span class="submenu_item">Pánske tričká </span> </li>
                              <li> <span class="submenu_item">Pánske mikiny </span> </li>
                              <li> <span class="submenu_item">Pánske bundy </span> </li>
                              <li> <span class="submenu_item">Pánske nohavice </span> </li>
                              <li> <span class="submenu_item">Pánske kraťasy </span> </li>
                          </ul>
                      </li>
                      <li>
                          <div class="sidebar_item" onclick="toggleSubmenuZENY(event)">
                              <span class="sidebar2_main" > Ženy </span>
                              <span class="sidebar_main plus"> + </span>
                          </div>
                          <ul class="submenu3 submenuZENY">
                              <li> <span class="submenu_item">Dámske tričká </span> </li>
                              <li> <span class="submenu_item">Dámske mikiny </span> </li>
                              <li> <span class="submenu_item">Dámske bundy </span> </li>
                              <li> <span class="submenu_item">Dámske nohavice </span> </li>
                              <li> <span class="submenu_item">Dámske kraťasy </span> </li>
                          </ul>
                      </li>
                      <li>
                          <div class="sidebar_item" onclick="toggleSubmenuZnackyOBLECENIE(event)">
                              <span class="sidebar2_main" > Značky </span>
                              <span class="sidebar_main plus"> + </span>
                          </div>
                          <ul class="submenu3 submenuZnackyOBLECENIE">
                              <li> <span class="submenu_item">Nike </span> </li>
                              <li> <span class="submenu_item">Jordan </span> </li>
                              <li> <span class="submenu_item">Adidas </span> </li>
                              <li> <span class="submenu_item">Adidas Originals </span> </li>
                              <li> <span class="submenu_item">Puma </span> </li>
                              <li> <span class="submenu_item">Pleasures </span> </li>
                          </ul>
                      </li>
                      <li>
                          <div class="sidebar_item" onclick="toggleSubmenuDETI(event)">
                              <span class="sidebar2_main" > Deti </span>
                              <span class="sidebar_main plus"> + </span>
                          </div>
                          <ul class="submenu3 submenuDETI">
                            <li> <span class="submenu_item">Detské tričká </span> </li>
                            <li> <span class="submenu_item">Detské mikiny </span> </li>
                            <li> <span class="submenu_item">Detské bundy </span> </li>
                            <li> <span class="submenu_item">Detské kraťasy</span> </li>
                            <li> <span class="submenu_item">Detské súpravy </span> </li>
                          </ul>
                      </li>
                    </ul>

                  </ul>
                </li>
                <li>
                    <div class="sidebar_item" onclick="toggleSubmenu(event)">
                        <span class="sidebar_main" href="#">DOPLNKY </span>
                        <span class="sidebar_main plus"> + </span>
                    </div>
                    <ul class="submenu">
                        <ul class="submenu2">
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY " > Lopty </span>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Batohy </span>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Čiapky </span>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Ponožky </span>
                            </li>
                            <li>
                            <div class="sidebar_item">
                                <span class="sidebar2_main sidebar2_mainDOPLNKY" > Šiltovky </span>
                            </li>
                            <li>
                            <div class="sidebar_item">
                                <span class="sidebar2_main sidebar2_mainDOPLNKY" > Ľadvinka </span>
                            </li>
                            <li>
                            <div class="sidebar_item">
                                <span class="sidebar2_main sidebar2_mainDOPLNKY" > Ostatné </span>
                            </li>
                        </ul>
                        </ul>
                </li>
                <li>
                    <div class="sidebar_item">
                        <span class="sidebar_main sidebar_vypredaj_item" href="#">Výpredaj </span>
                    </div>
                </li>
                <li>
                    <div class="sidebar_item">
                        <span class="sidebar_main komunita_vypredaj_item" href="#">Komunita </span>
                    </div>
                </li>


            </ul>
        </div>
        <div class="overlay" onclick="toggleSidebar()"></div>
        <div class="kosik_sidebar" id="kosik_sidebar">
            <div class="kosik_sidebar_header">
                <p>MôJ KOŠÍK  </p>
                <div >
                    <i class="fa-solid fa-arrow-right" onclick="toggleSidebarKosik(event)"></i>
                </div>
            </div>
            <div class="kosik_sidebar_items_container">
                <div class="kosik_sidebar_item">
                    <div id="kosik_sidebar_item_photo"></div>
                    <div class="kosik_sidebar_item_information">
                        <div class="kosik_sidebar_item_name"> <span id="kosik_sidebar_item_name_specified"> Air Jordan 4 RM "University Blue"</span></div>
                        <div class="kosik_sidebar_item_size">EUR: <span id="kosik_sidebar_item_size_specified">40.5</span> </div>
                    </div>
                </div>
                <div class="kosik_sidebar_item">
                    <div id="kosik_sidebar_item_photo"></div>
                    <div class="kosik_sidebar_item_information">
                        <div class="kosik_sidebar_item_name"> <span id="kosik_sidebar_item_name_specified"> Air Jordan 4 RM "University Blue"</span></div>
                        <div class="kosik_sidebar_item_size">EUR: <span id="kosik_sidebar_item_size_specified">40.5</span> </div>
                    </div>
                </div>
                <div class="kosik_sidebar_item">
                    <div id="kosik_sidebar_item_photo"></div>
                    <div class="kosik_sidebar_item_information">
                        <div class="kosik_sidebar_item_name"> <span id="kosik_sidebar_item_name_specified"> Air Jordan 4 RM "University Blue"</span></div>
                        <div class="kosik_sidebar_item_size">EUR: <span id="kosik_sidebar_item_size_specified">40.5</span> </div>
                    </div>
                </div>
                <div class="kosik_sidebar_item">
                    <div id="kosik_sidebar_item_photo"></div>
                    <div class="kosik_sidebar_item_information">
                        <div class="kosik_sidebar_item_name"> <span id="kosik_sidebar_item_name_specified"> Air Jordan 4 RM "University Blue"</span></div>
                        <div class="kosik_sidebar_item_size">EUR: <span id="kosik_sidebar_item_size_specified">40.5</span> </div>
                    </div>
                </div>
                <div class="kosik_sidebar_item">
                    <div id="kosik_sidebar_item_photo"></div>
                    <div class="kosik_sidebar_item_information">
                        <div class="kosik_sidebar_item_name"> <span id="kosik_sidebar_item_name_specified"> Air Jordan 4 RM "University Blue"</span></div>
                        <div class="kosik_sidebar_item_size">EUR: <span id="kosik_sidebar_item_size_specified">40.5</span> </div>
                    </div>
                </div>
            </div>

            <div class="kosik_sidebar_zaverecne_info">
                <div class="kosik_sidebar_zaverecne_info_medzisucet">
                    <div class="kosik_sidebar_zaverecne_info_medzisucet1">Medzisúčet košíka </div>
                    <div class="kosik_sidebar_zaverecne_info_medzisucet2"><span id="kosik_sidebar_zaverecne_info_medzisucet_specified">150.00</span> </div>

                </div>
                <a href="kosik.blade.php" class="prejst_do_pokladne_button"> Prejsť do pokladne </a>
            </div>
        </div>
        <div class="overlay2" onclick="toggleSidebarKosik()"></div>
    </header>




    <main>
        <aside class="text_filter">
            <h1>Tenisky</h1>
            <div class="filter_menu">
                <button class="filter_menu_item special" id="filter_open_btn">Filter</button>
                <div class="filter_kategorie", id="sliding_filter">
                    <button class="filter_menu_item" data-category ="brand">Značka</button>
                    <button class="filter_menu_item" data-category ="size">Veľkosť</button>
                    <button class="filter_menu_item" data-category ="color">Farba</button>
                    <button class="filter_menu_item" data-category ="available">Dostupnosť</button>
                    <button class="filter_menu_item" data-category ="price_sale">Cena</button>
                    <button class="filter_menu_item" data-category ="gender">Pohlavie</button>
                </div>
            </div>
        </aside>


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
                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>
                </article>


                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>
                </article>


                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>
                </article>


                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>
                </article>


                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka.jpg">
                    </div>

                    <div class="product_info">
                        <p>NIKE SABRINA 2 “FRESH MINT” WMNS</p>
                        <p><strong>130,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka2.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball MB.04 "Creativity Pack"</p>
                        <p><strong>135,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka3.jpg">
                    </div>

                    <div class="product_info">
                        <p>Puma x LaMelo Ball La France "Chrome Silver"</p>
                        <p><strong>110,00 €</strong></p>
                    </div>
                </article>


                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka4.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Foamposite One "Black Volt"</p>
                        <p><strong>230,00 €</strong></p>
                    </div>
                </article>


                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka5.jpg">
                    </div>

                    <div class="product_info">
                        <p>Nike Air Zoom G.T. Cut 3 "Blue Fury"</p>
                        <p><strong>200,00 €</strong></p>
                    </div>
                </article>

                <article class="product_item">
                    <div class="item_img">
                        <img src="./images/sample_topanka6.jpg">
                    </div>

                    <div class="product_info">
                        <p>New Balance U327SKC</p>
                        <p><strong>120,00 €</strong></p>
                    </div>
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
        <section class="filter_overlay">
            <div id="filter_container">
                <div class="top_filter_menu">
                    <div class="filt_top">
                        <button id="resize_back_btn"><img src="./icons/back_arrow.svg"></button>
                        <h2 id="filter_placeholder">Filtre</h2>
                        <button id="close_btn">
                            <img src="./icons/close_btn_X.svg">
                        </button>
                    </div>

                    <div class="selected_filters">
                        <p>Vybrané filtre:</p>
                        <div id="sel_filter_container">

                        </div>
                    </div>
                </div>



                <div class="filter_content">
                    <aside class="filter_category" id="cat_filter">
                        <button class="fil_cat selected" data-category ="brand">Značka</button>
                        <button class="fil_cat" data-category ="size">Veľkosť</button>
                        <button class="fil_cat" data-category ="color">Farba</button>
                        <button class="fil_cat" data-category ="available">Dostupnosť</button>
                        <button class="fil_cat" data-category ="price_sale">Cena</button>
                        <button class="fil_cat" data-category ="gender">Pohlavie</button>
                    </aside>


                    <section class="category_content selected" id="brand">
                        <div class="category_entry_list" data-category="brand">
                            <h3 class="category_identifier">Značka</h3>

                            <div class="checkbox_entry" data-value="Adidas">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Adidas</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Nike">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Nike</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Puma">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Puma</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Vans">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Vans</span>
                                </label>
                            </div>
                        </div>
                    </section>


                    <section class="category_content" id="size">
                        <div class="category_entry_list" data-category="size">
                            <h3 class="category_identifier">Veľkosť</h3>
                            <div class="cat_btn_container_sizes">

                            </div>
                        </div>
                    </section>


                    <!-- vždy bude mať trieda category_entry_list data-category -->
                    <section class="category_content" id="color">
                        <div class="category_entry_list" data-category="color">
                            <h3 class="category_identifier">Farba</h3>
                            <div class="cat_btn_container" >


                            </div>
                        </div>
                    </section>


                    <section class="category_content" id="available">
                        <div class="category_entry_list" data-category="available">
                            <h3 class="category_identifier">Dostupnosť</h3>
                            <div class="checkbox_entry" data-value="skladom">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Iba skladom</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Bratislava">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Na predajni v Bratislave</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Praha">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Na predajni v Prahe</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Košice">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Na predajni v Košiciach</span>
                                </label>
                            </div>
                        </div>
                    </section>


                    <section class="category_content" id="price_sale">
                        <div class="joined_cat_content">
                            <div class="category_entry_list" data-category="price">
                                <h3 class="category_identifier">Cena</h3>

                                <div class="min_max_filter">

                                    <div class="input_wrapper">
                                        <input type="number" class="min_price" value="0" min="10" max="1000"/>
                                        <span class="currency">€</span>
                                    </div>

                                    <div class="input_wrapper" >
                                        <input type="number" class="max_price" value="1000" min="10" max="1000"/>
                                        <span class="currency">€</span>
                                    </div>


                                </div>
                                <div class="slider_container">
                                    <span class="slider_track"></span>
                                    <div class="filled_track" id="filled_track"></div>
                                    <input type="range" class="min_slider" min="0" max="1000" value="0" step="20">
                                    <input type="range" class="max_slider" min="0" max="1000" value="1000" step="20">
                                </div>
                            </div>


                            <!--  data-op je operátor pre zľavu, od/do pre data-value  -->
                            <div class="category_entry_list" data-category="sale">
                                <h3 class="category_identifier">Zľavy</h3>

                                <div class="checkbox_entry" data-op="do" data-value="20">
                                    <label class="custom_checkbox">
                                      <input type="checkbox" />
                                      <span class="checkmark"></span>
                                      <span class="category_text">do 20%</span>
                                    </label>
                                </div>

                                <div class="checkbox_entry" data-op="od" data-value="20">
                                    <label class="custom_checkbox">
                                      <input type="checkbox" />
                                      <span class="checkmark"></span>
                                      <span class="category_text">od 20%</span>
                                    </label>
                                </div>

                                <div class="checkbox_entry" data-op="do" data-value="40">
                                    <label class="custom_checkbox">
                                      <input type="checkbox" />
                                      <span class="checkmark"></span>
                                      <span class="category_text">do 40%</span>
                                    </label>
                                </div>

                                <div class="checkbox_entry" data-op="do" data-value="100">
                                    <label class="custom_checkbox">
                                      <input type="checkbox" />
                                      <span class="checkmark"></span>
                                      <span class="category_text">Všetky zľavy</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </section>


                    <section class="category_content" id="gender">
                        <div class="category_entry_list" data-category="gender">
                            <h3 class="category_identifier">Pohlavie</h3>
                            <div class="checkbox_entry" data-value="Pánske">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Pánske</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Dámske">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Dámske</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Unisex">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Unisex</span>
                                </label>
                            </div>

                            <div class="checkbox_entry" data-value="Detské">
                                <label class="custom_checkbox">
                                  <input type="checkbox" />
                                  <span class="checkmark"></span>
                                  <span class="category_text">Detské</span>
                                </label>
                            </div>
                        </div>
                    </section>

                    <section class="category_content" id="no_filter">
                        <h3 class="category_identifier">No filter selected.</h3>
                    </section>

                </div>




                <div class="bottom_filter_menu">
                    <button id="resetFilters"><p>Vymazať filtre</p></button>
                    <button id="applyFilter">Zobraziť položky</button>
                </div>


                <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="./javascript/side_menubar.js"></script>
                <script src="./javascript/filter_overlay.js"></script>
                <script src="./javascript/price_slider.js"></script>
                <script src="./javascript/filter_resize.js"></script>
            </div>
        </section>
    </main>






    @include('components.footer_newsletter')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="./javascript/side_menubar.js"></script>
    <script src="./javascript/kosik_sidebar.js"></script>
    <script src="./javascript/zoznam_produktov.js"></script>

    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
</body>
</html>
