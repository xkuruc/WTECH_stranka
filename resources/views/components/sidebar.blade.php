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
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Pánske tenisky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen ">
                            @foreach($tenisky_pack['Pánske'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Pánske_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Dámske tenisky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($tenisky_pack['Dámske'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Dámske_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Unisex tenisky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($tenisky_pack['Unisex'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Tenisky', 'filters' => 'gender-Unisex_' . 'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Najnovšie tenisky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($tenisky_pack['latest'] as $product)
                                <li> <a href="{{ route('products.show', ['product' => $product->id]) }}" > <span class="submenu_item">{{ $product->name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

            </ul>
        </li>
        <li>
            <div class="sidebar_item" onclick="toggleSubmenu(event)">
                <span class="sidebar_main" href="#">Kopačky </span>
                <span class="sidebar_main plus"> + </span>
            </div>
            <ul class="submenu">
                <ul class="submenu2">
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Pánske kopačky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen ">
                            @foreach($kopacky_pack['Pánske'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Pánske_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Dámske kopačky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($kopacky_pack['Dámske'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Dámske_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Unisex kopačky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($kopacky_pack['Unisex'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Kopacky', 'filters' => 'gender-Unisex_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Najnovšie kopačky </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($kopacky_pack['latest'] as $product)
                                <li> <a href="{{ route('products.show', ['product' => $product->id]) }}" > <span class="submenu_item">{{ $product->name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

            </ul>
        </li>
        <li>
            <div class="sidebar_item" onclick="toggleSubmenu(event)">
                <span class="sidebar_main">Lopty </span>
                <span class="sidebar_main plus"> + </span>
            </div>
            <ul class="submenu">
                <ul class="submenu2">
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Pánske lopty </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen ">
                            @foreach($lopty_pack['Pánske'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Pánske_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Dámske lopty </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($lopty_pack['Dámske'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Dámske_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Unisex lopty </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($lopty_pack['Unisex'] as $brand)
                                <li> <a href="{{ route('products.index', ['type' => 'Lopty', 'filters' => 'gender-Unisex_' .'brand-' . $brand->name]) }}" > <span class="submenu_item">{{ $brand->display_name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <div class="sidebar_item" onclick="toggleSubmenu(event)">
                            <span class="sidebar2_main" > Najnovšie lopty </span>
                            <span class="sidebar_main plus"> + </span>
                        </div>
                        <ul class="submenu3 submenuOpen">
                            @foreach($lopty_pack['latest'] as $product)
                                <li> <a href="{{ route('products.show', ['product' => $product->id]) }}" > <span class="submenu_item">{{ $product->name }}</span></a> </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

            </ul>
        </li>
        <li>
            <div class="sidebar_item">
                <a class="sidebar_main sidebar_vypredaj_item" href="{{ url('/Vypredaj') }}">Výpredaj </a>
            </div>
        </li>
            <!-- treba či nie
           <li>
               <div class="sidebar_item">
                   <span class="sidebar_main komunita_vypredaj_item" href="#">Komunita </span>
               </div>
            </li>
            -->
    </ul>
</div>
