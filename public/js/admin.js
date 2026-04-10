document.addEventListener('DOMContentLoaded', () => {
    
    // ---- Mobile Sidebar Toggle ----
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const hamburger = document.getElementById('hamburger-btn');
    const closeBtn = document.getElementById('sidebar-close-btn');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', openSidebar);
    if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // Close sidebar when nav link clicked on mobile
    document.querySelectorAll('.admin-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });

    // Global State Tracker
    window.appData = {
        menu: [],
        news: [],
        promos: [],
        categories: [],
        feedbacks: []
    };
    window.currentEditId = null;
    window.currentEditType = null;

    // Toast Notification System
    window.showToast = function(message, type = 'success') {
        let container = document.getElementById('toast-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toast-container';
            Object.assign(container.style, {
                position: 'fixed',
                bottom: '20px',
                right: '20px',
                zIndex: '9999',
                display: 'flex',
                flexDirection: 'column',
                gap: '10px'
            });
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        Object.assign(toast.style, {
            padding: '12px 20px',
            borderRadius: '8px',
            color: '#fff',
            backgroundColor: type === 'success' ? '#10B981' : '#ef4444',
            boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
            opacity: '0',
            transform: 'translateY(20px)',
            transition: 'all 0.3s ease',
            display: 'flex',
            alignItems: 'center',
            gap: '10px',
            fontFamily: 'Montserrat, sans-serif',
            fontSize: '14px',
            fontWeight: '500'
        });

        const icon = type === 'success' ? '<i class="fa-solid fa-circle-check"></i>' : '<i class="fa-solid fa-circle-exclamation"></i>';
        toast.innerHTML = `${icon} <span>${message}</span>`;
        
        container.appendChild(toast);

        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
        });

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(20px)';
            setTimeout(() => {
                if (toast.parentNode) toast.parentNode.removeChild(toast);
            }, 300);
        }, 3000);
    };

    // --- UI Navigation ---
    const navLinks = document.querySelectorAll('.admin-nav-link');
    const sections = document.querySelectorAll('.admin-section');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            navLinks.forEach(nav => nav.classList.remove('active-link'));
            link.classList.add('active-link');

            sections.forEach(section => {
                section.classList.remove('active-section');
                const list = section.querySelector('.view-list');
                const form = section.querySelector('.view-form');
                if(list && form) {
                    list.style.display = 'block';
                    form.style.display = 'none';
                }
            });

            const targetId = link.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.add('active-section');
                loadSectionData(targetId);
            }
        });
    });

    function setupSectionToggle(sectionId) {
        const section = document.getElementById(sectionId);
        if (!section) return;

        const viewList = section.querySelector('.view-list');
        const viewForm = section.querySelector('.view-form');
        const formEl = viewForm.querySelector('form');
        
        const btnAdd = viewList.querySelector('.btn-add');
        const btnSave = viewForm.querySelector('.btn-save');
        const btnCancel = viewForm.querySelector('.btn-cancel');
        const btnBackIcon = viewForm.querySelector('.btn-back-icon');
        const fileInput = viewForm.querySelector('.file-input');
        const imgPreview = viewForm.querySelector('.img-preview');

        // File Input Preview
        if (fileInput && imgPreview) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    imgPreview.src = URL.createObjectURL(this.files[0]);
                    imgPreview.style.display = 'block';
                } else {
                    imgPreview.style.display = 'none';
                    imgPreview.src = '';
                }
            });
        }

        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                window.currentEditId = null;
                window.currentEditType = null;
                viewList.style.display = 'none';
                viewForm.style.display = 'block';
                viewForm.querySelector('.section-header h3').innerHTML = '<i class="fa-solid fa-arrow-left btn-back-icon"></i> Додати';
                formEl.reset();
                if (imgPreview) {
                    imgPreview.style.display = 'none';
                    imgPreview.src = '';
                }
                window.scrollTo(0, 0);
            });
        }

        const showList = () => {
            viewForm.style.display = 'none';
            viewList.style.display = 'block';
            window.scrollTo(0, 0);
        };

        if (btnCancel) btnCancel.addEventListener('click', showList);

        // Use event delegation — the back icon gets replaced by innerHTML on each open,
        // so we listen on the stable parent (viewForm) instead
        viewForm.addEventListener('click', (e) => {
            if (e.target.classList.contains('btn-back-icon') || e.target.closest('.btn-back-icon')) {
                showList();
            }
        });
        
        // Setup Form Save
        if (btnSave) {
            btnSave.addEventListener('click', async (e) => {
                e.preventDefault();
                if (!formEl.reportValidity()) {
                    return;
                }

                const originalText = btnSave.innerHTML;
                btnSave.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Збереження...';
                btnSave.disabled = true;

                const success = await saveSectionData(sectionId, formEl);
                
                btnSave.innerHTML = originalText;
                btnSave.disabled = false;
                
                if (success !== false) {
                    showList();
                }
            });
        }
    }

    setupSectionToggle('menu');
    setupSectionToggle('news');
    setupSectionToggle('promo');
    setupSectionToggle('categories');

    // --- Helpers ---
    function formatDate(dateStr) {
        if (!dateStr) return null;
        const d = new Date(dateStr);
        if (isNaN(d)) return dateStr;
        return d.toLocaleDateString('uk-UA', { day: '2-digit', month: '2-digit', year: 'numeric' });
    }

    // --- Data Fetching & Rendering ---
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function fetchData(endpoint) {
        const res = await fetch(endpoint);
        return await res.json();
    }

    async function submitFormData(endpoint, formData) {
        const res = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: formData
        });
        const json = await res.json();
        if (!res.ok) {
            showToast(json.message || JSON.stringify(json.errors) || 'Сталася помилка при збереженні', 'error');
            throw new Error('API Error');
        }
        return json;
    }

    async function deleteData(endpoint) {
        const res = await fetch(endpoint, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });
        if (!res.ok) {
            showToast('Помилка видалення', 'error');
            throw new Error('API Error');
        }
    }

    window.deleteItem = async function(type, id) {
        if(confirm('Ви впевнені, що хочете видалити цей елемент?')) {
            try {
                await deleteData(`/api/admin/${type}/${id}`);
                showToast('Успішно видалено!', 'success');
                loadSectionData(type);
            } catch (e) { console.error(e); }
        }
    }

    window.editItem = function(type, id) {
        const item = window.appData[type].find(i => i.id === id);
        if(!item) return;

        window.currentEditId = id;
        window.currentEditType = type;

        const section = document.getElementById(type);
        const viewList = section.querySelector('.view-list');
        const viewForm = section.querySelector('.view-form');
        const form = viewForm.querySelector('form');
        const inputs = form.querySelectorAll('input:not([type="file"]), select, textarea');
        const imgPreview = viewForm.querySelector('.img-preview');

        viewForm.querySelector('.section-header h3').innerHTML = '<i class="fa-solid fa-arrow-left btn-back-icon"></i> Редагувати';

        if (imgPreview) {
            if (item.image_url) {
                imgPreview.src = item.image_url;
                imgPreview.style.display = 'block';
            } else {
                imgPreview.src = '';
                imgPreview.style.display = 'none';
            }
        }

        if (type === 'menu') {
            inputs[0].value = item.name || ''; // Name
            if (item.category_id && item.category_id <= inputs[1].options.length) {
                inputs[1].selectedIndex = item.category_id - 1; // Category
            }
            inputs[2].value = item.price_uah || 0; // Price
            inputs[3].value = item.description || ''; // Description
            Array.from(inputs[4].options).forEach((opt, idx) => {
                if (opt.value === item.tag) inputs[4].selectedIndex = idx;
            });
        } else if (type === 'news') {
            inputs[0].value = item.title || '';
            inputs[1].value = item.description || '';
            inputs[2].value = item.start_date || '';
            inputs[3].value = item.end_date || '';
        } else if (type === 'promo') {
            inputs[0].value = item.title || '';
            inputs[1].value = item.description || '';
            inputs[2].value = item.discount_percent || '';
            inputs[3].value = item.valid_until ? item.valid_until.split('T')[0] : '';
        } else if (type === 'categories') {
            inputs[0].value = item.name || '';
        }

        viewList.style.display = 'none';
        viewForm.style.display = 'block';
        window.scrollTo(0, 0);
    }

    async function loadSectionData(type) {
        if (type === 'menu') {
            const items = await fetchData('/api/admin/menu');
            window.appData.menu = items;
            
            // Sync categories into the select dropdowns dynamically!
            const categories = await fetchData('/api/admin/categories');
            window.appData.categories = categories;
            const catSelect = document.querySelector('#menu-form select:nth-of-type(1)');
            if (catSelect) {
                catSelect.innerHTML = categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
            }

            const filterSelect = document.querySelector('#menu .filter-box select');
            if (filterSelect) {
                filterSelect.innerHTML = `<option value="all">Всі категорії</option>` + 
                    categories.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
            }

            const container = document.querySelector('#menu .admin-list');
            container.innerHTML = '';
            items.forEach(item => {
                container.innerHTML += `
                    <div class="admin-card-row" data-category-id="${item.category_id}">
                        <img src="${item.image_url || '/img/placeholder.png'}" alt="${item.name}">
                        <div class="row-info">
                            <h4>${item.name}</h4>
                            <span class="row-category">${item.category ? item.category.name : 'Без категорії'}</span>
                            <p>${item.description || ''}</p>
                            <div class="row-meta"><small>Створено</small></div>
                        </div>
                        <div class="row-price">${item.price_uah} ₴ ${item.tag ? `<span class="tag-blue">${item.tag}</span>` : ''}</div>
                        <div class="row-actions">
                            <button class="btn-icon edit" onclick="editItem('menu', ${item.id})"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-icon delete" onclick="deleteItem('menu', ${item.id})"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                `;
            });

            // Wire up filter — runs every time after render
            if (filterSelect) {
                // Remove old listener if any
                const newFilter = filterSelect.cloneNode(true);
                filterSelect.parentNode.replaceChild(newFilter, filterSelect);

                newFilter.addEventListener('change', () => {
                    const selectedId = newFilter.value;
                    const cards = container.querySelectorAll('.admin-card-row');
                    cards.forEach(card => {
                        if (selectedId === 'all' || card.dataset.categoryId === selectedId) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }
        } else if (type === 'news') {
            const items = await fetchData('/api/admin/news');
            window.appData.news = items;
            const container = document.querySelector('#news .admin-list');
            container.innerHTML = '';
            items.forEach(item => {
                let badgeHTML = '<span class="status-badge active">Активна</span>';
                if (item.end_date) {
                    const today = new Date();
                    today.setHours(0,0,0,0);
                    const validDate = new Date(item.end_date);
                    if (validDate < today) {
                        badgeHTML = '<span class="status-badge inactive" style="background:gray;">Завершена</span>';
                    }
                }
                container.innerHTML += `
                    <div class="admin-card-row">
                        <img src="${item.image_url || '/img/placeholder.png'}" alt="News">
                        <div class="row-info">
                            <div class="flex-head">
                                <h4>${item.title}</h4>
                                ${badgeHTML}
                            </div>
                            <span class="row-category">${item.type}</span>
                            <p>${item.description || ''}</p>
                            <div class="row-meta"><small>${item.start_date ? 'З ' + formatDate(item.start_date) : ''} ${item.end_date ? 'по ' + formatDate(item.end_date) : ''}</small></div>
                        </div>
                        <div class="row-actions">
                            <button class="btn-icon edit" onclick="editItem('news', ${item.id})"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-icon delete" onclick="deleteItem('news', ${item.id})"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                `;
            });
        } else if (type === 'promo') {
            const items = await fetchData('/api/admin/promos');
            window.appData.promos = items;
            const container = document.querySelector('#promo .admin-list');
            container.innerHTML = '';
            items.forEach(item => {
                let badgeHTML = '<span class="status-badge active">Активна</span>';
                if (item.valid_until) {
                    const today = new Date();
                    today.setHours(0,0,0,0);
                    const validDate = new Date(item.valid_until);
                    if (validDate < today) {
                        badgeHTML = '<span class="status-badge inactive" style="background:gray;">Неактивна</span>';
                    }
                }
                container.innerHTML += `
                    <div class="admin-card-row">
                        <img src="${item.image_url || '/img/placeholder.png'}" alt="Promo">
                        <div class="row-info">
                            <div class="flex-head">
                                <h4>${item.title}</h4>
                                ${badgeHTML}
                            </div>
                            <p>${item.description || ''}</p>
                            <div class="promo-details">
                                <span class="promo-date">Діє до: ${formatDate(item.valid_until) || 'Постійно'}</span>
                            </div>
                        </div>
                        <div class="row-actions-promo">
                            <button class="btn-icon edit" onclick="editItem('promo', ${item.id})"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-icon delete" onclick="deleteItem('promos', ${item.id})"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                `;
            });
        } else if (type === 'categories') {
            const items = await fetchData('/api/admin/categories');
            window.appData.categories = items;
            const container = document.querySelector('#categories .categories-grid');
            container.innerHTML = '';
            items.forEach(item => {
                container.innerHTML += `
                    <div class="category-card" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h4>${item.name}</h4>
                        </div>
                        <div>
                            <button class="btn-icon edit-simple" style="margin-right: 5px;" onclick="editItem('categories', ${item.id})"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-icon delete" style="color: #ef4444;" onclick="deleteItem('categories', ${item.id})"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                `;
            });
        } else if (type === 'feedbacks') {
            const items = await fetchData('/api/admin/feedbacks');
            window.appData.feedbacks = items;
            const container = document.getElementById('feedbacks-list');
            if (!items.length) {
                container.innerHTML = '<p style="text-align:center;color:#888;padding:32px;">Відгуків ще немає.</p>';
                return;
            }
            container.innerHTML = `
                <table style="width:100%;border-collapse:collapse;font-size:14px;">
                    <thead>
                        <tr style="background:#f1f5f9;text-align:left;">
                            <th style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">Дата</th>
                            <th style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">Ім'я</th>
                            <th style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">Email</th>
                            <th style="padding:12px 16px;border-bottom:1px solid #e2e8f0;">Повідомлення</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${items.map(f => `
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:12px 16px;white-space:nowrap;color:#64748b;">${new Date(f.created_at).toLocaleString('uk-UA')}</td>
                                <td style="padding:12px 16px;font-weight:500;">${f.name || '<span style="color:#aaa">—</span>'}</td>
                                <td style="padding:12px 16px;color:#3b82f6;">${f.email ? `<a href="mailto:${f.email}" style="color:#3b82f6;">${f.email}</a>` : '<span style="color:#aaa">—</span>'}</td>
                                <td style="padding:12px 16px;">${f.message}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        }
    }

    async function saveSectionData(type, form) {
        const inputs = form.querySelectorAll('input:not([type="file"]), select, textarea');
        const fileInput = form.querySelector('input[type="file"]');
        const formData = new FormData();
        
        let endpoint = `/api/admin/${type === 'promo' ? 'promos' : type}`;
        const isUpdate = (window.currentEditId !== null && window.currentEditType === type);
        
        if (isUpdate) {
            endpoint += `/${window.currentEditId}`;
        }

        try {
            if (fileInput && fileInput.files[0]) {
                if (fileInput.files[0].size > 2 * 1024 * 1024) {
                    showToast('Файл занадто великий! Розмір фото має бути до 2МБ.', 'error');
                    return false;
                }
            }

            if (type === 'menu') {
                formData.append('name', inputs[0].value);
                const val = inputs[1].value;
                if(!val) {
                    showToast('Помилка: Немає категорій. Створіть категорію спочатку.', 'error');
                    return false;
                }
                formData.append('category_id', val); 
                formData.append('price_uah', parseFloat(inputs[2].value) || 0);
                formData.append('description', inputs[3].value);
                formData.append('tag', inputs[4].value !== 'Без тегу' ? inputs[4].value : '');
                if (fileInput && fileInput.files[0]) {
                    formData.append('image', fileInput.files[0]);
                }
            } else if (type === 'news') {
                formData.append('title', inputs[0].value);
                formData.append('description', inputs[1].value);
                
                const startDate = inputs[2].value;
                const endDate = inputs[3].value;
                
                if (startDate && endDate) {
                    if (new Date(startDate) > new Date(endDate)) {
                        showToast('Помилка: Дата початку події не може бути пізніше за дату завершення!', 'error');
                        return false;
                    }
                }
                if (startDate) formData.append('start_date', startDate);
                if (endDate) formData.append('end_date', endDate);
                
                if (fileInput && fileInput.files[0]) {
                    formData.append('image', fileInput.files[0]);
                }
            } else if (type === 'promo') {
                formData.append('title', inputs[0].value);
                formData.append('description', inputs[1].value);
                formData.append('discount_percent', inputs[2].value);
                
                const startDate = inputs[3].value;
                const endDate = inputs[4].value;
                
                if (startDate && endDate) {
                    if (new Date(startDate) > new Date(endDate)) {
                        showToast('Помилка: Дата початку не може бути пізніше за дату завершення!', 'error');
                        return false;
                    }
                }
                
                if (endDate) formData.append('valid_until', endDate);
                if (fileInput && fileInput.files[0]) {
                    formData.append('image', fileInput.files[0]);
                }
            } else if (type === 'categories') {
                formData.append('name', inputs[0].value);
                if (fileInput && fileInput.files[0]) {
                    formData.append('image', fileInput.files[0]);
                }
            }
            
            await submitFormData(endpoint, formData);
            showToast('Успішно збережено!', 'success');
        } catch (e) {
            console.error(e);
            return false;
        }
        
        window.currentEditId = null;
        window.currentEditType = null;
        loadSectionData(type);
        return true;
    }

    setTimeout(() => {
        loadSectionData('menu');
    }, 100);

});