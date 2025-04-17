<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
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
                        <a href="zoznam_produktov.blade.php">Tenisky</a>
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
                        <a href="zoznam_produktov.blade.php">Oblecenie</a>
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
                        <a href="zoznam_produktov.blade.php">Doplnky</a>
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
                                </div>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Čiapky </span>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Ponožky </span>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Šiltovky </span>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Ľadvinka </span>
                                </div>
                            </li>
                            <li>
                                <div class="sidebar_item">
                                    <span class="sidebar2_main sidebar2_mainDOPLNKY" > Ostatné </span>
                                </div>
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
        <section class="main">
            <div class="options">
                <div class="option_prihlasitsa">Admin Dashboard</div>
            </div>
            <div>
                <form class="login_placeholder" onsubmit="window.location.href = 'admin_dashboard.blade.php'; return false;">
                    <input class="login_input" type="email" name="email" placeholder="E-mail*" required/>
                    <input class="login_input" type="password" name="password" placeholder="Heslo*" required />
                    <button class="login_button" type="submit">PRIHLÁSIŤ SA </button>
                </form>
                <p class="Zabudliheslo"> <a href="a">Zabudli ste heslo ? </a> </p>
                <div class="povinne_policka">
                    <p>*Povinné políčka</p>
                </div>
            </div>

        </section>
    </main>

    <footer class="joined_footer">
        <section class="info_section">
            <div class="info_nadpis">DORUČENIE A VRÁTENIE TOVARU </div>
            <div class="info">
                <div class="info1">
                    <div class="info_mininadpis"> O nás</div>
                    <div>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil veniam hic, animi corrupti nulla eius pariatur modi consequatur quo nisi magni? Voluptatem, perferendis. Sed, exercitationem est adipisci delectus repellendus dolore.
                    </div>
                    <div><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil veniam hic, animi corrupti nulla eius pariatur modi consequatur quo nisi magni? Voluptatem, perferendis. Sed, exercitationem est adipisci delectus repellendus dolore.
                    </div>
                </div>
                <div class="info2">
                    <div class="info_mininadpis"> Doručenie</div>
                    <div> Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, sequi. Voluptas cumque et, id inventore odio nobis enim iure dicta autem fuga veritatis, ullam iste possimus eos. Eum, ratione voluptas?</div>
                    <div class="info_mininadpis"> Ako vrátim tovar ? </div>
                    <div> Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, sequi. Voluptas cumque et, id inventore odio nobis enim iure dicta autem fuga veritatis, ullam iste possimus eos. Eum, ratione voluptas?</div>
                </div>
            </div>
        </section>


        <section class="newsletter">
            <div class="newsletter_obsah">
                <div class="newsletter_label"> Nezmeškaj veľkú šancu </div>
                <div class="newsletter_label2"> Prihláste sa do newslettera a získajte výhodné ponuky</div>
                <div class="newsletter_button_input">
                    <form onsubmit="alert('Zadaný e-mail: ' + this.email.value); return false;">
                        <input class="newsletter_input" type="email" name="email" placeholder="Vložte svoj e-mail" required/>
                        <button class="prihlasit_button" type="submit"> <span class="emoji">👟</span> PRIHLÁSIŤ SA </button>
                    </form>
                </div>
            </div>
        </section>


        <section class="footer_asi">
            <div class="footer_container">
                <div class="obchod_info">
                        <div class="obchod">
                            <div class="obchod_label"> Obchod- Praha </div>
                            <div class="obchod_text">Martinská 2, 110 00 </div>
                            <div>
                                <div class="obchod_hodiny_text"> Otvaracie hodiny </div>
                                <div class="obchod_text" style="white-space: pre;">PO - SO       11:00-19:00</div>
                                <div class="obchod_text" style="white-space: pre;">NE:              ZATVORENE</div>
                            </div>

                        </div>
                        <div class="obchod druhy">
                            <div class="obchod_label">Obchod- Bratislava </div>
                            <div class="obchod_text">Mlynské Nivy 10, 821 09</div>
                            <div>
                                <div class="obchod_hodiny_text"> Otvaracie hodiny </div>
                                <div class="obchod_text" style="white-space: pre;">PO - SO       10:00-20:00</div>
                                <div class="obchod_text" style="white-space: pre;">NE:              ZATVORENE</div>
                            </div>

                        </div>
                        <div class="obchod">
                            <div class="obchod_label">Obchod- Kosice </div>
                            <div class="obchod_text">Kukučínova 2, 040 01</div>
                            <div>
                                <div class="obchod_hodiny_text"> Otvaracie hodiny </div>
                                <div class="obchod_text" style="white-space: pre;">PO - SO       11:00-19:00</div>
                                <div class="obchod_text" style="white-space: pre;">NE:              ZATVORENE</div>
                            </div>

                        </div>
                </div>
                <div class="podmienky">
                    <div class="podmienky1">
                        <div class="podmienky_label"> The Blocks </div>
                        <br>
                        <div class="footer_text">  Obchody The Blocks </div>
                        <div class="footer_text">   Ochrana osobných údajov </div>
                        <div class="footer_text">   Ochranné podmienky </div>
                        <div class="footer_text">   Cookies </div>
                        <div class="footer_text">   Naše značky </div>
                        <div class="footer_text">   Eco Mission </div>
                        <div class="footer_text">   Affiliate </div>
                    </div>
                    <div class="podmienky2">
                        <div class="podmienky_label"> FAQ </div>
                        <br>
                        <div class="footer_text"> The Blocks family </div>
                        <div class="footer_text"> Platba a doručenie </div>
                        <div class="footer_text"> Reklamácia a vrátenie </div>
                        <div class="footer_text"> Blog </div>
                        <div class="footer_text"> Kontakt </div>
                        <div class="footer_text">  > </div>
                        <br>
                        <!-- <i class="fa-brands fa-linkedin-in"></i> -->
                    </div>
                    <div class="footer_social">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-x-twitter"></i>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./javascript/side_menubar.js"></script>
    <script src="./javascript/kosik_sidebar.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
</body>
</html>
