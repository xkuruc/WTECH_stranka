<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stranka</title>

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
            <div class="main_image_placeholder"></div>
        </section>

        <section class="brand_slider_section">
            <div class="brand_slider_mechanism">
                <div class="brand_slider_placeholder">
                    <div class="brand_slider_image" style="background-color: aqua;"> 1</div>
                    <div class="brand_slider_image" >2</div>
                    <div class="brand_slider_image" >3</div>
                    <div class="brand_slider_image" >4</div>
                    <div class="brand_slider_image" >5</div>
                    <div class="brand_slider_image" >6</div>
                    <div class="brand_slider_image" >7</div>
                    <div class="brand_slider_image" >8</div>
                </div>
            </div>
        </section>

        <section class="banner_hlavna_ponuka">
            <div class="banner_hlavna_ponuka_container">
                <a href="zoznam_produktov.blade.php" class="tenisky_banner" > <div> TENISKY</div> </a>
                <a href="zoznam_produktov.blade.php" class="kopacky_banner"> <div > KOPACKY</div> </a>
                <a href="zoznam_produktov.blade.php" class="lopty_banner"> <div > LOPTY</div> </a>
            </div>
        </section>

        <section class="product_sliders">
            <div class="label"> Zlavy</div>
            <section class="product_slider">
                <div class="slider-container">
                    <!-- <div class="customNavigation"><a class="btn prev"><i class="fa fa-caret-left"></i></a><a class="btn next"><i class="fa fa-caret-right"></i></a></div> -->
                    <div class="owl-carousel owl-carouselBRATU">
                        <div class="itemBRATU">1</div>
                        <div class="itemBRATU">2</div>
                        <div class="itemBRATU">3</div>
                        <div class="itemBRATU">4</div>
                        <div class="itemBRATU">5</div>
                        <div class="itemBRATU">6</div>
                    </div>
                </div>
            </section>

            <div class="label"> Todays pick</div>
            <section class="product_slider">
                <div class="slider-container">
                    <!-- <div class="customNavigation"><a class="btn prev"><i class="fa fa-caret-left"></i></a><a class="btn next"><i class="fa fa-caret-right"></i></a></div> -->
                    <div class="owl-carousel owl-carouselBRATU">
                        <div class="itemBRATU">1</div>
                        <div class="itemBRATU">2</div>
                        <div class="itemBRATU">3</div>
                        <div class="itemBRATU">4</div>
                        <div class="itemBRATU">5</div>
                        <div class="itemBRATU">6</div>
                    </div>
                </div>
            </section>

            <div class="label"> Adidas botaski</div>
            <section class="product_slider">
                <div class="slider-container">
                    <!-- <div class="customNavigation"><a class="btn prev"><i class="fa fa-caret-left"></i></a><a class="btn next"><i class="fa fa-caret-right"></i></a></div> -->
                    <div class="owl-carousel owl-carouselBRATU">
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

        @include('components.newsletter')

        <section class="fotokolaz_section">
            <div class="fotokolaz">
                <div class="grid-container">
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                    <div class="obr"></div>
                </div>
            </div>

        </section>

        <div style="height:1000px ;"></div>

    </main>


    @include('components.footer')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="javascript/product_slider.js"></script>
    <script src="./javascript/slider_moj.js"></script>
    <script src="./javascript/product_slider.js"></script>
    <script src="./javascript/side_menubar.js"></script>
    <script src="./javascript/kosik_sidebar.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
</body>
</html>
