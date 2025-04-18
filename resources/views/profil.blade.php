<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stranka</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/text_divider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/popup_overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>


    <main>
        <section class="text_divider padded"> <!-- text admin dashboard a potom oddelovať čiara -->
            <div class="h1_buttons">

                <h1>Môj účet</h1>
                <a href="admin_dash_login.blade.php" id="admin_dash_btn">Admin Dashboard <span>(Admin Only)</span></a>
                <a id="logout_btn" data-logout-url="{{ route('logout') }}">Odhlásiť sa</a>
            </div>
            <hr class="hr_divider">
        </section>


        <div class="profil_info_wrapper">
            <div class="profil_info_container">
                <div class="osobne_udaje_adresa">
                    <section class="osobne_udaje_pers">
                        <section class="osobne">
                            <h1>Osobné informácie</h1>

                            <ul class="info_ul">
                                <li>{{ $user->meno }} {{ $user->priezvisko }}</li>
                                <li>{{ $user->email }}</li>
                                <li>{{ $user->telephone }}</li>
                                <li>{{ $user->pohlavie }}</li>
                                <li>{{ $user->datum_narodenia }}</li>
                            </ul>
                        </section>

                        <section class="personalizacia">
                            <h1>Personalizované údaje</h1>

                            <ul class="info_ul">
                                <li>Výška: {{ $user->personalizacia->vyska }} cm</li>
                                <li>Hmotnosť: {{ $user->personalizacia->hmotnost }} kg</li>
                                <li>Veľkosť topánok: {{ $user->personalizacia->velkost_topanok }}</li>
                                <li>Značka: {{ $user->personalizacia->znacka }}</li>
                            </ul>

                        </section>
                    </section>

                    <section class="adresa_dorucenia">
                        <section class="adresa_shipping">
                            <h1>Adresa doručenia</h1>

                            <ul class="info_ul">
                                @foreach($user->address as $address)
                                    @if($address->address_type === 'shipping')
                                        <li>Ulica: {{ $address->ulica }}</li>
                                        <li>Číslo domu: {{ $address->cisloDomu }}</li>
                                        <li>Mesto: {{ $address->mesto }}</li>
                                        <li>PSČ: {{ $address->psc }}</li>
                                        <li>Krajina: {{ $address->krajina }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>


                        <section class="adresa_billing">
                            <h1>Adresa fakturácie</h1>

                            <ul class="info_ul">
                                @foreach($user->address as $address)
                                    @if($address->address_type === 'shipping')
                                        <li>Ulica: {{ $address->ulica }}</li>
                                        <li>Číslo domu: {{ $address->cisloDomu }}</li>
                                        <li>Mesto: {{ $address->mesto }}</li>
                                        <li>PSČ: {{ $address->psc }}</li>
                                        <li>Krajina: {{ $address->krajina }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </section>


                    </section>




                </div>

                <div class="newsletter_objednavky">
                    <section class="newsletter_odber">
                        <h1>Newsletter</h1>
                        <span>Nie ste prihlásený k odberu noviniek.</span>
                        <a href="newsletter_sablona.blade.php">Upraviť</a>
                    </section>

                    <section class="objednavky">
                        <h1>Moje objednávky</h1>
                        <span>Tu sa nachádza podrobný prehľad vašich objednávok.</span>
                        <a href="zoznam_objednavok.blade.php">Zobraziť moje objednávky</a>
                    </section>
                </div>

            </div>
        </div>

        <!-- popup okno -->
        @include('components.popup')
    </main>


    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/profil.js') }}"></script>
    <script src="{{ asset('javascript/popup_okno.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
