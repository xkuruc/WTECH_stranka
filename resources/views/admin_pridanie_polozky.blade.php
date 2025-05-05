<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/polozka.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/polozka_produktu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_item.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registracia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_pridanie.css') }}">
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



                <form id="upload_images" method="POST" class="product_main_info_container" action="/upload-product-images" enctype="multipart/form-data">
                    <div class="product_images">
                        <div class="product_images_kontajner">
                            <div class="big_images" id="sliding_container">
                                <div class="big_img selected add" data-img-id=1>
                                    <input type="file" class="file-input" accept="image/*" multiple>
                                    <img src="" alt="">
                                    <span class="plusko"></span>
                                    <button class="trash_can_right">
                                        <img src="{{ asset('./icons/kos_icon.png') }}" alt="">
                                    </button>
                                </div>
                            </div>


                            <div class="small_images" id="small_slider">
                                <div class="small_img selected add" data-img-id=1>
                                    <input type="file" class="file-input" accept="image/*" multiple>
                                    <img src="" alt="">
                                    <span class="plusko"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="produkt_information">
                        <div class="custom_input">
                            <span class="label_edit">Názov:</span>
                            <input class="input_edit" name="name" required>
                        </div>

                        <div class="custom_input">
                            <span class="label_edit">Stručný popis:</span>
                            <textarea class="input_edit_popis" name="description" required></textarea>
                        </div>


                        <div class="select_label">
                            <span class="label_edit">Značka:</span>
                            <select class="select_edit" name="brand_id" required> <!-- brand_id sa posúvajú do form -->
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == 1 ? 'selected' : '' }}>
                                        {{ $brand->display_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="select_label">
                            <span class="label_edit">Pohlavie:</span>
                            <select class="select_edit" name="gender" required>
                                <option value="Pánske" selected>Pánske</option>
                                <option value="Dámske">Dámske</option>
                                <option value="Unisex">Unisex</option>
                            </select>
                        </div>

                        <div class="select_label">
                            <span class="label_edit">Farba:</span>
                            <select class="select_edit" name="color_id" required>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ $color->id == 1 ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="select_label">
                            <span class="label_edit">Typ produktu:</span>
                            <select class="select_edit" name="type" required>
                                <option value="Tenisky" selected>Tenisky</option>
                                <option value="Kopačky">Kopačky</option>
                                <option value="Lopty">Lopty</option>
                            </select>
                        </div>


                        <div class="joined_input">
                            <div class="custom_input" >
                                <span class="label_edit">Cena:</span>
                                <input class="input_edit" type="number" min="0" name="price" required>
                            </div>

                            <div class="custom_input">
                                <span class="label_edit">Zľava:</span>
                                <input class="input_edit" type="number" min="0" max="100" name="discount" required>
                            </div>
                        </div>


                        <div class="select_label">
                            <span class="label_edit">Dostupné veľkosti:</span>
                            <div class="select_label dropdown" onclick="toggleDropdown('sizesSelect')">
                                <input type="text" id="selectedSizes" class="select_edit" placeholder="Preferovaná veľkosť oblečenia" readonly="">
                                <input type="hidden" name="sizes" id="sizesHidden">

                                <div id="sizesSelect" class="dropdown-content">
                                    @foreach ($sizes as $size)
                                        <div onclick="selectOption('sizes', '{{ $size }}')">
                                            {{ $size }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="button_pridat">Pridať</button>
                    </div>
                </form>
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
    <script src="{{ asset('javascript/product_slider.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
    <script src="{{ asset('javascript/drag_polozka.js') }}" defer></script>
    <script src="{{ asset('javascript/admin_pridanie.js') }}" defer></script>
</body>
</html>
