<nav class="navbar">
    
    <div class="logoMain">
        <a href="/"> 
            <!-- <div class="" >Logo </div> -->
            <i class="fa-solid fa-basketball"></i>
        </a>    
    </div>
    
    <div class="menu_icon" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </div>
    <div class="nav">
        <ul class="menu">
            <li class="main_category" id="tenisky">
                <a href="{{ url('/Tenisky') }}">Tenisky</a>
                <ul class="dropdown-menu dropdown-menuTENISKY">
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Pánske']) }}"> Pánske tenisky </a></span>
                        <div class="inside_category_moznosti">
                            @foreach($tenisky_pack['Pánske'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Pánske_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Dámske']) }}"> Dámske tenisky</a></span>
                        <div class="inside_category_moznosti">
                            @foreach($tenisky_pack['Dámske'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Dámske_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Unisex']) }}"> Unisex tenisky</a></span>
                        <div class="inside_category_moznosti">
                            @foreach($tenisky_pack['Unisex'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Unisex_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category inside_category_posledny">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => '&orderby=latest']) }}"> Najnovšie tenisky </a></span>
                        <div class="inside_category_moznosti">
                            @foreach($tenisky_pack['latest'] as $product)
                                <a href="{{ route('products.show', ['product' => $product->id]) }}" > <span class="konkretna_moznost">{{ $product->name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </li>
            <li class="main_category">
                <a href="{{ url('/Kopacky') }}">Kopačky</a>
                <ul class="dropdown-menu dropdown-menuKOPACKY">
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Pánske']) }}"> Pánske kopačky </a></span>
                        <div class="inside_category_moznosti">
                            @foreach($kopacky_pack['Pánske'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Pánske_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Dámske']) }}"> Dámske kopačky</a></span>
                        <div class="inside_category_moznosti">
                            @foreach($kopacky_pack['Dámske'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Dámske_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Unisex']) }}"> Unisex kopačky</a></span>
                        <div class="inside_category_moznosti">
                            @foreach($kopacky_pack['Unisex'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Unisex_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category inside_category_posledny">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => '&orderby=latest']) }}"> Najnovšie kopačky </a></span>
                        <div class="inside_category_moznosti">
                            @foreach($kopacky_pack['latest'] as $product)
                                <a href="{{ route('products.show', ['product' => $product->id]) }}" > <span class="konkretna_moznost">{{ $product->name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </li>
            <li class="main_category">
                <a href="{{ url('/Lopty') }}">Lopty</a>
                <ul class="dropdown-menu dropdown-menuLOPTY">
                    <!--
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
                    -->
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Pánske']) }}"> Pánske lopty </a></span>
                        <div class="inside_category_moznosti">
                            @foreach($lopty_pack['Pánske'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Pánske_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Dámske']) }}"> Dámske lopty</a></span>
                        <div class="inside_category_moznosti">
                            @foreach($lopty_pack['Dámske'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Dámske_' . 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Unisex']) }}"> Unisex lopty</a></span>
                        <div class="inside_category_moznosti">
                            @foreach($lopty_pack['Unisex'] as $brand)
                                <a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'brand-' . $brand->name]) }}" > <span class="konkretna_moznost">{{ $brand->display_name }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="inside_category inside_category_posledny">
                        <span class="inside_category_name"><a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => '&orderby=latest']) }}"> Najnovšie lopty </a></span>
                        <div class="inside_category_moznosti">
                            @foreach($lopty_pack['latest'] as $product)
                                <a href="{{ route('products.show', ['product' => $product->id]) }}" > <span class="konkretna_moznost">{{ $product->name }}</span></a>
                            @endforeach
                        </div>
                    </li>

                </ul>
            </li>
            <li class="main_category"><a href="{{ url('/Vypredaj') }}">Výpredaj</a></li>
        </ul>

    </div>
    <div class="right_part">
        <form action="{{ route('search') }}" method="GET">
            <input class="vyhladaj_input" type="text" name="query" placeholder="Vyhľadajte produkt..." value="{{ explode('/', request()->query('query'))[0] }}">
        </form>


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
                    <!-- <div class="profil">LOGIN</div> -->
                    <i class="fa-regular fa-user"></i>
                </a>
            @endguest
        </ul>


        <!-- <div class="kosik last" onclick="toggleSidebarKosik()">KOSIK </div> -->
        <div class="kosik last" onclick="toggleSidebarKosik()"><i class="fa-solid fa-cart-shopping"></i> </div>
        
    </div>
</nav>
