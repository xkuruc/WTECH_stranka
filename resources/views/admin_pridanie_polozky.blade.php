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
    <link rel="stylesheet" href="{{ asset('css/admin_pridanie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registracia.css') }}">
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

                        <div class="big_images" id="sliding_container">


                            <div class="big_img selected" data-img-id=1>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="big_img" data-img-id=2>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>


                            <div class="big_img" data-img-id=3>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="big_img" data-img-id=4>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="big_img" data-img-id=5>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="big_img" data-img-id=6>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>
                        </div>


                        <div class="small_images" id="small_slider">
                            <div class="small_img selected" data-img-id=1>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="small_img" data-img-id=2>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>


                            <div class="small_img" data-img-id=3>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="small_img" data-img-id=4>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="small_img" data-img-id=5>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>

                            <div class="small_img" data-img-id=6>
                                <input type="file" class="file-input" accept="image/*">
                                <img>
                                <span class="plusko"></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="produkt_information">
                    <div class="custom_input">
                        <span class="label_edit">Názov:</span>
                        <input class="input_edit">
                    </div>

                    <div class="custom_input">
                        <span class="label_edit">Stručný popis:</span>
                        <textarea class="input_edit_popis"></textarea>
                    </div>


                    <div class="select_label">
                        <span class="label_edit">Značka:</span>
                        <select class="select_edit">
                            <option value="adidas" selected>Adidas</option>
                            <option value="Nike">Nike</option>
                            <option value="Puma">Puma</option>
                            <option value="Vans">Vans</option>
                        </select>
                    </div>

                    <div class="select_label">
                        <span class="label_edit">Pohlavie:</span>
                        <select class="select_edit">
                            <option value="" disabled selected>Pohlavie*</option>
                            <option value="male">Chlop</option>
                            <option value="female">Princesska</option>
                        </select>
                    </div>

                    <div class="select_label">
                        <span class="label_edit">Farba:</span>
                        <select class="select_edit">
                            <option value="Červená" selected>Červená</option>
                            <option value="Modrá">Modrá</option>
                            <option value="Zelená">Zelená</option>
                            <option value="Čierna">Čierna</option>
                            <option value="Viacfarebná">Viacfarebná</option>
                        </select>
                    </div>


                    <div class="select_label">
                        <span class="label_edit">Typ produktu:</span>
                        <select class="select_edit">
                            <option value="Tenisky" selected>Tenisky</option>
                            <option value="Kopačky">Kopačky</option>
                            <option value="Lopty">Lopty</option>
                        </select>
                    </div>


                    <div class="joined_input">
                        <div class="custom_input">
                            <span class="label_edit">Cena:</span>
                            <input class="input_edit" type="number">
                        </div>

                        <div class="custom_input">
                            <span class="label_edit">Zľava:</span>
                            <input class="input_edit" type="number">
                        </div>
                    </div>


                    <div class="select_label">
                        <span class="label_edit">Dostupné veľkosti:</span>
                        <select class="select_edit">
                            <option value="38" selected>38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                        </select>
                    </div>

                    <a href="admin_dashboard.blade.php" class="button_pridat">Pridať</a>
                </div>
            </div>
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
    <script src="{{ asset('javascript/drag_polozka.js') }}"></script>
    <script src="{{ asset('javascript/admin_pridanie.js') }}"></script>
</body>
</html>
