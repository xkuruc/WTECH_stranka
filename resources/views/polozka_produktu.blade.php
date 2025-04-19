<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/polozka.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/polozka_produktu.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>

    <main>
        <section class="product_main_info">
            <div class="product_main_info_container">
                <div class="product_images">
                    <div class="product_images_kontajner">

                        {{-- Veľké obrázky --}}
                        <div class="big_images" id="sliding_container">
                            @foreach($product->images as $img)
                                <div class="big_img {{ $loop->first ? 'selected' : '' }}"
                                     data-img-id="{{ $loop->iteration }}">
                                    <img draggable="false"
                                         src="{{ asset('images/'. $product->main_image) }}"
                                         alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>

                        {{-- Mini obrázky --}}
                        <div class="small_images" id="small_slider">
                            @foreach($product->images as $img)
                                <div class="small_img {{ $loop->first ? 'selected' : '' }}"
                                     data-img-id="{{ $loop->iteration }}">
                                    <img src="{{ asset('images/'.$img->image_path) }}"
                                         alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="product_information">
                    <h1 class="product_name">{{ $product->name }}</h1>
                    <div class="product_brand">
                        Značka: <span class="specified">{{ $product->brand }}</span>
                    </div>
                    <div class="cena">
                        <span class="specified">{{ number_format($product->price,2) }}</span> €
                    </div>

                    
                    <form class="form_div" action="" method="POST">
                        @csrf
                        <select id="size" name="size" class="velkost_input" required>
                            <option value="" disabled selected>Veľkosť (US)</option>
                            @foreach($product->availableSizes() as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="pridat_do_kosika_button">
                            Pridať do košíka
                        </button>
                    </form>

                    <div class="odkaz">
                        <a href="">
                            Potrebujes poradit velkost? Klikni sem
                        </a>
                    </div>

                    <div class="avaibility">
                        <i class="fa-solid fa-globe"></i>
                        <span class="specified">
                            {{ $product->in_stock ? 'Skladom Online' : 'Momentálne vypredané' }}
                        </span>
                    </div>

                    <div class="other_information">
                        <div class="SKU">
                            SKU: <span class="specified">{{ $product->SKU }}</span>
                        </div>
                        <div class="pohlavie">
                            Pohlavie: <span class="specified">{{ $product->gender }}</span>
                        </div>
                        <div class="farba">
                            Farba: <span class="specified">{{ $product->color }}</span>
                        </div>
                        <div class="typ_produktu">
                            Typ produktu: <span class="specified">{{ $product->category->name }}</span>  {{-- :contentReference[oaicite:3]{index=3} --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sekcie so súvisiacimi kategóriami a slidermi ponechaj, stačí ich vložiť odtiaľ, kde máš statický HTML --}}
        <section class="suvisiacie_kategorie_section">
            <div class="suvisiacie_kategorie_container">
                <div class="label_container">
                    <h2>SÚVISIACIE KATEGÓRIE A ZNAČKY</h2>
                </div>
                <div class="category_container">
                    <div class="category_container_element">
                        <h1 class="category_label">Top kategórie </h1>
                        <div class="category_container_element_kategorie">
                            <a>Tenisky</a>
                            <a>Pánske tenisky</a>
                            <a>Air Jordan</a>
                            <a>Pánske livestyle tenisky</a>
                        </div>

                    </div>

                    <div class="category_container_element">
                        <h1 class="category_label">Top značky </h1>
                        <div class="category_container_element_znacky">
                            <div class="category_container_element_znacky_item">
                                <a>Jordan</a>
                                <a>Nike</a>
                                <a>Adidas</a>
                                <a>Vans</a>
                            </div>
                            <div class="category_container_element_znacky_item">
                                <a>Jordan</a>
                                <a>Nike</a>
                                <a>Adidas</a>
                                <a>Vans</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="product_sliders">
            <div class="label"> Zlavy</div>
            <section class="product_slider">
                <div class="slider-container">
                    <div class="owl-carousel owl-carouselBRATU ">
                    @foreach($discountedImages as $img)
                        
                            <img class="itemBRATU" src="{{ asset('images/'.$img->image_path) }}" alt="">
                        
                    @endforeach
                    </div>
                </div>
            </section>

            <div class="label"> Naposledy pozreté</div>
            <section class="product_slider">
                <div class="slider-container">
                    
                    <div class="owl-carousel owl-carouselBRATU ">
                        <div class="itemBRATU">1</div>
                        <div class="itemBRATU">2</div>
                        <div class="itemBRATU">3</div>
                        <div class="itemBRATU">4</div>
                        <div class="itemBRATU">5</div>
                        <div class="itemBRATU">6</div>
                    </div>
                </div>
            </section>
        </section>
    </main>
    
    <!-- <main>
        <section class="product_main_info">
            <div class="product_main_info_container">
                <div class="product_images">
                    <div class="product_images_kontajner">

                        <div class="big_images" id="sliding_container">

                            <div class="big_img selected" data-img-id=1>
                                <img draggable="false" src="./images/sample_topanka.jpg">
                            </div>

                            <div class="big_img" data-img-id=2>
                                <img draggable="false" src="./images/sample_topanka2.jpg">
                            </div>


                            <div class="big_img" data-img-id=3>
                                <img draggable="false" src="./images/sample_topanka3.jpg">
                            </div>

                            <div class="big_img" data-img-id=4>
                                <img draggable="false" src="./images/sample_topanka4.jpg">
                            </div>

                            <div class="big_img" data-img-id=5>
                                <img draggable="false" src="./images/sample_topanka5.jpg">
                            </div>

                            <div class="big_img" data-img-id=6>
                                <img draggable="false" src="./images/sample_topanka6.jpg">
                            </div>





                        </div>


                        <div class="small_images" id="small_slider">
                            <div class="small_img selected" data-img-id=1>
                                <img src="./images/sample_topanka.jpg">
                            </div>

                            <div class="small_img" data-img-id=2>
                                <img src="./images/sample_topanka2.jpg">
                            </div>



                            <div class="small_img" data-img-id=3>
                                <img src="./images/sample_topanka3.jpg">
                            </div>

                            <div class="small_img" data-img-id=4>
                                <img src="./images/sample_topanka4.jpg">
                            </div>

                            <div class="small_img" data-img-id=5>
                                <img src="./images/sample_topanka5.jpg">
                            </div>

                            <div class="small_img" data-img-id=6>
                                <img src="./images/sample_topanka6.jpg">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="product_information">
                    <h1 class="product_name">Air Jordan 4 RM "University Blue"</h1>
                    <div class="product_brand">Značka: <span id="product_brand_specified" class="specified">Jordan</span></div>
                    <div class="cena"> <span id="prize_specified" class="specified"> 150,00</span>€ </div>
                    <form class="form_div" action="">
                        <select id="size" class="velkost_input" required>
                            <option value="" disabled selected>Veľkosť (US)</option>
                        </select>
                        <button type="submit" class="pridat_do_kosika_button">Pridať do košíka</button>
                    </form>
                    <div class="odkaz"> <a href="daco">Potrebujes poradit velkost ? Klikni sem </a></div>
                    <div class="avaibility"><i class="fa-solid fa-globe"></i> <span id="avaibility_specified" class="specified"> Skladom Online</span> </div>
                    <div class="other_information">
                        <div class="SKU">SKU: <span id="SKU_specified" class="specified">FQ7939-104</span></div>
                        <div class="pohlavie">Pohlavie: <span id="pohlavie_specified" class="specified"> Pánske</span></div>
                        <div class="farba">Farba: <span id="farba_specified" class="specified"> Biela </span></div>
                        <div class="typ_produktu">Typ produktu: <span id="typ_produktu_specified" class="specified"> Tenisky</span></div>
                    </div>
                </div>

            </div>
        </section>

        <section class="suvisiacie_kategorie_section">
            <div class="suvisiacie_kategorie_container">
                <div class="label_container">
                    <h2>SÚVISIACIE KATEGÓRIE A ZNAČKY</h2>
                </div>
                <div class="category_container">
                    <div class="category_container_element">
                        <h1 class="category_label">Top kategórie </h1>
                        <div class="category_container_element_kategorie">
                            <a>Tenisky</a>
                            <a>Pánske tenisky</a>
                            <a>Air Jordan</a>
                            <a>Pánske livestyle tenisky</a>
                        </div>

                    </div>

                    <div class="category_container_element">
                        <h1 class="category_label">Top značky </h1>
                        <div class="category_container_element_znacky">
                            <div class="category_container_element_znacky_item">
                                <a>Jordan</a>
                                <a>Nike</a>
                                <a>Adidas</a>
                                <a>Vans</a>
                            </div>
                            <div class="category_container_element_znacky_item">
                                <a>Jordan</a>
                                <a>Nike</a>
                                <a>Adidas</a>
                                <a>Vans</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="product_sliders">
            <div class="label"> Zlavy</div>
            <section class="product_slider">
                <div class="slider-container">
                    <div class="owl-carousel owl-carouselBRATU ">
                        <div class="itemBRATU">1</div>
                        <div class="itemBRATU">2</div>
                        <div class="itemBRATU">3</div>
                        <div class="itemBRATU">4</div>
                        <div class="itemBRATU">5</div>
                        <div class="itemBRATU">6</div>
                    </div>
                </div>
            </section>

            <div class="label"> Naposledy pozreté</div>
            <section class="product_slider">
                <div class="slider-container">
                    
                    <div class="owl-carousel owl-carouselBRATU ">
                        <div class="itemBRATU">1</div>
                        <div class="itemBRATU">2</div>
                        <div class="itemBRATU">3</div>
                        <div class="itemBRATU">4</div>
                        <div class="itemBRATU">5</div>
                        <div class="itemBRATU">6</div>
                    </div>
                </div>
            </section>
        </section>
    </main> -->

    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous" defer></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/polozka.js') }}"></script>
    <script src="{{ asset('javascript/product_slider.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
    <script src="{{ asset('javascript/drag_polozka.js') }}"></script>
</body>
</html>
