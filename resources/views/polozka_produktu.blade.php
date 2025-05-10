<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botaski</title>

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
    
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_item.css') }}">
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
                        @php
                            /* hlavný obrázok */
                            $mainImage = $product->images->firstWhere('is_main', true);

                            /* vedľajšie obrázky */
                            $sideImages = $product->images->where('is_main', false)->sortBy(function($image) { /* zoradíme podľa čísla v názve */
                                preg_match('/side(\d+)/', $image->image_path, $matches); /* vyberie číslo z sideX v názve cesty */
                                return $matches[1] ?? 0;
                            });
                        @endphp

                        <div class="big_images" id="sliding_container">
                            <div class="big_img selected" data-img-id=1>
                                <img draggable="false" src="{{ asset('images/'.$mainImage->image_path) }}" alt="{{ $product->name }}">
                            </div>


                            @foreach($sideImages as $image)
                                <div class="big_img" data-img-id="{{ $loop->iteration + 1 }}">
                                    <img src="{{ asset('images/'.$image->image_path) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="small_images" id="small_slider">
                            <div class="small_img selected" data-img-id=1>
                                <img draggable="false" src="{{ asset('images/'.$mainImage->image_path) }}" alt="{{ $product->name }}">
                            </div>



                            @foreach($sideImages as $image)
                                <div class="small_img" data-img-id="{{ $loop->iteration + 1 }}">
                                    <img src="{{ asset('images/'.$image->image_path) }}" alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="product_information">
                    <h1 class="product_name">{{ $product->name }}</h1>
                    <div class="product_brand">
                        Značka: <span class="specified">{{ $product->brand->display_name }}</span>
                    </div>
                    <div class="cena">
                        <span class="specified">{{ number_format($product->price,2) }}</span> €
                    </div>


                    <form action="{{ route('cart.store') }}" method="POST" class="pridavanie-do-kosika-form">
                        @csrf

                        {{-- Skryté políčko s ID produktu --}}
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- Skryté políčko s množstvom (default = 1) --}}
                        <input type="hidden" name="quantity" value="1">

                        {{-- Výber veľkosti --}}
                        <label for="size" class="velkost_label">Veľkosť (US):</label>

                        <div class="form_div">
                            <select id="size" name="size" class="velkost_input" required>
                                <option value="" disabled selected>Vyber veľkosť</option>
                                @foreach($product->availableSizes() as $size)
                                    @php
                                        $sizeLabel = fmod((float) $size, 1.0) === 0.0
                                            ? intval($size)
                                            : $size;
                                    @endphp
                                    <option value="{{ $size }}">{{ $sizeLabel }}</option>
                                @endforeach
                            </select>

                            {{-- Tlačidlo na odoslanie --}}
                            <button type="submit" class="pridat_do_kosika_button">
                                Pridať do košíka
                            </button>
                        </div>
                    </form>


                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


                    <div class="odkaz">
                        <a href="">
                            Potrebujes poradit velkost? Klikni sem
                        </a>
                    </div>

                    <div class="avaibility">
                        <i class="fa-solid fa-globe"></i>
                        <span class="specified">
                            {{ $product->available == 'Skladom' ? 'Skladom' : 'Na predajni v: ' . $product->available }}
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
                            Farba: <span class="specified">{{ $product->color->name }}</span>
                        </div>
                        <div class="sezona">
                            Sezóna: <span class="specified">{{ $product->season->name }}</span>
                             (typ: <span class="specified">{{ $product->type }}</span>)
                        </div>
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

        @php
                $brand = $product->brand;
                $brandName = $brand->display_name ?? $brand->name;

                // nacitame n dalsich produktov tej znacky (okrem toho nahodneho)
                $brandProducts = \App\Models\Product::with('images')
                    ->where('brand_id', $brand->id)
                    ->where('id', '!=', $product->id)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            @endphp

            <div class="label">{{ $brandName }} botaski </div>
            <section class="product_slider">
                <div class="slider-container">
                    <div class="owl-carousel owl-carouselBRATU">
                        {{-- potom dalsie produkty tej istej znacky --}}
                        @foreach($brandProducts as $productt)
                            @php
                                $main = $productt->images->firstWhere('is_main', true);
                            @endphp
                            @if($main)
                                <div>
                                    <a href="{{ url('polozka-produktu/' . $productt->id) }}">
                                        <img class="itemBRATU" 
                                            src="{{ asset('images/' . $main->image_path) }}"
                                            alt="{{ $productt->name }}">
                                            @if($productt->discount > 1)
                                            <div class="sale_placeholder">
                                                -{{ round($productt->discount) }}%
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>

        @php
            // nacitame vsetky produkty so zlavou 
            $discountedProducts = \App\Models\Product::with('images')
                ->where('discount', '>', 0)
                ->get();
        @endphp
        <section class="product_sliders">
            <div class="label"> Zlavy</div>
            <section class="product_slider">
                <div class="slider-container">
                    <div class="owl-carousel owl-carouselBRATU">
                        @foreach($discountedProducts as $productt)
                            @php
                                // vyberieme hlavný obrázok (is_main = true)
                                $mainImage = $productt->images->firstWhere('is_main', true);
                            @endphp

                            @if($mainImage)
                                <div>
                                    <a href="{{ url('polozka-produktu/' . $productt->id) }}">
                                        <img class="itemBRATU" 
                                        src="{{ asset('images/' . $mainImage->image_path) }}" 
                                        alt="{{ $productt->name }}"
                                        >
                                        <div class="sale_placeholder">
                                            -{{ round($productt->discount) }}%
                                        </div>
                                    </a>
                                    
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>


                @php
                // nacita n nahodnych produktov
                $randomProducts = \App\Models\Product::with('images')
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            @endphp

            <div class="label"> Todays pick</div>
            <section class="product_slider">
                <div class="slider-container">
                    <div class="owl-carousel owl-carouselBRATU">
                        @foreach($randomProducts as $productt)
                            @php
                                // vyberieme hlavný obrázok
                                $mainImage = $productt->images->firstWhere('is_main', true);
                            @endphp

                            @if($mainImage)
                                <div>
                                    <a href="{{ url('polozka-produktu/' . $productt->id) }}">
                                        <img class="itemBRATU"
                                        src="{{ asset('images/' . $mainImage->image_path) }}" 
                                        alt="{{ $productt->name }}"
                                        >
                                        @if($productt->discount > 1)
                                            <div class="sale_placeholder">
                                                -{{ round($productt->discount) }}%
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>

        </section>
    </main>


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
    <script src="{{ asset('javascript/drag_polozka.js') }}" defer></script>
</body>
</html>
