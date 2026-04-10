<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteBar Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="admin-body">

    <div class="admin-container">
        <aside class="admin-sidebar" id="admin-sidebar">
            <div class="admin-sidebar-top">
                <div class="admin-logo">
                    <div class="logo-icon">B</div>
                    <span>ByteBar Admin</span>
                </div>
                <button class="sidebar-close-btn" id="sidebar-close-btn"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <nav class="admin-nav">
                <ul>
                    <li><a href="#" class="admin-nav-link" data-target="news">Новини та Події</a></li>
                    <li><a href="#" class="admin-nav-link active-link" data-target="menu">Меню</a></li>
                    <li><a href="#" class="admin-nav-link" data-target="categories">Категорії товарів</a></li>
                    <li><a href="#" class="admin-nav-link" data-target="promo">Акції та знижки</a></li>
                    <li><a href="#" class="admin-nav-link" data-target="feedbacks">Відгуки</a></li>
                </ul>
            </nav>
        </aside>

        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <div class="admin-mobile-header">
            <button class="hamburger-btn" id="hamburger-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="admin-logo-mobile">
                <div class="logo-icon">B</div>
                <span>ByteBar Admin</span>
            </div>
        </div>

        <main class="admin-content">
            
            <section id="menu" class="admin-section active-section">
                
                <div class="view-list">
                    <div class="section-header">
                        <h2>Меню</h2>
                        <button class="btn btn-primary btn-add"><i class="fa-solid fa-plus"></i> Додати позицію</button>
                    </div>

                    <div class="filter-box">
                        <label>Фільтр за категорією</label>
                        <select class="admin-select">
                            <option>Всі категорії</option>
                            <option>Кава</option>
                            <option>Снеки</option>
                            <option>Власне виробництво</option>
                        </select>
                    </div>

                    <div class="admin-list">
                        <!-- Items injected dynamically via admin.js -->
                    </div>
                </div>

                <div class="view-form" style="display: none;">
                    <div class="section-header">
                        <h3><i class="fa-solid fa-arrow-left btn-back-icon"></i> Додати позицію</h3>
                    </div>
                    
                    <div class="form-container-card">
                        <form class="admin-form" id="menu-form">
                            <div class="form-group">
                                <label>Назва позиції *</label>
                                <input type="text" placeholder="Введіть назву позиції" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Категорія *</label>
                                    <select required>
                                        <option>Кава</option>
                                        <option>Снеки</option>
                                        <option>Власне виробництво</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ціна (₴) *</label>
                                    <input type="number" placeholder="0" required min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Опис</label>
                                <textarea placeholder="Введіть опис позиції" rows="3"></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Тег</label>
                                    <select>
                                        <option>Топ продажів</option>
                                        <option>Новинка</option>
                                        <option>Без тегу</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ПДВ (%)</label>
                                    <select>
                                        <option>5% - Стандарт</option>
                                        <option>7% - Пільговий</option>
                                        <option>10% - Акциз</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Зображення</label>
                                <input type="file" accept="image/*" class="file-input">
                                <div class="image-preview-container" style="margin-top: 10px;">
                                    <img class="img-preview" src="" style="display: none; height: 80px; object-fit: cover; border-radius: 8px;">
                                </div>
                            </div>

                            <div class="form-divider-title">Поживна цінність (необов'язково)</div>

                            <div class="form-group">
                                <label>Енергетична цінність</label>
                                <input type="text" placeholder="наприклад, 145 ккал / 607 кДж">
                            </div>
                            <div class="form-group">
                                <label>Склад продуктів</label>
                                <input type="text" placeholder="білки, жири, вуглеводи, тощо">
                            </div>
                            <div class="form-actions-footer">
                                <button type="button" class="btn btn-primary btn-save">
                                    <i class="fa-regular fa-floppy-disk"></i> Зберегти
                                </button>
                                <button type="button" class="btn btn-outline-gray btn-cancel">Скасувати</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section id="news" class="admin-section">
                <div class="view-list">
                    <div class="section-header">
                        <h2>Новини та Події</h2>
                        <button class="btn btn-primary btn-add"><i class="fa-solid fa-plus"></i> Додати новину</button>
                    </div>

                    <div class="admin-list">
                        <!-- Items injected dynamically via admin.js -->
                    </div>
                </div>

                <div class="view-form" style="display: none;">
                    <div class="section-header">
                        <h3><i class="fa-solid fa-arrow-left btn-back-icon"></i> Додати подію</h3>
                    </div>
                    
                    <div class="form-container-card">
                        <form class="admin-form" id="news-form">
                            <div class="form-group">
                                <label>Назва події *</label>
                                <input type="text" placeholder="Введіть назву події" required>
                            </div>
                            <div class="form-group">
                                <label>Опис події</label>
                                <textarea placeholder="Введіть опис події" rows="3"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Дата початку *</label>
                                    <input type="date" required>
                                </div>
                                <div class="form-group">
                                    <label>Дата завершення *</label>
                                    <input type="date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Зображення (необов'язково)</label>
                                <input type="file" accept="image/*" class="file-input">
                                <div class="image-preview-container" style="margin-top: 10px;">
                                    <img class="img-preview" src="" style="display: none; height: 80px; object-fit: cover; border-radius: 8px;">
                                </div>
                            </div>
                            <div class="form-actions-footer">
                                <button type="submit" class="btn btn-primary btn-save">
                                    <i class="fa-regular fa-floppy-disk"></i> Зберегти
                                </button>
                                <button type="button" class="btn btn-outline-gray btn-cancel">Скасувати</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>


            <section id="categories" class="admin-section">
                <div class="view-list">
                    <div class="section-header">
                        <h2>Категорії товарів</h2>
                        <button class="btn btn-primary btn-add"><i class="fa-solid fa-plus"></i> Додати категорію</button>
                    </div>

                    <div class="categories-grid">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <div class="view-form" style="display: none;">
                    <div class="section-header">
                        <h3><i class="fa-solid fa-arrow-left btn-back-icon"></i> Додати категорію</h3>
                    </div>
                    
                    <div class="form-container-card">
                        <form class="admin-form" id="category-form">
                            <div class="form-group">
                                <label>Назва категорії *</label>
                                <input type="text" placeholder="Введіть назву категорії" required>
                            </div>
                            <div class="form-group">
                                <label>Іконка категорії</label>
                                <label class="btn-upload">
                                    <i class="fa-solid fa-image"></i> Обрати іконку
                                    <input type="file" accept="image/*" class="file-input" style="display:none;">
                                </label>
                                <div class="image-preview-container" style="margin-top: 10px;">
                                    <img class="img-preview" src="" style="display: none; height: 80px; object-fit: cover; border-radius: 8px;">
                                </div>
                            </div>
                            <div class="form-actions-footer">
                                <button type="submit" class="btn btn-primary btn-save">
                                    <i class="fa-regular fa-floppy-disk"></i> Зберегти
                                </button>
                                <button type="button" class="btn btn-outline-gray btn-cancel">Скасувати</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>


            <section id="promo" class="admin-section">
                <div class="view-list">
                    <div class="section-header">
                        <h2>Акції та знижки</h2>
                        <button class="btn btn-primary btn-add"><i class="fa-solid fa-plus"></i> Додати акцію</button>
                    </div>

                    <div class="admin-list">
                        <!-- Items injected dynamically via admin.js -->
                    </div>
                </div>

                <div class="view-form" style="display: none;">
                    <div class="section-header">
                        <h3><i class="fa-solid fa-arrow-left btn-back-icon"></i> Додати акцію</h3>
                    </div>

                    <div class="form-container-card">
                        <form class="admin-form" id="promo-form">
                            <div class="form-group">
                                <label>Назва акції *</label>
                                <input type="text" placeholder="Введіть назву акції" required>
                            </div>
                            <div class="form-group">
                                <label>Опис акції</label>
                                <textarea placeholder="Опис умов акції" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Знижка (%) *</label>
                                <input type="number" placeholder="0" required min="0" max="100">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Дата початку *</label>
                                    <input type="date" required>
                                </div>
                                <div class="form-group">
                                    <label>Дата завершення *</label>
                                    <input type="date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Зображення акції (необов'язково)</label>
                                <input type="file" accept="image/*" class="file-input">
                                <div class="image-preview-container" style="margin-top: 10px;">
                                    <img class="img-preview" src="" style="display: none; height: 80px; object-fit: cover; border-radius: 8px;">
                                </div>
                            </div>
                            <div class="form-actions-footer">
                                <button type="submit" class="btn btn-primary btn-save">
                                    <i class="fa-regular fa-floppy-disk"></i> Зберегти
                                </button>
                                <button type="button" class="btn btn-outline-gray btn-cancel">Скасувати</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section id="feedbacks" class="admin-section">
                <div class="view-list">
                    <div class="section-header">
                        <h2>Відгуки користувачів</h2>
                    </div>
                    <div id="feedbacks-list"></div>
                </div>
            </section>

        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}?v={{ time() + 10 }}"></script>
</body>
</html>
