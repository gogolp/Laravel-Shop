document.addEventListener('DOMContentLoaded', () => {
    
    // ==========================================
    // 1. ЛОГІКА МОДАЛЬНОГО ВІКНА
    // ==========================================
    const modal = document.getElementById('productModal');
    const closeBtn = document.querySelector('.close-btn');

    // Базові елементи модалки
    const modalImg = document.getElementById('modalImg');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalCalories = document.getElementById('modalCalories');
    
    // Додаткові елементи з поживністю та складом
    const modalProtein = document.getElementById('modalProtein');
    const modalCarbs = document.getElementById('modalCarbs');
    const modalFats = document.getElementById('modalFats');
    const modalFiber = document.getElementById('modalFiber');
    const modalSalt = document.getElementById('modalSalt');
    const modalIngredients = document.getElementById('modalIngredients');
    const modalAllergens = document.getElementById('modalAllergens');

    function openModal(card) {
        // Беремо базові дані з видимої частини картки
        const img = card.querySelector('img').src;
        const title = card.querySelector('h4').innerText;
        const descEl = card.querySelector('.description');
        const desc = descEl ? descEl.innerText : '';
        const calEl = card.querySelector('.calories');
        const cal = calEl ? calEl.innerText : '';

        // Беремо додаткові дані з прихованого блоку .hidden-data
        const hiddenData = card.querySelector('.hidden-data');

        // Заповнюємо модалку
        if(modalImg) modalImg.src = img;
        if(modalTitle) modalTitle.innerText = title;
        if(modalDesc) modalDesc.innerText = desc;
        if(modalCalories) modalCalories.innerText = cal;

        // Заповнюємо деталі, якщо вони є
        if(hiddenData) {
            if(modalProtein) modalProtein.innerText = hiddenData.dataset.protein + ' г';
            if(modalCarbs) modalCarbs.innerText = hiddenData.dataset.carbs + ' г';
            if(modalFats) modalFats.innerText = hiddenData.dataset.fats + ' г';
            if(modalFiber) modalFiber.innerText = hiddenData.dataset.fiber + ' г';
            if(modalSalt) modalSalt.innerText = hiddenData.dataset.salt + ' г';
            if(modalIngredients) modalIngredients.innerText = hiddenData.dataset.ingredients;
            if(modalAllergens) modalAllergens.innerText = hiddenData.dataset.allergens;
        }

        // Відкриваємо вікно та блокуємо скрол сторінки
        if(modal) {
            modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal() {
        if(modal) {
            modal.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    // Делегування подій для динамічних карток (оскільки ми генеруємо їх через JS)
    document.body.addEventListener('click', (e) => {
        // Шукаємо, чи клік був по картці або елементу всередині неї
        const card = e.target.closest('.menu-item-card');
        
        if (card) {
            e.preventDefault();
            openModal(card);
        }
    });

    // Закриття на хрестик та клік поза модалкою
    if(closeBtn) closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });


    // ==========================================
    // 2. ЛОГІКА ПЕРЕМИКАННЯ ВКЛАДОК (КАТЕГОРІЙ)
    // ==========================================
    const tabs = document.querySelectorAll('.catalog-tab');
    const contents = document.querySelectorAll('.tab-content');

    // Створюємо окрему функцію для активації вкладки
    function activateTab(tabId) {
        const targetTab = document.querySelector(`.catalog-tab[data-tab="${tabId}"]`);
        const targetContent = document.getElementById(tabId);

        if (targetTab && targetContent) {
            // Забираємо активний клас у всіх вкладок і контенту
            tabs.forEach(t => t.classList.remove('active-category'));
            contents.forEach(c => c.classList.remove('active-content'));

            // Додаємо класи лише потрібній вкладці
            targetTab.classList.add('active-category');
            targetContent.classList.add('active-content');
        }
    }

    // Перевіряємо URL при завантаженні сторінки (для переходів з index.html)
    if (window.location.hash) {
        // Забираємо символ '#' і активуємо вкладку (наприклад, 'desserts')
        const hash = window.location.hash.replace('#', '');
        activateTab(hash);
    }

    // Обробляємо звичайний клік по вкладках на самій сторінці меню
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault(); 
            const targetId = tab.getAttribute('data-tab');
            activateTab(targetId);
            
            // Оновлюємо URL в адресному рядку браузера без перезавантаження сторінки
            history.pushState(null, null, `#${targetId}`);
        });
    });

});