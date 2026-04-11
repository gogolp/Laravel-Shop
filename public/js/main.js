/**
 * ByteBar — main.js
 * Динамічне меню + форма відгуків
 */

const CSRF_META = document.querySelector('meta[name="csrf-token"]');
const CSRF = CSRF_META ? CSRF_META.getAttribute('content') : '';

/* =============================================
   1. ДИНАМІЧНІ КАТЕГОРІЇ
   ============================================= */
async function loadCategories() {
    const container = document.getElementById('menu-categories-list');
    if (!container) return;

    try {
        const res = await fetch('/api/categories');
        const cats = await res.json();

        if (!cats || cats.length === 0) {
            container.innerHTML = '<p style="color:#888;text-align:center;">Категорії не знайдені</p>';
            return;
        }

        container.innerHTML = cats.map(cat => {
            const icon = cat.icon_path
                ? `<img src="${cat.icon_path}" alt="${cat.name}">`
                : `<div class="cat-icon-placeholder"><i class="fa-solid fa-utensils"></i></div>`;

            return `
                <a href="/coffee" class="category-item">
                    ${icon}
                    <p>${cat.name}</p>
                </a>`;
        }).join('');

    } catch (err) {
        console.error('Помилка завантаження категорій:', err);
        container.innerHTML = '<p style="color:#888;text-align:center;">Не вдалося завантажити категорії</p>';
    }
}

/* =============================================
   2. ДИНАМІЧНІ КЛЮЧОВІ ПОЗИЦІЇ
   ============================================= */
async function loadHighlights() {
    const container = document.getElementById('menu-highlights-list');
    if (!container) return;

    try {
        const res = await fetch('/api/catalog/products?tag=' + encodeURIComponent('Топ продажів'));
        const products = await res.json();

        if (!products || products.length === 0) {
            container.innerHTML = '<p style="color:#888;text-align:center;">Товари не знайдені</p>';
            return;
        }

        container.innerHTML = products.slice(0, 3).map(p => `
            <div class="menu-card">
                <img src="${p.image_url || '/img/placeholder.png'}" alt="${p.name}">
                <div class="menu-card-content">
                    <h4>${p.name}</h4>
                    <p>${p.description || ''}</p>
                    <a href="/coffee" class="btn btn-outline" style="margin-top:10px;display:inline-block;">
                        Переглянути меню
                    </a>
                </div>
            </div>`
        ).join('');

    } catch (err) {
        console.error('Помилка завантаження продуктів:', err);
        container.innerHTML = '<p style="color:#888;text-align:center;">Не вдалося завантажити продукти</p>';
    }
}

/* =============================================
   3. ФОРМА ВІДГУКІВ
   ============================================= */
function showFeedbackMsg(text, isSuccess) {
    const msg = document.getElementById('feedback-msg');
    if (!msg) return;
    msg.style.display = 'block';
    msg.style.padding = '14px 20px';
    msg.style.borderRadius = '10px';
    msg.style.marginBottom = '20px';
    msg.style.fontWeight = '500';
    msg.style.fontSize = '1rem';
    if (isSuccess) {
        msg.style.background = '#dcfce7';
        msg.style.color = '#166534';
        msg.style.border = '1px solid #bbf7d0';
    } else {
        msg.style.background = '#fef2f2';
        msg.style.color = '#991b1b';
        msg.style.border = '1px solid #fecaca';
    }
    msg.textContent = text;
}

async function setupFeedbackForm() {
    const form = document.getElementById('feedback-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.getElementById('feedback-submit');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Відправка...';

        const data = {
            name: document.getElementById('feedback-name')?.value || '',
            email: document.getElementById('feedback-email')?.value || '',
            message: document.getElementById('feedback-message')?.value || '',
        };

        try {
            const res = await fetch('/api/feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                },
                body: JSON.stringify(data),
            });

            const json = await res.json();

            if (res.ok && json.success) {
                showFeedbackMsg('✓ ' + json.message, true);
                form.reset();
                // Ховаємо форму після успіху
                setTimeout(() => { form.style.display = 'none'; }, 500);
            } else {
                const errors = json.errors
                    ? Object.values(json.errors).flat().join(' ')
                    : (json.message || 'Сталася помилка');
                showFeedbackMsg('✗ ' + errors, false);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        } catch (err) {
            showFeedbackMsg('✗ Помилка з\'єднання. Спробуйте пізніше.', false);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
}

/* =============================================
   INIT
   ============================================= */
document.addEventListener('DOMContentLoaded', () => {
    loadCategories();
    loadHighlights();
    setupFeedbackForm();

    // Hide preloader when everything is loaded
    window.addEventListener('load', () => {
        const preloader = document.getElementById('global-preloader');
        if (preloader) {
            setTimeout(() => preloader.classList.add('hidden'), 300);
        }
    });

    // Burger Menu Logic
    const burgerBtn = document.getElementById('burgerBtn');
    const navGroup = document.getElementById('navGroup');
    
    if (burgerBtn && navGroup) {
        burgerBtn.addEventListener('click', () => {
            navGroup.classList.toggle('active');
            
            // Зміна іконки
            const icon = burgerBtn.querySelector('i');
            if (navGroup.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }
        });

        // Закривати меню при кліку на посилання
        document.querySelectorAll('#navGroup a').forEach(link => {
            link.addEventListener('click', () => {
                navGroup.classList.remove('active');
                const icon = burgerBtn.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-xmark');
                    icon.classList.add('fa-bars');
                }
            });
        });
    }
});
