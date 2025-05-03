<div class="filter_overlay">
    <div id="filter_container">
        <div class="top_filter_menu">
            <div class="filt_top">
                <button id="resize_back_btn"><img src="{{ asset('icons/back_arrow.svg') }}"></button>
                <h2 id="filter_placeholder">Filtre</h2>
                <button id="close_btn">
                    <img src="{{ asset('icons/close_btn_X.svg') }}">
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
                <button class="fil_cat" data-category="size">Veľkosť</button>
                <button class="fil_cat" data-category="color">Farba</button>
                <button class="fil_cat" data-category="available">Dostupnosť</button>
                <button class="fil_cat" data-category="price_sale">Cena</button>
                <button class="fil_cat" data-category="gender">Pohlavie</button>
                <button class="fil_cat" data-category="season">Sezóna</button>
            </aside>


            <section class="category_content selected" id="brand">
                <div class="category_entry_list" data-category="brand">
                    <h3 class="category_identifier">Značka</h3>

                    @foreach($brands as $brand)
                        <div class="checkbox_entry" data-value="{{ $brand->name }}">
                            <label class="custom_checkbox">
                                <input type="checkbox" @if(in_array($brand->name, $appliedFilters['brand'] ?? [])) checked @endif />
                                <span class="checkmark @if(in_array($brand->name, $appliedFilters['brand'] ?? []))clicked @endif"></span>
                                <span class="category_text">{{ $brand->display_name }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </section>


            <section class="category_content" id="size">
                <div class="category_entry_list" data-category="size">
                    <h3 class="category_identifier">Veľkosť</h3>
                    <div class="cat_btn_container_sizes">
                        @foreach ($sizes as $size)
                            <button class="cat_entry_btn_size @if(in_array($size, $appliedFilters['size'] ?? [])) clicked @endif" data-value="{{ number_format($size, 0) }}">
                                {{ number_format($size, 0) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>


            <!-- vždy bude mať trieda category_entry_list data-category -->
            <section class="category_content" id="color">
                <div class="category_entry_list" data-category="color">
                    <h3 class="category_identifier">Farba</h3>
                    <div class="cat_btn_container">
                        @foreach ($colors as $color)
                            <button class="cat_entry_btn @if(in_array($color->name, $appliedFilters['color'] ?? [])) clicked @endif" data-value="{{ $color->name }}">
                                @php
                                    $property_to_add = strpos($color->name, 'Viacfarebný') !== false ? 'background' : 'background-color';
                                @endphp
                                <span class="color-box" style="{{ $property_to_add }}: {{ $color->hex }};"></span>
                                {{ $color->name }}

                            </button>
                        @endforeach
                    </div>
                </div>
            </section>


            <section class="category_content" id="available">
                @php
                    /* poradie prvkov */
                    $poradie_available = ['Skladom', 'Bratislava', 'Praha', 'Košice'];

                    /* načítam kolekciu */
                    $availables = collect($available ?? []);

                    /* usporiadam podľa poradia */
                    $usporiadane_available = collect($poradie_available)
                        ->filter(fn($value) => $availables->contains($value));
                @endphp


                <div class="category_entry_list" data-category="available">
                    <h3 class="category_identifier">Dostupnosť</h3>
                    @foreach($usporiadane_available as $availability)
                        <div class="checkbox_entry" data-value="{{ $availability }}">
                            <label class="custom_checkbox">
                                <input type="checkbox"
                                       @if(in_array($availability, $appliedFilters['available'] ?? [])) checked @endif />
                                <span class="checkmark @if(in_array($availability, $appliedFilters['available'] ?? [])) clicked @endif"></span>
                                <span class="category_text">
                                    @if($availability === 'Skladom')
                                        Iba skladom
                                    @else
                                        Na predajni v {{ $availability }}
                                    @endif
                                </span>
                            </label>
                        </div>
                @endforeach
            </section>


            <section class="category_content" id="price_sale">
                <div class="joined_cat_content">
                    <div class="category_entry_list" data-category="price">
                        <h3 class="category_identifier">Cena</h3>

                        <div class="min_max_filter">

                            <div class="input_wrapper">
                                <input type="number" class="min_price" value="{{ $appliedFilters['price'][0] ?? 0 }}" min="10" max="1000"/>
                                <span class="currency">€</span>
                            </div>

                            <div class="input_wrapper" >
                                <input type="number" class="max_price" value="{{ $appliedFilters['price'][1] ?? 1000 }}" min="10" max="1000"/>
                                <span class="currency">€</span>
                            </div>


                        </div>
                        <div class="slider_container">
                            <span class="slider_track"></span>
                            <div class="filled_track" id="filled_track"></div>
                            <input type="range" class="min_slider" min="0" max="1000" value="{{ $appliedFilters['price'][0] ?? 0 }}" step="20">
                            <input type="range" class="max_slider" min="0" max="1000" value="{{ $appliedFilters['price'][1] ?? 1000 }}" step="20">
                        </div>
                    </div>


                    <!--  data-op je operátor pre zľavu, od/do pre data-value  -->
                    <div class="category_entry_list" data-category="sale">
                        <h3 class="category_identifier">Zľavy</h3>

                        <div class="checkbox_entry" data-op="do" data-value="20">
                            <label class="custom_checkbox">
                                <input type="checkbox" @if(($appliedFilters['sale']['do'] ?? null) == 20) checked @endif />
                                <span class="checkmark @if(($appliedFilters['sale']['do'] ?? null) == 20) clicked @endif"></span>
                                <span class="category_text">do 20%</span>
                            </label>
                        </div>

                        <div class="checkbox_entry" data-op="od" data-value="20">
                            <label class="custom_checkbox">
                                <input type="checkbox" @if(($appliedFilters['sale']['od'] ?? null) == 20) checked @endif />
                                <span class="checkmark @if(($appliedFilters['sale']['od'] ?? null) == 20) clicked @endif"></span>
                                <span class="category_text">od 20%</span>
                            </label>
                        </div>

                        <div class="checkbox_entry" data-op="do" data-value="40">
                            <label class="custom_checkbox">
                                <input type="checkbox" @if(($appliedFilters['sale']['do'] ?? null) == 40) checked @endif />
                                <span class="checkmark @if(($appliedFilters['sale']['do'] ?? null) == 40) clicked @endif"></span>
                                <span class="category_text">do 40%</span>
                            </label>
                        </div>

                        <div class="checkbox_entry" data-op="do" data-value="100">
                            <label class="custom_checkbox">
                                <input type="checkbox" @if(($appliedFilters['sale']['do'] ?? null) == 100) checked @endif />
                                <span class="checkmark @if(($appliedFilters['sale']['do'] ?? null) == 100) clicked @endif"></span>
                                <span class="category_text">Všetky zľavy</span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>


            <section class="category_content" id="gender">
                @php
                    /* chcem mať takéto poradie, ak by nejaké chýbali */
                    $poradie = ['Pánske', 'Dámske', 'Unisex'];

                    $genders = collect($genders ?? []);

                    /* usporiada podľa môjho poradia */
                    $usporiadane_genders = collect($poradie)
                        ->filter(fn($gender) => $genders->contains($gender));
                @endphp


                <div class="category_entry_list" data-category="gender">
                    <h3 class="category_identifier">Pohlavie</h3>


                    @foreach($usporiadane_genders as $gender)
                        <div class="checkbox_entry" data-value="{{ $gender }}">
                            <label class="custom_checkbox">
                                <input type="checkbox" name="gender[]" value="{{ $gender }}"
                                       @if(in_array($gender, $appliedFilters['gender'] ?? [])) checked @endif />
                                <span class="checkmark @if(in_array($gender, $appliedFilters['gender'] ?? [])) clicked @endif"></span>
                                <span class="category_text">{{ $gender }}</span>
                            </label>
                        </div>
                    @endforeach

                </div>
            </section>


            <section class="category_content" id="season">
                @php
                    /* chcem mať takéto poradie, ak by nejaké chýbali */
                    $poradie_sezony = ['Jarné', 'Letné', 'Jesenné', 'Zimné', 'Celoročné', 'Športové', 'Štýlové'];;

                    $seasons = collect($seasons ?? []);

                    /* usporiada podľa môjho poradia */
                    $usporiadane_sezony = collect($poradie_sezony)
                        ->filter(fn($season) => $seasons->contains($season));
                @endphp


                <div class="category_entry_list" data-category="season">
                    <h3 class="category_identifier">Sezóna</h3>


                    @foreach($usporiadane_sezony as $sezona)
                        <div class="checkbox_entry" data-value="{{ $sezona }}">
                            <label class="custom_checkbox">
                                <input type="checkbox" name="season[]" value="{{ $sezona }}"
                                       @if(in_array($sezona, $appliedFilters['season'] ?? [])) checked @endif />
                                <span class="checkmark @if(in_array($sezona, $appliedFilters['season'] ?? [])) clicked @endif"></span>
                                <span class="category_text">{{ $sezona }}</span>
                            </label>
                        </div>
                    @endforeach

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
    </div>
</div>


<!-- FILTRUJEME -->
<!--

treba mi specificky:
BRAND, COLOR, GENDER, SEASON, kolko ich je, IN_STOCK

-zmenim in_stock na [je, nie je, predajna x,y,z]

necham všeobecne:
PRICE, DISCOUNT,




-->

