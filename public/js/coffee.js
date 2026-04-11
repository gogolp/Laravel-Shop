/**
 * ByteBar — coffee.js
 * Динамічне завантаження категорій і товарів на сторінці меню
 */

let allProducts = [];

/* =============================================
   ВІДКРИТТЯ МОДАЛЬНОГО ВІКНА
   ============================================= */
function openModal(product) {
    document.getElementById('modalTitle').textContent = product.name;
    document.getElementById('modalDesc').textContent = product.description || '';
    document.getElementById('modalImg').src = product.image_url || '/img/placeholder.png';
    document.getElementById('modalImg').alt = product.name;
    document.getElementById('modalPrice').textContent = product.price_uah
        ? product.price_uah + ' ₴'
        : '';
    document.getElementById('productModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('productModal').classList.remove('active');
    document.body.style.overflow = '';
}

/* =============================================
   РЕНДЕР ТОВАРІВ ПО КАТЕГОРІЇ
   ============================================= */
function renderProducts(categoryId) {
    const content = document.getElementById('catalog-content');
    const filtered = allProducts.filter(p => p.category_id === categoryId);

    if (filtered.length === 0) {
        content.innerHTML = `
            <div class="empty-placeholder" style="text-align: center; padding: 40px 20px; display: flex; flex-direction: column; align-items: center;">
                <i class="fa-solid fa-utensils" style="font-size: 48px; color: #ccc; margin-bottom: 16px;"></i>
                <h3 style="margin-bottom: 8px;">Товари в цій категорії відсутні</h3>
                <p style="color: #666;">Скоро тут з'являться нові позиції!</p>
            </div>`;
        return;
    }

    content.innerHTML = `
        <div class="menu-items-grid tab-content active-content">
            ${filtered.map(p => `
                <div class="menu-item-card" data-id="${p.id}" style="cursor:pointer;">
                    <img src="${p.image_url || '/img/CatalogPage.png'}" alt="${p.name}">
                    <div class="item-content">
                        <h4>${p.name}</h4>
                        <p class="description">${p.description || ''}</p>
                        <div class="item-details">
                            <span class="label">Ціна:</span>
                            <span class="calories">${p.price_uah} ₴</span>
                        </div>
                    </div>
                </div>`).join('')}
        </div>`;

    // Клік по картці — відкриває модалку
    content.querySelectorAll('.menu-item-card').forEach(card => {
        card.addEventListener('click', () => {
            const id = parseInt(card.dataset.id);
            const product = allProducts.find(p => p.id === id);
            if (product) openModal(product);
        });
    });
}

/* =============================================
   ЗАВАНТАЖЕННЯ КАТЕГОРІЙ І ТОВАРІВ
   ============================================= */
async function loadCatalog() {
    const nav = document.getElementById('catalog-nav');
    const content = document.getElementById('catalog-content');

    try {
        // Завантажуємо паралельно
        const [catsRes, prodsRes] = await Promise.all([
            fetch('/api/categories'),
            fetch('/api/catalog/products')
        ]);

        const categories = await catsRes.json();
        allProducts = await prodsRes.json();

        if (!categories || categories.length === 0) {
            nav.innerHTML = '<p style="color:#888;">Категорії не знайдені</p>';
            return;
        }

        // Рендер вкладок
        nav.innerHTML = categories.map((cat, idx) => {
            const icon = cat.icon_path
                ? `<img src="${cat.icon_path}" alt="${cat.name}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                   <span class="cat-icon-fallback" style="display:none;"><i class="fa-solid fa-utensils"></i></span>`
                : `<span class="cat-icon-fallback"><i class="fa-solid fa-utensils"></i></span>`;
            return `
                <button class="catalog-tab ${idx === 0 ? 'active-category' : ''}"
                        data-id="${cat.id}">
                    ${icon}
                    <p>${cat.name}</p>
                </button>`;
        }).join('');

        // Показуємо першу категорію
        renderProducts(categories[0].id);

        // Перемикання вкладок
        nav.querySelectorAll('.catalog-tab').forEach(btn => {
            btn.addEventListener('click', () => {
                nav.querySelectorAll('.catalog-tab').forEach(b => b.classList.remove('active-category'));
                btn.classList.add('active-category');
                renderProducts(parseInt(btn.dataset.id));
            });
        });

        // Скрол до потрібної категорії якщо є хеш в URL (#coffee, #snacks тощо)
        const hash = window.location.hash.replace('#', '');
        if (hash) {
            const matchedCat = categories.find(c =>
                c.name.toLowerCase().includes(hash) || hash.includes(c.name.toLowerCase())
            );
            if (matchedCat) {
                const tabBtn = nav.querySelector(`[data-id="${matchedCat.id}"]`);
                if (tabBtn) tabBtn.click();
            }
        }

    } catch (err) {
        console.error('Помилка завантаження каталогу:', err);
        nav.innerHTML = '<p style="color:#888;">Помилка завантаження</p>';
    }
}

/* =============================================
   ІНІЦІАЛІЗАЦІЯ
   ============================================= */
document.addEventListener('DOMContentLoaded', () => {
    loadCatalog();

    // Hide preloader when everything is loaded
    window.addEventListener('load', () => {
        const preloader = document.getElementById('global-preloader');
        if (preloader) {
            setTimeout(() => preloader.classList.add('hidden'), 300);
        }
    });

    // Закриття модалки
    const closeBtn = document.querySelector('.close-btn');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    const productModal = document.getElementById('productModal');
    if (productModal) {
        productModal.addEventListener('click', (e) => {
            if (e.target.id === 'productModal') closeModal();
        });
    }
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });

    // Burger Menu Logic
    const burgerBtn = document.getElementById('burgerBtn');
    const navGroup = document.getElementById('navGroup');
    
    if (burgerBtn && navGroup) {
        burgerBtn.addEventListener('click', () => {
            navGroup.classList.toggle('active');
            
            const icon = burgerBtn.querySelector('i');
            if (navGroup.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }
        });

        document.querySelectorAll('#navGroup a').forEach(link => {
            link.addEventListener('click', () => {
                navGroup.classList.remove('active');
                if (burgerBtn.querySelector('i')) {
                    burgerBtn.querySelector('i').classList.remove('fa-xmark');
                    burgerBtn.querySelector('i').classList.add('fa-bars');
                }
            });
        });
    }
});
