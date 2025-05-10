<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stranka</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/brand_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/banner_hlavna_ponuka.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fotokolaz.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_item.css') }}">
    
    <!--
    dizajn stránky je inšpirovaný stránkou thestreets.sk a filter je inšpirovaný filtrom stránky https://www.footshop.sk/
    -->

</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>


    <main>
        <section class="main_image_section">
            <!-- <div class="main_image_placeholder"></div> -->
             <div class="main_image_placeholder">
             <img src="{{ asset('images/o.jpg') }}">
             </div>

        </section>

        <section class="brand_slider_section">
                <div class="slider-containerBRAND">
                    <div class="owl-carouselBRAND">
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/n.png') }}"></div>
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/a.jpg') }}"></div>
                        <div class="itemBRAND"><img width="130" src="{{ asset('images/f.webp') }}"></div>
                        <div class="itemBRAND"><img width="80" src="{{ asset('images/c.png') }}"></div>
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/p.png') }}"></div>
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/r.webp') }}"></div>
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/n.gif') }}"></div>
                        <div class="itemBRAND"><img width="120" src="{{ asset('images/c.svg') }}"></div>
                        <div class="itemBRAND"><img width="120" src="{{ asset('images/v.jpg') }}"></div>
                        <div class="itemBRAND"><img width="120" src="{{ asset('images/co.png') }}"></div>
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/s.png') }}"></div>
                        <div class="itemBRAND"><img width="100" src="{{ asset('images/jo.jpeg') }}"></div>
                        <div class="itemBRAND"><img width="150" src="{{ asset('images/ua2.png') }}"></div>
                        <div class="itemBRAND"><img width="130" src="{{ asset('images/columbia.png') }}"></div>
                        <div class="itemBRAND"><img width="130" src="{{ asset('images/tnf.png') }}"></div>
                        <div class="itemBRAND"><img width="90" src="{{ asset('images/dc.png') }}"></div>
                        <div class="itemBRAND"><img width="120" src="{{ asset('images/h.jpg') }}"></div>
                        <div class="itemBRAND"><img width="90" src="{{ asset('images/asics.jpg') }}"></div>
                    </div>
                </div>
        </section>

        <section class="banner_hlavna_ponuka">
            <div class="banner_hlavna_ponuka_container">
                <a href="{{ url('/Tenisky') }}" class="tenisky_banner">
                    <img src="{{ asset('images/sample_topanka1/sample_topanka1_main.jpg') }}">
                </a>
                <a href="{{ url('/Kopacky') }}" class="kopacky_banner">
                    <img src="{{ asset('images/sample_topanka2/sample_topanka2_main.jpg') }}">
                </a>
                <a href="{{ url('/Lopty') }}" class="lopty_banner">
                    <img src="{{ asset('images/sample_topanka3/sample_topanka3_main.jpg') }}">
                </a>
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
                        @foreach($discountedProducts as $product)
                            @php
                                // vyberieme hlavný obrázok (is_main = true)
                                $mainImage = $product->images->firstWhere('is_main', true);
                            @endphp

                            @if($mainImage)
                                <div>
                                    <a href="{{ url('polozka-produktu/' . $product->id) }}">
                                        <img class="itemBRATU" 
                                        src="{{ asset('images/' . $mainImage->image_path) }}" 
                                        alt="{{ $product->name }}"
                                        >
                                        <div class="sale_placeholder">
                                            -{{ round($product->discount) }}%
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
                        @foreach($randomProducts as $product)
                            @php
                                // vyberieme hlavný obrázok
                                $mainImage = $product->images->firstWhere('is_main', true);
                            @endphp

                            @if($mainImage)
                                <div>
                                    <a href="{{ url('polozka-produktu/' . $product->id) }}">
                                        <img class="itemBRATU"
                                        src="{{ asset('images/' . $mainImage->image_path) }}" 
                                        alt="{{ $product->name }}"
                                        >
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>

            
            @php
                // nahodne vyberieme jeden produkt
                $randomProduct = \App\Models\Product::has('images')
                    ->inRandomOrder()
                    ->with('brand', 'images')
                    ->first();

                // ziskame jej znacku a jej ID
                $brand = $randomProduct->brand;
                $brandName = $brand->display_name ?? $brand->name;

                // nacitame n dalsich produktov tej znacky (okrem toho nahodneho)
                $brandProducts = \App\Models\Product::with('images')
                    ->where('brand_id', $brand->id)
                    ->where('id', '!=', $randomProduct->id)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            @endphp

            <div class="label">{{ $brandName }} botaski </div>
            <section class="product_slider">
                <div class="slider-container">
                    <div class="owl-carousel owl-carouselBRATU">
                        {{-- zobrazi najprv prvy prodkut --}}
                        @php
                            $mainImage = $randomProduct->images->firstWhere('is_main', true);
                        @endphp
                        @if($mainImage)
                            <div>
                                <a href="{{ url('polozka-produktu/' . $product->id) }}">
                                    <img
                                        class="itemBRATU"
                                        src="{{ asset('images/' . $mainImage->image_path) }}"
                                        alt="{{ $randomProduct->name }}">
                                </a>
                            </div>
                        @endif

                        {{-- potom dalsie produkty tej istej znacky --}}
                        @foreach($brandProducts as $product)
                            @php
                                $main = $product->images->firstWhere('is_main', true);
                            @endphp
                            @if($main)
                                <div>
                                    <a href="{{ url('polozka-produktu/' . $product->id) }}">
                                        <img class="itemBRATU" 
                                            src="{{ asset('images/' . $main->image_path) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>



        </section>

        @include('components.newsletter')

        <section class="fotokolaz_section">
            <div class="fotokolaz">
                <div class="grid-container">
                    <img class="obr" src="{{ asset('images/daco.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco2.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco3.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco4.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco2.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco3.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco4.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco2.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco3.jpeg') }}" alt="">
                    <img class="obr" src="{{ asset('images/daco4.jpeg') }}" alt="">

                </div>
            </div>

        </section>
        <!-- <div style="height:1000px ;"></div> -->
    </main>

    <!-- footer -->
    @include('components.footer')

    <!-- externé skripty -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/product_slider.js') }}"></script>
    <script src="{{ asset('javascript/slider_moj.js') }}"></script>
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
