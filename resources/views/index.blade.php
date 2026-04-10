<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ByteBar - Головна</title>
    
    <!-- SEO & Meta Tags -->
    <meta name="description" content="ByteBar - Міні-маркет готової їжі та комфортний IT-Hub. Свіжа їжа, преміальна кава та ідеальний простір для роботи в Києві.">
    <meta name="keywords" content="ByteBar, IT-Hub, кафе, коворкінг, готова їжа, кава, Київ">
    <meta name="author" content="ByteBar">

    <!-- Open Graph (Facebook, Telegram, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="ByteBar - Ваш щоденний апгрейд">
    <meta property="og:description" content="Зручний міні-маркет готової їжі та IT-Hub. Завантажуй додаток та отримуй бонуси!">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="ByteBar - Ваш щоденний апгрейд">
    <meta property="twitter:description" content="Зручний міні-маркет готової їжі та IT-Hub. Завантажуй додаток та отримуй бонуси!">
    <meta property="twitter:image" content="{{ asset('img/logo.png') }}">
    
    <!-- Browser Customization -->
    <meta name="theme-color" content="#1a202c">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
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

    <!-- Schema.org / Google Rich Snippets -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "CafeOrCoffeeShop",
      "name": "ByteBar",
      "image": "{{ asset('img/logo.png') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "+380440000000",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "вул. Дмитра Дорошенка, 57а",
        "addressLocality": "Київ",
        "addressCountry": "UA"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday", "Tuesday", "Wednesday",
          "Thursday", "Friday", "Saturday", "Sunday"
        ],
        "opens": "08:00",
        "closes": "22:00"
      }
    }
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
                        <li><a href="#about">Про нас</a></li>
                        <li><a href="#menu">Меню</a></li>
                        <li><a href="#location">Контакти</a></li>
                        <li><a href="#news">Новини</a></li>
                    </ul>
                </nav>
                <a href="#cta" class="btn btn-primary"><i class="fa-solid fa-download"></i> Завантажити додаток</a>
            </div>
        </div>
    </header>

    <main>
        <section id="hero">
            <div class="hero-overlay"></div>

            <img src="{{ asset('img/Strip/top_strip.png') }}" class="hero-strip top-strip" alt="decorative strip">

            <div class="hero-content">
                <h1>ByteBar: Ваш щоденний апгрейд</h1>
                <p>Міні-маркет готової їжі & Комфортний IT-Hub</p>
                <a href="#about" class="btn btn-light"><img src="{{ asset('img/Icon/Icon.png') }}" alt=""> Дізнатися більше</a>
            </div>

            <img src="{{ asset('img/Strip/bottom_strip.png') }}" class="hero-strip bottom-strip" alt="decorative strip">
        </section>

        <section id="about">
            <div class="container">
                <h2>Наша концепція та переваги</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <img src="{{ asset('img/App/App1.png') }}" alt="Простір">
                        <h3>Сучасний простір</h3>
                        <p>Комфортний коворкінг з високошвидкісним інтернетом, зручними робочими місцями та атмосферою для продуктивної роботи</p>
                    </div>
                    <div class="feature-card">
                        <img src="{{ asset('img/App/App2.png') }}" alt="Їжа">
                        <h3>Свіжа готова їжа</h3>
                        <p>Широкий асортимент свіжих страв власного виробництва, здорові снеки та напої преміум-якості</p>
                    </div>
                    <div class="feature-card">
                        <img src="{{ asset('img/App/App3.png') }}" alt="Проєкт">
                        <h3>Український проєкт</h3>
                        <p>Гордо підтримуємо локальних виробників та розвиваємо ІТ-екосистему України</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="cta">
            <div class="container cta-content">
                <i class="fa-solid fa-qrcode"></i>
                <h3>Завантажуй додаток та отримуй унікальні знижки за айтішки</h3>
                <p>Просто скануйте свій QR-код при покупках та отримуйте знижки і спеціальні пропозиції</p>
                <div class="cta-store-buttons">
                    <a href="https://play.google.com/store" target="_blank" class="btn-store" onclick="gtag('event', 'download_app_click', { 'platform': 'Android' });">
                        <i class="fa-brands fa-google-play"></i>
                        <div>
                            <span class="btn-store-sub">Завантажити в</span>
                            <span class="btn-store-main">Google Play</span>
                        </div>
                    </a>
                    <a href="https://www.apple.com/app-store/" target="_blank" class="btn-store" onclick="gtag('event', 'download_app_click', { 'platform': 'iOS' });">
                        <i class="fa-brands fa-apple"></i>
                        <div>
                            <span class="btn-store-sub">Завантажити в</span>
                            <span class="btn-store-main">App Store</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section id="menu">
            <div class="container">
                <h2>Досліджуйте наше меню</h2>

                <div class="menu-categories" id="menu-categories-list">
                    {{-- Динамічно підтягується з /api/categories --}}
                    <div class="menu-categories-skeleton">Завантаження...</div>
                </div>

                <h3 class="subsection-title">Ключові позиції</h3>
                <div class="menu-highlights" id="menu-highlights-list">
                    {{-- Динамічно підтягується з /api/catalog/products?tag=Топ продажів --}}
                </div>
            </div>
        </section>

        <section id="location">
            <div class="container">
                <h2>Локація та контакти</h2>
                
                <div class="location-content">
                    
                    <div class="location-slider-column">
                        <div class="location-slider-container">
                            <div class="location-slide active-slide" data-location="techpark">
                                <div class="location-header">
                                    <h3>ByteBar</h3>
                                </div>
                                <div class="info-item">
                                    <img src="{{ asset('img/Contacts/Address.png') }}" alt="Адреса">
                                    <div>
                                        <strong>Адреса</strong>
                                        <p>м.Київ, вул. Д. Дорошенка, 57а</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <img src="{{ asset('img/Contacts/Phone.png') }}" alt="Телефон">
                                    <div>
                                        <strong>Телефон</strong>
                                        <p>+380 (044) 531-31-68</p>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <img src="{{ asset('img/Contacts/Mode.png') }}" alt="Режим роботи">
                                    <div>
                                        <strong>Режим роботи</strong>
                                        <p>Пн-Пт: 08:00 - 22:00, Сб-Нд: 09:00 - 21:00</p>
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <a href="https://maps.google.com/?q=вул.+Дмитра+Дорошенка,+57а,+Київ" target="_blank" class="btn btn-primary map-btn">
                                        <i class="fa-solid fa-route"></i> &ensp;Маршрут
                                    </a>
                                    <a href="#" class="btn btn-outline detail-btn">Подробиці</a>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    
                    <div class="map-container" style="height: 540px; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow);">
                        <iframe 
                            src="https://maps.google.com/maps?q=м.Київ,%20вул.%20Дмитра%20Дорошенка,%2057а&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div> 
            </div>
        </section>

        <section id="news">
            <div class="container">
                <h2>Останні новини та події хабу</h2>
                <div class="news-grid" id="newsGrid">
                    <!-- News cards will be dynamically loaded here via API -->
                </div>
            </div>
        </section>

        <section id="feedback">
            <div class="container">
                <h2>Ваш відгук важливий</h2>
                <p class="feedback-subtitle">Поділіться вашими думками, пропозиціями або побажаннями</p>
                <div id="feedback-msg" style="display:none;"></div>
                <form id="feedback-form">
                    <div class="form-group">
                        <label for="feedback-name">Ім'я (необов'язково)</label>
                        <input type="text" id="feedback-name" name="name" placeholder="Ваше ім'я">
                    </div>
                    <div class="form-group">
                        <label for="feedback-email">Email (необов'язково)</label>
                        <input type="email" id="feedback-email" name="email" placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label for="feedback-message">Повідомлення *</label>
                        <textarea id="feedback-message" name="message" rows="5" placeholder="Ваш відгук або пропозиція..." required></textarea>
                    </div>
                    <button type="submit" id="feedback-submit" class="btn btn-primary btn-full">
                        <i class="fa-solid fa-paper-plane"></i> Надіслати пропозицію
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <a href="{{ url('/') }}" class="logo"><img src="{{ asset('img/logo.png') }}" alt="ByteBar Logo" class="logo-img"> ByteBar</a>
            <p class="footer-subtitle">Міні-маркет готової їжі & Комфортний IT-Hub</p>
            <p class="copyright">&copy; 2025 ByteBar. Всі права захищені.</p>
            <p class="made-in">Зроблено з <i class="fa-solid fa-heart" style="color: #e25555;"></i> в Україні</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newsGrid = document.getElementById('newsGrid');

            Promise.all([
                fetch('/api/news-feed').then(r => r.json()),
                fetch('/api/promotions').then(r => r.json())
            ])
            .then(([newsResult, promosResult]) => {
                // Нормалізуємо новини
                const newsItems = (newsResult.data || []).map(item => ({
                    title:       item.title,
                    description: item.description || '',
                    image_url:   item.image_url || null,
                    date:        item.created_at || '',
                    label:       null
                }));

                // Нормалізуємо акції
                const promos = Array.isArray(promosResult) ? promosResult : (promosResult.data || []);
                const promoItems = promos.map(item => ({
                    title:       item.title,
                    description: item.description || '',
                    image_url:   item.image_url || null,
                    date:        item.valid_until || '',
                    label:       'Акція'
                }));

                // Об'єднуємо та перемішуємо (Fisher-Yates)
                let combined = [...newsItems, ...promoItems];
                for (let i = combined.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [combined[i], combined[j]] = [combined[j], combined[i]];
                }

                const picked = combined.slice(0, 3);

                if (picked.length === 0) {
                    newsGrid.innerHTML = '<p style="grid-column: 1 / -1; text-align: center;">Немає останніх новин.</p>';
                    return;
                }

                newsGrid.innerHTML = '';
                picked.forEach(item => {
                    const imgUrl = item.image_url ? item.image_url : '{{ asset("img/Photo/Photo_5.png") }}';
                    const dateStr = item.label
                        ? `<span class="date" style="background:#22c55e;color:#fff;padding:2px 10px;border-radius:12px;font-size:12px;">${item.label}</span>`
                        : `<span class="date">${item.date}</span>`;
                    const card = `
                        <div class="news-card">
                            <img src="${imgUrl}" alt="${item.title}">
                            <div class="news-card-content">
                                ${dateStr}
                                <h4>${item.title}</h4>
                                <p>${item.description}</p>
                                <a href="#" class="btn btn-outline">Детальніше</a>
                            </div>
                        </div>
                    `;
                    newsGrid.insertAdjacentHTML('beforeend', card);
                });
            })
            .catch(error => {
                console.error('Error fetching content:', error);
                newsGrid.innerHTML = '<p style="grid-column: 1 / -1; text-align: center;">Помилка завантаження.</p>';
            });
        });
    </script>
    <script src="{{ asset('js/main.js') }}?v={{ time() }}"></script>
</body>
</html>
