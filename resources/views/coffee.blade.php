<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteBar - Кава</title>
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
                <div class="catalog-nav">
                    <button class="catalog-tab active-category" data-tab="coffee">
                        <img src="{{ asset('img/Icon_2/Icon_1.png') }}" alt="Кава">
                        <p>Кава</p>
                    </button>
                    <button class="catalog-tab" data-tab="snacks">
                        <img src="{{ asset('img/Icon_2/Icon_2.png') }}" alt="Снеки">
                        <p>Снеки</p>
                    </button>
                    <button class="catalog-tab" data-tab="own">
                        <img src="{{ asset('img/Icon_2/Icon_3.png') }}" alt="Власне">
                        <p>Власне</p>
                    </button>
                    <button class="catalog-tab" data-tab="desserts">
                        <img src="{{ asset('img/Icon_2/Icon_4.png') }}" alt="Десерти">
                        <p>Десерти</p>
                    </button>
                    <button class="catalog-tab" data-tab="healthy">
                        <img src="{{ asset('img/Icon_2/Icon_5.png') }}" alt="Здорове">
                        <p>Здорове</p>
                    </button>
                    <button class="catalog-tab" data-tab="bakery">
                        <img src="{{ asset('img/Icon_2/Icon_6.png') }}" alt="Випічка">
                        <p>Випічка</p>
                    </button>
                </div>

                <div class="tabs-container">

                    <div id="coffee" class="menu-items-grid tab-content active-content">
                        <div class="menu-item-card">
                            <img src="{{ asset('img/CatalogPage.png') }}" alt="Латте ванільний">
                            <div class="item-content">
                                <h4>Латте ванільний</h4>
                                <p class="description">Ніжний латте з натуральною ванільною есенцією</p>
                                <div class="item-details">
                                    <span class="label">Калорії:</span>
                                    <span class="calories">145 ккал</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-card">
                            <img src="{{ asset('img/CatalogPage.png') }}" alt="Капучино">
                            <div class="item-content">
                                <h4>Капучино Класік</h4>
                                <p class="description">Класичний капучино з густою молочною пінкою</p>
                                <div class="item-details">
                                    <span class="label">Калорії:</span>
                                    <span class="calories">110 ккал</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-card">
                            <img src="{{ asset('img/CatalogPage.png') }}" alt="Американо">
                            <div class="item-content">
                                <h4>Американо</h4>
                                <p class="description">Насичена чорна кава з додаванням гарячої води</p>
                                <div class="item-details">
                                    <span class="label">Калорії:</span>
                                    <span class="calories">5 ккал</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="menu-item-card">
                            <img src="{{ asset('img/CatalogPage.png') }}" alt="Раф кава">
                            <div class="item-content">
                                <h4>Раф кава</h4>
                                <p class="description">Збита кава з вершками та ванільним цукром</p>
                                <div class="item-details">
                                    <span class="label">Калорії:</span>
                                    <span class="calories">190 ккал</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="snacks" class="tab-content empty-placeholder">
                        <i class="fa-solid fa-cookie-bite"></i>
                        <h3>Цей розділ в розробці</h3>
                        <p>Ми вже готуємо найсмачніші снеки для вас. Завітайте трохи згодом!</p>
                    </div>

                    <div id="own" class="tab-content empty-placeholder">
                        <i class="fa-solid fa-utensils"></i>
                        <h3>Скоро тут буде смачно</h3>
                        <p>Наші кухарі розробляють унікальні рецепти страв.</p>
                    </div>

                    <div id="desserts" class="tab-content empty-placeholder">
                        <i class="fa-solid fa-cake-candles"></i>
                        <h3>Солодке життя попереду</h3>
                        <p>Найніжніші десерти з'являться тут зовсім скоро.</p>
                    </div>

                    <div id="healthy" class="tab-content empty-placeholder">
                        <i class="fa-solid fa-carrot"></i>
                        <h3>Здоров'я - це головне</h3>
                        <p>Формуємо меню зі свіжих салатів та боулів.</p>
                    </div>

                    <div id="bakery" class="tab-content empty-placeholder">
                        <i class="fa-solid fa-bread-slice"></i>
                        <h3>Аромат свіжої випічки...</h3>
                        <p>Вже скоро ви побачите тут наші круасани та булочки.</p>
                    </div>

                </div>
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

    <div id="productModal" class="modal">
        <div class="modal-content">
            
            <div class="modal-header">
                <h3 id="modalTitle">Назва товару</h3>
                <span class="close-btn">&times;</span>
            </div>

            <div class="modal-body">
                
                <img id="modalImg" src="" alt="Product Image" class="modal-main-img">
                
                <p id="modalDesc" class="modal-description">Опис товару...</p>

                <div class="nutrition-box">
                    <h4>Поживна цінність (на 100г)</h4>
                    
                    <div class="nutrition-row">
                        <span>Енергетична цінність</span>
                        <span class="nutrition-val">
                            <span id="modalCalories">145 ккал</span>
                            <br><small>607 кДж</small>
                        </span>
                    </div>
                    
                    <div class="nutrition-row">
                        <span>Білки</span>
                        <span class="nutrition-val">7.2 г</span>
                    </div>
                    
                    <div class="nutrition-row">
                        <span>Вуглеводи</span>
                        <span class="nutrition-val">15.3 г</span>
                    </div>
                    
                    <div class="nutrition-row">
                        <span>Жири</span>
                        <span class="nutrition-val">6.8 г</span>
                    </div>

                    <div class="nutrition-row">
                        <span>Клітковина</span>
                        <span class="nutrition-val">0 г</span>
                    </div>

                    <div class="nutrition-row last-row">
                        <span>Сіль</span>
                        <span class="nutrition-val">0.18 г</span>
                    </div>
                </div>

                <div class="ingredients-section">
                    <h4>Склад</h4>
                    <p>Кава арабіка 100%, молоко коров'яче пастеризоване, сироп ванільний (цукор, вода, натуральний ароматизатор).</p>
                </div>

                <div class="allergens-box">
                    <h4>Алергени</h4>
                    <p>Молоко</p>
                </div>
                
            </div>
        </div>
    </div>

    <script src="{{ asset('js/modal.js') }}"></script>

</body>
</html>
