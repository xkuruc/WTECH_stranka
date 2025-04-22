<nav class="navbar">
    <a href="/" class="logo_link"> <div class="logo main_category" >Logo </div> </a>
    <div class="menu_icon" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="nav">
        <ul class="menu">
            <li class="main_category" id="tenisky">
                <a href="{{ url('/Tenisky') }}">Tenisky</a>
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
                <a href="{{ url('/Kopacky') }}">Kopačky</a>
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
                <a href="{{ url('/Lopty') }}">Lopty</a>
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
            <li class="main_category"><a href="{{ url('/Vypredaj') }}">Výpredaj</a></li>
        </ul>

    </div>
    <div class="right_part">
        <form action="{{ route('search') }}" method="GET">
            <input class="vyhladaj_input" type="text" name="query" placeholder="Vyhľadajte produkt..." value="{{ request()->query('query') }}">
            <button type="submit">Hľadať</button>
        </form>
        <!-- <a href="prihlasenie.blade.php" class="logo_link"><div class="profil">PROFIL </div></a> -->

        <ul>
            <!-- Ak je používateľ prihlásený, zobrazí sa Profil -->
            @auth
                <a href="{{ route('profil') }}" class="logo_link">
                    <div class="profil">PROFIL</div>
                </a>
            @endauth

            <!-- Ak používateľ nie je prihlásený, zobrazí sa Login -->
            @guest
                <a href="{{ route('login') }}" class="logo_link">
                    <div class="profil">LOGIN</div>
                </a>
            @endguest
        </ul>


        <div class="kosik last" onclick="toggleSidebarKosik()">KOSIK </div>
    </div>
</nav>
