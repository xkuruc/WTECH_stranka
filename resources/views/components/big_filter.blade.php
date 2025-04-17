<div class="filter_overlay">
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
                <button class="fil_cat" data-category="size">Veľkosť</button>
                <button class="fil_cat" data-category="color">Farba</button>
                <button class="fil_cat" data-category="available">Dostupnosť</button>
                <button class="fil_cat" data-category="price_sale">Cena</button>
                <button class="fil_cat" data-category="gender">Pohlavie</button>
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
    </div>
</div>
