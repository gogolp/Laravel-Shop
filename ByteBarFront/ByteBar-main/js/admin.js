document.addEventListener('DOMContentLoaded', () => {
    
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
            }
        });
    });

    setupSectionToggle('menu');
    setupSectionToggle('news');
    setupSectionToggle('promo');

    function setupSectionToggle(sectionId) {
        const section = document.getElementById(sectionId);
        if (!section) return;

        const viewList = section.querySelector('.view-list');
        const viewForm = section.querySelector('.view-form');
        
        const btnAdd = viewList.querySelector('.btn-add');
        const btnSave = viewForm.querySelector('.btn-save');
        const btnCancel = viewForm.querySelector('.btn-cancel');
        const btnBackIcon = viewForm.querySelector('.btn-back-icon');

        if (btnAdd) {
            btnAdd.addEventListener('click', () => {
                viewList.style.display = 'none';
                viewForm.style.display = 'block';
                window.scrollTo(0, 0);
            });
        }

        const showList = () => {
            viewForm.style.display = 'none';
            viewList.style.display = 'block';
            window.scrollTo(0, 0);
        };

        if (btnCancel) btnCancel.addEventListener('click', showList);
        if (btnSave) btnSave.addEventListener('click', showList);
        if (btnBackIcon) btnBackIcon.addEventListener('click', showList);
    }

});