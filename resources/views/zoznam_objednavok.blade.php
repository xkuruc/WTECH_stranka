<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stranka</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/text_divider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zoznam_objednavok.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>

    <main>
        <section class="text_divider padded">
            <h1>Moje objednávky</h1>
            <hr class="hr_divider long">
        </section>

        <section class="objednavky_wrapper">
            <div class="objednavky_container">
                <button class="objednavka_btn description">
                    <ul class="order_info">
                      <li class="cislo_objednavky">Číslo objednávky:</li>
                      <li class="datum">Dátum:</li>
                      <li class="sposob_platby">Spôsob platby:</li>
                      <li class="sposob_dopravy">Spôsob dopravy:</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="102168916416">
                    <ul class="order_info">
                      <li class="cislo_objednavky">102168916416</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Platba kartou</li>
                      <li class="sposob_dopravy">Osobný odber - Košice Kukučínova 2</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="103545691671">
                    <ul class="order_info">
                      <li class="cislo_objednavky">103545691671</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Platba kartou</li>
                      <li class="sposob_dopravy">Osobný odber - 2</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="103123691564">
                    <ul class="order_info">
                      <li class="cislo_objednavky">103123691564</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Platba kartou</li>
                      <li class="sposob_dopravy">Osobný odber - 2</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="111155691688">
                    <ul class="order_info">
                      <li class="cislo_objednavky">111155691688</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Dobierka</li>
                      <li class="sposob_dopravy">Kuriér</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="125654486771">
                    <ul class="order_info">
                      <li class="cislo_objednavky">125654486771</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Paypal Express</li>
                      <li class="sposob_dopravy">Osobný odber - Bratislava Mlynské Nivy 10</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="102168916416">
                    <ul class="order_info">
                      <li class="cislo_objednavky">102168916416</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Platba kartou</li>
                      <li class="sposob_dopravy">Osobný odber - Košice Kukučínova 2</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="103545691671">
                    <ul class="order_info">
                      <li class="cislo_objednavky">103545691671</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Platba kartou</li>
                      <li class="sposob_dopravy">Osobný odber - 2</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="103123691564">
                    <ul class="order_info">
                      <li class="cislo_objednavky">103123691564</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Platba kartou</li>
                      <li class="sposob_dopravy">Osobný odber - 2</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="111155691688">
                    <ul class="order_info">
                      <li class="cislo_objednavky">111155691688</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Dobierka</li>
                      <li class="sposob_dopravy">Kuriér</li>
                    </ul>
                </button>

                <button class="objednavka_btn" data-order-id="125654486771">
                    <ul class="order_info">
                      <li class="cislo_objednavky">125654486771</li>
                      <li class="datum">12.5.2025</li>
                      <li class="sposob_platby">Paypal Express</li>
                      <li class="sposob_dopravy">Osobný odber - Bratislava Mlynské Nivy 10</li>
                    </ul>
                </button>
            </div>
        </section>
    </main>


    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/zoznam_objednavok.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
