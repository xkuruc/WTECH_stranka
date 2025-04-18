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
    <link rel="stylesheet" href="{{ asset('css/newsletter_sablona.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_radio_btn.css') }}">
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
            <h1>Odoberanie noviniek</h1>
            <hr class="hr_divider">
        </section>

        <section class="newsletter_submit">
            <!-- dynamicky sa doplní, či ide o prihlásenie/odhlásenie z odberu noviniek -->
            <form id="radio_form" method="POST" action="{{ route('newsletter.update') }}">
                @csrf

                <label class="custom_radio_checkbox">
                    <input type="checkbox" name="newsletter" value="1" {{ $user->newsletter ? 'checked' : '' }}>
                    <span class="radio_btn"></span>
                    @if($user->newsletter)
                        Ste prihlásený na odber noviniek.
                    @else
                        Prihlásiť sa na odber noviniek.
                    @endif
                </label>

                <button id="submit_btn" type="submit"><strong>Uložiť</strong></button>
            </form>
        </section>
    </main>

    <!-- footer -->
    @include('components.footer_newsletter')

    <!-- externé skripty -->
    <script src="https://kit.fontawesome.com/39951b4cb0.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- skripty -->
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
    <script src="{{ asset('javascript/side_menubar.js') }}"></script>
</body>
</html>
