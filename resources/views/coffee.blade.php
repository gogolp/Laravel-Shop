<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteBar - Кава та Меню</title>
    
    <!-- SEO & Meta Tags -->
    <meta name="description" content="Дослідіть меню ByteBar: від класичної арабіки до десертів та здорового харчування. Якісні продукти власного виробництва.">
    <meta name="keywords" content="ByteBar, меню, кава, арабіка, капучино, десерти, Київ, готова їжа">
    <meta name="author" content="ByteBar">

    <!-- Open Graph (Facebook, Telegram, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/coffee') }}">
    <meta property="og:title" content="Меню ByteBar - Найкраща кава та снеки">
    <meta property="og:description" content="Дослідіть меню ByteBar: від класичної арабіки до десертів та здорового харчування.">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/coffee') }}">
    <meta property="twitter:title" content="Меню ByteBar - Найкраща кава та снеки">
    <meta property="twitter:description" content="Дослідіть меню ByteBar: від класичної арабіки до десертів та здорового харчування.">
    <meta property="twitter:image" content="{{ asset('img/logo.png') }}">
    
    <title>ByteBar - Меню</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google tag (gtag.js) GA4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W9VSR1XK6R"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-W9VSR1XK6R');
    </script>
</head>
<body>

    <header>
        <div class="container nav-container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="ByteBar Logo" class="logo-img"> ByteBar
            </a>
            
            <button class="burger-menu-btn" id="burgerBtn">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="nav-group" id="navGroup">
                <nav>
                    <ul>
                        <li><a href="{{ url('/#about') }}">Про нас</a></li>
                        <li><a href="{{ url('/#menu') }}">Меню</a></li>
                        <li><a href="{{ url('/#location') }}">Контакти</a></li>
                        <li><a href="{{ url('/#news') }}">Новини</a></li>
                    </ul>
                </nav>
                <a href="{{ url('/#cta') }}" class="btn btn-primary"><i class="fa-solid fa-download"></i> Завантажити додаток</a>
            </div>
        </div>
    </header>

    <main>
        <section id="menu" style="padding-top: 0;">
            <div class="menu-header-bg">
                <img src="{{ asset('img/Strip/left_strip.png') }}" class="bg-strip strip-left" alt="">

                <div class="container">
                    <h2>Досліджуйте наше меню</h2>
                    <p class="menu-subtitle">Свіжі продукти власного виробництва щодня</p>
                </div>

                <img src="{{ asset('img/Strip/right_strip.png') }}" class="bg-strip strip-right" alt="">
            </div>

            <div class="container menu-content-container">
                {{-- Вкладки категорій — підтягуються динамічно з /api/categories --}}
                <div id="catalog-nav" class="catalog-nav">
                    <div class="catalog-loading"><i class="fa-solid fa-spinner fa-spin"></i></div>
                </div>

                {{-- Товари за категорією — підтягуються з /api/catalog/products --}}
                <div id="catalog-content" class="tabs-container"></div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <a href="{{ url('/') }}" class="logo"><img src="{{ asset('img/logo.png') }}" alt="ByteBar Logo" class="logo-img"> ByteBar</a>
            <p class="footer-subtitle">Міні-маркет готової їжі &amp; Комфортний IT-Hub</p>
            <p class="copyright">&copy; 2025 ByteBar. Всі права захищені.</p>
            <p class="made-in">Зроблено з <i class="fa-solid fa-heart" style="color: #e25555;"></i> в Україні</p>
        </div>
    </footer>

    {{-- Модальне вікно для перегляду товару --}}
    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Назва товару</h3>
                <span class="close-btn">&times;</span>
            </div>
            <div class="modal-body">
                <img id="modalImg" src="" alt="Product Image" class="modal-main-img">
                <p id="modalDesc" class="modal-description"></p>
                <div class="modal-price" id="modalPrice"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/coffee.js') }}?v={{ time() }}"></script>

</body>
</html>
