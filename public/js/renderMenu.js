document.addEventListener('DOMContentLoaded', () => {
    // Перевіряємо, чи підключився файл з даними
    if (typeof menuData === 'undefined') {
        console.error('Масив menuData не знайдено. Перевір підключення файлу menuData.js');
        return;
    }

    // Функція для генерації HTML однієї картки
    const createCardHTML = (item) => {
        return `
            <div class="menu-item-card">
                <img src="${item.image}" alt="${item.title}">
                <div class="item-content">
                    <h4>${item.title}</h4>
                    <p class="description">${item.description}</p>
                    <div class="item-details">
                        <span class="label">Калорії:</span>
                        <span class="calories">${item.calories} ккал</span>
                    </div>
                </div>
                <div class="hidden-data" style="display: none;" 
                    data-protein="${item.protein}" 
                    data-carbs="${item.carbs}" 
                    data-fats="${item.fats}" 
                    data-fiber="${item.fiber}" 
                    data-salt="${item.salt}" 
                    data-ingredients="${item.ingredients}" 
                    data-allergens="${item.allergens}">
                </div>
            </div>
        `;
    };

    // Список категорій (ID має співпадати з ID контейнерів у HTML)
    const categories = [
        { id: 'coffee', icon: 'fa-mug-hot' },
        { id: 'snacks', icon: 'fa-cookie-bite' },
        { id: 'own', icon: 'fa-utensils' },
        { id: 'desserts', icon: 'fa-cake-candles' },
        { id: 'healthy', icon: 'fa-carrot' },
        { id: 'bakery', icon: 'fa-bread-slice' }
    ];

    // Проходимось по кожній категорії і рендеримо товари
    categories.forEach(category => {
        const container = document.getElementById(category.id);
        if (!container) return;

        // Фільтруємо товари з menuData
        const categoryItems = menuData.filter(item => item.category === category.id);

        if (categoryItems.length > 0) {
            // Якщо товари є - генеруємо картки
            container.innerHTML = categoryItems.map(item => createCardHTML(item)).join('');
            // Переконуємось, що клас сітки на місці
            container.classList.add('menu-items-grid'); 
        } else {
            // Якщо товарів немає - показуємо красиву заглушку
            container.innerHTML = `
                <div class="empty-placeholder">
                    <i class="fa-solid ${category.icon}"></i>
                    <h3>Цей розділ в розробці</h3>
                    <p>Ми вже готуємо найсмачніші позиції для вас. Завітайте трохи згодом!</p>
                </div>
            `;
            container.classList.remove('menu-items-grid');
        }
    });
});