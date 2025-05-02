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
    <link rel="stylesheet" href="{{ asset('css/filter_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orderby_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product_item.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page_number_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filter_big_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/text_divider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/popup_overlay.css') }}">
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
        <!-- filter menu -->
        @include('components.filter_menu')

        <section class="produkty_kontajner">
            <section class="text_divider"> <!-- text admin dashboard a potom oddelovať čiara -->
                <div class="h1_buttons">
                    <h1>Admin Dashboard</h1>
                    <a id="logout_btn" data-logout-url="{{ route('admin_leave_dash') }}">Opustiť rozhranie</a>
                </div>
                <hr class="hr_divider">
            </section>


            <!-- zoradiť podľa menučko -->
            <div class="orderby_menu">
                <p>Zoradiť podľa: </p>
                <select id="sort">
                    <option value="" disabled selected hidden>Vyber zoradenie</option>
                    <option value="price~asc" {{ request()->query('orderby') === 'price~asc' ? 'selected' : '' }}>Najlacnejšie</option>
                    <option value="price~desc" {{ request()->query('orderby') === 'price~desc' ? 'selected' : '' }}>Najdrahšie</option>
                    <option value="latest" {{ request()->query('orderby') === 'latest' ? 'selected' : '' }}>Najnovšie</option>
                </select>
            </div>


            <!-- obrázky a info/ceny k nim pochádzajú zo stránky https://www.thestreets.sk/ -->
            <!-- zoznam produktov -->
            <div class="product_list">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="product_link">
                        <article class="product_item_relative">
                            <div class="item_img">
                                <img src="{{ asset('images/' . ($product->main_image ?? 'default.jpg')) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="product_info">
                                <p class="product_label">{{ $product->name }}</p>

                                @if($product->discount > 0)
                                    <div class="discounted_price">
                                        <strong>
                                            {{ number_format($product->price * (1 - $product->discount / 100), 2) }} €
                                        </strong>

                                        <span class="old_price" style="text-decoration: line-through; color: #888;">
                                        {{ number_format($product->price, 2) }} €
                                    </span>
                                    </div>
                                    <!-- zlava -->
                                    <div class="sale_placeholder">
                                        -{{ round($product->discount) }}%
                                    </div>
                                @else
                                    <strong>
                                        {{ number_format($product->price), 2}} €
                                    </strong>
                            @endif

                        </article>
                    </a>
                @endforeach

                @if($products->isEmpty())
                    <p>Žiadne produkty na zobrazenie.</p>
                @endif
            </div>



            <!-- stránkovanie -->
            <nav class="page_number_list">
                {{-- Predchadzajuca stranka --}}
                @if($products->onFirstPage())
                    <button id="prev_page_btn" disabled>
                        <img src="{{ asset('icons/filter_sipka.svg') }}" alt="Predchádzajúca">
                    </button>
                @else
                    <button id="prev_page_btn"
                            onclick="location.href='{{ $products->previousPageUrl() }}'">
                        <img src="{{ asset('icons/filter_sipka.svg') }}" alt="Predchádzajúca">
                    </button>
                @endif

                <div id="page_list">
                    {{-- Dynamicky generovane cisla stranok --}}
                    @for ($page = 1; $page <= $products->lastPage(); $page++)
                        <button class="page_number {{ $page == $products->currentPage() ? 'active' : '' }}"
                                onclick="location.href='{{ $products->url($page) }}'">
                            {{ $page }}
                        </button>
                    @endfor
                </div>

                {{-- dalsia stranka --}}
                @if($products->hasMorePages())
                    <button id="next_page_btn"
                            onclick="location.href='{{ $products->nextPageUrl() }}'">
                        <img src="{{ asset('icons/filter_sipka.svg') }}" alt="Ďalšia">
                    </button>
                @else
                    <button id="next_page_btn" disabled>
                        <img src="{{ asset('icons/filter_sipka.svg') }}" alt="Ďalšia">
                    </button>
                @endif
            </nav>
        </section>


        <!-- filter overlay -->
        @include('components.big_filter', [
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'filters' => $appliedFilters
        ])


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
    <script src="{{ asset('javascript/filter_overlay.js') }}"></script>
    <script src="{{ asset('javascript/price_slider.js') }}"></script>
    <script src="{{ asset('javascript/filter_resize.js') }}"></script>
    <script src="{{ asset('javascript/admin_dash.js') }}"></script>
    <script src="{{ asset('javascript/popup_okno.js') }}"></script>
    <script src="{{ asset('javascript/kosik_sidebar.js') }}"></script>
</body>
</html>
