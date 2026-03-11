document.addEventListener('DOMContentLoaded', () => {
    
    const modal = document.getElementById('productModal');
    const closeBtn = document.querySelector('.close-btn');
    
    const productCards = document.querySelectorAll('.menu-item-card');

    const modalImg = document.getElementById('modalImg');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalCalories = document.getElementById('modalCalories');

    function openModal(card) {
        const img = card.querySelector('img').src;
        const title = card.querySelector('h4').innerText;
        
        const descEl = card.querySelector('.description');
        const desc = descEl ? descEl.innerText : '';
        const calEl = card.querySelector('.calories');
        const cal = calEl ? calEl.innerText : '';

        if(modalImg) modalImg.src = img;
        if(modalTitle) modalTitle.innerText = title;
        if(modalDesc) modalDesc.innerText = desc;
        if(modalCalories) modalCalories.innerText = cal;

        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }

    productCards.forEach(card => {
        card.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(card);
        });
    });

    if(closeBtn) closeBtn.addEventListener('click', closeModal);

    window.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    const tabs = document.querySelectorAll('.catalog-tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault(); 

            tabs.forEach(t => t.classList.remove('active-category'));
            
            tab.classList.add('active-category');

            const targetId = tab.getAttribute('data-tab');

            contents.forEach(content => {
                content.classList.remove('active-content');
            });

            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.add('active-content');
            }
        });
    });

});