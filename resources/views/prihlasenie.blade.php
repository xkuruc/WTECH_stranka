<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/menu_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kosik_sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        @include('components.navbar')
        @include('components.sidebar')
        @include('components.kosik_sidebar')
    </header>

    <main>
        <section class="main">
            <div class="options">
                <div class="option_prihlasitsa">Prihlásiť sa</div>
                <div class="option_registracia"> <a href="registracia.blade.php">Registrácia </a> </div>
            </div>
            <div>
                <form class="login_placeholder" onsubmit="alert('Zadaný e-mail: ' + this.email.value); window.location.href = 'profil.blade.php'; return false;">
                    <input class="login_input" type="email" name="email" placeholder="E-mail*" required/>
                    <input class="login_input" type="password" name="password" placeholder="Heslo*" required />
                    <button class="login_button" type="submit">PRIHLÁSIŤ SA </button>
                </form>
                <p class="Zabudliheslo"> <a href="a">Zabudli ste heslo ? </a> </p>
                <div class="povinne_policka">
                    <p>*Povinné políčka</p>
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>

    <!-- naše skripty -->
    <script src="{{ asset('javascript/product_slider.js') }}"></script>
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
