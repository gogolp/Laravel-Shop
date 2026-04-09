<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteBar - Головна</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <header>
        <div class="container nav-container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="ByteBar Logo" class="logo-img"> ByteBar
            </a>
            
            <div class="nav-group">
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

        <section id="features">
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
                    <a href="https://play.google.com/store" target="_blank" class="btn-store">
                        <i class="fa-brands fa-google-play"></i>
                        <div>
                            <span class="btn-store-sub">Завантажити в</span>
                            <span class="btn-store-main">Google Play</span>
                        </div>
                    </a>
                    <a href="https://www.apple.com/app-store/" target="_blank" class="btn-store">
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
                
                <div class="menu-categories">
                    <a href="{{ url('/coffee') }}#coffee" class="category-item">
                        <img src="{{ asset('img/Icon/Icon_1.png') }}" alt="Кава">
                        <p>Кава</p>
                    </a>
                    <a href="{{ url('/coffee') }}#snacks" class="category-item">
                        <img src="{{ asset('img/Icon/Icon_2.png') }}" alt="Снеки">
                        <p>Снеки</p>
                    </a>
                    <a href="{{ url('/coffee') }}#own" class="category-item">
                        <img src="{{ asset('img/Icon/Icon_3.png') }}" alt="Власне виробництво">
                        <p>Власне виробництво</p>
                    </a>
                    <a href="{{ url('/coffee') }}#desserts" class="category-item">
                        <img src="{{ asset('img/Icon/Icon_4.png') }}" alt="Десерти">
                        <p>Десерти</p>
                    </a>
                    <a href="{{ url('/coffee') }}#healthy" class="category-item">
                        <img src="{{ asset('img/Icon/Icon_5.png') }}" alt="Здорове харчування">
                        <p>Здорове харчування</p>
                    </a>
                    <a href="{{ url('/coffee') }}#bakery" class="category-item">
                        <img src="{{ asset('img/Icon/Icon_6.png') }}" alt="Випічка">
                        <p>Випічка</p>
                    </a>
                </div>

                <h3 class="subsection-title">Ключові позиції</h3>
                <div class="menu-highlights">
                    <div class="menu-card">
                        <img src="{{ asset('img/Photo/Photo_1.png') }}" alt="Сендвіч">
                        <div class="menu-card-content">
                            <h4>Сендвіч дня</h4>
                            <p>Свіжий багет з авокадо, лососем та сирним кремом</p>
                        </div>
                    </div>
                    <div class="menu-card">
                        <img src="{{ asset('img/Photo/Photo_2.png') }}" alt="Капучино">
                        <div class="menu-card-content">
                            <h4>Фірмовий капучино</h4>
                            <p>100% арабіка з Колумбії, молоко на вибір</p>
                        </div>
                    </div>
                    <div class="menu-card">
                        <img src="{{ asset('img/Photo/Photo_3.png') }}" alt="Випічка">
                        <div class="menu-card-content">
                            <h4>Домашня випічка</h4>
                            <p>Круасани, чізкейки та тістечка власного виробництва</p>
                        </div>
                    </div>
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2540.665792949791!2d30.5053075!3d50.4472851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce5e933682fd%3A0xb71a8bc8fec2db9a!2sVul.%20Dmytra%20Doroshenka%2C%2057%D0%B0%2C%20Kyiv%2C%20Ukraine%2C%2002000!5e0!3m2!1sen!2sus!4v1715000000000!5m2!1sen!2sus" 
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
                <div class="news-grid">
                    <div class="news-card">
                        <img src="{{ asset('img/Photo/Photo_5.png') }}" alt="Сири">
                        <div class="news-card-content">
                            <span class="date">15 Листопада 2025</span>
                            <h4>15% знижка на всі сири у п'ятницю</h4>
                            <p>Святкуємо місяць крафтового сиру! Спробуйте найкращі локальні сири зі знижкою.</p>
                            <a href="#" class="btn btn-outline">Детальніше</a>
                        </div>
                    </div>
                    <div class="news-card">
                        <img src="{{ asset('img/Photo/Photo_4.png') }}" alt="Настільні ігри">
                        <div class="news-card-content">
                            <span class="date">20 Листопада 2025</span>
                            <h4>Вечір настільних ігор</h4>
                            <p>Запрошуємо всіх на вечір спілкування та настільних ігор. Старт о 18:00.</p>
                            <a href="#" class="btn btn-outline">Детальніше</a>
                        </div>
                    </div>
                    <div class="news-card">
                        <img src="{{ asset('img/Photo/Photo_6.png') }}" alt="Осіннє меню">
                        <div class="news-card-content">
                            <span class="date">25 Жовтня 2025</span>
                            <h4>Нове осіннє меню вже доступне</h4>
                            <p>Гарбузовий латте, теплі салати та супи - зустрічайте осінь смачно!</p>
                            <a href="#" class="btn btn-outline">Детальніше</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="feedback">
            <div class="container">
                <h2>Ваш відгук важливий</h2>
                <p class="feedback-subtitle">Поділіться вашими думками, пропозиціями або побажаннями</p>
                <form>
                    <div class="form-group">
                        <label for="name">Ім'я (необов'язково)</label>
                        <input type="text" id="name" placeholder="Ваше ім'я">
                    </div>
                    <div class="form-group">
                        <label for="email">Email (необов'язково)</label>
                        <input type="email" id="email" placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label for="message">Повідомлення *</label>
                        <textarea id="message" rows="5" placeholder="Ваш відгук або пропозиція..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
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

</body>
</html>
